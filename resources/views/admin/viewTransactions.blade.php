<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
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

<body class="bg-gray-100 h-fit">
    
    
    <div class="navbar shadow-md bg-gray-100 px-6 py-3 sticky top-0 z-50 flex flex lg:">
        <div class="flex-1">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.front') : route('rooms.list') }}"
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
                <li><a class="text-primary font-bold">Home</a></li>
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


    
    <div class=" card bg-white flex flex-wrap justify-start items-center  py-12 px-6 bg-gray-100 min-h-screen w-full">
        <div class="overflow-x-auto w-full">
  <table class="table flex-auto w-full">
    <thead>
      <tr>
        <th></th>
        <th>Bookers Name</th>
        <th>Booked Room</th>
        <th>Price Per Night</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Days Booked</th>
        <th>Total</th>
        <th>Price Paid</th>
      </tr>
    </thead>
    @foreach ($transactions as $transactions)
        <tbody>
        <tr class="hover:bg-base-300">
            @if ($transactions->room->room_price * $transactions->booker->num_days >= $transactions->price_paid)
                <th>{{ $transactions->booker->name }}</th>
                <td>{{ $transactions->room->room_type }}</td>
                <td>{{ $transactions->room->room_price }}</td>
                <td>{{ $transactions->book_date }}</td>
                <td>{{ $transactions->end_date }}</td>
                <td>{{ $transactions->room->room_price * $transactions->booker->num_days }}</td>
                <td>{{ $transactions->price_paid }}</td>
                <td>
                    <button class="btn btn-primary btn-outline text-md btn-sm">Edit</button>
                    <button class="btn btn-outline btn-error text-md btn-sm">Delete</button>
                </td>
            @endif
      </tr>
    </tbody>
    @endforeach
    
  </table>
</div>
    
</div>

</body>

</html>
