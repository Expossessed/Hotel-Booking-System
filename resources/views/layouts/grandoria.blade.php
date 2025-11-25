<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hotel Bookie') }}</title>

    {{-- Base href so all relative Grandoria asset paths resolve under /grandoria --}}
    <base href="{{ asset('grandoria') }}/">

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
    <!-- ======= Top Bar (thinner contact strip) ======= -->
    <section id="topbar" class="topbar d-flex align-items-center dark-background py-1">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center small">
                <i class="bi bi-envelope d-flex align-items-center"><span>contact@example.com</span></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
        </div>
    </section>

    <!-- ======= Header / Navigation (Grandoria-style) ======= -->
    <header id="header" class="header sticky-top">
        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                    <h1 class="sitename mb-0">Hotel Bookie</h1>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{ route('home') }}" class="@if (request()->routeIs('home')) active @endif">Home</a></li>
                        <li><a href="{{ route('about') }}" class="@if (request()->routeIs('about')) active @endif">About</a></li>
                        <li><a href="{{ route('rooms.list') }}" class="@if (request()->routeIs('rooms.list')) active @endif">Rooms</a></li>
                        @auth
                            <li><a href="{{ route('bookings.history') }}" class="@if (request()->routeIs('bookings.history')) active @endif">History</a></li>
                            <li class="d-none d-md-block"><span class="nav-link">Hello, {{ auth()->user()->name }}</span></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn-getstarted small">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    </ul>
                </nav>

                <a class="btn-getstarted" href="{{ route('bookings.form') }}">Book Now</a>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
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
