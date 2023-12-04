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
        $posts = Cache::rememberForever("posts", function() { 
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
        // check if instance of signed route
        $signedRouteService = resolve('SignedRouteService');
        $persistedSignedRoute = $signedRouteService->fetch(request());
        if($persistedSignedRoute) {
            $signedRouteService->consume($persistedSignedRoute);
        }
        $cachedPost = Cache::rememberForever("posts.{$post->slug}", function () use ($post) {
            return $post->load(['tags', 'author']);
        });
        return view('post.show', [
            'author' => $cachedPost->author,
            'post' => $cachedPost,
            'tags' => $cachedPost->tags
        ]);
    }

}
