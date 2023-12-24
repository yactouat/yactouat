@extends('components.blog-post-layout')

@section('title', $post->title)

@section('meta')
    <meta name="description" content="{{ $post->excerpt }}">
    @php
        $tags_unioned = $post->tags->map(function($tag) {
            return $tag->name;
        })->join(', ');
    @endphp
    <meta name="keywords" content="{{ $tags_unioned }}">
    <!-- OpenGraph Tags -->
    <meta property="og:title" content="yactouat.com | {{ $post->title }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ $post->thumbnail_img_web }}">
    <meta property="og:url" content="{{ url('/') . '/posts/' . $post->slug }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="yactouat.com | {{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt }}">
    <meta name="twitter:image" content="{{ $post->thumbnail_img_web }}">
@endsection

@section('filters')
    @include('post._filters')
@endsection

@section('content')
    <article class="max-full mx-auto lg:grid lg:grid-cols-12 gap-x-10 article-height">
        <div class="col-span-12">
            <div
                class="flex flex-col justify-center items-center"
            >
                <img 
                    alt="{{ $post->thumbnail_img_alt }}" 
                    id="post-thumbnail"
                    src="{{ $post->thumbnail_img_web }}" >
                @if($post->thumbnail_ai_generated)
                    <x-ai-generated-illustration class="self-center"/>
                @else
                    <p class="text-xs text-gray-500 my-2">{{ $post->thumbnail_img_alt }}</p>
                @endif
                <p class="block text-gray-500 text-xs text-center self-start my-2">
                    published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>        
            </div>

            <div class="flex items-center lg:justify-start text-sm my-4">
                <!-- TODO implement profile pic -->
                <!-- <img src="/images/lary-avatar.svg" alt="Lary avatar"> -->
                <div class="text-left my-2">
                    <h5 class="font-bold">by <x-link href="/?author={{ $post->author->username }}">{{ $post->author->name }}</x-link></h5>
                    <!-- TODO implement user public title -->
                    <!-- <h6>Mascot at Laracasts</h6> -->
                </div>
            </div>
            <div class="lg:flex justify-between mb-6">
                <x-link
                    href="/"
                    class="relative inline-flex items-center text-lg"
                >
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    back to posts                    
                </x-link>

                <div class="space-x-2">
                    <x-tag-links :tags="$post->tags" />
                </div>

            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{ $post->title }}
            </h1>

            <section class="space-y-4 lg:text-lg leading-loose" id="post-body">
                {!! $post->body !!}
            </section>
        </div>
    </article>

    <x-hr/>

    <section 
        id="post-comments"
        class="max-w-4xl mx-auto flex flex-col mt-10 space-y-3 post-comments"
    >
        @include('post._add-comment-form')

        @foreach ($post->comments->sortByDesc('updated_at') as $comment)
            <x-post-comment :comment="$comment" />
        @endforeach
    </section>
@endsection