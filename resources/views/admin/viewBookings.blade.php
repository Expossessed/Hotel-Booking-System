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

<body class="bg-gray-100 h-fit">

    
    <div class="navbar shadow-md bg-gray-100 px-6 py-3 sticky top-0 z-50 flex flex lg:">
        <div class="flex-1">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.front') : route('rooms.list') }}"
                   class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @else
                <a href="{{ route('home') }}" class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @endauth
        </div>

        <div class="content-center">
            <ul class="menu menu-horizontal gap-8 text-lg font-medium">
                <li><a class="text-primary font-bold">Home</a></li>
                <li><a href="/admin/create" class="hover:text-primary">Add</a></li>
            </ul>
        </div>

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>

    <div class="flex flex-wrap justify-center items-start gap-8 py-12 px-6 bg-gray-100 min-h-screen">
    
        @foreach($booking as $bookings)
        <div class="card w-80 bg-white shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 rounded-xl">
            
            <div class="card-body h-60 justify-start">
                <div>
                        <h2 class="text-xl font-bold mb-2 flex items-center gap-2">
                        <span>{{ $bookings->name }}</span>
                        <span>{{ $bookings->email }}</span>
                        <span>{{ $bookings->password }}</span>
                        <span>{{ $bookings->role }}</span>
                        
                    </h2>
                    
                </div>

                <div class="card-actions justify-end mt-5">
                    <form action="" method="GET">
                        <button class="btn btn-outline btn-primary btn-sm">Edit</button>
                    </form>
                    <form action="" method="GET">
                        <button class="btn btn-outline btn-primary btn-sm">View</button>
                    </form>
                    <form action="/admin/viewUser/{{ $user->id }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this room?');">
                        @csrf
                        <button class="btn btn-outline btn-error btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    
</div>

</body>

</html>
