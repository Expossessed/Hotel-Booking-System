@section('body_class', 'booking-page bg-gray-100')


    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* 🎨 STYLING: Consistent Dark Brown & Orange Theme */

        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        body {
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: var(--color-text-light);
        }
        
        .navbar-top {
            background-color: #312620; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-menu a {
            color: var(--color-text-light);
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
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }

        .content-section {
            background-color: rgba(0, 0, 0, 0.2);
        }
        .section-title {
            color: var(--color-accent-orange);
            font-family: serif;
            font-weight: 300;
        }
    </style>



<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="javascript:history.back()" class="btn btn-ghost">← Back</a>
    </div>

    <div class="bg-[#312620] rounded-lg shadow-xl overflow-hidden">
        <div class="p-6 border-b border-white/10">
            <h3 class="text-2xl font-semibold text-white">Create New Booking</h3>
        </div>

        <div class="p-6 bg-[#3C2A21]/80 text-white">
            @if ($errors->any())
                <div class="alert alert-error shadow-lg mb-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.5 19.5L19.5 4.5"/></svg>
                        <span>
                            <strong>There were some problems with your input:</strong>
                            <ul class="mt-1 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </span>
                    </div>
                </div>
            @endif

            <form action="{{ route('bookings.create') }}" method="POST">
                @csrf

                <input type="hidden" name="room_id" value="{{ $room_id }}">

                <div class="mb-4">
                    <label class="block text-sm text-white/85 mb-2">Room Type</label>
                    <input type="text" name="room_type" class="input input-bordered w-full bg-transparent text-white" value="{{ old('room_type', $room_type ?? '') }}" readonly tabindex="-1">
                </div>

                <div class="mb-4">
                    <label for="book_date" class="block text-sm text-white/85 mb-2">Booking Start Date</label>
                    <input type="date" name="book_date" id="book_date" class="input input-bordered w-full bg-white/5 text-white" value="{{ old('book_date') }}" required>
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-sm text-white/85 mb-2">Booking End Date</label>
                    <input type="date" name="end_date" id="end_date" class="input input-bordered w-full bg-white/5 text-white" value="" readonly tabindex="-1">
                </div>

                <div class="mb-4">
                    <label for="room_price" class="block text-sm text-white/85 mb-2">Price per Night</label>
                    <input type="number" name="room_price" id="room_price" class="input input-bordered w-full bg-white/5 text-white" value="{{ old('room_price', $room_price ?? '') }}" readonly tabindex="-1">
                </div>

                <div class="mb-4">
                    <label for="num_days" class="block text-sm text-white/85 mb-2">Number of Days</label>
                    <div class="flex items-center gap-2">
                        <button type="button" class="btn btn-outline btn-sm" id="minus_days">-</button>
                        <input type="number" name="num_days" id="num_days" class="input input-bordered w-24 text-white" value="{{ old('num_days', 1) }}" min="1">
                        <button type="button" class="btn btn-outline btn-sm" id="plus_days">+</button>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="total_price" class="block text-sm text-white/85 mb-2">Total Price</label>
                    <input type="text" name="total_price" id="total_price" class="input input-bordered w-full bg-white/5 text-white" value="{{ old('total_price', $preview_total ?? '') }}" readonly tabindex="-1">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-accent-color">Create Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (!empty($preview ?? false))
    <div id="booking-preview" class="modal modal-open">
        <div class="modal-box bg-white text-black max-w-md w-full">
            <h5 class="text-xl font-semibold mb-3">Booking Receipt</h5>
            <ul class="space-y-2 mb-4">
                <li><strong>Customer Name:</strong> {{ $preview_user_name }}</li>
                <li><strong>Customer Email:</strong> {{ $preview_user_email }}</li>
                <li><strong>Room Type:</strong> {{ $preview_room_type }}</li>
                <li><strong>Start Date:</strong> {{ $preview_book_date }}</li>
                <li><strong>End Date:</strong> {{ $preview_end_date }}</li>
                <li><strong>Number of Days:</strong> {{ $preview_num_days }}</li>
                <li><strong>Price per Night:</strong> {{ $preview_room_price }}</li>
                <li><strong>Total Price:</strong> {{ $preview_total }}</li>
            </ul>
            <p class="mb-3">Are you sure?</p>
            <div class="flex gap-2 justify-end">
                <form method="POST" action="{{ route('bookings.create') }}">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room_id }}">
                    <input type="hidden" name="book_date" value="{{ $preview_book_date }}">
                    <input type="hidden" name="num_days" value="{{ $preview_num_days }}">
                    <input type="hidden" name="confirm" value="yes">
                    <button type="submit" class="btn btn-accent-color btn-sm">Yes</button>
                </form>
                <button type="button" class="btn btn-ghost btn-sm" onclick="document.getElementById('booking-preview').remove();">No</button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookDateInput   = document.getElementById('book_date');
        const endDateInput    = document.getElementById('end_date');
        const numDaysInput    = document.getElementById('num_days');
        const roomPriceInput  = document.getElementById('room_price');
        const totalPriceInput = document.getElementById('total_price');
        const minusBtn        = document.getElementById('minus_days');
        const plusBtn         = document.getElementById('plus_days');

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
            recalcDatesAndTotal();
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
    
