<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHq6O3b+6N5b5p>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Create a Review</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="room_id" value="{{ request('room_id') }}">

        <div class="mb-4">
            <label for="rating" class="block text-lg font-medium mb-2">Rating (1-5):</label>
            <select id="rating" name="rating" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Select rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-lg font-medium mb-2">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Write your review here..."></textarea>
        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Submit Review
        </button>
    </form>
    </div>
</body>
</html>