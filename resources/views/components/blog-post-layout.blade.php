<!doctype html>

<html lang="en">
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
        <!-- highlight.js -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
        <!-- ridiculous cookie consent banner -->
        <link rel="preload" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.9.2/dist/cookieconsent.css">
        </noscript>
        <!-- application styles -->
        @vite('resources/css/app.css')
    </head>

    <body style="font-family: Open Sans, sans-serif" class="w-full" id="app-blog-post-body">
        @include('partials._nav')

        <main class="px-6 py-8">

            <section class="max-w-7xl max-md:w-full mx-auto mt-10 lg:mt-20 space-y-6 min-h-screen">
                @yield('content')
            </section>

            @include('partials._footer')
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/markdown.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/php.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/python.min.js"></script>
        <script>
            hljs.highlightAll();
        </script>
        <script defer src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
        <x-cookie-consent />
        @vite('resources/js/app.js')

        @include('partials._toasts')

    </body>
</html>
