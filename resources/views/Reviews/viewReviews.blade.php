<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Reviews for Room ID: {{ $room_id }}</h1>

        @if($reviews->isEmpty())
            <p class="text-gray-600">No reviews available for this room.</p>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <div class="flex items-center mb-2">
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