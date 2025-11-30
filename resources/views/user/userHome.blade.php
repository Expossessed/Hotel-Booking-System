<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Rooms</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        /* Background image with dark overlay and blur */
        body {
            background-image: url('https://images.unsplash.com/photo-1560347876-aeef00ee58a1?auto=format&fit=crop&w=1950&q=80'); /* replace with your hotel image */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(2px);
            z-index: 0;
        }

        main, .navbar {
            position: relative;
            z-index: 10; /* above overlay */
        }

        /* Glass effect for navbar and cards */
        .glass {
            background: rgba(20, 20, 20, 0.45); /* darker, semi-transparent for background blending */
            backdrop-filter: blur(12px);
            color: #fff;
        }

        .navbar a, .btn, .text-primary {
            color: #fff;
        }

        .btn-primary {
            background-color: rgba(13, 110, 253, 0.8);
            border-color: rgba(13, 110, 253, 0.8);
        }

        .btn-outline {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.7);
        }

        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .badge-error {
            background-color: rgba(220, 53, 69, 0.8);
            color: #fff;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }

        /* Room card hover effect */
        .room-card:hover {
            transform: scale(1.03);
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="text-gray-100 relative">

<!-- NAVBAR -->
<div class="navbar shadow-lg glass px-6 py-3 sticky top-0 z-50 rounded-b-xl">
    <div class="flex-1">
        @auth
        <a href="{{ auth()->user()->isAdmin() ? route('admin.front') : route('rooms.list') }}"
           class="text-2xl md:text-3xl font-bold">
           HOTEL BOOKIE
        </a>
        @else
        <a href="{{ route('home') }}" class="text-2xl md:text-3xl font-bold">HOTEL BOOKIE</a>
        @endauth
    </div>

    <div>
        <ul class="menu menu-horizontal gap-6 text-md md:text-lg font-medium">
            @auth
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.createRoom') }}" class="hover:text-primary">Add Room</a></li>
                @endif
            @endauth
        </ul>
    </div>

    <div>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
        @endauth
    </div>
</div>

<!-- MAIN CONTENT -->
<main class="px-4 md:px-6 py-10">

    <!-- Hero / Search Section -->
    <section class="max-w-6xl mx-auto mb-10">
        <div class="glass shadow-xl rounded-xl p-8 grid gap-6 md:grid-cols-3 items-end">
            <div>
                <label class="text-sm font-semibold">Check-in</label>
                <input type="date" class="input input-bordered w-full bg-black bg-opacity-20 text-white border-white" />
            </div>
            <div>
                <label class="text-sm font-semibold">Check-out</label>
                <input type="date" class="input input-bordered w-full bg-black bg-opacity-20 text-white border-white" />
            </div>
            <div class="flex gap-2 items-end">
                <div class="w-full">
                    <label class="text-sm font-semibold">Guests</label>
                    <select class="select select-bordered w-full bg-black bg-opacity-20 text-white border-white">
                        <option>1 guest</option>
                        <option>2 guests</option>
                        <option>3 guests</option>
                        <option>4+ guests</option>
                    </select>
                </div>
                <button class="btn btn-primary btn-md">Search</button>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="mt-6 flex items-center gap-3 flex-wrap">
            <span class="text-sm font-semibold text-white">Filters:</span>
            <div class="btn-group">
                <a href="{{ route('rooms.list') }}" class="btn btn-sm {{ empty($currentFilter) ? '' : 'btn-outline' }}">All</a>
                <a href="{{ route('rooms.list', ['filter' => 'available']) }}" class="btn btn-sm {{ ($currentFilter ?? null) === 'available' ? '' : 'btn-outline' }}">Available</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_low']) }}" class="btn btn-sm {{ ($currentSort ?? null) === 'price_low' ? '' : 'btn-outline' }}">Price Low</a>
                <a href="{{ route('rooms.list', ['sort' => 'price_high']) }}" class="btn btn-sm {{ ($currentSort ?? null) === 'price_high' ? '' : 'btn-outline' }}">Price High</a>
            </div>
        </div>
    </section>

    <!-- Room Cards -->
    <section class="max-w-6xl mx-auto rooms-grid">
        @if ($rooms->isEmpty())
            <div class="glass shadow-xl rounded-xl p-10 text-center">
                <h2 class="text-3xl font-semibold">No Rooms Available</h2>
                <p class="text-gray-200 mt-2">Please check again later.</p>
            </div>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($rooms as $room)
                    <div class="glass shadow-xl rounded-xl overflow-hidden flex flex-col room-card">
                        <img src="{{ $room->image_link }}" class="w-full h-52 object-cover" alt="Room Image">

                        <div class="p-6 flex flex-col h-full">
                            <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
                                {{ $room->room_name }}
                                @if (!$room->is_available)
                                    <span class="badge badge-error">Unavailable</span>
                                @endif
                            </h3>

                            <p class="text-gray-200 mb-4 line-clamp-3">{{ $room->room_desc }}</p>

                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-lg font-semibold text-primary">${{ $room->room_price }}</span>
                                <div class="flex gap-2">
                                    <a href="{{ route('rooms.view', ['id' => $room->room_id]) }}" class="btn btn-outline btn-sm">Details</a>
                                    <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}" class="btn btn-primary btn-sm {{ !$room->is_available ? 'btn-disabled' : '' }}">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

</main>

</body>
</html>
