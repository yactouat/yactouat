<!doctype html>

<head>
    <title>yactouat.com | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/71848dd692.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>

<body style="font-family: Open Sans, sans-serif">
    @include('partials._nav')

    <section class="px-6 py-8">

        <header class="max-w-xl mx-auto mt-12 text-center">
            <div class="flex justify-center">
                <div class="rounded-full bg-gray-200 w-32 h-32 flex items-center justify-center">
                    <img src="/logo.png" alt="Logo" class="w-32 h-32">
                </div>
            </div>
            <h1 class="text-4xl">
                <x-link href="/">yactouat.com</x-link>
            </h1>
            <!-- TODO implement profile pics -->
            <!-- <h2 class="inline-flex mt-2">By Lary Laracore <img src="/images/lary-head.svg"
                                                                alt="Head of Lary the mascot"></h2> -->
            
            <section class="max-w-6xl mx-auto px-6 py-8">
                <div class="text-center">
                    <p class="text-gray-600 mb-6">by Yacine Touati, IT consultant / web development mentor</p>
                </div>

                <div class="mb-8">
                    <p class="text-gray-600">I'm a generalist software developer who is driven by curiosity, positivity, and a can-do attitude; I like to design full stack solutions with various technologies, my objective is to solve problems with code</p>
                </div>

                <div class="text-center mb-8">
                    <h3 class="text-3xl font-semibold mb-4">contact me</h3>
                    <p class="text-gray-600">have questions? <x-link href="#app-contact">get in touch!</x-link></p>
                </div>

                <div class="text-center">
                    <p class="text-gray-600">in the meanwhile, please do browse my content! it is regulary updated</p>
                </div>
            </section>

            @yield('filters')

        </header>

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6 min-h-screen">
            @yield('content')
        </main>

        @include('partials._footer')
    </section>

    @vite('resources/js/app.js')

    @include('partials._toasts')
</body>
