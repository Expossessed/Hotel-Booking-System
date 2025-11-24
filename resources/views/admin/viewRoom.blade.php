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
            
            <!-- Room Image -->
            <div class="w-full lg:w-1/2">
                <img src="{{ $rooms->image_link }}" 
                     alt="{{ $rooms->room_type }}" 
                     class="rounded-xl shadow-md w-full object-cover h-[400px]">
            </div>

            <!-- Room Info -->
            <div class="w-full lg:w-1/2 flex flex-col justify-between gap-8">
                
                <div>
                    <h2 class="text-4xl md:text-5xl font-bold text-primary mb-2">
                        {{ $rooms->room_type }}
                    </h2>
                    <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">
                        ${{ $rooms->room_price }}/Night
                    </h3>
                    <p class="text-lg md:text-xl text-gray-700">
                        {{ $rooms->room_desc }}
                    </p>
                </div>

                <div class="flex gap-4 mt-6">
                    <form action="/admin/edit/{{ $rooms->room_id }}" method="GET">
                        <button class="btn btn-primary btn-outline text-lg md:text-xl w-32">Edit</button>
                    </form>
                    <form action="/admin/delete/{{ $rooms->room_id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');">
                        @csrf
                        <button class="btn btn-error btn-outline text-lg md:text-xl w-32">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>