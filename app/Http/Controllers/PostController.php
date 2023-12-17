<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{

    public function create() {
        return view('post.create');
    }

    public function index() {
        $posts = Cache::remember("posts", config('cache.content_cache_duration'), function() { 
            return Post::latest()->with('tags', 'author')->paginate(9);
        });
        if(request('search') || request('tag') || request('author') || request('page')) {
            $posts = Post::latest()
                ->filter(request(['search', 'tag', 'author']))
                ->with('tags', 'author')
                ->paginate(9)->withQueryString();
        }
        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post) {
        if (!$post) {
            abort(404);
        }
        $persistedSignedRoute = null;
        if (request()->has('signature')) {
            // check if instance of signed route
            $signedRouteService = resolve('SignedRouteService');
            $persistedSignedRoute = $signedRouteService->fetch(request());
            if($persistedSignedRoute) {
                $signedRouteService->consume($persistedSignedRoute);
            }
        }
        else {
            $post = Cache::remember("posts.{$post->slug}", config('cache.content_cache_duration'), function () use ($post) {
                return $post->load(['tags', 'author']);
            });
        }
        return view('post.show', [
            'author' => $post->author,
            'post' => $post,
            'tags' => $post->tags
        ]);
    }

}
