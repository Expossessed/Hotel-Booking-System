<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1a75ff', // Strong, clean blue
                        'primary-dark': '#0f4da4', // Darker shade for hover
                        'primary': '#1a75ff', // Ensure DaisyUI 'primary' uses the custom blue
                        'error-red': '#ef4444', // Consistent red for error/reset
                    },
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* Base styles from previous files */
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

        .btn-error {
             background-color: #ef4444;
             border-color: #ef4444;
             color: white;
        }
        .btn-error.btn-outline {
            background-color: transparent;
            color: #ef4444;
            border-color: #ef4444;
        }
        .btn-error.btn-outline:hover {
            background-color: #fee2e2;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen text-gray-800">

    <header class="sticky top-0 z-50 shadow-md bg-white border-b border-gray-200 mb-12">
        <div class="navbar max-w-7xl mx-auto px-6 py-3">
            <div class="flex-1">
                @auth
                    <a href="{{ route('admin.front') }}"
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
                    @auth
                    <li>
                        <label for="my-modal" class="modal-button cursor-pointer">
                            <span class="font-bold hover:text-primary-blue transition duration-200 px-3">Balance: ${{ auth()->user()->balance }}</span>
                        </label>
                    </li>
                    <li><a href="/admin/create" class="hover:text-primary-blue px-3 text-primary-blue">Add Room</a></li>
                    @endauth
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

    <div class="flex items-center justify-center py-12 px-6 sm:px-8">
        <div class="card w-full max-w-3xl bg-white shadow-2xl rounded-xl p-10 border border-gray-100">
            <h2 class="text-4xl font-extrabold text-primary-blue mb-8 text-center">Create New Room</h2>
            
            <form action="/admin/create" method="POST" class="space-y-6">
                @csrf

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Room Name</span>
                    </label>
                    <input type="text" name="room_name" id="room_name" placeholder="Enter room name"
                        value="{{ old('room_name') }}"
                        class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" />
                    @error('room_name')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Room Type</span>
                    </label>
                    <select name="room_type" id="room_type"
                        class="select select-bordered w-full bg-gray-100 text-black border-gray-300 focus:border-primary-blue focus:ring-primary-blue">
                        <option value="" disabled selected>Choose a room type</option>
                        <option value="single" {{ old('room_type') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="family" {{ old('room_type') == 'family' ? 'selected' : '' }}>Family</option>
                        <option value="VIP" {{ old('room_type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                    </select>
                    @error('room_type')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Description</span>
                    </label>
                    <textarea name="room_desc" id="room_desc" placeholder="Enter room description"
                        class="textarea textarea-bordered w-full h-32 bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue">{{ old('room_desc') }}</textarea>
                    @error('room_desc')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg font-semibold text-gray-700">Price per Night ($)</span>
                        </label>
                        <input type="number" id="room_price" name="room_price" placeholder="Enter price"
                            class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue"
                            min="0" step="0.01" value="{{ old('room_price') }}">
                        @error('room_price')
                            <span class="text-error mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-lg font-semibold text-gray-700">Available Rooms</span>
                        </label>
                        <input type="number" id="available_rooms" name="available_rooms" placeholder="Number of available rooms"
                            class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue"
                            min="0" value="{{ old('available_rooms') }}">
                        @error('available_rooms')
                            <span class="text-error mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-control w-full pt-4">
                    <label class="label cursor-pointer justify-start gap-4">
                        <input type="checkbox" name="is_available" id="is_available" value="1" 
                                class="checkbox checkbox-lg checkbox-primary" 
                                {{ old('is_available', 1) ? 'checked' : '' }}>
                        <span class="label-text text-lg font-semibold text-gray-700">Room is available for booking</span>
                    </label>
                    @error('is_available')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <h3 class="text-2xl font-bold text-gray-800 pt-6 border-t mt-6">Image Links</h3>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Main Display Image Link (URL)</span>
                    </label>
                    <input type="text" name="image_link" id="image_link" placeholder="Enter image link"
                        value="{{ old('image_link') }}"
                        class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" />
                    @error('image_link')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base font-semibold text-gray-700">Room Image 1 URL</span>
                        </label>
                        <input type="text" id="room_image1" name="room_image1" placeholder="Enter image link"
                            class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" value="{{ old('room_image1') }}">
                        @error('room_image1')
                            <span class="text-error mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base font-semibold text-gray-700">Room Image 2 URL</span>
                        </label>
                        <input type="text" id="room_image2" name="room_image2" placeholder="Enter image link"
                            class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" value="{{ old('room_image2') }}">
                        @error('room_image2')
                            <span class="text-error mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text text-base font-semibold text-gray-700">Room Image 3 URL</span>
                        </label>
                        <input type="text" id="room_image3" name="room_image3" placeholder="Enter image link"
                            class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" value="{{ old('room_image3') }}">
                        @error('room_image3')
                            <span class="text-error mt-1 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 pt-6 border-t mt-6">Free Items & Amenities</h3>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Select Included Amenities</span>
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @php
                            $freeItems = ['Wi-Fi', 'Breakfast', 'Parking', 'Fitness Center', 'Room Service', 'Swimming Pool'];
                        @endphp
                        
                        @foreach($freeItems as $item)
                            <label class="label cursor-pointer justify-start gap-2">
                                <input type="checkbox" name="free_items[]" value="{{ $item }}" class="checkbox checkbox-primary"
                                    {{ in_array($item, old('free_items', [])) ? 'checked' : '' }}>
                                <span class="label-text text-gray-600">{{ $item }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('free_items')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="flex justify-end gap-4 pt-8 border-t mt-8">
                    <button type="reset" class="btn btn-outline btn-error hover:text-white">Clear Form</button>
                    <button type="submit" class="btn btn-primary bg-primary-blue hover:bg-primary-dark">Create Room</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>