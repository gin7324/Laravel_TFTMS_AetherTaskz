<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex min-h-screen flex-col bg-gray-100">
            <div class="flex flex-1 flex-col items-center justify-center px-4 py-8">
                <div>
                    <a href="/">
                        <span class="brand-wordmark text-2xl font-extrabold tracking-tight text-gray-950">{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="mt-6 w-full border border-gray-300 bg-white px-6 py-6 shadow-xl sm:max-w-md sm:px-8">
                    {{ $slot }}
                </div>
            </div>
            <footer class="border-t border-gray-300 bg-white">
                <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-5 text-center text-xs text-gray-600 sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:text-left lg:px-8">
                    <p>© 2026 AetherWorkz. All Rights Reserved.</p>
                    <p>Developed and maintained by Gene Kenry Peralta.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
