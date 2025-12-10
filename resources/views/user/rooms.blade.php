<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | View All Rooms & Suites</title>

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
            min-height: 100vh;
        }

        .btn-accent {
            background-color: var(--color-accent-orange) !important;
            border-color: var(--color-accent-orange) !important;
            color: white !important;
        }

        .btn-accent:hover {
            background-color: #A84B2C !important;
            border-color: #A84B2C !important;
        }

        .filter-bar {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
        }

        .room-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(5px);
            transition: all .3s ease;
        }

        .room-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 34px rgba(0, 0, 0, 0.5);
        }

        .section-title {
            font-size: 3.3rem;
            font-weight: 600;
            font-family: serif;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.06);
            padding: 30px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(6px);
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

<main class="px-4 md:px-6 py-4">

    <!-- HEADER -->
    <section class="max-w-6xl mx-auto mb-14">
        <h1 class="section-title text-white mb-3">Rooms & Suites</h1>
        <p class="text-white/70 text-lg max-w-2xl">
            Browse our collection of luxury rooms and suites. Adjust your dates or apply filters to find your ideal stay.
        </p>
    </section>

    <!-- SEARCH BAR (PREMIUM STYLE)
    <section class="max-w-6xl mx-auto mb-14">
        <form method="GET" class="search-box grid gap-6 md:grid-cols-4 items-end shadow-xl">

            <div>
                <label class="text-sm text-white/80 block mb-1">Check-in</label>
                <input type="date" name="check_in" class="input input-bordered w-full bg-white/10 text-white border-white/20 rounded-none"/>
            </div>

            <div>
                <label class="text-sm text-white/80 block mb-1">Check-out</label>
                <input type="date" name="check_out" class="input input-bordered w-full bg-white/10 text-white border-white/20 rounded-none"/>
            </div>

            <div>
                <label class="text-sm text-white/80 block mb-1">Guests</label>
                <select name="guests" class="select select-bordered w-full bg-white/10 text-white border-white/20 rounded-none">
                    <option value="1">1 guest</option>
                    <option value="2" selected>2 guests</option>
                    <option value="3">3 guests</option>
                    <option value="4">4+ guests</option>
                </select>
            </div>

            <button class="btn btn-accent w-full rounded-none font-semibold">Search</button>

        </form>
    </section> -->

    <!-- FILTER BUTTONS -->
    <section class="max-w-6xl mx-auto mb-12">
        <div class="flex items-center gap-4 flex-wrap">
            <span class="text-lg font-semibold text-white/90">Filter & Sort:</span>

            <div class="btn-group rounded-none shadow-lg">

                <a href="{{ route('user.rooms') }}"
                    class="btn btn-outline text-white border-white/20 rounded-none
                    {{ empty($currentFilter) && empty($currentSort) ? 'bg-accent-orange/40' : '' }}">
                    All
                </a>

                <a href="{{ route('user.rooms', ['filter' => 'available']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none
                    {{ ($currentFilter ?? null) === 'available' ? 'bg-accent-orange/40' : '' }}">
                    Available
                </a>

                <a href="{{ route('user.rooms', ['sort' => 'price_low']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none
                    {{ ($currentSort ?? null) === 'price_low' ? 'bg-accent-orange/40' : '' }}">
                    Price Low
                </a>

                <a href="{{ route('user.rooms', ['sort' => 'price_high']) }}"
                    class="btn btn-outline text-white border-white/20 rounded-none
                    {{ ($currentSort ?? null) === 'price_high' ? 'bg-accent-orange/40' : '' }}">
                    Price High
                </a>

            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">

            @if ($rooms->isEmpty())
                <div class="col-span-full text-center bg-white/10 rounded-xl p-12">
                    <h2 class="text-3xl font-semibold text-red-300">No Rooms Found</h2>
                    <p class="mt-2 text-white/70">Try adjusting your filters or search dates.</p>
                </div>
            @else
                @foreach ($rooms as $room)
                    <div class="room-card rounded-xl overflow-hidden shadow-lg flex flex-col">

                        <img src="{{ $room->image_link }}" class="fixed-room-img" alt="Room Image">

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

                            <div class="mt-auto pt-4 border-t border-white/10 flex justify-between items-center">
                                <span class="text-2xl font-extrabold">₱{{ $room->room_price }}</span>

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

</main>

</body>

</html>
