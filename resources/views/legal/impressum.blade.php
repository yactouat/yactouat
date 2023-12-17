@extends('components.layout')

@section('title', 'impressum')

@section('meta')
    <meta name="description" content="impressum of yactouat.com">
    <meta name="keywords" content="legal, impressum">
    <!-- OpenGraph Tags -->
    <meta property="og:title" content="yactouat.com | impressum">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ url('/') }}/logo.png">
    <meta property="og:url" content="{{ url('/') }}/impressum">
    <meta property="og:description" content="impressum of yactouat.com">
    <!-- Twitter Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="yactouat.com | impressum">
    <meta name="twitter:description" content="impressum of yactouat.com">
    <meta name="twitter:image" content="{{ url('/') }}/logo.png">
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-xl font-semibold mb-4">Impressum</h1>
        <p class="mb-4">This impressum provides required legal information about yactouat.com, a blog focused on software development and thoughts around working in the tech industry.</p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Owner</h2>
        <p>Yacine Touati<br>Strasbourg 67000 France</p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Contact Information</h2>
        <p>Email: <a href="mailto:{{ config('mail.reply_to.address') }}" class="text-gray-500 underline">{{ config("mail.reply_to.address") }}</a></p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Responsible for Content</h2>
        <p>Yacine Touati, <a href="mailto:{{ config('mail.reply_to.address') }}" class="text-gray-500 underline">{{ config("mail.reply_to.address") }}</a></p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Additional Information</h2>
        <p><br>SIRET Number: 85370939200015</p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Disclaimer</h2>
        <p>Despite careful content control, we assume no liability for the content of external links. The content of linked pages is the sole responsibility of their operators. All content is provided for general information and is not intended as professional advice.</p>

        <h2 class="text-lg font-semibold mt-6 mb-2">Copyright Notice</h2>
        <p>All rights reserved. Unauthorized copying, distribution, presentation, or use of this content is prohibited without prior written permission from Yacine Touati.</p>
    </div>    
@endsection
