<!doctype html>

<head>
    <title>yactouat.com | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    </noscript>
    <!-- Font Awesome -->
    <script defer src="https://kit.fontawesome.com/71848dd692.js" crossorigin="anonymous"></script>
    <!-- custom scrollbar loaded asynchronously as explained in https://web.dev/articles/defer-non-critical-css?hl=en -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    </noscript>
    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <!-- ridiculous cookie consent banner -->
    <link rel="preload" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css">
    </noscript>
    <!-- application styles -->
    @vite('resources/css/app.css')
</head>

<body style="font-family: Open Sans, sans-serif">
    @include('partials._nav')
    
    <section class="px-6 py-8">
        
        <header class="max-w-xl mx-auto mt-12 text-center">
            <div class="flex flex-col justify-center items-center">
                <div class="rounded-full bg-gray-200 w-32 h-32 flex flex-col items-center justify-center">
                    <img 
                    alt="yactouat.comm logo (ai generated image content)"
                    class="w-32 h-32"
                    src="/logo.webp"> 
                </div>
            </div>
            <h1 class="text-4xl">
                <x-link href="/">yactouat.com</x-link>
            </h1>
            <!-- TODO implement profile pics -->
            <!-- <h2 class="inline-flex mt-2">By Lary Laracore <img src="/images/lary-head.svg"
            alt="Head of Lary the mascot"></h2> -->
            
            @yield('header')
            
            @yield('filters')
            
        </header>
        
        <main class="max-w-7xl mx-auto mt-6 lg:mt-20 space-y-6 min-h-screen">
            @yield('content')
        </main>
        
        @include('partials._footer')
    </section>
    
    <script defer src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <x-cookie-consent />
    @vite('resources/js/app.js')
    
    @include('partials._toasts')
</body>
