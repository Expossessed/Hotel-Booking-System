<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Room</title>
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
        <h2 class="text-4xl font-bold text-primary mb-6 text-center">Create New Room</h2>
        
        <form action="/admin/create" method="POST" class="space-y-6">
            @csrf

            <!-- Room Name (unique) -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Room Name</span>
                </label>
                <input
                    type="text"
                    name="room_name"
                    id="room_name"
                    placeholder="e.g. 1st Floor - Room 1"
                    class="input bg-gray-200 text-black placeholder-gray-500 input-bordered w-full"
                    value="{{ old('room_name') }}"
                >
                @error('room_name')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Room Type (fixed options) -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Room Type</span>
                </label>
                <select
                    name="room_type"
                    id="room_type"
                    class="select bg-gray-200 text-black select-bordered w-full"
                >
                    <option value="solo" {{ old('room_type') === 'solo' ? 'selected' : '' }}>Solo</option>
                    <option value="family" {{ old('room_type') === 'family' ? 'selected' : '' }}>Family</option>
                    <option value="deluxe_vip" {{ old('room_type') === 'deluxe_vip' ? 'selected' : '' }}>Deluxe / VIP</option>
                </select>
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
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-32">{{ old('room_desc') }}</textarea>
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
                    min="0" step="0.01" value="{{ old('room_price') }}">
                @error('room_price')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Available Rooms (preset per room type, read-only info) -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Capacity (rooms of this type)</span>
                </label>
                <input
                    type="text"
                    id="available_rooms_display"
                    class="input bg-gray-200 text-black input-bordered w-full"
                    value="Solo: 20 • Family: 10 • Deluxe / VIP: 5"
                    readonly
                >
                <span class="text-xs text-gray-500 mt-1">Capacity is automatically set from the room type you choose.</span>
            </div>

            <!-- Is Available -->
            <div class="form-control w-full">
                <label class="label cursor-pointer">
                    <span class="label-text font-semibold text-black">Is Available?</span>
                    <input type="checkbox" name="is_available" id="is_available" value="1" class="checkbox checkbox-primary" {{ old('is_available') ? 'checked' : '' }}>
                </label>
                @error('is_available')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Image</span>
                </label>
                <input type="string" id="image_link" name="image_link" placeholder="Enter image "
                    class="input bg-gray-200 text-black placeholder-gray-500 input-bordered w-full" value="{{ old('image_link') }}">
                @error('image_link')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-4 mt-4">
                <button type="reset" class="btn btn-outline btn-error">Reset</button>
                <button type="submit" class="btn btn-primary">Create Room</button>
            </div>
        </form>
    </div>

</body>
</html>
