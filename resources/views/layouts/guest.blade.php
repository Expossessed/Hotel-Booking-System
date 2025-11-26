<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hotel Bookie') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind & DaisyUI via CDN to match main site theme -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

        <!-- Vite assets (kept in case they are used elsewhere) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100">
        <div class="min-h-screen flex flex-col">
            <nav class="navbar bg-white shadow-md px-6 py-3">
                <div class="flex-1">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-primary">
                        HOTEL BOOKIE
                    </a>
                </div>
                <div class="flex-none space-x-2">
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">
                            {{ __('Login') }}
                        </a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            {{ __('Register') }}
                        </a>
                    @endif
                </div>
            </nav>

            <main class="flex-1 flex items-center justify-center px-4 py-10">
                <div class="w-full max-w-md">
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
