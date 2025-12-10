<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
        <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Create Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        body {
            background-image: none;
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            position: relative;
        }
        
        body, .text-gray-100 {
            color: var(--color-text-light);
        }

        .navbar-menu a {
            color: var(--color-text-light);
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .navbar-menu a:hover {
            color: var(--color-accent-orange);
        }

        .profile-dropdown-content {
            background: #312620;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

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

        .booking-container {
            background-color: #312620;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-dark, .select-dark {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.3);
            color: var(--color-text-light);
            transition: border-color 0.2s ease;
        }
        .input-dark:focus, .select-dark:focus {
            border-color: var(--color-accent-orange);
        }
        .input-readonly {
            background-color: #312620;
            border-color: rgba(255, 255, 255, 0.1);
        }

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

@include('layouts.hotelNav')

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
                            <input type="text" name="room_price" id="room_price" class="input input-bordered w-full input-dark input-readonly rounded-none" value="{{ old('room_price', $room_price ? '₱' . number_format($room_price, 2) : 'N/A') }}" readonly tabindex="-1">
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
                <li class="flex justify-between pt-3 border-t border-white/10 text-xl font-bold"><strong>Total Price:</strong> <span class="text-white">₱{{ $preview_total }}</span></li>
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
                totalPriceDisplay.value = `₱${totalPrice.toFixed(2)}`; // For display
            } else {
                totalPriceInput.value = '0.00';
                totalPriceDisplay.value = '₱0.00';
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