@extends('components.layout')

@section('title', 'posts')

@section('filters')
    @include('post._filters')
@endsection

@section('content')
    @if ($posts->count())
        <x-featured-post-card :post="$posts[0]" />
        @if ($posts->count() > 1)
            <x-posts-grid :posts="$posts" />
            <div class="flex justify-center">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <p class="text-center">no content to show yet, but please do come back later!</p>
    @endif
@endsection
