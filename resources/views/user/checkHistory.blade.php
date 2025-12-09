<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking History - HOTEL BOOKIE</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        

        :root {
            --color-dark-brown: #3C2A21; 
            --color-accent-orange: #C45B3A; 
            --color-text-light: #F7F7F7;
        }


        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-dark-brown);
            color: var(--color-text-light);
            min-height: 100vh;
        }

       
        .navbar-top {
            background-color: #312620;
        }

        .card-dark-bg {
            background-color: #312620;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            border-radius: 0;
        }

        .btn-accent-color:hover {
            background-color: #A94E31;
            border-color: #A94E31;
        }

        .badge-pending {
            background-color: rgba(234, 179, 8, 0.2);
            color: #fbbf24;
            border: 1px solid #fbbf24;
        }

        .badge-confirmed {
            background-color: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid #86efac;
        }

        .badge-paid {
            background-color: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid #86efac;
        }

        .payment-modal-content {
            background-color: #312620;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .payment-option {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .payment-option:hover {
            background-color: rgba(196, 91, 58, 0.2);
            border-color: var(--color-accent-orange);
        }

        .alert-insufficient {
            background-color: rgba(220, 38, 38, 0.1);
            border-color: #f87171;
            color: #f87171;
        }

        .main-header {
            font-family: 'Playfair Display', serif;
        }

        .room-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body>

@include('layouts.hotelNav')
<main class="px-4 md:px-6 py-12 max-w-6xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-4xl main-header font-bold mb-2 text-white">
            My Booking History
        </h1>
        <p class="text-white/60">Current Balance: <span class="text-white font-semibold">${{ number_format(auth()->user()->balance, 2) }}</span></p>
    </div>

    @if(session('success'))
        <div role="alert" class="alert alert-success shadow-lg mb-6 rounded-none" style="background-color: rgba(34, 197, 94, 0.2); border: 1px solid #86efac;">
            <span class="text-green-300">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div role="alert" class="alert alert-error shadow-lg mb-6 rounded-none alert-insufficient">
            <span>{{ session('error') }}</span>
        </div>
    @endif
        
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
    
        @if(isset($bookings) && $bookings->isEmpty())
            <div class="lg:col-span-2 text-center p-12 card-dark-bg rounded-lg">
                <p class="text-xl text-white/80 font-medium">You have no bookings yet.</p>
                <a href="{{ route('rooms.list') }}" class="mt-4 inline-block text-lg font-semibold text-[var(--color-accent-orange)] hover:text-white transition-colors">Start your journey here.</a>
            </div>
        @elseif(isset($bookings))
            @foreach($bookings as $booking)
                @php
                    $isPending = $booking->status === 'pending';
                    $isConfirmed = $booking->status === 'confirmed' || $booking->status === 'paid';
                    $room = $booking->room;
                    $imageUrl = $room && $room->room_image1 ? $room->room_image1 : 'https://via.placeholder.com/400x250?text=Room';
                @endphp
                
                <div class="card-dark-bg rounded-lg overflow-hidden flex flex-col justify-between shadow-lg">
                    
                   
                    <div class="w-full h-40 bg-gray-700 overflow-hidden">
                        <img 
                            src="{{ $imageUrl }}"
                            alt="{{ $room ? $room->room_type : 'Room' }}"
                            class="room-image"
                            onerror="this.src='https://via.placeholder.com/400x250?text=Room';"
                        >
                    </div>

                   
                    <div class="p-6 flex flex-col justify-between flex-1">
                        
                        <div class="flex justify-between items-start border-b border-white/10 pb-4 mb-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-white leading-tight">
                                    {{ $room ? $room->room_type : 'Room' }}
                                </h2>
                                @if($room && $room->room_desc)
                                    <p class="text-sm text-white/60 mt-1">{{ Str::limit($room->room_desc, 60) }}</p>
                                @endif
                            </div>  
                            <span class="badge badge-base {{ $isPending ? 'badge-pending' : 'badge-confirmed' }} px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $isPending ? 'Pending' : 'Confirmed' }}
                            </span>
                        </div>
                        
                        
                        <div class="grid grid-cols-2 gap-y-3 text-sm mb-4">
                            
                            
                            <div>
                                <p class="text-white/60">Check-in</p>
                                <p class="font-medium text-white">{{ \Carbon\Carbon::parse($booking->book_date)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-white/60">Check-out</p>
                                <p class="font-medium text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                            </div>

                           
                            <div>
                                <p class="text-white/60">Nights</p>
                                <p class="font-medium text-white">{{ $booking->num_days }}</p>
                            </div>
                            <div>
                                <p class="text-white/60">Price/Night</p>
                                <p class="font-medium text-white">${{ number_format($booking->room_price, 2) }}</p>
                            </div>
                        </div>

                       
                        @if($room && ($room->room_name || $room->free_items))
                            <div class="border-t border-white/10 pt-3 mb-4">
                                @if($room->room_name)
                                    <p class="text-sm text-white/70"><span class="font-medium">Room:</span> {{ $room->room_name }}</p>
                                @endif
                                @if($room->free_items)
                                    <p class="text-sm text-white/70 mt-1"><span class="font-medium">Amenities:</span> {{ implode(', ', is_array($room->free_items) ? $room->free_items : [$room->free_items]) }}</p>
                                @endif
                            </div>
                        @endif

                    
                        <div class="flex justify-between items-center border-t border-white/10 pt-4">
                            <div>
                                <p class="text-sm text-white/60">Total Cost</p>
                                <p class="text-2xl font-extrabold text-[var(--color-accent-orange)]">${{ number_format($booking->total, 2) }}</p>
                            </div>
                            
                           
                            @if($isPending)
                                <button 
                                    class="btn btn-accent-color btn-sm rounded-none font-semibold"
                                    data-booking-id="{{ $booking->booking_id ?? $booking->id }}"
                                    data-room-type="{{ $room ? $room->room_type : 'Room' }}"
                                    data-total="{{ $booking->total }}"
                                    data-balance="{{ auth()->user()->balance ?? 0 }}"
                                    onclick="openPaymentModal(this.dataset.bookingId, this.dataset.roomType, parseFloat(this.dataset.total), parseFloat(this.dataset.balance))">
                                    Pay Now
                                </button>
                            @else
                                <span class="text-white/50 text-sm">Completed</span>
                            @endif
                        </div>
                       
                    </div>
                </div>
            @endforeach
        @endif
        
    </div>


</main>


<dialog id="payment_modal" class="modal">
    <div class="modal-box payment-modal-content p-8 rounded-lg max-w-md">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
        </form>
        
        <h3 class="font-bold text-2xl mb-2 text-white">Choose Payment Method</h3>
        <p class="text-white/70 mb-6 text-sm">
            <span id="modal_room_type" class="font-semibold"></span> - 
            <span id="modal_total" class="font-semibold text-[var(--color-accent-orange)]"></span>
        </p>

        <div id="insufficient_balance_alert" class="alert-insufficient alert rounded-none mb-6 p-4 hidden" style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid #f87171;">
            <span class="text-sm">Insufficient balance. Please add funds to proceed.</span>
        </div>

        <div class="space-y-3 mb-6" id="payment_methods_container">
            <div class="payment-option p-4 flex items-center rounded-none">
                <input type="radio" name="payment_method_choice" value="balance" id="pay_balance" class="radio radio-sm" checked>
                <label for="pay_balance" class="ml-4 flex-1 cursor-pointer payment-label text-white">
                    <span class="font-medium">Account Balance</span>
                    <br/>
                    <span class="text-white/60 text-xs">Available: <span id="user_balance_display">$0.00</span></span>
                </label>
            </div>

            <div class="payment-option p-4 flex items-center rounded-none">
                <input type="radio" name="payment_method_choice" value="card" id="pay_card" class="radio radio-sm">
                <label for="pay_card" class="ml-4 flex-1 cursor-pointer payment-label text-white">
                    <span class="font-medium">Credit/Debit Card</span>
                </label>
            </div>

            <div class="payment-option p-4 flex items-center rounded-none">
                <input type="radio" name="payment_method_choice" value="paypal" id="pay_paypal" class="radio radio-sm">
                <label for="pay_paypal" class="ml-4 flex-1 cursor-pointer payment-label text-white">
                    <span class="font-medium">PayPal</span>
                </label>
            </div>

            <div class="payment-option p-4 flex items-center rounded-none">
                <input type="radio" name="payment_method_choice" value="gcash" id="pay_gcash" class="radio radio-sm">
                <label for="pay_gcash" class="ml-4 flex-1 cursor-pointer payment-label text-white">
                    <span class="font-medium">Gcash</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 justify-end">
            <form method="dialog">
                <button type="button" class="btn btn-outline btn-sm rounded-none text-white border-white/40 hover:bg-white/10">Cancel</button>
            </form>
            <button type="button" class="btn btn-accent-color btn-sm rounded-none font-semibold" id="proceed_payment_btn" onclick="proceedToConfirmation()">
                Proceed to Payment
            </button>
        </div>
    </div>
    </form>
    
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="confirmation_modal" class="modal">
    <div class="modal-box payment-modal-content p-8 rounded-lg max-w-md">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
        </form>
        
        <h3 class="font-bold text-2xl mb-4 text-white">Confirm Payment</h3>
        
        <div class="bg-black/30 rounded-lg p-4 mb-6 border border-white/10">
            <div class="flex justify-between mb-3">
                <span class="text-white/70">Room:</span>
                <span class="text-white font-semibold" id="confirm_room_type"></span>
            </div>
            <div class="flex justify-between mb-3">
                <span class="text-white/70">Amount:</span>
                <span class="text-white font-semibold" id="confirm_amount"></span>
            </div>
            <div class="flex justify-between border-t border-white/10 pt-3">
                <span class="text-white/70">Method:</span>
                <span class="text-[var(--color-accent-orange)] font-semibold" id="confirm_method"></span>
            </div>
        </div>

        <p class="text-white/70 text-sm mb-6">Are you sure you want to proceed with this payment?</p>

        <form id="payment_form" action="{{ route('bookings.payPending') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" id="modal_booking_id">
            <input type="hidden" name="payment_method" id="modal_payment_method">

            <div class="flex gap-3 justify-end">
                <button type="button" class="btn btn-outline btn-sm rounded-none text-white border-white/40 hover:bg-white/10" onclick="goBackToMethods()">
                    Back
                </button>
                <button type="submit" class="btn btn-accent-color btn-sm rounded-none font-semibold">
                    Confirm Payment
                </button>
            </div>
        </form>
    </div>
    
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    let currentPaymentData = {
        bookingId: null,
        roomType: null,
        totalAmoun: null,
        userBalance: null,
        selectedMethod: null
    };

    const methodLabels = {
        balance: 'Account Balance',
        card: 'Credit/Debit Card',
        paypal: 'PayPal',
        gcash: 'Gcash'
    };

    function openPaymentModal(bookingId, roomType, totalAmount, userBalance) {
        currentPaymentData = {
            bookingId: bookingId,
            roomType: roomType,
            totalAmount: parseFloat(totalAmount),
            userBalance: parseFloat(userBalance),
            selectedMethod: null
        };

         document.getElementById('modal_booking_id').value = bookingId;
        document.getElementById('modal_room_type').textContent = roomType;
        document.getElementById('modal_total').textContent = '$' + totalAmount.toFixed(2);
        document.getElementById('user_balance_display').textContent = '$' + userBalance.toFixed(2);

        const balanceOption = document.getElementById('pay_balance');
        const insufficientAlert = document.getElementById('insufficient_balance_alert');

        if (userBalance < totalAmount) {
            balanceOption.disabled = true;
            balanceOption.parentElement.style.opacity = '0.5';
            balanceOption.parentElement.style.pointerEvents = 'none';
            insufficientAlert.classList.remove('hidden');
            document.getElementById('pay_card').checked = true;
        } else {
            balanceOption.disabled = false;
            balanceOption.parentElement.style.opacity = '1';
            balanceOption.parentElement.style.pointerEvents = 'auto';
            insufficientAlert.classList.add('hidden');
            document.getElementById('pay_balance').checked = true;
        }

        document.getElementById('payment_modal').showModal();
    }

    function proceedToConfirmation() {
        const selectedMethod = document.querySelector('input[name="payment_method_choice"]:checked').value;
        const bookingId = document.getElementById('modal_booking_id').value;
        const userBalance = currentPaymentData.userBalance;
        const totalAmount = currentPaymentData.totalAmount;

        if (selectedMethod === 'balance' && userBalance < totalAmount) {
            Swal.fire({
                icon: 'error',
                title: 'Insufficient Balance',
                text: 'Your account balance is not enough for this booking. Please add funds or choose another payment method.',
                confirmButtonColor: '#C45B3A',
                confirmButtonText: 'OK',
                background: '#312620',
                color: '#F7F7F7'
            });
            return;
        }

        currentPaymentData.selectedMethod = selectedMethod;
        document.getElementById('modal_payment_method').value = selectedMethod;


        document.getElementById('payment_modal').close();
        

        document.getElementById('confirm_room_type').textContent = currentPaymentData.roomType;
        document.getElementById('confirm_amount').textContent = '$' + totalAmount.toFixed(2);
        document.getElementById('confirm_method').textContent = methodLabels[selectedMethod];

        setTimeout(() => {
            document.getElementById('confirmation_modal').showModal();
        }, 100);
    }

    function goBackToMethods() {
        document.getElementById('confirmation_modal').close();
        setTimeout(() => {
            document.getElementById('payment_modal').showModal();
        }, 100);
    }


    document.getElementById('payment_form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const selectedMethod = currentPaymentData.selectedMethod;
        const userBalance = currentPaymentData.userBalance;
        const totalAmount = currentPaymentData.totalAmount;

        if (selectedMethod === 'balance' && userBalance < totalAmount) {
            Swal.fire({
                icon: 'error',
                title: 'Insufficient Balance',
                text: 'Your account balance is not enough for this booking.',
                confirmButtonColor: '#C45B3A',
                confirmButtonText: 'OK',
                background: '#312620',
                color: '#F7F7F7'
            });
            return;
        }
        this.submit();
    });
</script>

</body>
</html>