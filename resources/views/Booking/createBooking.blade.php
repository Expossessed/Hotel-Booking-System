<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">

<nav class="navbar bg-white dark:bg-gray-800 shadow-md px-6 py-3 sticky top-0 z-50 flex lg:">
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

    <div class="hidden lg:block">
        <ul class="menu menu-horizontal gap-6 text-lg font-medium">
            <li><a href="{{ route('rooms.list') }}" class="text-primary font-bold">Home</a></li>
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
</nav>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Create New Booking</h4>
        </div>

        <div class="card-body">
           
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

         
            <form action="{{ route('bookings.create') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="room_type" class="form-label">Room Type</label>
                    <select name="room_type" id="room_type" class="form-select" required>
                        @php
                            $currentType = old('room_type', $room_type ?? 'Suite');
                        @endphp
                        <option value="Suite" {{ $currentType === 'Suite' ? 'selected' : '' }}>Suite</option>
                        <option value="Solo" {{ $currentType === 'Solo' ? 'selected' : '' }}>Solo</option>
                        <option value="Duo" {{ $currentType === 'Duo' ? 'selected' : '' }}>Duo</option>
                        <option value="Family" {{ $currentType === 'Family' ? 'selected' : '' }}>Family</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_date" class="form-label">Booking Start Date</label>
                    <input type="date" name="book_date" id="book_date" class="form-control" value="{{ old('book_date') }}" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Booking End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="" readonly>
                </div>

                <div class="mb-3">
                    <label for="room_price" class="form-label">Price per Night</label>
                    <input type="number" id="room_price" class="form-control" value="{{ old('room_price', $room_price ?? '') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="num_days" class="form-label">Number of Days</label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" id="minus_days">-</button>
                        <input type="number" name="num_days" id="num_days" class="form-control" value="{{ old('num_days', 1) }}" min="1">
                        <button type="button" class="btn btn-outline-secondary" id="plus_days">+</button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="text" id="total_price" class="form-control" readonly>
                </div>

                <button type="submit" class="btn btn-success">Create Booking</button>
            </form>
        </div>
    </div>
</div>

@if (!empty($preview ?? false))
    <div id="booking-preview" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-4">
            <h5 class="text-xl font-semibold mb-3">Booking Receipt</h5>
            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Customer Name:</strong> {{ $preview_user_name }}</li>
                <li class="list-group-item"><strong>Customer Email:</strong> {{ $preview_user_email }}</li>
                <li class="list-group-item"><strong>Room Type:</strong> {{ $preview_room_type }}</li>
                <li class="list-group-item"><strong>Start Date:</strong> {{ $preview_book_date }}</li>
                <li class="list-group-item"><strong>End Date:</strong> {{ $preview_end_date }}</li>
                <li class="list-group-item"><strong>Number of Days:</strong> {{ $preview_num_days }}</li>
                <li class="list-group-item"><strong>Price per Night:</strong> {{ $preview_room_price }}</li>
                <li class="list-group-item"><strong>Total Price:</strong> {{ $preview_total }}</li>
            </ul>
            <p class="mb-3">Are you sure?</p>
            <div class="d-flex gap-2 justify-content-end">
                <form method="POST" action="{{ route('bookings.create') }}">
                    @csrf
                    <input type="hidden" name="room_type" value="{{ $preview_room_type }}">
                    <input type="hidden" name="book_date" value="{{ $preview_book_date }}">
                    <input type="hidden" name="num_days" value="{{ $preview_num_days }}">
                    <input type="hidden" name="confirm" value="yes">
                    <button type="submit" class="btn btn-success btn-sm">Yes</button>
                </form>
                <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('booking-preview').remove();">No</button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roomTypeSelect  = document.getElementById('room_type');
        const bookDateInput   = document.getElementById('book_date');
        const endDateInput    = document.getElementById('end_date');
        const numDaysInput    = document.getElementById('num_days');
        const roomPriceInput  = document.getElementById('room_price');
        const totalPriceInput = document.getElementById('total_price');
        const minusBtn        = document.getElementById('minus_days');
        const plusBtn         = document.getElementById('plus_days');

        const PRICES = {
            'Suite': 999,
            'Solo': 1999,
            'Duo': 2999,
            'Family': 3999,
        };

        function setTodayAsMin() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            const todayStr = `${yyyy}-${mm}-${dd}`;

            bookDateInput.min = todayStr;
            if (!bookDateInput.value || bookDateInput.value < todayStr) {
                bookDateInput.value = todayStr;
            }
        }

        function recalcPrice() {
            const type = roomTypeSelect.value;
            const price = PRICES[type] || 0;
            roomPriceInput.value = price;
        }

        function recalcDatesAndTotal() {
            if (!bookDateInput.value) {
                totalPriceInput.value = '';
                endDateInput.value = '';
                return;
            }

            let days = parseInt(numDaysInput.value, 10);
            if (isNaN(days) || days < 1) {
                days = 1;
                numDaysInput.value = 1;
            }

            const start = new Date(bookDateInput.value);
            const end = new Date(start);
            end.setDate(start.getDate() + days);

            const yyyy = end.getFullYear();
            const mm = String(end.getMonth() + 1).padStart(2, '0');
            const dd = String(end.getDate()).padStart(2, '0');
            endDateInput.value = `${yyyy}-${mm}-${dd}`;

            const pricePerNight = parseFloat(roomPriceInput.value || '0');
            if (pricePerNight > 0) {
                totalPriceInput.value = pricePerNight * days;
            } else {
                totalPriceInput.value = '';
            }
        }

        function recalcAll() {
            recalcPrice();
            recalcDatesAndTotal();
        }

        setTodayAsMin();
        recalcAll();

        if (roomTypeSelect) {
            roomTypeSelect.addEventListener('change', recalcAll);
        }

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
