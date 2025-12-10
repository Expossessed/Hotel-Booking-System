<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body>
    <div class="container mx-auto p-6">
        <div class="max-w-2xl mx-auto mb-6">
            <form method="GET" action="{{ route('reviews.viewReviews') }}" class="flex gap-2">
                <input name="room_name" value="{{ request('room_name') ?? $room_name ?? '' }}" placeholder="Search by room name (e.g. Deluxe Suite)" class="flex-1 border border-gray-300 rounded-lg px-3 py-2" />
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
                <a href="{{ route('reviews.viewReviews') }}" class="ml-2 px-4 py-2 rounded-lg border border-gray-200">All</a>
            </form>
        </div>
        <h1 class="text-3xl font-bold mb-6">Reviews for: {{ $room_name ?? ('Room ID: ' . ($room_id ?? 'All')) }}</h1>

        @if($reviews->isEmpty())
            <p class="text-gray-600">No reviews available for this room.</p>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                            <div class="flex items-center mb-2 justify-between">
                                <div class="flex items-center">
                                    <div class="mr-3 font-semibold text-gray-800">{{ $review->user?->name ?? 'Guest' }}</div>
                                    <span class="text-yellow-500 mr-2">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    &#9733;
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    &#9734;
                                @endfor
                            </span>
                            <span class="text-gray-500 text-sm">Reviewed on {{ $review->created_at->format('F j, Y') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>