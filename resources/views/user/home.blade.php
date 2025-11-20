<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Booking - Rooms</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <nav class="navbar shadow-md px-6 py-3 sticky top-0 z-50 bg-white">
        <div class="flex-1">
            <a class="text-3xl font-bold text-primary">HOTEL BOOKIE</a>
        </div>

        <div class="hidden lg:block">
            <ul class="menu menu-horizontal gap-6 text-lg font-medium">
                <li><a class="text-primary font-bold">Home</a></li>
                <li>
                    <details class="group">
                        <summary class="cursor-pointer hover:text-primary">Book</summary>
                        <ul class="p-2 bg-white shadow-lg rounded-md mt-2 w-40">
                            <li><a class="hover:bg-primary/10 rounded-md">Suite</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Solo</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Duo</a></li>
                            <li><a class="hover:bg-primary/10 rounded-md">Family</a></li>
                        </ul>
                    </details>
                </li>
                <li><a class="hover:text-primary">History</a></li>
                
            </ul>
        </div>

        <div>
            <a class="btn btn-primary btn-sm">Login</a>
        </div>
    </nav>

    <main class="px-6 py-8">
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
                    <button class="btn btn-sm btn-outline">All</button>
                    <button class="btn btn-sm">Available</button>
                    <button class="btn btn-sm">Price Low</button>
                    <button class="btn btn-sm">Price High</button>
                </div>
            </div>
        </section>

        <h1>No rooms available on listing</h1>

</body>

</html>