<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | About Us</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>

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

        .content-section {
            background-color: rgba(0, 0, 0, 0.2);
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

<header class="relative w-full h-[60vh] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?cs=srgb&dl=pexels-pixabay-258154.jpg&fm=jpg'); opacity: 0.5;"></div>
    
    <div class="relative z-10 text-center max-w-4xl p-8">
        <p class="text-xl font-serif section-title mb-4">Our Heritage</p>
        <h1 class="text-6xl md:text-8xl font-serif font-bold leading-tight text-white mb-6">
            Defining Luxury Since 2005
        </h1>
    </div>
</header>


<main class="px-4 md:px-6 py-20 bg-white/5">
    <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
        
        <div class="p-8 content-section rounded-lg shadow-2xl">
            <p class="section-title text-2xl mb-4">Our Story</p>
            <h2 class="text-4xl font-serif font-bold text-white mb-6">A Vision of Hospitality</h2>
            <p class="text-white/80 leading-relaxed mb-6">
                HOTEL BOOKIE was founded on the simple yet ambitious idea of providing a sanctuary where modern design meets timeless comfort. From our first property, we committed ourselves to creating not just rooms, but experiences that resonate with elegance and tranquility. We believe true luxury is found in the details—the quality of service, the refinement of our spaces, and the dedication of our team.
            </p>
            <p class="text-white/80 leading-relaxed">
                Over the past two decades, we have grown, but our core mission remains unchanged: to offer world-class accommodation that feels both exclusive and welcoming, making every stay an unforgettable moment of repose.
            </p>
        </div>

        <div class="hidden lg:block">
            <img src="https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?cs=srgb&dl=pexels-pixabay-258154.jpg&fm=jpg" class="w-full rounded-lg shadow-xl" alt="Elegant interior design">
        </div>

    </div>
    
    <div class="max-w-6xl mx-auto mt-20">
        <div class="text-center mb-12">
            <p class="section-title text-2xl mb-2">Our Commitments</p>
            <h3 class="text-5xl font-serif font-bold text-white">What We Stand For</h3>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
        
            <div class="p-6 content-section rounded-lg shadow-xl text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto mb-4 text-accent-orange">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 19.5a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <h4 class="text-xl font-semibold mb-3 text-white">Unparalleled Service</h4>
                <p class="text-white/70 text-sm">Anticipating every need, our staff ensures a seamless and highly personalized experience for all our guests.</p>
            </div>
            
        
            <div class="p-6 content-section rounded-lg shadow-xl text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto mb-4 text-accent-orange">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5m-16.5 0A2.25 2.25 0 0 0 5.25 18H2.25a.75.75 0 0 1-.75-.75V8.461c0-.491.246-.941.666-1.214L11.25 2.203c.353-.235.798-.235 1.151 0l7.29 4.844c.42.273.666.723.666 1.214V17.25c0 .414-.336.75-.75.75H18m-15.75 0H5.25m9.75 0H18m0 0h3.75M7.5 18h9m-9 3h9" />
                </svg>
                <h4 class="text-xl font-semibold mb-3 text-white">Sustainable Luxury</h4>
                <p class="text-white/70 text-sm">We integrate eco-friendly practices into our operations, ensuring that your stay is as responsible as it is indulgent.</p>
            </div>
            
            <div class="p-6 content-section rounded-lg shadow-xl text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mx-auto mb-4 text-accent-orange">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.749a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.6l-4.72-2.822a.563.563 0 0 0-.586 0l-4.72 2.822a.562.562 0 0 1-.84-.6l1.285-5.385a.562.562 0 0 0-.182-.557L2.94 9.499a.563.563 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345l2.125-5.111Z" />
                </svg>
                <h4 class="text-xl font-semibold mb-3 text-white">Excellence in Design</h4>
                <p class="text-white/70 text-sm">Every element of our hotel, from the architecture to the linens, is chosen to reflect sophisticated, contemporary comfort.</p>
            </div>
        </div>
    </div>
</main>

<footer class="p-10 bg-black/40 text-center text-white/50">
    <p>© 2024 HOTEL BOOKIE. All rights reserved.</p>
</footer>

</body>
</html>