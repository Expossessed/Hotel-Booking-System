<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
@section('body_class', 'rooms-page bg-gray-100')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        
        input[readonly],
        textarea[readonly],
        input:disabled,
        textarea:disabled {
            pointer-events: none;
            cursor: default;
            caret-color: transparent;
        }
        
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        input,
        textarea {
            -webkit-user-select: text;
            -moz-user-select: text;
            user-select: text;
        }
    </style>



    <main class="px-6 py-8 bg-gray-100">
        <!-- Search / Filter -->
        <section class="max-w-6xl mx-auto mb-8">
            <div class="bg-white shadow-md rounded-lg p-4 grid gap-4 md:grid-cols-3 items-end">
                <div>
                    <label class="text-sm text-gray-600">Check-in</label>
                    <input type="date" class="input input-bordered w-full" />
                </div>
                <div>
                    <label class="text-sm text-gray-600">Check-out</label>
                    <input type="date" class="input input-bordered w-full" />
                </div>
                <div class="flex gap-2 items-center">
                    <div class="w-full">
                        <label class="text-sm text-gray-600">Guests</label>
                        <select class="select select-bordered w-full">
                            <option>1 guest</option>
                            <option>2 guests</option>
                            <option>3 guests</option>
                            <option>4+ guests</option>
                        </select>
                    </div>
                    <button class="btn btn-primary ml-2">Search</button>
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <span class="text-sm text-gray-600">Filters:</span>
                <div class="btn-group">
                    <a href="{{ route('rooms.list') }}"
                       class="btn btn-sm {{ empty($currentFilter) && empty($currentSort) ? '' : 'btn-outline' }}">
                        All
                    </a>
                    <a href="{{ route('rooms.list', ['filter' => 'available']) }}"
                       class="btn btn-sm {{ ($currentFilter ?? null) === 'available' ? '' : 'btn-outline' }}">
                        Available
                    </a>
                    <a href="{{ route('rooms.list', ['sort' => 'price_low']) }}"
                       class="btn btn-sm {{ ($currentSort ?? null) === 'price_low' ? '' : 'btn-outline' }}">
                        Price Low
                    </a>
                    <a href="{{ route('rooms.list', ['sort' => 'price_high']) }}"
                       class="btn btn-sm {{ ($currentSort ?? null) === 'price_high' ? '' : 'btn-outline' }}">
                        Price High
                    </a>
                </div>
            </div>
        </section>

        <section class="max-w-6xl mx-auto">
            @if ($rooms->isEmpty())
                <div class="bg-white shadow-md rounded-lg p-8 text-center">
                    <h2 class="text-2xl font-semibold mb-2">No rooms available yet</h2>
                    <p class="text-gray-600">Please check back later. New rooms will appear here once added by the admin.</p>
                </div>
            @else
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($rooms as $room)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden h-full flex flex-col">
                            <img src="{{ $room->image_link }}"
                                 alt="{{ $room->room_type }}"
                                 class="w-full h-48 object-cover" />

                            <div class="p-4 flex flex-col justify-between h-full">
                                <div>
                                    <h3 class="text-xl font-bold mb-2 flex items-center gap-2">
                                        <span>{{ $room->room_type }}</span>
                                        @if (!$room->is_available)
                                            <span class="badge badge-error text-xs">Unavailable</span>
                                        @endif
                                    </h3>
                                    <p class="text-blue-600 mb-4">{{ $room->room_desc }}</p>
                                </div>

                                <div class="flex justify-between items-center mt-auto">
                                    <span class="text-lg font-semibold text-primary">
                                        ${{ $room->room_price }}
                                    </span>
                                    <div class="flex gap-2">
                                        <a href="{{ route('rooms.view', ['id' => $room->room_id]) }}" class="btn btn-outline btn-sm">View Details</a>
                                        <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}" class="btn btn-primary btn-sm">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>

