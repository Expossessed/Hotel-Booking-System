<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Contact Us</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Assuming DaisyUI is installed via npm or CDN is preferred for this static example -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        /* 🎨 STYLING: Consistent Dark Brown & Orange Theme */

        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        body {
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--color-text-light);
        }
        
        .navbar-top {
            background-color: #312620; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a {
            color: var(--color-text-light);
            transition: color 0.3s ease;
        }
        .navbar-menu a:hover {
            color: var(--color-accent-orange);
        }

        .profile-dropdown-content {
            background: #312620;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.2);
        }
        .input-dark {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        .input-dark:focus {
            border-color: var(--color-accent-orange);
            outline: none;
        }
        .section-title {
            color: var(--color-accent-orange);
            font-family: serif;
            font-weight: 300;
        }
    </style>
</head>
<body class="relative">

<!-- 💎 NAVBAR 💎 -->
<div class="navbar navbar-top px-4 md:px-12 py-3 sticky top-0 z-50 shadow-lg">
    <div class="flex-1">
        <!-- In a Blade file, the href would ideally use the Laravel route helper -->
        <a href="{{ url('/') }}" class="text-xl md:text-2xl font-extrabold tracking-widest text-white">
            HOTEL BOOKIE
        </a>
    </div>

    <div class="flex-none">
        <!-- Desktop Menu: HOME, ROOMS, ABOUT, CONTACT -->
        <ul class="menu menu-horizontal p-0 hidden md:flex gap-6 navbar-menu text-lg">
            <li><a href="{{ route('rooms.list') }}">Home</a></li>
            <li><a href="{{ route('rooms') }}">Rooms</a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}" class="font-bold text-accent-orange">Contact</a></li>
        </ul>

        <!-- Profile/Booking Placeholder -->
        <div class="ml-8 hidden md:block">
            <a href="{{ url('/bookings') }}" class="btn btn-accent-color btn-md px-6 font-semibold rounded-none">Book Now</a>
        </div>

        <!-- Mobile Menu -->
        <div class="dropdown dropdown-end md:hidden ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="{{ route('rooms.list') }}">Home</a></li>
                <li><a href="{{ route('rooms') }}">Rooms</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}" class="font-bold text-accent-orange">Contact</a></li>
                <li class="mt-2"><a href="{{ url('/bookings') }}" class="btn btn-accent-color btn-sm rounded-none">Book Now</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- 🖼️ CONTACT HERO BANNER 🖼️ -->
<header class="relative w-full h-[50vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('https://placehold.co/1920x800/211713/F7F7F7?text=HOTEL+RECEPTION+DESK'); opacity: 0.5;"></div>
    
    <div class="relative z-10 text-center max-w-4xl p-8">
        <p class="text-xl font-serif section-title mb-4">Contact Us</p>
        <h1 class="text-6xl md:text-7xl font-serif font-bold leading-tight text-white mb-6">
            Get In Touch
        </h1>
    </div>
</header>


<!-- MAIN CONTENT (Form & Details) -->
<main class="px-4 md:px-6 py-20 bg-white/5">
    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-16">
        
        <!-- Contact Form -->
        <div class="p-8 form-container rounded-lg shadow-2xl">
            <h2 class="text-3xl font-serif font-bold text-white mb-6 border-b border-white/10 pb-4">Send Us a Message</h2>
            <!-- Note: The form action uses the URL helper, and @csrf is mandatory for Laravel POST requests. -->
            <form action="{{ url('/contact') }}" method="POST" class="space-y-4">
                @csrf 
                <div>
                    <label for="name" class="block text-sm font-medium text-white/80 mb-1">Full Name</label>
                    <input type="text" id="name" name="name" class="input input-bordered w-full input-dark rounded-none" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-white/80 mb-1">Email Address</label>
                    <input type="email" id="email" name="email" class="input input-bordered w-full input-dark rounded-none" required>
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-white/80 mb-1">Subject</label>
                    <input type="text" id="subject" name="subject" class="input input-bordered w-full input-dark rounded-none">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-white/80 mb-1">Your Message</label>
                    <textarea id="message" name="message" rows="4" class="textarea textarea-bordered w-full input-dark rounded-none" required></textarea>
                </div>
                <button type="submit" class="btn btn-accent-color btn-lg px-8 rounded-none font-semibold w-full md:w-auto">
                    Submit Enquiry
                </button>
            </form>
        </div>

        <!-- Contact Details -->
        <div class="space-y-10 p-8">
            <div class="space-y-4">
                <h2 class="text-3xl font-serif font-bold text-white border-b border-white/10 pb-4">Our Details</h2>
                
                <!-- Address -->
                <div class="flex items-start space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-accent-orange mt-1 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <div>
                        <p class="font-semibold text-white">Location</p>
                        <p class="text-white/70">66/A, Green Lane, New York, NY 10001</p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-accent-orange mt-1 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75l1.5 1.5M2.25 15.75l1.5 1.5m18-9l-1.5 1.5m-1.5 1.5l-1.5-1.5m0 0l-3.75 3.75m1.5 1.5l1.5 1.5m-1.5-1.5l1.5-1.5m-1.5 1.5L9.75 9.75m0 0l-1.5 1.5m-1.5 1.5l-1.5-1.5m0 0l-3.75 3.75m1.5 1.5l1.5 1.5m-1.5-1.5L8.25 8.25m-3.75 3.75h14.25" />
                    </svg>
                    <div>
                        <p class="font-semibold text-white">Phone Number</p>
                        <p class="text-white/70">+10 (759) 657 5378 (24/7)</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-start space-x-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-accent-orange mt-1 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.625a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <div>
                        <p class="font-semibold text-white">Email</p>
                        <p class="text-white/70">reservations@hotelbookie.com</p>
                    </div>
                </div>
            </div>
            
            <!-- Map Placeholder -->
            <div class="h-64 rounded-lg overflow-hidden shadow-xl border border-white/10">
                <img src="https://placehold.co/600x400/3C2A21/F7F7F7?text=MAP+Placeholder" class="w-full h-full object-cover" alt="Map Location">
            </div>

        </div>
    </div>
</main>

<!-- Footer Placeholder -->
<footer class="p-10 bg-black/40 text-center text-white/50">
    <p>© 2024 HOTEL BOOKIE. All rights reserved.</p>
</footer>

</body>
</html>