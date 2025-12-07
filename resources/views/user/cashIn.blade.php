<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash In | Hotel Bookie</title>

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

    <div class="max-w-2xl mx-auto py-8">

        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-8 text-white">
            <a href="/" class="text-white/70 hover:text-white transition-colors">Account</a> / Cash In
        </h1>

        @if ($errors->any())
            <div class="alert alert-error mb-6 rounded-lg">
                <div class="flex flex-col gap-2">
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success mb-6 rounded-lg">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card details-card shadow-2xl rounded-lg overflow-hidden">
            <div class="card-body p-6 lg:p-8">

                <!-- Current Balance Display -->
                <div class="mb-8 p-4 bg-black/50 rounded-lg border border-white/20">
                    <p class="text-white/70 text-sm mb-2">Current Balance:</p>
                    <p class="text-4xl font-bold text-white">${{ number_format($user->balance ?? 0, 2) }}</p>
                </div>

                <h2 class="card-title text-2xl font-bold text-white mb-6">Add Funds to Your Account</h2>

                <form action="{{ route('cashIn.store') }}" method="POST">
                    @csrf

                    <!-- Amount Input -->
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text text-white font-semibold">Amount to Add</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-white text-xl">$</span>
                            <input type="number" name="amount" step="0.01" min="1" max="999999.99" 
                                placeholder="0.00" class="input input-bordered w-full pl-8 bg-black/50 border-white/20 text-white placeholder-white/50"
                                value="{{ old('amount') }}" required>
                        </div>
                        @error('amount')
                            <label class="label">
                                <span class="label-text-alt text-red-400">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="mb-8">
                        <label class="label">
                            <span class="label-text text-white font-semibold">Select Payment Method</span>
                        </label>

                        <div class="space-y-3">
                            <div class="form-control">
                                <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors border border-white/20"
                                    :class="{'border-orange-500': selectedMethod === 'card'}">
                                    <span class="label-text text-white text-lg font-medium">Credit/Debit Card</span>
                                    <input type="radio" name="payment_method" value="card" class="radio radio-lg radio-warning" 
                                        @change="selectedMethod = 'card'" checked/>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors border border-white/20"
                                    :class="{'border-orange-500': selectedMethod === 'paypal'}">
                                    <span class="label-text text-white text-lg font-medium">PayPal</span>
                                    <input type="radio" name="payment_method" value="paypal" class="radio radio-lg radio-warning"
                                        @change="selectedMethod = 'paypal'"/>
                                </label>
                            </div>

                            <div class="form-control">
                                <label class="label cursor-pointer p-4 bg-black/50 hover:bg-black/70 rounded-md transition-colors border border-white/20"
                                    :class="{'border-orange-500': selectedMethod === 'gcash'}">
                                    <span class="label-text text-white text-lg font-medium">GCash</span>
                                    <input type="radio" name="payment_method" value="gcash" class="radio radio-lg radio-warning"
                                        @change="selectedMethod = 'gcash'"/>
                                </label>
                            </div>
                        </div>

                        @error('payment_method')
                            <label class="label">
                                <span class="label-text-alt text-red-400">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Selected Method Display -->
                    <div class="mb-8 p-4 bg-black/50 rounded-lg border border-white/20">
                        <p class="text-white/70 text-sm mb-2">Selected Payment Method:</p>
                        <p class="text-white font-semibold" x-text="selectedMethod === 'card' ? 'Credit/Debit Card' : selectedMethod === 'paypal' ? 'PayPal' : 'GCash'">Credit/Debit Card</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="card-actions justify-center gap-4">
                        <a href="{{ route('rooms.list') }}" class="btn btn-outline btn-lg rounded-none text-white hover:bg-white/10 border-white/40">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-accent-color btn-lg px-12 rounded-none font-semibold">
                            Confirm Cash In
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <a href="{{ route('rooms.list') }}" class="btn btn-outline btn-sm rounded-none text-white hover:bg-white/10 mt-6 border-white/40">
            &larr; Back to Home
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cashInForm', () => ({
                selectedMethod: 'card',
            }));
        });
    </script>

</body>
</html>
