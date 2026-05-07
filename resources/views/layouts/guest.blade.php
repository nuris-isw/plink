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
    <body class="font-sans antialiased bg-gray-light/40 text-dark">

        <div class="relative min-h-screen flex flex-col justify-center items-center px-4 py-10 overflow-hidden">

            <!-- BACKGROUND DECORATION -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-0 w-72 h-72 bg-brand-red opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand-red-dark opacity-10 rounded-full blur-3xl"></div>
            </div>

            <!-- LOGO -->
            <div class="relative mb-6">
                <a href="/" class="group">
                    <div class="flex items-center justify-center w-24 h-24 rounded-3xl bg-white border border-gray-light shadow-xl transition duration-300 group-hover:shadow-2xl">
                        <x-application-logo class="w-14 h-14 fill-current text-brand-red" />
                    </div>
                </a>
            </div>

            <!-- CARD -->
            <div class="relative w-full sm:max-w-md overflow-hidden rounded-3xl border border-gray-light bg-white px-6 py-8 shadow-2xl">

                <!-- TOP ACCENT -->
                <div class="absolute inset-x-0 top-0 h-1 bg-brand-red"></div>

                {{ $slot }}
            </div>

        </div>

    </body>
</html>
