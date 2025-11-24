<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOTEL BOOKIE</title>

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
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center px-4">
        <h1 class="text-6xl md:text-7xl font-bold text-primary mb-4">
            HOTEL BOOKIE
        </h1>

        <p class="text-xl md:text-2xl text-gray-700 mb-8 max-w-2xl mx-auto">
            Welcome to HOTEL BOOKIE – Stay here, With bookie ;)
        </p>

        <a href="{{ auth()->user()->role === 'admin' ? route('admin.front') : route('rooms.list') }}"
           class="btn btn-primary btn-lg">
            Go to Rooms
        </a>
    </div>
</body>
</html>
