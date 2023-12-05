<!doctype html>

<head>
    <title>yactouat.com | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/71848dd692.js" crossorigin="anonymous"></script>
</head>

<body style="font-family: Open Sans, sans-serif">
    @include('partials._nav')

    <section class="px-6 py-8">

        <main class="max-w-7xl mx-auto mt-10 lg:mt-20 space-y-6 min-h-screen">
            @yield('content')
        </main>

        @include('partials._footer')
    </section>

    @vite('resources/js/app.js')

    @include('partials._toasts')

</body>
