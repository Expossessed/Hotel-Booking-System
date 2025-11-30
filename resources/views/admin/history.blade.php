<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Bookings - Admin History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#1a75ff', // Strong, clean blue
                        'primary-dark': '#0f4da4', // Darker shade for hover
                        'primary': '#1a75ff', // Ensure DaisyUI 'primary' uses the custom blue
                    },
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* Base styles from previous files */
        input[readonly],
        textarea[readonly],
        input:disabled,
        textarea:disabled {
            pointer-events: none;
            cursor: default;
            caret-color: transparent;
        }

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
        
        /* Ensure primary button uses the custom blue */
        .btn-primary {
            background-color: #1a75ff;
            border-color: #1a75ff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0f4da4;
            border-color: #0f4da4;
        }

        /* Specific Table Styling for alignment */
        .table th:nth-child(1), .table td:nth-child(1) { text-align: left; } /* Customer */
        .table th:nth-child(2), .table td:nth-child(2) { text-align: left; } /* Email */
        .table th:nth-child(3), .table td:nth-child(3) { text-align: left; } /* Room */
        .table th:nth-child(4), .table td:nth-child(4) { text-align: center; } /* Start Date */
        .table th:nth-child(5), .table td:nth-child(5) { text-align: center; } /* End Date */
        .table th:nth-child(6), .table td:nth-child(6) { text-align: right; } /* Nights */
        .table th:nth-child(7), .table td:nth-child(7) { text-align: right; } /* Price/Night */
        .table th:nth-child(8), .table td:nth-child(8) { text-align: right; } /* Total */
    </style>
</head>

<body class="bg-gray-50 min-h-screen text-gray-800">

    <header class="sticky top-0 z-50 shadow-md bg-white border-b border-gray-200">
        <div class="navbar max-w-7xl mx-auto px-6 py-3">
            <div class="flex-1">
                @auth
                    <a href="{{ route('admin.front') }}"
                       class="text-4xl font-extrabold text-primary-blue hover:text-primary-dark transition duration-300">
                        HOTEL BOOKIE
                    </a>
                @else
                    <a href="{{ route('home') }}" class="text-4xl font-extrabold text-primary-blue hover:text-primary-dark transition duration-300">
                        HOTEL BOOKIE
                    </a>
                @endauth
            </div>

            <div class="flex-none">
                <ul class="menu menu-horizontal gap-4 text-base font-semibold text-gray-700">
                    <li><a class="hover:text-primary-blue px-3">Home</a></li>
                    <li>
                        <details class="dropdown dropdown-end">
                            <summary class="hover:text-primary-blue px-3 cursor-pointer">Views</summary>
                            <ul class="bg-white rounded-box p-2 w-64 shadow-2xl border border-gray-100 mt-2 z-50">
                                <li><a href="viewbookings" class="hover:bg-gray-100 py-2">View Pending Bookings</a></li>
                                <li><a href="history" class="hover:bg-gray-100 py-2">View Booking History</a></li>
                                <li><a href="viewtransactions" class="hover:bg-gray-100 py-2">View Pending Transactions</a></li>
                                <li><a href="" class="hover:bg-gray-100 py-2">View Transaction History</a></li>
                                <li><a href="viewUser" class="hover:bg-gray-100 py-2">View Users</a></li>
                            </ul>
                        </details>
                    </li>
                    <li>
                        <label for="my-modal" class="modal-button cursor-pointer">
                            <span class="font-bold hover:text-primary-blue transition duration-200 px-3">Balance: ${{ auth()->user()->balance }}</span>
                        </label>
                    </li>
                    <li><a href="/admin/create" class="hover:text-primary-blue px-3">Add Room</a></li>
                </ul>
            </div>
            
            <div class="ml-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-error btn-sm text-white hover:bg-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm bg-primary-blue hover:bg-primary-dark border-none text-white">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <input type="checkbox" id="my-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative bg-white shadow-2xl">
            <label for="my-modal" class="btn btn-sm btn-circle absolute right-4 top-4 border-none bg-gray-200 hover:bg-gray-300">✕</label>
            <h3 class="text-xl font-bold mb-6 text-gray-800">Add Balance</h3>

            <form action="{{ route('admin.addBalance') }}" method="POST">
                @csrf
                <input type="number" name="balance" class="input input-bordered w-full mb-4 focus:border-primary-blue" placeholder="Enter amount" required min="1">
                <div class="modal-action mt-0">
                    <button type="submit" class="btn bg-primary-blue hover:bg-primary-dark border-none text-white w-full">Add Balance</button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-12 px-6 sm:px-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 border-b pb-4">All Hotel Bookings</h1>

        @if ($bookings->isEmpty())
            <div class="bg-white shadow-xl rounded-lg p-10 text-center border border-gray-100">
                <p class="text-xl text-gray-600 font-medium">No bookings have been recorded yet.</p>
            </div>
        @else
            <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-100">
                <div class="overflow-x-auto w-full">
                    <table class="table w-full text-base">
                        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider">
                            <tr>
                                <th class="py-4 px-4 font-semibold text-left">Customer</th>
                                <th class="py-4 px-4 font-semibold text-left">Email</th>
                                <th class="py-4 px-4 font-semibold text-left">Room Type</th>
                                <th class="py-4 px-4 font-semibold text-center">Start Date</th>
                                <th class="py-4 px-4 font-semibold text-center">End Date</th>
                                <th class="py-4 px-4 font-semibold text-right">Nights</th>
                                <th class="py-4 px-4 font-semibold text-right">Price/Night</th>
                                <th class="py-4 px-4 font-semibold text-right">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                @php
                                    $total_cost = $booking->room_price * $booking->num_days;
                                    $customer_name = optional($booking->user)->name ?? 'Unknown user';
                                    $customer_email = optional($booking->user)->email ?? '-';
                                    $room_type = optional($booking->room)->room_type ?? 'Room deleted';
                                @endphp

                                <tr class="hover:bg-gray-50 border-b border-gray-200 transition duration-150">
                                    <td class="px-4 py-3 font-medium text-left">{{ $customer_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500 text-left">{{ $customer_email }}</td>
                                    <td class="px-4 py-3 text-left font-medium text-primary-blue">{{ $room_type }}</td>
                                    <td class="px-4 py-3 text-center">{{ $booking->book_date }}</td>
                                    <td class="px-4 py-3 text-center">{{ $booking->end_date }}</td>
                                    <td class="px-4 py-3 text-right">{{ $booking->num_days }}</td>
                                    <td class="px-4 py-3 text-right">${{ number_format($booking->room_price, 2) }}</td>
                                    <td class="px-4 py-3 font-bold text-lg text-right text-primary-blue">${{ number_format($total_cost, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</body>
</html>