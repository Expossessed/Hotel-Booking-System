<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $room->room_type }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

    <!-- Main Container -->
<div class="max-w-3xl w-full bg-white shadow-lg rounded-lg overflow-hidden">

    <!-- Image Placeholder with Link -->
    <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
        <img 
            src="https://tse2.mm.bing.net/th/id/OIP._NZ0Uz16uS_9wXnHy89QpQHaE5?rs=1&pid=ImgDetMain&o=7&rm=3" 
            alt="Room Image" 
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