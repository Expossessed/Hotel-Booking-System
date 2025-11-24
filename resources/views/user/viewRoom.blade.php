<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $room->room_type }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Content -->
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-4">Room Details</h1>

        <p class="text-lg"><strong>Room ID:</strong> {{ $room->room_id }}</p>
        <p class="text-lg"><strong>Room Type:</strong> {{ $room->room_type }}</p>
        <p class="text-lg"><strong>Room Price:</strong> ${{ $room->room_price }} per night</p>
        <p class="text-lg mb-4"><strong>Description:</strong> {{ $room->room_desc }}</p>

        <a href="{{ route('rooms.list') }}" class="btn btn-primary mt-4">
            ← Back to Home
        </a>
    </div>
</div>


</body>
</html>