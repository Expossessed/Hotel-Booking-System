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
        
        <form action="/admin/updateUser/{{ $users->id }}" method="POST" class="space-y-6">
            @csrf

            
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Name</span>
                </label>
                <textarea name="name" id="name" placeholder="Enter name"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-15">{{ old('name', $users->name) }}</textarea>
                @error('name')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Email</span>
                </label>
                <textarea type="email" name="email" id="email" placeholder="Enter email"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-15">{{ old('email', $users->email) }}</textarea>
                @error('email')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Password</span>
                </label>
                <textarea type="password" name="password" id="password" placeholder="Enter password"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-15">{{ old('password', $users->password) }}</textarea>
                @error('password')
                    <span class="text-error mt-1 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text font-semibold text-black">Role</span>
                </label>
                <textarea type="password" name="role" id="role" placeholder="Enter role"
                    class="textarea bg-gray-200 text-black placeholder-gray-500 textarea-bordered w-full h-15">{{ old('role', $users->role) }}</textarea>
                @error('role')
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
