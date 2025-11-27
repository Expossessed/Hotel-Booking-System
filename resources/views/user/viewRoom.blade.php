<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $room->room_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
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
    </style>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

    <!-- Main Container -->
<div class="max-w-3xl w-full bg-white shadow-lg rounded-lg overflow-hidden">

    <!-- Room Image from DB -->
    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
        <img 
            src="{{ $room->image_link }}" 
            alt="{{ $room->room_type }}" 
            class="w-full h-full object-cover"
        />
    </div>

    <!-- Room Interior Images Card -->
    <div class="container mx-auto py-12 px-4">
        <h2 class="text-4xl font-bold text-center text-black mb-8">Inside the Room</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image1 }}" alt="Room Interior 1" class="w-full h-64 object-cover">
                <div class="p-4"><p class="text-gray-700">Cozy bedroom with modern furniture.</p></div>
            </div>
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image2 }}" alt="Room Interior 2" class="w-full h-64 object-cover">
                <div class="p-4"><p class="text-gray-700">Spacious bathroom with elegant design.</p></div>
            </div>
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image3 }}" alt="Room Interior 3" class="w-full h-64 object-cover">
                <div class="p-4"><p class="text-gray-700">Beautiful view from the balcony.</p></div>
            </div>
        </div>
    </div>

</body>
</html>