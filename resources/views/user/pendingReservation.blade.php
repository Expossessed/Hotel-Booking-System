@extends('layouts.hotel')

@section('body_class', 'history-page')

@push('head')
    <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        body {
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            color: var(--color-text-light);
        }

        .booking-table {
            background-color: #312620;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .booking-table thead {
            background-color: #3C2A21;
            border-bottom: 2px solid var(--color-accent-orange);
        }

        .booking-table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .booking-table tbody tr:hover {
            background-color: rgba(196, 91, 58, 0.1);
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

        .payment-option input[type="radio"]:checked ~ .payment-label {
            color: var(--color-accent-orange);
        }

        .alert-insufficient {
            background-color: rgba(220, 38, 38, 0.1);
            border-color: #f87171;
            color: #f87171;
        }
    </style>
@endpush

@section('content')
    @include('layouts.hotelNav')

    <main class="px-6 py-8 max-w-6xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('rooms.list') }}" class="text-white/80 hover:text-white transition-colors">← Back to Rooms</a>
        </div>

        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Your Pending Bookings</h1>
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

        @if ($bookings->isEmpty())
            <div class="booking-table rounded-lg shadow-xl p-8 text-center">
                <p class="text-lg text-white/70 mb-4">You have no pending bookings.</p>
                <a href="{{ route('rooms.list') }}" class="btn btn-accent-color btn-lg rounded-none font-semibold">Browse Rooms</a>
            </div>
        @else
            <div class="booking-table rounded-lg shadow-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-white/80">Room Type</th>
                            <th class="px-6 py-4 text-left font-semibold text-white/80">Check-in</th>
                            <th class="px-6 py-4 text-left font-semibold text-white/80">Check-out</th>
                            <th class="px-6 py-4 text-center font-semibold text-white/80">Nights</th>
                            <th class="px-6 py-4 text-right font-semibold text-white/80">Price/Night</th>
                            <th class="px-6 py-4 text-right font-semibold text-white/80">Total</th>
                            <th class="px-6 py-4 text-center font-semibold text-white/80">Status</th>
                            <th class="px-6 py-4 text-center font-semibold text-white/80">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 text-white">
                                    {{ optional($booking->room)->room_type ?? 'Room deleted' }}
                                </td>
                                <td class="px-6 py-4 text-white/70">{{ \Carbon\Carbon::parse($booking->book_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-white/70">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-center text-white/70">{{ $booking->num_days }}</td>
                                <td class="px-6 py-4 text-right text-white/70">${{ number_format($booking->room_price, 2) }}</td>
                                <td class="px-6 py-4 text-right font-semibold text-white">${{ number_format($booking->total, 2) }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($booking->status === 'confirmed' || $booking->status === 'paid')
                                        <span class="badge-confirmed px-3 py-1 rounded-full text-xs font-semibold">Confirmed</span>
                                    @else
                                        <span class="badge-pending px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($booking->status === 'pending')
                                        <button 
                                            class="btn btn-accent-color btn-sm rounded-none font-semibold"
                                            data-booking-id="{{ $booking->booking_id ?? $booking->id }}"
                                            data-room-type="{{ $booking->room->room_type ?? 'Room' }}"
                                            data-total="{{ $booking->total }}"
                                            data-balance="{{ auth()->user()->balance ?? 0 }}"
                                            onclick="openPaymentModal(this.dataset.bookingId, this.dataset.roomType, parseFloat(this.dataset.total), parseFloat(this.dataset.balance))">
                                            Pay Now
                                        </button>
                                    @else
                                        <span class="text-white/50">Completed</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>

    <dialog id="payment_modal" class="modal">
        <div class="modal-box payment-modal-content p-8 rounded-lg max-w-md">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
            </form>
            
            <h3 class="font-bold text-2xl mb-2 text-white">Choose Payment Method</h3>
            <p class="text-white/70 mb-6 text-sm">
                <span id="modal_room_type" class="font-semibold"></span> - 
                <span id="modal_total" class="font-semibold text-var(--color-accent-orange)"></span>
            </p>


            <div id="insufficient_balance_alert" class="alert-insufficient alert rounded-none mb-6 p-4 hidden" style="background-color: rgba(220, 38, 38, 0.1); border: 1px solid #f87171;">
                <span class="text-sm">Insufficient balance. Please add funds to proceed.</span>
            </div>

            <form id="payment_form" action="" method="POST">
                @csrf
                <input type="hidden" name="booking_id" id="modal_booking_id">
                <input type="hidden" name="payment_method" id="modal_payment_method">

                <div class="space-y-3 mb-6">
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
                        <label for="pay_cash" class="ml-4 flex-1 cursor-pointer payment-label text-white">
                            <span class="font-medium">Gcash</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3 justify-end">
                    <form method="dialog">
                        <button type="button" class="btn btn-outline btn-sm rounded-none text-white border-white/40 hover:bg-white/10">Cancel</button>
                    </form>
                    <button type="submit" class="btn btn-accent-color btn-sm rounded-none font-semibold" id="confirm_payment_btn">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
        
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function openPaymentModal(bookingId, roomType, totalAmount, userBalance) {
            document.getElementById('modal_booking_id').value = bookingId;
            document.getElementById('modal_room_type').textContent = roomType;
            document.getElementById('modal_total').textContent = '$' + parseFloat(totalAmount).toFixed(2);
            document.getElementById('user_balance_display').textContent = '$' + parseFloat(userBalance).toFixed(2);


            const balanceOption = document.getElementById('pay_balance');
            const insufficientAlert = document.getElementById('insufficient_balance_alert');
            const confirmBtn = document.getElementById('confirm_payment_btn');

            if (userBalance < totalAmount) {
                balanceOption.disabled = true;
                insufficientAlert.classList.remove('hidden');

                document.getElementById('pay_card').checked = true;
            } else {
                balanceOption.disabled = false;
                insufficientAlert.classList.add('hidden');
                document.getElementById('pay_balance').checked = true;
            }


            document.getElementById('payment_form').action = '/user/pending';

            document.getElementById('payment_modal').showModal();
        }

        document.getElementById('payment_form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedMethod = document.querySelector('input[name="payment_method_choice"]:checked').value;
            const bookingId = document.getElementById('modal_booking_id').value;
            const userBalance = parseFloat(document.getElementById('user_balance_display').textContent.replace('$', ''));
            const totalAmount = parseFloat(document.getElementById('modal_total').textContent.replace('$', ''));

            if (selectedMethod === 'balance' && userBalance < totalAmount) {
                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Balance',
                    text: 'Your account balance is not enough for this booking. Please add funds or choose another payment method.',
                    confirmButtonColor: '#C45B3A'
                });
                return;
            }

            document.getElementById('modal_payment_method').value = selectedMethod;

            Swal.fire({
                title: 'Confirm Payment',
                text: `Pay $${totalAmount.toFixed(2)} using ${selectedMethod === 'balance' ? 'Account Balance' : selectedMethod.toUpperCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#C45B3A',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endsection
