<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | View All Rooms & Suites</title>

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
        
        /* Input Focus State for Dark Theme */
        .input:focus, .select:focus {
            border-color: var(--color-accent-orange) !important;
            box-shadow: 0 0 0 2px var(--color-accent-orange);
            outline: none;
        }

        /* 3. Accent Button Style (Orange/Brown) */
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

        /* 4. Room Card Styling for scrolling content */
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

@include('layouts.hotelNav')

<!-- ========================================================= -->
<!-- MAIN CONTENT: Search, Filter, and Room Grid -->
<!-- ========================================================= -->
<main class="px-4 md:px-6 py-16 bg-white/5">

    <section class="max-w-6xl mx-auto mb-16">
        <h1 class="text-5xl font-serif font-bold text-white mb-2">
            Browse All Rooms & Suites
        </h1>
        <p class="text-white/70 mb-8 text-lg">Find your perfect stay by searching dates or applying filters below.</p>
        
        <!-- Search Form -->
        <form action="" method="GET" class="p-8 grid gap-6 md:grid-cols-4 items-end bg-black/40 rounded-lg shadow-2xl">
            <div>
                <label for="check_in" class="text-sm font-light text-white/80 block mb-1">Check-in</label>
                <input type="date" id="check_in" name="check_in" class="input input-bordered w-full bg-white/10 text-white border-white/30 rounded-none" />
            </div>
            <div>
                <label for="check_out" class="text-sm font-light text-white/80 block mb-1">Check-out</label>
                <input type="date" id="check_out" name="check_out" class="input input-bordered w-full bg-white/10 text-white border-white/30 rounded-none" />
            </div>
            <div>
                <label for="guests" class="text-sm font-light text-white/80 block mb-1">Guests</label>
                <select id="guests" name="guests" class="select select-bordered w-full bg-white/10 text-white border-white/30 rounded-none">
                    <option value="1">1 guest</option>
                    <option value="2" selected>2 guests</option>
                    <option value="3">3 guests</option>
                    <option value="4">4+ guests</option>
                </select>
            </div>
            <div class="mt-4 md:mt-0">
                <button type="submit" class="btn btn-accent-color btn-md w-full rounded-none font-semibold">
                    Search
                </button>
            </div>
        </form>

        <!-- Filters and Sorting -->
        <div class="mt-8 flex items-center gap-4 flex-wrap">
            <span class="text-md font-semibold text-white/90">Filter & Sort:</span>
            <div class="btn-group shadow-lg">
                <!-- Note: The variables $currentFilter and $currentSort are assumed to be passed to this view -->
                <a href="{{ route('rooms.list') }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ empty($currentFilter) && empty($currentSort) ? 'bg-accent-orange/30' : '' }} rounded-none">All</a>
                <a href="{{ route('rooms.list', ['filter' => 'available']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentFilter ?? null) === 'available' ? 'bg-accent-orange/30' : '' }} rounded-none">Available</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_low']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentSort ?? null) === 'price_low' ? 'bg-accent-orange/30' : '' }} rounded-none">Price Low</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_high']) }}" class="btn btn-sm btn-outline-accent text-white hover:bg-accent-orange {{ ($currentSort ?? null) === 'price_high' ? 'bg-accent-orange/30' : '' }} rounded-none">Price High</a>
            </div>
        </div>
    </section>

    <!-- Room Grid Listing -->
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