<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | World Class Accommodation</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        /* 🎨 STYLING: Based on the ECOHO Image (Dark Brown & White/Orange) */

        /* Define Core Colors */
        :root {
            --color-dark-brown: #3C2A21; /* Rich dark brown for background/side panel */
            --color-accent-orange: #C45B3A; /* Reddish-orange accent (like the button/bed runner) */
            --color-text-light: #F7F7F7; /* Near-white for text */
        }

        /* 1. Reset Body Background */
        body {
            background-image: none;
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            position: relative;
        }
        body::before {
            content: none;
        }
        
        body, .text-gray-100 {
            color: var(--color-text-light);
        }

        /* 2. NAVBAR Styling (Clean, Simple, White on Dark) */
        .navbar-top {
            /* Using a slightly darker shade for the fixed bar */
            background-color: #312620; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a {
            color: var(--color-text-light);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-menu a:hover {
            color: var(--color-accent-orange);
        }

        /* Profile Dropdown Styling */
        .profile-dropdown-content {
            background: #312620;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }


        /* 3. Hero Section Split Screen */
        .hero-split-left {
            background-color: var(--color-dark-brown);
        }

        /* 4. Accent Button Style (Orange/Brown) */
        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }
        .btn-outline-accent {
            color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
        }
        .btn-outline-accent:hover {
            background-color: var(--color-accent-orange);
            color: white;
        }

        /* 5. Room Card Styling for scrolling content */
        .room-card-style {
            background-color: rgba(0, 0, 0, 0.3); /* Darker card background for contrast */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .room-card-style:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body class="relative">

<div class="navbar navbar-top px-4 md:px-12 py-3 sticky top-0 z-50 shadow-lg">
    
    <div class="flex-1">
        <a href="{{ route('home') }}" class="text-xl md:text-2xl font-extrabold tracking-widest text-white">
            HOTEL BOOKIE
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal p-0 hidden md:flex gap-6 navbar-menu text-lg">
            <li><a href="">Home</a></li>
            <li><a href="rooms">Rooms</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>

        @auth
        <div class="dropdown dropdown-end ml-6">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border-2 border-white/50 hover:bg-white/10 transition-colors">
                <div class="w-10 rounded-full bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 19.5a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="bookings.html" class="font-medium">My Bookings</a></li>
                
                <li><a href="{{ route('profile.edit') }}" class="font-medium">Profile & Settings</a></li>
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.front') }}" class="text-yellow-400 font-medium">Admin Panel</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <div class="ml-8 hidden md:block">
            <a href="{{ route('bookings.form') }}" class="btn btn-accent-color btn-md px-6 font-semibold rounded-none">Book Now</a>
        </div>
        @endauth


        <div class="dropdown dropdown-end md:hidden ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="">Home</a></li>
                <li><a href="rooms">Rooms</a></li>
                <li><a href="about">About</a></li>
                <li><a href="contact">Contact</a></li>
                
                @auth
                    <li><a href="bookings.html" class="font-medium">My Bookings</a></li>
                    
                    <li><a href="{{ route('profile.edit') }}" class="font-medium">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="mt-2"><a href="{{ route('bookings.form') }}" class="btn btn-accent-color btn-sm rounded-none">Book Now</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<header class="relative w-full h-[80vh] flex">
    
    <div class="hero-split-left w-full lg:w-1/2 flex items-center justify-center p-10 md:p-16">
        <div class="max-w-xl text-left">
            <h1 class="text-5xl md:text-6xl font-serif font-bold leading-tight text-white mb-6">
                World Class Accommodation
            </h1>
            <p class="text-lg text-white/80 mb-8 max-w-sm">
                Discover a hotel that defines a new dimension of luxury.
            </p>
            <a href="{{ route('about') }}" class="btn btn-accent-color btn-lg px-10 rounded-none text-base font-semibold">
                View More
            </a>
        </div>
    </div>
    <div class="hidden lg:block w-1/2">
        <img src="https://tse1.mm.bing.net/th/id/OIP.L2Cxp3TdbaRTwyckzEJE3wHaEo?w=2560&h=1600&rs=1&pid=ImgDetMain&o=7&rm=3"
             alt="Luxury Hotel Room"
             class="w-full h-full object-cover">
    </div>
</header>


<main class="px-4 md:px-6 py-16 bg-white/5">

    <section class="max-w-6xl mx-auto mb-16">
        <h2 class="text-4xl font-serif font-normal text-white mb-2">
            Available Rooms & Suites
        </h2>
        <p class="text-white/70 mb-8">Discover a hotel that defines a new dimension of luxury.</p>
        
        <div class="p-8 grid gap-6 md:grid-cols-4 items-end bg-black/40 rounded-lg shadow-2xl">
            <div>
                <label class="text-sm font-light text-white/80 block mb-1">Check-in</label>
                <input type="date" class="input input-bordered w-full bg-white/10 text-white border-white/30 rounded-none" />
            </div>
            <div>
                <label class="text-sm font-light text-white/80 block mb-1">Check-out</label>
                <input type="date" class="input input-bordered w-full bg-white/10 text-white border-white/30 rounded-none" />
            </div>
            <div>
                <label class="text-sm font-light text-white/80 block mb-1">Guests</label>
                <select class="select select-bordered w-full bg-white/10 text-white border-white/30 rounded-none">
                    <option>1 guest</option>
                    <option>2 guests</option>
                    <option>3 guests</option>
                    <option>4+ guests</option>
                </select>
            </div>
            <div class="mt-4 md:mt-0">
                <button class="btn btn-accent-color btn-md w-full rounded-none font-semibold">
                    Search
                </button>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-4 flex-wrap">
            <span class="text-md font-semibold text-white/90">Filter by:</span>
            <div class="btn-group shadow-lg">
                <a href="{{ route('rooms.list') }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ empty($currentFilter) && empty($currentSort) ? 'bg-accent-orange/30' : '' }} rounded-none">All</a>
                <a href="{{ route('rooms.list', ['filter' => 'available']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentFilter ?? null) === 'available' ? 'bg-accent-orange/30' : '' }} rounded-none">Available</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_low']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentSort ?? null) === 'price_low' ? 'bg-accent-orange/30' : '' }} rounded-none">Price Low</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_high']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentSort ?? null) === 'price_high' ? 'bg-accent-orange/30' : '' }} rounded-none">Price High</a>
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto rooms-grid">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @if ($rooms->isEmpty())
                <div class="p-10 text-center col-span-full bg-black/40 rounded-lg">
                    <h2 class="text-3xl font-semibold text-red-400">No Rooms Found</h2>
                    <p class="text-gray-300 mt-2">Try adjusting your search dates or filters.</p>
                </div>
            @else
                @foreach ($rooms as $room)
                    <div class="shadow-xl rounded-lg overflow-hidden flex flex-col room-card-style">
                        <img src="{{ $room->image_link }}" class="w-full h-52 object-cover transition duration-300" alt="Room Image">

                        <div class="p-6 flex flex-col h-full">
                            
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold leading-tight text-white">
                                    {{ $room->room_name }}
                                </h3>
                                
                                @if (!$room->is_available)
                                    <span class="badge badge-error text-xs p-3 font-semibold text-white rounded-none">Sold Out</span>
                                @else
                                    <span class="badge badge-success text-xs p-3 font-semibold text-white rounded-none">Available</span>
                                @endif
                            </div>


                            <p class="text-gray-300 mb-4 line-clamp-3 text-sm">{{ $room->room_desc }}</p>

                            <div class="flex justify-between items-center mt-auto border-t border-white/10 pt-4">
                                <span class="text-2xl font-extrabold text-white">${{ $room->room_price }}</span>
                                <div class="flex gap-3">
                                    <a href="{{ route('rooms.view', ['id' => $room->room_id]) }}" class="btn btn-outline btn-sm text-white rounded-none hover:bg-white/10 border-white/40">Details</a>
                                    <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}" class="btn btn-accent-color btn-sm rounded-none {{ !$room->is_available ? 'btn-disabled opacity-50' : '' }}">
                                        Reserve
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

</main>

</body>
</html>