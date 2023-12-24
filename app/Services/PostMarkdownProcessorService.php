<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class PostMarkdownProcessorService
{
    public static function getPostFromMdFile(string $mdFileContents, string $mdFileName): null | array
    {
        // get meta and contents
        $md = MarkdownRendererService::getMetaAndContent($mdFileContents);
        // getting tags
        $tags = collect(isset($md['meta']['tags']) ? $md['meta']['tags']: []);
        // checking if all required attributes exist
        $body = $md['content'];
        // post process all links so that they have target blank
        $body = str_replace('<a ', '<a target="_blank" ', $body);
        // update local images links with remote links
        $body = self::updateLocalImageLinks($body);
        if(
            !isset($md['meta']['excerpt']) || !isset($md['meta']['title'])
            || count($tags) === 0 || trim($body) === ''
        ) {
            return null;
        }
        $newTagsToInsert = $tags->filter(function ($tag) {
            return !Tag::where('name', $tag)->exists();
        });
        // inserting new tags
        $newTagsToInsert->each(function ($tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'slug' => str_replace(' ', '-', strtolower($tag))
            ]);
        });
        // getting post attributes
        $excerpt = $md['meta']['excerpt'];
        $slug = str_replace('.md', '', $mdFileName);
        $title = $md['meta']['title'];
        $post = new Post();
        $post->body = $body;
        $post->excerpt = $excerpt;
        $post->is_published = isset($md['meta']['is_published']) ? $md['meta']['is_published'] : true;
        if (!$post->is_published) {
            $post->published_at = null;
        } else {
            $post->published_at = isset($md['meta']['published_at']) ? $md['meta']['published_at'] : null;
        }
        $post->slug = $slug;
        $post->thumbnail_ai_generated = isset($md['meta']['thumbnail_ai_generated']) ? $md['meta']['thumbnail_ai_generated'] : true;
        $post->thumbnail_img = isset($md['meta']['thumbnail_img']) ? $md['meta']['thumbnail_img'] : null;
        $post->thumbnail_img_alt = isset($md['meta']['thumbnail_img_alt']) ? $md['meta']['thumbnail_img_alt'] : 'blog post illustration';
        $post->title = $title;
        $post->user_id = User::where('email', env('ADMIN_EMAIL'))->first()->id;
        return [
            'post' => $post,
            'tags' => $tags
        ];
    }

    public static function updateLocalImageLinks(string $body): string
    {
        // put a marker on local images links
        $body = str_replace('<img src="../images/', '<img src="LOCAL_IMAGE', $body);
        // get all images urls within the post body that are saved locally
        preg_match_all('/LOCAL_IMAGE.+\.png/', $body, $matches);
        // flatten the array
        $images_local_links = array_reduce($matches, 'array_merge', array());
        // remove the markers from the image names
        $images_names = array_map(function ($image_local_link) {
            return str_replace('LOCAL_IMAGE', '', $image_local_link);
        }, $images_local_links);
        // remove duplicates
        $images_names = array_unique($images_names);
        // loop through the images urls
        foreach ($images_names as $image_name) {
            // push the image to storage
            $remoteImagesPaths = ImageService::storeOriginalAndWebImages($image_name);
            // replace the local url with the remote url
            $body = str_replace(
                'LOCAL_IMAGE' . $image_name,
                $remoteImagesPaths['remoteWebImagePath'],
                $body
            );
        }
        return $body;
    }
}