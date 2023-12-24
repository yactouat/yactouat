@extends('components.layout')

@section('title', 'blog')

@section('meta')
    @php
        $description = "home of yactouat.com, the developer website and blog of Yacine Touati about AI, software development, and tech in general!";
    @endphp
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="software, AI, developer, blog, tech">
    <!-- OpenGraph Tags -->
    <meta property="og:title" content="yactouat.com | blog">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ url('/') }}/logo.webp">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{ $description }}">
    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="yactouat.com | blog">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/') }}/logo.webp">
@endsection

@section('header')
<section class="max-w-6xl mx-auto px-6 py-8">
    <div class="text-center">
        <p class="text-gray-600 mb-6">by Yacine Touati, IT consultant / web development mentor</p>
    </div>

    <div class="mb-8">
        <p class="text-gray-600">I'm a generalist software developer who is driven by curiosity, positivity, and a can-do attitude; I like to design full stack solutions with various technologies, my objective is to solve problems with code</p>
    </div>

    <div class="text-center mb-8">
        <h2 class="text-3xl font-semibold mb-4">contact me</h2>
        <p class="text-gray-600">have questions? <x-link href="#app-contact">get in touch!</x-link></p>
    </div>

    <div class="text-center">
        <p class="text-gray-600">in the meanwhile, please do browse my content! it is regulary updated</p>
    </div>
</section>
@endsection

@section('filters')
    @include('post._filters')
@endsection

@section('content')
    @if ($posts->count())
            <x-featured-post-card :post="$posts[0]" />
            <x-posts-grid :posts="$posts" />
            <div class="flex justify-center">
                {{ $posts->links() }}
            </div>
    @else
        <p class="text-center">no content to show yet, but please do come back later!</p>
    @endif
@endsection
