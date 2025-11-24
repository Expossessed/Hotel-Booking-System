<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 h-fit">

    
    <div class="navbar shadow-md bg-gray-100 px-6 py-3 sticky top-0 z-50 flex lg:">
        <div class="flex-1">
            <a class="text-3xl font-bold text-primary">HOTEL BOOKIE</a>
        </div>

        <div class="content-center">
            <ul class="menu menu-horizontal gap-8 text-lg font-medium">
                <li><a href="/admin/home" class="text-primary font-bold">Home</a></li>
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
                <li><a href="/admin/create" class="hover:text-primary">Add</a></li>
            </ul>
        </div>

        <div>
            <a class="btn btn-primary btn-sm">Login</a>
        </div>
    </div>
    <div class="card w-full  bg-white shadow-xl rounded-xl p-8">
        <div class="bg-gray-100 min-h-screen flex flex-col items-center">
       <h1 class="text-6xl font-bold text-black mt-10 ml-10">Room Details </h1>
        <div class="flex flex-row justify-center hero bg-gray-100 flex mt-10  items-center">
            <div class="hero-content ">
                <img
                src="https://housr.in/_next/image?url=https%3A%2F%2Fblogcms.housr.in%2Fwp-content%2Fuploads%2F2024%2F11%2FHousr-HSR-1-HDR-1.jpg&w=1080&q=75"
                class="max-w-3xl rounded-lg shadow-2xl"
                />
            </div>
            <div class="flex flex-col justify-start gap-8">
                <div class="flex flex-col gap-8 h-40">
                    <div class="flex flex-col gap-3">
                        <h2 class="card-title text-primary text-7xl">
                            {{ $rooms->room_type }}
                        </h2>
                        <h2 class="card-title text-black text-4xl">
                            ${{ $rooms->room_price }}/Night
                        </h2>
                    </div>
                    
                    <p class="text-4xl max-w-4xl">
                        {{$rooms->room_desc}}
                    </p> 
                </div>
                <div class="flex flex-row justify-end items-end h-80 "> 
                    <div class="card-actions justify-end gap-2">
                        <form action="/admin/home/{{ $rooms->id }}" method="GET">
                            <button class="btn btn-outline flex-col items-center btn-primary btn-md text-3xl">Edit</button>
                        </form>
                        <form action="/admin/home/{{ $rooms->id }}" method="GET">
                            <button class="btn btn-outline flex-col items-center btn-error  btn-md text-3xl">Delete</button>
                        </form>
                        
                    </div>
                </div>
            </div>

        
        </div> 
    </div>
    </div>
    
    
</div>



</body>

</html>
