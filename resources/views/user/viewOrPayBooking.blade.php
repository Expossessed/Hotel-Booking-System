<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
        <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details | Hotel Bookie</title>

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
            color: var(--color-text-light);
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

        .details-card {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="p-4 md:p-12">

    <div class="max-w-4xl mx-auto py-8">

        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-8 text-white">
            <a href="/" class="text-white/70 hover:text-white transition-colors">Booking</a> Details
        </h1>

        <div class="card lg:card-side shadow-2xl details-card rounded-lg overflow-hidden">
            
            <figure class="lg:w-1/3 min-h-64">
                <img src="{{ $booking->image_url }}" alt="Room Image" class="w-full h-full object-cover">
            </figure>

            <div class="card-body p-6 lg:w-2/3">
                
                <div class="flex items-center justify-between mb-2">
                    <h2 class="card-title text-3xl font-bold text-white leading-snug">{{ $booking->service_name ?? optional($booking->room)->room_type ?? 'Booking' }}</h2>
                    <span class="text-white/50 text-sm">Booking ID: {{ $booking->booking_id ?? $booking->id }}</span>
                </div>
                
                <p class="text-gray-300 mb-6">{{ $booking->room_desc ?? 'A brief description of the booked room or service.' }}</p>

                <div class="grid grid-cols-2 gap-4 text-lg mb-6 border-b border-white/10 pb-4">
                    <p class="font-medium text-white/70">Check-in/Service Date:</p>
                    <p class="font-semibold text-white">{{ $booking->book_date ?? $booking->date }}</p>

                    <p class="font-medium text-white/70">Total Guests:</p>
                    <p class="font-semibold text-white">{{ $booking->guests ?? 'N/A' }}</p>
                </div>

                <div class="flex justify-between items-center pt-2">
                        <span class="text-4xl font-extrabold text-white">
                        ${{ $booking->total ?? $booking->room_price ?? 'N/A' }} 
                        <span class="text-base font-normal text-white/50">Total Amount</span>
                    </span>

                    @if($booking->status === 'paid' || $booking->status === 'confirmed')
                        <span class="badge badge-success text-sm p-3 font-semibold text-white rounded-none">Paid / Confirmed</span>
                    @elseif($booking->status === 'pending')
                        <span class="badge badge-warning text-sm p-3 font-semibold text-white rounded-none">Payment Pending</span>
                    @else
                        <span class="badge badge-error text-sm p-3 font-semibold text-white rounded-none">{{ $booking->status }}</span>
                    @endif
                </div>

                <div id="payment_method_display" class="mt-6">
                    <p class="text-white/70 text-sm mb-2">Selected Payment Method:</p>
                    <div class="px-4 py-3 bg-black/50 border border-white/20 rounded-md flex items-center justify-between cursor-pointer hover:bg-black/70 transition-colors" onclick="showPaymentModal()">
                        <span class="text-white font-semibold" id="display_method_value">Choose a payment method</span>
                        <span class="text-white/50 text-sm">Select</span>
                    </div>
                </div>

                <div class="card-actions justify-center mt-8 w-full">
                    @php $isPending = (isset($booking->status) && $booking->status === 'pending'); @endphp
                    @if($isPending)
                        <button type="button" class="btn btn-accent-color w-full h-12 rounded-none font-semibold text-lg" onclick="showPaymentModal()">
                            Pay Now
                        </button>
                    @else
                        <button class="btn btn-accent-color w-full h-12 rounded-none font-semibold text-lg opacity-50 btn-disabled">
                            Payment Complete
                        </button>
                    @endif
                </div>

            </div>
        </div>
        
        <a href="{{ route('bookings.userHistory') }}" class="btn btn-outline btn-sm rounded-none text-white hover:bg-white/10 mt-6 border-white/40">
            &larr; Back to My Bookings
        </a>

    </div>


    <dialog id="payment_modal" class="modal">
        <div class="modal-box details-card p-8 rounded-lg">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-white">✕</button>
            </form>
            <h3 class="font-bold text-3xl mb-4 text-white">Choose Payment Method</h3>
            <p class="text-white/80 mb-6">Select your preferred method to complete the payment of ${{ $booking->total ?? 'N/A' }}.</p>
            
            <div id="insufficient_balance_alert" class="alert alert-error shadow-lg mb-6 rounded-none bg-red-800/30 border-red-400 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.5 19.5L19.5 4.5"/></svg>
                <span class="text-red-300">Insufficient balance. Please add funds to proceed.</span>
            </div>

            <form id="payment_form" action="{{ route('user.payBooking', ['id' => $booking->booking_id ?? $booking->id]) }}" method="POST">
                @csrf
                <div class="space-y-4 mb-6">
                    <div class="form-control">
                        <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors">
                            <div class="flex-1">
                                <span class="label-text text-white text-lg font-medium">Account Balance</span>
                                <p class="text-white/60 text-sm">Available: ${{ number_format(auth()->user()->balance, 2) }}</p>
                            </div>
                            <input type="radio" name="payment_method" value="balance" class="radio radio-lg radio-warning" onchange="updatePaymentSelected()" checked/>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors">
                            <span class="label-text text-white text-lg font-medium">Credit/Debit Card</span> 
                            <input type="radio" name="payment_method" value="card" class="radio radio-lg radio-warning" onchange="updatePaymentSelected()"/>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors">
                            <span class="label-text text-white text-lg font-medium">PayPal</span> 
                            <input type="radio" name="payment_method" value="paypal" class="radio radio-lg radio-warning" onchange="updatePaymentSelected()"/>
                        </label>
                    </div>
                    <div class="form-control">
                        <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors">
                            <span class="label-text text-white text-lg font-medium">Gcash</span> 
                            <input type="radio" name="payment_method" value="gcash" class="radio radio-lg radio-warning" onchange="updatePaymentSelected()"/>
                        </label>
                    </div>
                </div>

                <div class="mt-4 text-white/80">
                    <p class="text-sm">Selected payment method: <span id="selected_method_value" class="font-semibold">Account Balance</span></p>
                </div>

                <div class="modal-action mt-8">
                    <button type="submit" class="btn btn-accent-color btn-lg px-8 rounded-none font-semibold w-full">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
        
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = {
            balance: 'Account Balance',
            card: 'Credit/Debit Card',
            paypal: 'PayPal',
            gcash: 'Gcash'
        };

        const radios = document.querySelectorAll('input[name="payment_method"]');
        const selected = document.getElementById('selected_method_value');
        const userBalance = parseFloat('{{ auth()->user()->balance }}');
        const bookingTotal = parseFloat('{{ $booking->total ?? 0 }}');
        const balanceOption = document.querySelector('input[name="payment_method"][value="balance"]');
        const insufficientAlert = document.getElementById('insufficient_balance_alert');
        const paymentForm = document.getElementById('payment_form');

        function updateSelected() {
            const checked = document.querySelector('input[name="payment_method"]:checked');
            if (checked && selected) {
                const methodText = labels[checked.value] || checked.value;
                selected.textContent = methodText;
            }
        }

        function validateBalance() {
            const checked = document.querySelector('input[name="payment_method"]:checked');
            
            if (checked && checked.value === 'balance' && userBalance < bookingTotal) {
                insufficientAlert.classList.remove('hidden');
                return false;
            } else {
                insufficientAlert.classList.add('hidden');
                return true;
            }
        }

        window.updatePaymentSelected = updateSelected;

        radios.forEach(r => {
            r.addEventListener('change', updateSelected);
            r.addEventListener('change', validateBalance);
        });

        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                if (!validateBalance()) {
                    e.preventDefault();
                    const cardOption = document.querySelector('input[name="payment_method"][value="card"]');
                    if (cardOption) {
                        cardOption.checked = true;
                        updateSelected();
                    }
                }
            });
        }

        updateSelected();
        validateBalance();
    });

    function showPaymentModal() {
        const dlg = document.getElementById('payment_modal');
        if (dlg && typeof dlg.showModal === 'function') {
            dlg.showModal();
        }
    }
</script>
</html>