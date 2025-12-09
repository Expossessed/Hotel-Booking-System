<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Luxury Redefined</title>

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
            color: var(--color-text-light);
        }

        .btn-accent {
            background-color: var(--color-accent-orange);
            border: none;
            color: white;
        }

        .btn-accent:hover {
            background-color: #A84B2C;
        }

        .section-title {
            font-size: 2.75rem;
            font-weight: 600;
            font-family: serif;
        }

        .room-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all .3s ease;
        }

        .room-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 34px rgba(0, 0, 0, 0.5);
        }

        .filter-bar {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
        }

        .hero {
            background-image: url('https://images.pexels.com/photos/2034335/pexels-photo-2034335.jpeg?cs=srgb&dl=pexels-konstantinos-eleftheriadis-2034335.jpg&fm=jpg');
            background-size: cover;
            background-position: center;
            height: 85vh;
            position: relative;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(60, 42, 33, 0.7), rgba(60, 42, 33, 0.95));
        }
        .fixed-room-img {
            width: 100%;
            height: 240px !important;   /* FORCE same height */
            min-height: 240px !important;
            max-height: 240px !important;
            object-fit: cover !important;
            object-position: center;
            display: block;
            background-color: #1f1f1f;
        }
    </style>
</head>

<body>

    @include('layouts.hotelNav')

    <!-- HERO -->
    <section class="hero flex items-center relative">
        <div class="relative z-10 px-6 md:px-20 max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-serif font-bold text-white drop-shadow-xl leading-tight mb-6">
                Your Perfect Stay Awaits
            </h1>
            <p class="text-lg text-white/85 mb-8 max-w-xl">
                Discover comfort, elegance, and unforgettable experiences. Book your dream room today with ease and confidence.
            </p>
            <a href="{{ route('about') }}" class="btn btn-accent rounded-none px-10 shadow-lg">
                Explore Hotel
            </a>
        </div>
    </section>

    <!-- SEARCH BAR (NEW MODERN STYLE) -->
    <section class="max-w-5xl mx-auto p-6 mt-[-40px] relative z-20">
        <div class="filter-bar rounded-xl p-6 shadow-lg grid md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm text-white/80">Check-in</label>
                <input type="date" class="input bg-white/10 border-white/20 text-white rounded-none w-full" />
            </div>
            <div>
                <label class="text-sm text-white/80">Check-out</label>
                <input type="date" class="input bg-white/10 border-white/20 text-white rounded-none w-full" />
            </div>
            <div>
                <label class="text-sm text-white/80">Guests</label>
                <select class="select bg-white/10 border-white/20 text-white rounded-none w-full">
                    <option>1 guest</option>
                    <option>2 guests</option>
                    <option>3 guests</option>
                    <option>4+ guests</option>
                </select>
            </div>
            <button class="btn btn-accent w-full rounded-none mt-6 md:mt-0">Search</button>
        </div>
    </section>

    <!-- FILTER BUTTONS -->
    <section class="max-w-6xl mx-auto px-6 mt-12 mb-10">
        <div class="flex items-center gap-4 flex-wrap">
            <span class="text-lg font-semibold text-white">Filter Rooms:</span>

            <div class="btn-group rounded-none">
                <a href="{{ route('rooms.list') }}"
                    class="btn btn-outline text-white border-white/20 rounded-none {{ empty($currentFilter) && empty($currentSort) ? 'bg-accent-orange/40' : '' }}">
                    All
                </a>

                <a href="{{ route('rooms.list', ['filter' => 'available']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none {{ ($currentFilter ?? null) === 'available' ? 'bg-accent-orange/40' : '' }}">
                    Available
                </a>

                <a href="{{ route('rooms.list', ['sort' => 'price_low']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none {{ ($currentSort ?? null) === 'price_low' ? 'bg-accent-orange/40' : '' }}">
                    Price Low
                </a>

                <a href="{{ route('rooms.list', ['sort' => 'price_high']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none {{ ($currentSort ?? null) === 'price_high' ? 'bg-accent-orange/40' : '' }}">
                    Price High
                </a>
            </div>
        </div>
    </section>

    <!-- ROOMS -->
    <section class="max-w-6xl mx-auto px-6 pb-20">
        <h2 class="section-title text-center mb-10">Our Rooms & Suites</h2>

        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">

            @if ($rooms->isEmpty())
                <div class="col-span-full text-center bg-white/10 rounded-xl p-12">
                    <h2 class="text-3xl font-semibold text-red-300">No Rooms Found</h2>
                    <p class="mt-2 text-white/70">Try adjusting your filters or search dates.</p>
                </div>
            @else
                @foreach ($rooms as $room)
                    <div class="room-card rounded-xl overflow-hidden shadow-lg flex flex-col">

                        <img src="{{ $room->image_link }}" class="w-full h-56 object-cover fixed-room-img" alt="Room Image">

                        <div class="p-6 flex flex-col h-full">

                            <div class="flex justify-between mb-3">
                                <h3 class="text-xl font-bold">{{ $room->room_name }}</h3>

                                @if (!$room->is_available)
                                    <span class="badge badge-error rounded-none p-3">Sold Out</span>
                                @else
                                    <span class="badge badge-success rounded-none p-3">Available</span>
                                @endif
                            </div>

                            <p class="text-sm text-white/70 mb-4 line-clamp-3">
                                {{ $room->room_desc }}
                            </p>

                            <div
                                class="mt-auto pt-4 border-t border-white/10 flex justify-between items-center">
                                <span class="text-2xl font-extrabold">${{ $room->room_price }}</span>

                                <div class="flex gap-3">
                                    <a href="{{ route('rooms.view', ['id' => $room->room_id]) }}"
                                        class="btn btn-outline text-white border-white/40 btn-sm rounded-none">
                                        Details
                                    </a>

                                    <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}"
                                        class="btn btn-accent btn-sm rounded-none {{ !$room->is_available ? 'btn-disabled opacity-50' : '' }}">
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

</body>

</html>
