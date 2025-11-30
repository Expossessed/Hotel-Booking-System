<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $rooms->room_name ?? 'Room Details' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1a75ff', // Strong, clean blue
                        'primary-dark': '#0f4da4', // Darker shade for hover
                        'primary': '#1a75ff', // Ensure DaisyUI 'primary' uses the custom blue
                    },
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* Base styles */
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
        
        /* Ensure primary button uses the custom blue */
        .btn-primary {
            background-color: #1a75ff;
            border-color: #1a75ff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0f4da4;
            border-color: #0f4da4;
        }
        .btn-primary-outline {
            border-color: #1a75ff;
            color: #1a75ff;
            background-color: transparent;
        }
        .btn-primary-outline:hover {
            background-color: #1a75ff;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen text-gray-800">

    <header class="sticky top-0 z-50 shadow-md bg-white border-b border-gray-200">
        <div class="navbar max-w-7xl mx-auto px-6 py-3">
            <div class="flex-1">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.front') : route('rooms.list') }}"
                       class="text-4xl font-extrabold text-primary-blue hover:text-primary-dark transition duration-300">
                        HOTEL BOOKIE
                    </a>
                @else
                    <a href="{{ route('home') }}" class="text-4xl font-extrabold text-primary-blue hover:text-primary-dark transition duration-300">
                        HOTEL BOOKIE
                    </a>
                @endauth
            </div>

            <div class="flex-none">
                <ul class="menu menu-horizontal gap-4 text-base font-semibold text-gray-700">
                    <li><a class="hover:text-primary-blue px-3">Home</a></li>
                    <li>
                        <details class="dropdown dropdown-end">
                            <summary class="hover:text-primary-blue px-3 cursor-pointer">Views</summary>
                            <ul class="bg-white rounded-box p-2 w-64 shadow-2xl border border-gray-100 mt-2 z-50">
                                <li><a href="viewbookings" class="hover:bg-gray-100 py-2">View Pending Bookings</a></li>
                                <li><a href="history" class="hover:bg-gray-100 py-2">View Booking History</a></li>
                                <li><a href="viewtransactions" class="hover:bg-gray-100 py-2">View Pending Transactions</a></li>
                                <li><a href="" class="hover:bg-gray-100 py-2">View Transaction History</a></li>
                                <li><a href="viewUser" class="hover:bg-gray-100 py-2">View Users</a></li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <label for="my-modal" class="modal-button cursor-pointer">
                            <span class="font-bold hover:text-primary-blue transition duration-200 px-3">Balance: ${{ auth()->user()->balance }}</span>
                        </label>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <li><a href="/admin/create" class="hover:text-primary-blue px-3">Add Room</a></li>
                    @endif
                </ul>
            </div>
            
            <div class="ml-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-error btn-sm text-white hover:bg-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm bg-primary-blue hover:bg-primary-dark border-none text-white">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <input type="checkbox" id="my-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative bg-white shadow-2xl">
            <label for="my-modal" class="btn btn-sm btn-circle absolute right-4 top-4 border-none bg-gray-200 hover:bg-gray-300">✕</label>
            <h3 class="text-xl font-bold mb-6 text-gray-800">Add Balance</h3>

            <form action="{{ route('admin.addBalance') }}" method="POST">
                @csrf
                <input type="number" name="balance" class="input input-bordered w-full mb-4 focus:border-primary-blue" placeholder="Enter amount" required min="1">
                <div class="modal-action mt-0">
                    <button type="submit" class="btn bg-primary-blue hover:bg-primary-dark border-none text-white w-full">Add Balance</button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-6 sm:px-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 border-b pb-4">Room Details</h1>

        <div class="flex flex-col lg:flex-row gap-10 items-start bg-white shadow-2xl rounded-xl p-8 border border-gray-100">
            
            <div class="w-full lg:w-1/2">
                <img src="{{ $rooms->image_link }}" 
                    alt="{{ $rooms->room_name }}" 
                    class="rounded-xl shadow-lg w-full object-cover h-[400px] mb-6">
                
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 mt-6">Gallery Highlights</h2>
                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-lg overflow-hidden shadow-md border border-gray-200">
                        <img src="{{ $rooms->room_image1 }}" alt="Room Interior 1" class="w-full h-24 object-cover hover:scale-105 transition duration-300 cursor-pointer">
                    </div>

                    <div class="rounded-lg overflow-hidden shadow-md border border-gray-200">
                        <img src="{{ $rooms->room_image2 }}" alt="Room Interior 2" class="w-full h-24 object-cover hover:scale-105 transition duration-300 cursor-pointer">
                    </div>

                    <div class="rounded-lg overflow-hidden shadow-md border border-gray-200">
                        <img src="{{ $rooms->room_image3 }}" alt="Room Interior 3" class="w-full h-24 object-cover hover:scale-105 transition duration-300 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-start">
                
                <div class="mb-6 pb-4 border-b">
                    <h2 class="text-4xl font-extrabold text-primary-blue mb-2">
                        {{ $rooms->room_name }}
                    </h2>
                    <p class="text-xl text-gray-600 mb-4">{{ strtoupper($rooms->room_type) }}</p>
                    <h3 class="text-4xl font-bold text-gray-800">
                        ${{ $rooms->room_price }} <span class="text-xl font-normal text-gray-500">/ Night</span>
                    </h3>
                </div>

                <div class="mb-6">
                    <h4 class="text-2xl font-semibold text-gray-800 mb-3">About This Room</h4>
                    <p class="text-lg text-gray-600 mb-4">
                        {{ $rooms->room_desc }}
                    </p>
                    
                    <div class="flex items-center">
                        <div class="rating rating-lg rating-half">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating-{{ $rooms->room_id }}" 
                                    class="bg-yellow-400 mask mask-star-2" disabled 
                                    @if ($i == round($rooms->rating)) checked @endif />
                            @endfor
                        </div>
                        <span class="ml-3 text-lg font-semibold text-gray-700">({{ number_format($rooms->rating, 1) }}/5)</span>
                    </div>
                </div>
                
                <div class="mb-8">
                    <button type="button" 
                        class="btn btn-lg btn-block btn-primary-outline w-full text-lg"
                        onclick="document.getElementById('freeItems').classList.toggle('hidden')">  
                        View Free Items & Amenities
                    </button>

                    <div id="freeItems" class="hidden mt-4 bg-gray-100 rounded-lg p-6 border border-gray-200">
                        <h5 class="text-xl font-bold text-gray-800 mb-3">Included Amenities:</h5>
                        <ul class="list-disc list-inside text-gray-700 text-lg grid grid-cols-2 gap-2">
                            @if (isset($rooms->free_items) && is_array($rooms->free_items))
                                @foreach($rooms->free_items as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            @else
                                <li>No specific amenities listed.</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="flex gap-4 w-full">
                    <form action="/admin/edit/{{ $rooms->room_id }}" method="GET" class="flex-1">
                        <button class="btn btn-lg w-full bg-primary-blue hover:bg-primary-dark border-none text-white font-bold">
                            Edit Room
                        </button>
                    </form>
                    <form action="/admin/delete/{{ $rooms->room_id }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you absolutely sure you want to delete the room: {{ $rooms->room_name }}?');">
                        @csrf
                        <button class="btn btn-lg btn-outline btn-error w-full font-bold">
                            Delete Room
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>