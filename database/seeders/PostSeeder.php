<?php

namespace Database\Seeders;

use App\Mail\PostAuthored;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\PostMarkdownProcessorService;
use App\Services\RemoteUrlService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{

    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get authored posts that are in disk
        $authoredPosts = collect(File::files(base_path('content/posts')))
            ->map(function ($file) {
                $mdFileName = $file->getFilename();
                $slug = str_replace('.md', '', $mdFileName);
                return $slug;
            });
        // get all posts from db
        $postsInDb = Post::all();
        // initialize a new posts collection
        $newPosts = collect([]);
        collect(File::files(base_path('content/posts')))
            ->map(function ($file) use ($newPosts) {
                $mdFileContents = $file->getContents();
                $mdFileName = $file->getFilename();
                $postData = PostMarkdownProcessorService::getPostFromMdFile($mdFileContents, $mdFileName);
                if ($postData === null) {
                    return null;
                }
                $postToSave = $postData['post'];

                // check if post exists
                $postInDb = Post::where('slug', $postToSave->slug)->first();
                $postHasChanged = false;
                $postExists = $postInDb != null;
                if($postExists) 
                {
                    // if exists check if has changed
                    $postHasChanged = $postToSave->body !== $postInDb->body || $postToSave->excerpt !== $postInDb->excerpt || $postToSave->title !== $postInDb->title;
                }
                // process tags
                $tags = collect($postData['tags'])
                    ->map(function ($tag) {
                        return Tag::where('name', $tag)->first();
                    });
                $tagsHaveChanged= $postInDb != null ? $postInDb->tags->count() !== $tags->count()
                    || $postInDb->tags->diff($tags)->count() !== 0 : true;
                // if has not changed after the checks do nothing
                if($postExists && !$postHasChanged && !$tagsHaveChanged) 
                {
                    return null;
                }
                // push thumbnail to storage
                if($postToSave->thumbnail_img != null) 
                {
                    Storage::disk('gcp_public')
                        ->put(
                            RemoteUrlService::prefix() . 'images/' . $postToSave->thumbnail_img, 
                            file_get_contents(base_path('content/images') . '/' . $postToSave->thumbnail_img)
                        );
                    $postToSave->thumbnail_img = RemoteUrlService::get(RemoteUrlService::prefix() . 'images/' . $postToSave->thumbnail_img);
                } 
                else 
                {
                    $postToSave->thumbnail_img = "/images/blog-post-thumbnail-placeholder.png";
                }
                // first save without tags
                if(!$postExists) {
                    $postToSave->save();
                }
                if($postExists && $postHasChanged) {
                    $postInDb->body = $postToSave->body;
                    $postInDb->excerpt = $postToSave->excerpt;
                    $postInDb->title = $postToSave->title;
                    $postInDb->thumbnail_img = $postToSave->thumbnail_img;
                    $postInDb->updated_at = now();
                    $postInDb->save();
                }
                // then save tags
                if ($tagsHaveChanged) {
                    $postInDb = Post::where('slug', $postToSave->slug)->first();
                    $postInDb->tags()->detach();
                    $tags->each(function ($tag) use ($postInDb) {
                        $postInDb->tags()->attach($tag->id);
                    });
                    $postInDb->updated_at = now();
                    $postInDb->save();
                    if(!$postExists)
                    {
                        // add to new posts collection
                        $newPosts->push($postInDb);
                    }
                }
            });
        // get db posts that are no longer authored
        $noLongerAuthored = $postsInDb->filter(function ($post) use ($authoredPosts) {
            return !$authoredPosts->contains($post->slug);
        });
        // delete posts that are no longer authored
        $noLongerAuthored->each(function ($post) {
            $post->delete();
        });
        // get last of new posts
        $lastPost = $newPosts->sortByDesc('created_at')->first();
        // get users who are subscribed to new posts notifications
        $subscribers = User::where('notify_on_blog_post', true)->get();
        // send email to subscribers
        $subscribers->each(function ($subscriber) use ($lastPost) {
            if($lastPost == null) {
                return;
            }
            $signedRouteService = resolve('SignedRouteService');
            $unsubscribeUrl = $signedRouteService->persist($subscriber->id, 'unsubscribe-from-emails');
            $authedUrl = $signedRouteService->persist($subscriber->id, 'post', 'post', $lastPost->slug);
            Mail::mailer('sendgrid')->to($subscriber->email)->send(
                new PostAuthored(
                    $unsubscribeUrl,
                    $subscriber,
                    $lastPost,
                    $authedUrl
                )
            );
        });
    }
}
