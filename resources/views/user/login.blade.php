@extends('components.layout')

@section('title', 'login')

@section('meta')
    @php
        $description = "login to yactouat.com, the developer website and blog of Yacine Touati about AI, software development, and tech in general!";
    @endphp
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="software, AI, developer, blog, tech">
    <!-- OpenGraph Tags -->
    <meta property="og:title" content="yactouat.com | login">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ url('/') }}/logo.png">
    <meta property="og:url" content="{{ url('/login') }}">
    <meta property="og:description" content="{{ $description }}">
    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="yactouat.com | login">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/') }}/logo.png">
@endsection

@section('content')
    <section class="px-6 py-8 max-md:px-0">
        <x-panel
            class="max-w-lg mx-auto my-10 bg-gray-200 max-md:w-full"
        >
            <h2 class="text-center font-bold text-xl">login</h2>
            <form method="post" action="/login" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-10">
                @csrf
                <x-form-email-input name="email" required="{{ true }}" />
                <x-form-password-input name="password" required="{{ true }}" autocomplete="current-password"/>
                <div class="flex items-center justify-between">
                    <x-button 
                        type="submit"
                    >
                        login
                    </x-button>
                </div>
            </form>
            <x-small>
                <x-link href="/forgot-password">forgot password?</x-link>
            </x-small>
        </x-panel>
    </section>
@endsection
