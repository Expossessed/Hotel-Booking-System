<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* Make non-editable form controls non-interactive on this page */
        input[readonly],
        textarea[readonly],
        input:disabled,
        textarea:disabled {
            pointer-events: none;
            cursor: default;
            caret-color: transparent;
        }
        /* Disable caret / text selection for non-input text on this page */
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
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="navbar shadow-md bg-white px-6 py-3 sticky top-0 z-50 flex justify-between items-center">
        <a class="text-3xl font-bold text-primary">HOTEL BOOKIE</a>
        <ul class="menu menu-horizontal gap-6 text-lg font-medium">
            <li><a href="/admin/home" class="text-primary font-bold">Home</a></li>
            <li><a href="{{ route('admin.history') }}" class="hover:text-primary">History</a></li>
            <li><a href="/admin/create" class="hover:text-primary">Add</a></li>
        </ul>
        <a class="btn btn-primary btn-sm">Login</a>
    </nav>

    <!-- Room Details Card -->
<div class="container mx-auto py-12 px-4">
    <h1 class="text-5xl md:text-6xl font-bold text-center text-black mb-12">Room Details</h1>

    <div class="flex flex-col lg:flex-row gap-12 items-center bg-white shadow-xl rounded-xl p-8">
        
        <!-- Room Image (kept as is) -->
        <div class="w-full lg:w-1/2">
            <img src="{{ $room->image_link }}" 
                 alt="{{ $room->room_name }}" 
                 class="rounded-xl shadow-md w-full object-cover h-[400px]">
        </div>

        <!-- Room Info -->
        <div class="w-full lg:w-1/2 flex flex-col justify-between gap-8">
            
            <div>
                <h2 class="text-4xl md:text-5xl font-bold text-primary mb-2">
                    {{ $room->room_name }}
                </h2>
                <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">
                    ${{ $room->room_price }}/Night
                </h3>

                <!-- Ratings -->
                <div class="flex items-center mb-4">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $room->rating) 
                            <span class="text-yellow-500 text-2xl">&#9733;</span> <!-- filled star -->
                        @else
                            <span class="text-gray-300 text-2xl">&#9733;</span> <!-- empty star -->
                        @endif
                    @endfor
                    <span class="ml-2 text-gray-600 text-lg">({{ $room->rating }}/5)</span>
                </div>
                <!-- Room Description -->
                <p class="text-lg md:text-xl text-black-700 font-bold">
                    {{ strtoupper($room->room_type) }}
                </p>
                <p class="text-lg md:text-xl text-gray-500">
                    {{ $room->room_desc }}
                </p>
                
    </div>
    <a href="{{ route('reviews.view', ['id' => $room->id]) }}" class="btn btn-link text-lg mr-4">
    View Reviews
</a>
<a href="{{ route('reviews.create', ['id' => $room->id]) }}" class="btn btn-primary text-lg w-42">
    Add a Review
</a>

            <!-- Free Items Button + Collapse -->
<div class="mt-6">
    <button type="button" 
            class="btn btn-outline btn-primary w-full text-lg"
            onclick="document.getElementById('freeItems').classList.toggle('hidden')">
        Free Items Included
    </button>

    <!-- Hidden list toggled by button -->
    <div id="freeItems" class="hidden mt-4 bg-gray-100 rounded-lg p-4">
        <ul class="list-disc list-inside text-gray-700 text-lg">
            @foreach($room->free_items as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        </div>
    </div>
</div>
</div>

<!-- Room Interior Images Card -->
<div class="container mx-auto py-12 px-4">
    <h2 class="text-4xl font-bold text-center text-black mb-8">Inside the Room</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Image 1 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="{{ $room->room_image1 }}" 
                 alt="Room Interior 1" 
                 class="w-full h-64 object-cover">
            <div class="p-4">
                <p class="text-gray-700">Cozy bedroom with modern furniture.</p>
            </div>
        </div>

        <!-- Image 2 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="{{ $room->room_image2 }}" 
                 alt="Room Interior 2" 
                 class="w-full h-64 object-cover">
            <div class="p-4">
                <p class="text-gray-700">Spacious bathroom with elegant design.</p>
            </div>
        </div>

        <!-- Image 3 -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <img src="{{ $room->room_image3 }}" 
                 alt="Room Interior 3" 
                 class="w-full h-64 object-cover">
            <div class="p-4">
                <p class="text-gray-700">Beautiful view from the balcony.</p>
            </div>
        </div>
    </div>
</div>

</body>

</html>