<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Profile Settings</title>

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
        }
        
        body, .text-gray-100 {
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

        .input-dark-style {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--color-text-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-dark-style:focus:not(:disabled) {
             border-color: var(--color-accent-orange);
             outline: none;
             box-shadow: 0 0 0 2px rgba(196, 91, 58, 0.5);
        }
        .input-dark-style::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .input-dark-style:disabled {
            background-color: rgba(0, 0, 0, 0.1);
            border-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="relative">

@include('layouts.hotelNav')


<main class="px-4 md:px-6 py-16">

    <div class="max-w-6xl mx-auto">

        <header class="mb-10 text-center md:text-left">
            <h1 class="text-5xl font-serif font-bold text-white mb-2">
                User Profile Settings
            </h1>
            <p class="text-lg text-white/70">
                Update your personal details and account credentials.
            </p>
            <div class="divider before:bg-white/10 after:bg-white/10 mt-4"></div>
        </header>

        <div class="bg-black/40 p-8 md:p-12 rounded-lg shadow-2xl">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                    
                    <section class="lg:pr-8">
                        <h2 class="text-3xl font-serif font-bold mb-6 text-white/95 border-b border-white/20 pb-2">
                            Personal Details
                        </h2>

                        <div class="space-y-6">
                            
                            <div>
                                <label for="name" class="label">
                                    <span class="label-text text-white/80 font-medium">Full Name</span>
                                </label>
                                <input type="text" id="name" name="name" 
                                       value="{{ $user->name ?? 'John Doe' }}" 
                                       placeholder="Enter your full name" 
                                       class="input input-dark-style w-full rounded-none" required />
                            </div>

                            <div>
                                <label for="email" class="label">
                                    <span class="label-text text-white/80 font-medium">Email Address</span>
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="{{ $user->email ?? 'john.doe@example.com' }}" 
                                       placeholder="Enter your email" 
                                       class="input input-dark-style w-full rounded-none" required />
                            </div>
                        </div>

                        <div class="mt-8 pt-4 border-t border-white/10 space-y-4">
                             <div>
                                <label class="label">
                                    <span class="label-text text-white/80 font-medium">Account Role</span>
                                </label>
                                <input type="text" 
                                       value="{{ ucfirst($user->role ?? 'user') }}" 
                                       class="input input-dark-style w-full rounded-none" disabled />
                                <p class="label-text-alt text-white/50 mt-1">Role determines access privileges.</p>
                            </div>

                            <div>
                                <label class="label">
                                    <span class="label-text text-white/80 font-medium">Account Balance</span>
                                </label>
                                <input type="text" 
                                       value="${{ number_format($user->balance ?? 0, 2) }}" 
                                       class="input input-dark-style w-full rounded-none" disabled />
                                <p class="label-text-alt text-white/50 mt-1">Current credit balance for bookings.</p>
                            </div>
                        </div>
                    </section>
                    
                    <section class="lg:pl-8 lg:border-l border-white/10">
                        <h2 class="text-3xl font-serif font-bold mb-6 text-white/95 border-b border-white/20 pb-2">
                            Security & Password
                        </h2>
                        
                        <div class="space-y-6">
                            <p class="text-sm text-white/70">
                                To change your password, fill in the fields below. Leave them blank if you only wish to update your personal details.
                            </p>
                            
                            <div>
                                <label for="current_password" class="label">
                                    <span class="label-text text-white/80 font-medium">Current Password</span>
                                </label>
                                <input type="password" id="current_password" name="current_password" 
                                       placeholder="Your current password" 
                                       class="input input-dark-style w-full rounded-none" />
                            </div>
                            
                            <div>
                                <label for="new_password" class="label">
                                    <span class="label-text text-white/80 font-medium">New Password</span>
                                </label>
                                <input type="password" id="new_password" name="new_password" 
                                       placeholder="Enter new password" 
                                       class="input input-dark-style w-full rounded-none" />
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="label">
                                    <span class="label-text text-white/80 font-medium">Confirm New Password</span>
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                       placeholder="Repeat new password" 
                                       class="input input-dark-style w-full rounded-none" />
                            </div>
                        </div>

                    </section>
                </div>
                

                <div class="mt-12 pt-8 border-t border-white/10 text-center">
                    <button type="submit" class="btn btn-accent-color btn-lg px-10 rounded-none font-semibold">
                        Save All Changes
                    </button>
                </div>
            </form>
        </div>

    </div>

</main>

</body>
</html>