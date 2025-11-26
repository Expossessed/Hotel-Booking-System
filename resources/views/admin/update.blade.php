<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="card w-full max-w-2xl bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-4xl font-bold text-primary mb-6 text-center">Update Room</h2>
        
        <form action="/admin/edit/{{ $rooms->room_id }}" method="POST" class="space-y-6">
            @csrf

            <!-- Room Type -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Room Type</span>
                </label>
                <textarea name="room_type" id="room_type" placeholder="Enter room type"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-15">{{ old('room_type', $rooms->room_type) }}</textarea>
                @error('room_type')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Room Description -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Description</span>
                </label>
                <textarea name="room_desc" id="room_desc" placeholder="Enter room description"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-32">{{ old('room_desc', $rooms->room_desc) }}</textarea>
                @error('room_desc')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Price per Night -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Price per Night ($)</span>
                </label>
                <input type="number" id="room_price" name="room_price" placeholder="Enter price"
                    class="input bg-gray-200 text-black placeholder-gray-500 input-bordered w-full"
                    min="0" step="0.01" value="{{ old('room_price', $rooms->room_price) }}">
                @error('room_price')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Available Rooms -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Available Rooms</span>
                </label>
                <input type="number" id="available_rooms" name="available_rooms" placeholder="Number of available rooms"
                    class="input bg-gray-200 text-black placeholder-gray-500 input-bordered w-full"
                    min="0" value="{{ old('available_rooms', $rooms->available_rooms) }}">
                @error('available_rooms')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Is Available -->
            <div class="form-control w-full">
                <label class="label cursor-pointer">
                    <span class="label-text font-semibold text-black">Is Available?</span>
                    <input type="checkbox" name="is_available" id="is_available" value="1" class="checkbox checkbox-primary" {{ old('is_available', $rooms->is_available) ? 'checked' : '' }}>
                </label>
                @error('is_available')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Image</span>
                </label>
                <textarea name="image_link" id="image_link" placeholder="Enter image link"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-32">{{ old('image_link', $rooms->image_link) }}</textarea>
                @error('image_link')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 mt-4">
                <a href="/admin/home" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Room</button>
            </div>
        </form>
    </div>

</body>
</html>
