<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Create Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        /* 🎨 STYLING: Consistent Dark Brown & Orange Theme (Copied from Homepage) */

        /* Define Core Colors */
        :root {
            --color-dark-brown: #3C2A21; /* Rich dark brown for background/side panel */
            --color-accent-orange: #C45B3A; /* Reddish-orange accent (like the button/bed runner) */
            --color-text-light: #F7F7F7; /* Near-white for text */
        }

        /* 1. Reset Body Background */
        body {
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            color: var(--color-text-light);
            font-family: sans-serif; /* Using sans-serif for form consistency */
        }
        
        /* 2. NAVBAR Styling (Clean, Simple, White on Dark) */
        .navbar-top {
            /* Using a slightly darker shade for the fixed bar */
            background-color: #312620; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a {
            color: var(--color-text-light);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-menu a:hover {
            color: var(--color-accent-orange);
        }

        /* Profile Dropdown Styling */
        .profile-dropdown-content {
            background: #312620;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }


        /* 3. Accent Button Style (Orange/Brown) */
        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }
        .btn-outline-accent {
            color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
        }
        .btn-outline-accent:hover {
            background-color: var(--color-accent-orange);
            color: white;
        }

        /* 4. Form/Container Styling */
        .booking-container {
            background-color: #312620; /* Slightly darker background for the main container */
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Input Styling */
        .input-dark, .select-dark {
            background-color: rgba(255, 255, 255, 0.05); /* White/5 opacity for inputs */
            border-color: rgba(255, 255, 255, 0.3); /* Lighter border for visibility */
            color: var(--color-text-light);
            transition: border-color 0.2s ease;
        }
        .input-dark:focus, .select-dark:focus {
            border-color: var(--color-accent-orange);
        }
        .input-readonly {
            background-color: #312620; /* Darker background for readonly fields */
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Number of Days Buttons */
        .btn-num-days {
            color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
        }
        .btn-num-days:hover {
            background-color: var(--color-accent-orange);
            color: white;
        }
    </style>
</head>
<body class="relative">

<div class="navbar navbar-top px-4 md:px-12 py-3 sticky top-0 z-50 shadow-lg">
    
    <div class="flex-1">
        <a href="{{ route('home') }}" class="text-xl md:text-2xl font-extrabold tracking-widest text-white">
            HOTEL BOOKIE
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal p-0 hidden md:flex gap-6 navbar-menu text-lg">
            <li><a href="">Home</a></li>
            <li><a href="rooms">Rooms</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contact">Contact</a></li>
        </ul>

        @auth
        <div class="dropdown dropdown-end ml-6">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border-2 border-white/50 hover:bg-white/10 transition-colors">
                <div class="w-10 rounded-full bg-white/10 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 19.5a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="bookings.html" class="font-medium">My Bookings</a></li>
                
                <li><a href="{{ route('profile.edit') }}" class="font-medium">Profile & Settings</a></li>
                @if(auth()->user()->isAdmin())
                    <li><a href="{{ route('admin.front') }}" class="text-yellow-400 font-medium">Admin Panel</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        @else
        <div class="ml-8 hidden md:block">
            <a href="{{ route('bookings.form') }}" class="btn btn-accent-color btn-md px-6 font-semibold rounded-none">Book Now</a>
        </div>
        @endauth


        <div class="dropdown dropdown-end md:hidden ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="">Home</a></li>
                <li><a href="rooms">Rooms</a></li>
                <li><a href="about">About</a></li>
                <li><a href="contact">Contact</a></li>
                
                @auth
                    <li><a href="bookings.html" class="font-medium">My Bookings</a></li>
                    
                    <li><a href="{{ route('profile.edit') }}" class="font-medium">Profile</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="mt-2"><a href="{{ route('bookings.form') }}" class="btn btn-accent-color btn-sm rounded-none">Book Now</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>

<main>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="javascript:history.back()" class="btn btn-ghost text-white/80 hover:bg-white/10 rounded-none">← Back to Rooms</a>
        </div>

        <div class="booking-container rounded-lg shadow-2xl overflow-hidden">
            <div class="p-6 border-b border-white/10 bg-[#3C2A21]">
                <h3 class="text-3xl font-serif text-white tracking-wide">Create New Booking</h3>
            </div>

            <div class="p-8 text-white">
                @if ($errors->any())
                    <div role="alert" class="alert alert-error shadow-lg mb-6 rounded-none bg-red-800/30 border-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.5 19.5L19.5 4.5"/></svg>
                        <div class="text-red-300">
                            <strong>There were some problems with your input:</strong>
                            <ul class="mt-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('bookings.create') }}" method="POST">
                    @csrf

                    <input type="hidden" name="room_id" value="{{ $room_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="mb-4 md:mb-0">
                            <label class="block text-sm font-light text-white/85 mb-2">Room Type</label>
                            <input type="text" name="room_type" class="input input-bordered w-full input-dark input-readonly rounded-none" value="{{ old('room_type', $room_type ?? 'N/A') }}" readonly tabindex="-1">
                        </div>

                        <div class="mb-4 md:mb-0">
                            <label for="room_price" class="block text-sm font-light text-white/85 mb-2">Price per Night</label>
                            <input type="text" name="room_price" id="room_price" class="input input-bordered w-full input-dark input-readonly rounded-none" value="{{ old('room_price', $room_price ? '$' . number_format($room_price, 2) : 'N/A') }}" readonly tabindex="-1">
                            <input type="hidden" id="room_price_hidden" value="{{ $room_price ?? 0 }}">
                        </div>

                        <div>
                            <label for="book_date" class="block text-sm font-light text-white/85 mb-2">Check-in Date *</label>
                            <input type="date" name="book_date" id="book_date" class="input input-bordered w-full input-dark rounded-none" value="{{ old('book_date') }}" required>
                        </div>

                        <div>
                            <label for="num_days" class="block text-sm font-light text-white/85 mb-2">Number of Nights *</label>
                            <div class="flex items-center gap-3">
                                <button type="button" class="btn btn-sm btn-outline btn-num-days rounded-none" id="minus_days">-</button>
                                <input type="number" name="num_days" id="num_days" class="input input-bordered w-24 text-center input-dark rounded-none" value="{{ old('num_days', 1) }}" min="1">
                                <button type="button" class="btn btn-sm btn-outline btn-num-days rounded-none" id="plus_days">+</button>
                            </div>
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-light text-white/85 mb-2">Check-out Date (Calculated)</label>
                            <input type="date" name="end_date" id="end_date" class="input input-bordered w-full input-dark input-readonly rounded-none" value="" readonly tabindex="-1">
                        </div>

                        <div>
                            <label for="total_price" class="block text-sm font-light text-white/85 mb-2">Total Price</label>
                            <input type="text" name="total_price_display" id="total_price_display" class="input input-bordered w-full input-dark input-readonly text-xl font-bold rounded-none" value="{{ old('total_price', $preview_total ?? '') }}" readonly tabindex="-1">
                            <input type="hidden" name="total_price" id="total_price"> </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="btn btn-accent-color btn-lg px-8 rounded-none font-semibold">
                            Create Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


@if (!empty($preview ?? false))
    <div id="booking-preview" class="modal modal-open z-50">
        <div class="modal-box bg-[#312620] text-white max-w-md w-full rounded-lg shadow-2xl">
            <h5 class="text-2xl font-serif text-white mb-4 border-b border-white/10 pb-2">Booking Receipt</h5>
            <ul class="space-y-3 mb-6 text-sm">
                <li class="flex justify-between"><strong>Customer Name:</strong> <span class="text-white/80">{{ $preview_user_name }}</span></li>
                <li class="flex justify-between"><strong>Customer Email:</strong> <span class="text-white/80">{{ $preview_user_email }}</span></li>
                <li class="flex justify-between"><strong>Room Type:</strong> <span class="text-white/80">{{ $preview_room_type }}</span></li>
                <li class="flex justify-between"><strong>Check-in Date:</strong> <span class="text-white/80">{{ $preview_book_date }}</span></li>
                <li class="flex justify-between"><strong>Check-out Date:</strong> <span class="text-white/80">{{ $preview_end_date }}</span></li>
                <li class="flex justify-between"><strong>Number of Nights:</strong> <span class="text-white/80">{{ $preview_num_days }}</span></li>
                <li class="flex justify-between"><strong>Price per Night:</strong> <span class="text-white/80">{{ $preview_room_price }}</span></li>
                <li class="flex justify-between pt-3 border-t border-white/10 text-xl font-bold"><strong>Total Price:</strong> <span class="text-white">${{ $preview_total }}</span></li>
            </ul>
            <p class="mb-4 text-lg">Are you sure you want to confirm this booking?</p>
            <div class="flex gap-3 justify-end">
                <form method="POST" action="{{ route('bookings.create') }}">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room_id }}">
                    <input type="hidden" name="book_date" value="{{ $preview_book_date }}">
                    <input type="hidden" name="num_days" value="{{ $preview_num_days }}">
                    <input type="hidden" name="confirm" value="yes">
                    <button type="submit" class="btn btn-accent-color btn-md rounded-none font-semibold">Yes, Confirm</button>
                </form>
                <button type="button" class="btn btn-outline btn-num-days btn-md rounded-none" onclick="document.getElementById('booking-preview').remove();">No, Cancel</button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookDateInput   = document.getElementById('book_date');
        const endDateInput    = document.getElementById('end_date');
        const numDaysInput    = document.getElementById('num_days');
        const roomPriceHidden = document.getElementById('room_price_hidden');
        const totalPriceInput = document.getElementById('total_price');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const minusBtn        = document.getElementById('minus_days');
        const plusBtn         = document.getElementById('plus_days');

        function setTodayAsMin() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;

            bookDateInput.min = todayStr;
            if (!bookDateInput.value || bookDateInput.value < todayStr) {
                // Set the default date only if it's not pre-filled by old()
                if (!bookDateInput.hasAttribute('data-old')) {
                    bookDateInput.value = todayStr;
                }
            }
        }

        function formatDate(date) {
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            return `${yyyy}-${mm}-${dd}`;
        }

        function recalcDatesAndTotal() {
            if (!bookDateInput.value) {
                totalPriceInput.value = '';
                totalPriceDisplay.value = '';
                endDateInput.value = '';
                return;
            }

            let days = parseInt(numDaysInput.value, 10);
            if (isNaN(days) || days < 1) {
                days = 1;
                numDaysInput.value = 1;
            }

            // Calculate End Date
            const start = new Date(bookDateInput.value + 'T00:00:00'); // Add T00:00:00 to avoid timezone issues
            const end = new Date(start);
            end.setDate(start.getDate() + days);

            endDateInput.value = formatDate(end);

            // Calculate Total Price
            const pricePerNight = parseFloat(roomPriceHidden.value || '0');
            if (pricePerNight > 0) {
                const totalPrice = pricePerNight * days;
                totalPriceInput.value = totalPrice.toFixed(2); // For backend submission
                totalPriceDisplay.value = `$${totalPrice.toFixed(2)}`; // For display
            } else {
                totalPriceInput.value = '0.00';
                totalPriceDisplay.value = '$0.00';
            }
        }

        function recalcAll() {
            recalcDatesAndTotal();
        }

        // Check if bookDateInput has a value from old('book_date')
        if (bookDateInput.value) {
            bookDateInput.setAttribute('data-old', 'true');
        }

        setTodayAsMin();
        recalcAll();

        if (bookDateInput) {
            bookDateInput.addEventListener('change', recalcAll);
        }

        if (numDaysInput) {
            numDaysInput.addEventListener('input', recalcDatesAndTotal);
        }

        if (minusBtn) {
            minusBtn.addEventListener('click', function () {
                let val = parseInt(numDaysInput.value, 10) || 1;
                if (val > 1) {
                    numDaysInput.value = val - 1;
                    recalcDatesAndTotal();
                }
            });
        }

        if (plusBtn) {
            plusBtn.addEventListener('click', function () {
                let val = parseInt(numDaysInput.value, 10) || 1;
                numDaysInput.value = val + 1;
                recalcDatesAndTotal();
            });
        }
    });
</script>
</body>
</html>