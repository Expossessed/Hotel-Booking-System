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

@include('layouts.hotelNav')

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