<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Profile Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />

    <style>
        /* 🎨 STYLING: Based on the Home Page (Dark Brown & White/Orange) */

        /* Define Core Colors */
        :root {
            --color-dark-brown: #3C2A21;
            --color-accent-orange: #C45B3A;
            --color-text-light: #F7F7F7;
        }

        /* 1. Reset Body Background */
        body {
            background-image: none;
            background-color: var(--color-dark-brown);
            min-height: 100vh;
        }
        
        body, .text-gray-100 {
            color: var(--color-text-light);
        }

        /* 4. Accent Button Style (Orange/Brown) */
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

        /* Input/Select Styling to match the dark theme */
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
        
        /* Disabled state styling for the non-editable fields */
        .input-dark-style:disabled {
            background-color: rgba(0, 0, 0, 0.1);
            border-color: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }

        /* DaisyUI Collapse Customization */
        .collapse-custom-header {
            background-color: rgba(0, 0, 0, 0.3);
            color: var(--color-text-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }
        .collapse-custom-header:hover {
             background-color: rgba(0, 0, 0, 0.5);
        }

    </style>
</head>
<body class="relative">

{{-- @include('layouts.hotelNav') --}}
<div class="h-16 w-full bg-black/30 border-b border-white/10 flex items-center px-4 md:px-6">
    <p class="text-xl font-bold text-white">Hotel Bookie</p>
</div>

<main class="px-4 md:px-6 py-16">

    <div class="max-w-4xl mx-auto">

        <header class="mb-10 text-center md:text-left">
            <h1 class="text-5xl font-serif font-bold text-white mb-2">
                User Profile Settings
            </h1>
            <p class="text-lg text-white/70">
                Update your personal details and account information.
            </p>
            <div class="divider before:bg-white/10 after:bg-white/10 mt-4"></div>
        </header>

        <div class="bg-black/40 p-8 md:p-12 rounded-lg shadow-2xl">
            <form action="{{ route('profile.update') }}" method="POST">
                {{-- @csrf --}}
                {{-- @method('PUT') --}}

                <h2 class="text-2xl font-semibold mb-4 text-white/90">Personal Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
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

                    <div>
                        <label class="label">
                            <span class="label-text text-white/80 font-medium">Account Role</span>
                        </label>
                        <input type="text" 
                               value="{{ ucfirst($user->role ?? 'user') }}" 
                               class="input input-dark-style w-full rounded-none" disabled />
                        <p class="label-text-alt text-white/50 mt-1">This field cannot be edited.</p>
                    </div>

                    <div>
                        <label class="label">
                            <span class="label-text text-white/80 font-medium">Account Balance</span>
                        </label>
                        <input type="text" 
                               value="${{ number_format($user->balance ?? 0, 2) }}" 
                               class="input input-dark-style w-full rounded-none" disabled />
                        <p class="label-text-alt text-white/50 mt-1">For loyalty/credit system.</p>
                    </div>

                </div>
                
                <div class="divider before:bg-white/10 after:bg-white/10 my-8">
                    <span class="text-white/70">Security</span>
                </div>

                <div class="collapse collapse-plus rounded-lg border border-white/10 shadow-lg">
                    <input type="checkbox" name="password_change_toggle" /> 
                    <div class="collapse-title text-xl font-medium collapse-custom-header">
                        Change Your Password
                    </div>
                    <div class="collapse-content p-6 bg-black/30">
                        <p class="text-sm text-white/70 mb-4">Leave these fields blank if you do not wish to change your password.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                                       placeholder="New password" 
                                       class="input input-dark-style w-full rounded-none" />
                            </div>

                            <div>
                                <label for="new_password_confirmation" class="label">
                                    <span class="label-text text-white/80 font-medium">Confirm New Password</span>
                                </label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                                       placeholder="Confirm new password" 
                                       class="input input-dark-style w-full rounded-none" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-8 text-right">
                    <button type="submit" class="btn btn-accent-color btn-lg px-10 rounded-none font-semibold">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    </div>

</main>

</body>
</html>