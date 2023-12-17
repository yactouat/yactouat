@extends('components.layout')

@section('title', 'forgot password')

@section('meta')
    @php
        $description = "forgot password for your yactouat.com account ? don't worry, we got you covered!";
    @endphp
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="software, developer, blog, tech, account">
    <!-- OpenGraph Tags -->
    <meta property="og:title" content="yactouat.com | forgot password">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ url('/') }}/logo.png">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{ $description }}">
    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="yactouat.com | forgot password">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/') }}/logo.png">
@endsection

@section('content')
    <section class="px-6 py-8 max-md:px-0">
        <x-panel
            class="max-w-lg mx-auto my-10 bg-gray-200 max-md:w-full"
        >
            <h2 class="text-center font-bold text-xl">forgot password</h2>
            <form method="post" action="/forgot-password" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-10">
                @csrf
                <x-form-email-input name="email" required="{{ true }}" />
                <div class="flex items-center justify-between">
                    <x-button 
                        type="submit"
                    >
                        email password reset link
                    </x-button>
                </div>
            </form>
        </x-panel>
    </section>
@endsection
