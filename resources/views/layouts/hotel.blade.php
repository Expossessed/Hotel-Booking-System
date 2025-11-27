<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Bookie') }}</title>

    
    

    {{-- Laravel Vite assets (Tailwind/JS for the rest of the app) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicons -->
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Josefin+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    @stack('head')
</head>

<body class="@yield('body_class', 'index-page')">
    

    <!-- ======= Header / Navigation (Grandoria-style) ======= -->
    <header id="header" class="header sticky-top">
        <div class="navbar shadow-md bg-gray-100 px-6 py-3 sticky top-0 z-50 flex flex lg:">
        <div class="flex-1">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.front') : route('rooms.list') }}"
                   class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @else
                <a href="{{ route('home') }}" class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @endauth
        </div>

        <div class="content-center">
            <ul class="menu menu-horizontal gap-8 text-lg font-medium">
                <li><a class="text-primary font-bold">Home</a></li>
                
            </ul>
        </div>

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>
    </header>

    <main id="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-2 mb-md-0">
                <span>© {{ date('Y') }} {{ config('app.name', 'Hotel Bookie') }}. All Rights Reserved.</span>
            </div>
            <div class="d-flex flex-column flex-md-row gap-3 align-items-center">
                <div class="footer-links d-flex gap-3">
                    <a href="{{ route('terms') }}">Terms</a>
                    <a href="{{ route('privacy') }}">Privacy</a>
                </div>
                <div class="social-links d-flex gap-3">
                    <a href="#" class="text-decoration-none"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-decoration-none"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    @stack('scripts')
</body>

</html>
