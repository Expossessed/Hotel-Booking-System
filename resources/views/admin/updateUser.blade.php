<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User: {{ $users->name ?? 'User' }}</title> 
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
    </style>
</head>

<body class="bg-gray-50 min-h-screen text-gray-800">

    <header class="sticky top-0 z-50 shadow-md bg-white border-b border-gray-200 mb-12">
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

    <div class="flex items-center justify-center py-12 px-6 sm:px-8">
        <div class="card w-full max-w-xl bg-white shadow-2xl rounded-xl p-10 border border-gray-100">
            <h2 class="text-4xl font-extrabold text-primary-blue mb-8 text-center">📝 Edit User: {{ $users->name }}</h2>
            
            <form action="/admin/updateUser/{{ $users->id }}" method="POST" class="space-y-6">
                @csrf
                {{-- @method('PUT') --}} 

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Name</span>
                    </label>
                    <input type="text" name="name" id="name" placeholder="Enter name"
                        value="{{ old('name', $users->name) }}"
                        class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" />
                    @error('name')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Email</span>
                    </label>
                    <input type="email" name="email" id="email" placeholder="Enter email"
                        value="{{ old('email', $users->email) }}"
                        class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" />
                    @error('email')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">New Password (Leave blank to keep current)</span>
                    </label>
                    <input type="password" name="password" id="password" placeholder="Enter new password"
                        class="input input-bordered w-full bg-gray-100 text-black placeholder-gray-500 border-gray-300 focus:border-primary-blue focus:ring-primary-blue" />
                    @error('password')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-lg font-semibold text-gray-700">Role</span>
                    </label>
                    <select name="role" id="role"
                        class="select select-bordered w-full bg-gray-100 text-black border-gray-300 focus:border-primary-blue focus:ring-primary-blue">
                        <option value="user" {{ old('role', $users->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $users->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <span class="text-error mt-1 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end gap-4 pt-6">
                    <a href="/admin/home" class="btn btn-outline border-gray-300 text-gray-600 hover:bg-gray-100">Cancel</a>
                    <button type="submit" class="btn btn-primary bg-primary-blue hover:bg-primary-dark">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>