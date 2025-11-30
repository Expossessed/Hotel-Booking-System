<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1a75ff', // A strong, clean blue
                        'primary-dark': '#0f4da4', // Darker shade for hover
                        'accent-green': '#3db6b1', // Keeping the original accent for flavor if needed
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

        /* Custom Card Styles for a Blocky, Premium Look */
        .card-room-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.6s ease-in-out;
        }
        .card-room:hover .card-room-image {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">

    <header class="sticky top-0 z-50 shadow-md bg-white">
        <div class="bg-gray-100 border-b border-gray-200 py-2">
            <div class="max-w-7xl mx-auto flex justify-end px-6 sm:px-8">
                @auth
                    <span class="text-sm font-medium text-gray-600 mr-4 hidden sm:inline-block">Welcome, {{ auth()->user()->name ?? 'User' }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-primary-blue hover:text-primary-dark transition duration-200">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-primary-blue hover:text-primary-dark transition duration-200 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-primary-blue hover:text-primary-dark transition duration-200">Register</a>
                @endauth
            </div>
        </div>

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

    <div class="max-w-7xl mx-auto py-16 px-6 sm:px-8">
        <h1 class="text-4xl font-light mb-10 text-center">Available <span class="font-extrabold text-primary-blue">Accommodations</span></h1>
        
        @if($rooms->isEmpty())
            <div class="w-full max-w-xl mx-auto bg-white shadow-xl rounded-lg p-10 text-center border-t-4 border-primary-blue">
                <h2 class="text-3xl font-extrabold mb-3 text-gray-800">No rooms added yet</h2>
                <p class="text-gray-600 mb-6 text-lg">Start by creating a new room to populate your hotel listing.</p>
                <a href="/admin/create" class="btn btn-lg bg-primary-blue hover:bg-primary-dark border-none text-white">Add First Room</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($rooms as $room)
                <div class="card card-room bg-white shadow-xl hover:shadow-2xl transition-all duration-500 rounded-lg overflow-hidden group">
                    
                    <figure class="overflow-hidden">
                        <img src="{{ $room->image_link }}"
                            alt="{{ $room->room_name }}"
                            class="card-room-image" />
                    </figure>

                    <div class="card-body p-6">
                        
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $room->room_name }}</h2>
                            @if (!$room->is_available)
                                <span class="badge badge-error text-xs p-3 font-semibold text-white">Unavailable</span>
                            @else
                                <span class="badge badge-success text-xs p-3 font-semibold text-white">Available</span>
                            @endif
                        </div>
                        
                        <p class="text-3xl font-extrabold text-primary-blue mb-3">${{ $room->room_price }} / <span class="text-lg font-normal text-gray-500">Night</span></p>
                        
                        <p class="text-sm text-gray-600 mb-6 line-clamp-3">
                            {{ $room->room_desc }}
                        </p>

                        <div class="card-actions justify-end space-y-2">
                            <form action="/admin/view/{{ $room->room_id }}" method="GET" class="w-full">
                                <button class="btn w-full bg-primary-blue hover:bg-primary-dark border-none text-white font-bold">View Details</button>
                            </form>
                            
                            <div class="flex justify-between w-full gap-2">
                                <form action="/admin/edit/{{ $room->room_id }}" method="GET" class="flex-1">
                                    <button class="btn btn-outline btn-warning btn-sm w-full">Edit</button>
                                </form>
                                <form action="/admin/delete/{{ $room->room_id }}" method="POST" class="flex-1"
                                        onsubmit="return confirm('Are you sure you want to delete this room?');">
                                    @csrf
                                    <button class="btn btn-outline btn-error btn-sm w-full">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>