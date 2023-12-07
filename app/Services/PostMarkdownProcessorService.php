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
        $post->published_at = isset($md['meta']['published_at']) ? $md['meta']['published_at'] : null;
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
}