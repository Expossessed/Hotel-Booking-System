<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Secure Login & Register</title>

    <!-- Tailwind CSS and DaisyUI Setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    
    <!-- Using Inter font which is the default for Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <style>
        /* 🎨 THEME COLORS: Dark Brown & Accent Orange */
        :root {
            --color-dark-brown: #3C2A21; /* Rich dark brown for background/side panel */
            --color-accent-orange: #C45B3A; /* Reddish-orange accent */
            --color-text-light: #F7F7F7; /* Near-white for text */
            --color-bg-contrast: #312620; /* Slightly darker for deeper contrast elements */
        }
        
        /* 1. Body Background (Full Dark Theme Look) */
        body {
            background: linear-gradient(to bottom, rgba(0,0,0,0.8), var(--color-dark-brown) 90%),
                        url('https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg')
                        center/cover no-repeat fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            color: white;
        }

        /* 2. Authentication Card */
        .auth-card {
            max-width: 900px;
            /* Increased min-height to better accommodate the stacked register fields */
            min-height: 580px; 
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0px 8px 30px rgba(0,0,0,0.8);
            background: var(--color-bg-contrast); /* Darker card background */
            transition: all 0.3s ease;
        }

        /* 3. Left Panel (Image) - UPDATED FOR PROFESSIONAL LOOK */
        .left-panel {
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.4)), /* Darker gradient overlay */
                        url('https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg')
                        center/cover no-repeat;
            flex: 1;
            /* Added styling for internal content */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        /* 4. Right Panel (Form) */
        .right-panel {
            flex: 1;
            padding: 2.5rem; /* 40px */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* 5. Custom Accent Styles */
        .hotel-title {
            font-weight: 800;
            color: var(--color-accent-orange);
            letter-spacing: 0.1em;
            text-shadow: 0 0 5px rgba(196, 91, 58, 0.4);
        }

        /* 6. DaisyUI Overrides for Tabs and Inputs */
        .tab-active {
            color: white !important;
            background-color: var(--color-accent-orange) !important;
        }

        .tabs a {
            color: var(--color-accent-orange);
            border-radius: 0.5rem;
            transition: background-color 0.3s;
        }

        .input, .input:focus, .input-bordered {
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 0.5rem;
        }
        
        .input:focus {
            border-color: var(--color-accent-orange) !important;
            box-shadow: 0 0 0 2px var(--color-accent-orange);
        }

        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 0.5rem;
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }
        
        .btn-secondary-color {
            background-color: #2e7d32; /* A nice green for register */
            border-color: #2e7d32;
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            border-radius: 0.5rem;
        }
        .btn-secondary-color:hover {
            background-color: #1b5e20;
            border-color: #1b5e20;
        }

        /* Smooth fade */
        .tab-content > div {
            transition: opacity 0.4s ease-in-out;
        }
        .tab-content > .hidden {
            opacity: 0;
            height: 0;
            overflow: hidden;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .auth-card {
                margin: 1rem;
                min-height: auto;
            }
            .right-panel {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- BLADE LOGIC: Redirect if already authenticated -->
@auth
<script> 
    // This is typically handled by Laravel middleware, but client-side redirect for immediate feedback
    window.location.href = "{{ route('rooms.list') }}"; 
</script>
@endauth

@guest
<div class="auth-card mx-4 sm:mx-auto">
    
    <!-- LEFT SIDE IMAGE (Hidden on Mobile) -->
    <div class="left-panel hidden md:block">
        <h2 class="text-5xl font-extrabold mb-4" style="color: var(--color-text-light);">
            Welcome Back.
        </h2>
        <p class="text-gray-300 text-lg mb-8">
            Your next luxury stay awaits. Fast check-in and room management at your fingertips.
        </p>
    </div>

    <!-- RIGHT SIDE FORM -->
    <div class="right-panel">
        <h3 class="text-3xl text-center hotel-title mb-1">HOTEL BOOKIE</h3>
        <p class="text-center text-gray-400 mb-6 text-sm">Luxury • Comfort • Convenience</p>
        
        <!-- TAB BUTTONS -->
        <div role="tablist" class="tabs tabs-boxed mb-6 bg-black/30 w-full">
            <a role="tab" class="tab font-semibold" id="login-tab">Login</a>
            <a role="tab" class="tab font-semibold" id="register-tab">Register</a>
        </div>

        <!-- TAB CONTENT -->
        <!-- Min-height is set in CSS on .auth-card to ensure consistent right panel size -->
        <div id="tabContent">
            <!-- LOGIN FORM -->
            <div id="login" class="tab-pane">
                <!-- We intercept the default Laravel action with a simulated JS function -->
                <form id="loginForm" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Email Address</span></label>
                        <input type="email" class="input input-bordered w-full" name="email" id="login_email" required autofocus>
                    </div>
                    <div class="mb-2">
                        <label class="label"><span class="label-text text-gray-300">Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password" required>
                    </div>
                    
                    <!-- Forgot Password Link for balanced height -->
                    <div class="text-right mb-6"> 
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                            Forgot Password?
                        </a>
                    </div>
                    
                    <button type="submit" class="btn btn-accent-color w-full">Login</button>
                </form>
            </div>

            <!-- REGISTER FORM - Now uses stacked, full-width inputs -->
            <div id="register" class="tab-pane hidden">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Full Name (Full Width) -->
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Full Name</span></label>
                        <input type="text" class="input input-bordered w-full" name="name" required>
                    </div>
                    <!-- Email Address (Full Width) -->
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Email Address</span></label>
                        <input type="email" class="input input-bordered w-full" name="email" required>
                    </div>
                    <!-- Password (Full Width) -->
                    <div class="mb-4">
                        <label class="label"><span class="label-text text-gray-300">Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password" required>
                    </div>
                    <!-- Confirm Password (Full Width) -->
                    <div class="mb-6">
                        <label class="label"><span class="label-text text-gray-300">Confirm Password</span></label>
                        <input type="password" class="input input-bordered w-full" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-secondary-color w-full">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endguest
</script>

</body>
</html>