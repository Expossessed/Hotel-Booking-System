<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings - Admin History</title>
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
<body class="bg-gray-100 min-h-screen">

    <div class="navbar shadow-md bg-gray-100 px-6 py-3 sticky top-0 z-50 flex flex lg:">
        <div class="flex-1">
            @auth
                <a href="{{ route('admin.front') }}"
                   class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @else
                <a href="{{ route('home') }}" class="text-3xl font-bold text-primary">
                    HOTEL BOOKIE
                </a>
            @endauth
        </div>

        <div class="content-center">
            <ul class="menu menu-horizontal gap-8 text-lg font-medium">
                <li><a href="{{ route('admin.front') }}" class="hover:text-primary">Home</a></li>
                <li><a class="text-primary font-bold">History</a></li>
                <li><a href="/admin/create" class="hover:text-primary">Add</a></li>
            </ul>
        </div>

        <div>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>

    <div class="max-w-6xl mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold mb-6">All Bookings</h1>

        @if ($bookings->isEmpty())
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <p class="text-gray-600">No bookings have been made yet.</p>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-auto">
                <table class="table w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Customer</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Room</th>
                            <th class="px-4 py-2">Start Date</th>
                            <th class="px-4 py-2">End Date</th>
                            <th class="px-4 py-2">Nights</th>
                            <th class="px-4 py-2">Price/Night</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    {{ optional($booking->user)->name ?? 'Unknown user' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ optional($booking->user)->email ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ optional($booking->room)->room_type ?? 'Room deleted' }}
                                </td>
                                <td class="px-4 py-2">{{ $booking->book_date }}</td>
                                <td class="px-4 py-2">{{ $booking->end_date }}</td>
                                <td class="px-4 py-2">{{ $booking->num_days }}</td>
                                <td class="px-4 py-2">${{ $booking->room_price }}</td>
                                <td class="px-4 py-2 font-semibold">
                                    ${{ $booking->room_price * $booking->num_days }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
