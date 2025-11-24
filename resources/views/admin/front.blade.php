<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>

    <!-- Tailwind + DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    
    <div class="navbar shadow-md px-6 py-3 sticky top-0 z-50 flex lg:">
        <div class="flex-1">
            <a class="text-3xl font-bold text-primary">HOTEL BOOKIE</a>
        </div>

        <div class="content-center">
            <ul class="menu menu-horizontal gap-8 text-lg font-medium">
                <li><li><a class="text-primary font-bold">Home</a></li></li>
                <li>
                    <details class="group">
                        <summary class="cursor-pointer hover:text-primary">Book</summary>
                        <ul class="p-2 bg-white shadow-lg rounded-md mt-2 w-36">
                            <li><a class="hover:bg-primary/10 rounded-md">Suite</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Solo</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Duo</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Family</a></li>
                        </ul>
                    </details>
                </li>
                <li><a class="hover:text-primary">History</a></li>
                <li><a class="hover:text-primary">Add</a></li>
            </ul>
        </div>

        <div>
            <a class="btn btn-primary btn-sm">Login</a>
        </div>
    </div>

    <div class="flex flex-wrap justify-center items-start gap-8 py-12 px-6 bg-gray-100 min-h-screen">
        @foreach($rooms as $room)
        <div class="card w-80 bg-white shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 rounded-xl">
            <figure>
                <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                    alt="Suite" class="rounded-t-xl" />
            </figure>
            <div class="card-body">
                <h2 class="card-title text-primary">{{ $room->room_type }}</h2>
                <p>{{$rooms->room_desc}}</p>
                <div class="card-actions justify-end gap-2">
                    <button class="btn btn-outline btn-primary btn-sm">Edit</button>
                    <button class="btn btn-outline btn-primary btn-sm">View</button>
                    <button class="btn btn-outline btn-error  btn-sm">Delete</button>
                    <button class="btn btn-outline  btn-primary btn-sm">Book Now</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>


</div>

</body>

</html>
