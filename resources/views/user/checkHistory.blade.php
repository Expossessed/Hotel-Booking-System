<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Booking History - HOTEL BOOKIE</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DaisyUI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* 🎨 CORE UI STYLING REPLICATION (Dark Brown, White Text, Orange Accent) */

        /* Define Core Colors */
        :root {
            --color-dark-brown: #3C2A21; /* Rich dark brown for background */
            --color-accent-orange: #C45B3A; /* Reddish-orange accent */
            --color-text-light: #F7F7F7; /* Near-white */
        }

        /* 1. Global Dark Theme Background & Text */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-dark-brown);
            color: var(--color-text-light);
            min-height: 100vh;
        }

        /* 2. Navbar Styling */
        .navbar-top {
            background-color: #312620; /* Slightly darker shade */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
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
        
        /* 3. Accent Button (Square Corners) */
        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            border-radius: 0.25rem; /* Slightly rounded corners for buttons */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-accent-color:hover:not(:disabled) {
            background-color: #A94E31; 
            border-color: #A94E31;
        }
        /* Style for Disabled Buttons */
        .btn-accent-color:disabled {
            background-color: #4D3C36; /* Darker, muted brown */
            border-color: #4D3C36;
            color: #A3A3A3; /* Lighter gray text */
            cursor: not-allowed;
            opacity: 0.7;
        }


        /* 4. Content Card/Table Container */
        .card-dark-bg {
            background-color: rgba(0, 0, 0, 0.3); 
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .card-dark-bg:hover {
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        /* 5. Status Badges */
        .badge-base {
            padding: 0.5rem 1rem;
            border-radius: 0.25rem; /* Rounded corners for badges in card view */
            min-width: 6rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-flex;
            justify-content: center;
        }
        .badge-pending {
            background-color: #ff9900; 
            color: black;
        }
        .badge-approved {
            background-color: #10B981; 
            color: white;
        }
        .badge-canceled {
            background-color: #EF4444; 
            color: white;
        }

        /* Additional styles for the header to use Playfair Display */
        .main-header {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body>

<!-- 1. NAVBAR -->
<div class="navbar navbar-top px-4 md:px-12 py-3 sticky top-0 z-50 shadow-lg">
    <div class="flex-1">
        <a href="#" class="text-xl md:text-2xl font-extrabold tracking-widest text-white">
            HOTEL BOOKIE
        </a>
    </div>

    <div class="flex-none">
        <ul class="menu menu-horizontal p-0 hidden md:flex gap-6 navbar-menu text-lg">
            <li><a href="#">Home</a></li>
            <li><a href="#">Rooms</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <!-- User Profile Dropdown (Mock Auth) -->
        <div class="dropdown dropdown-end ml-6">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar border-2 border-white/50 hover:bg-white/10 transition-colors">
                <div class="w-10 rounded-full bg-white/10 flex items-center justify-center">
                    <!-- User Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 19.5a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="#" class="font-medium">My Bookings</a></li>
                <li><a href="#" class="font-medium">Profile & Settings</a></li>
                <li><button class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button></li>
            </ul>
        </div>

        <!-- Mobile Menu -->
        <div class="dropdown dropdown-end md:hidden ml-2">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content z-[1] p-2 shadow-xl rounded-box w-52 mt-3 profile-dropdown-content">
                <li><a href="#">Home</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#" class="font-medium">My Bookings</a></li>
                <li><button class="text-error hover:bg-error hover:text-white transition-colors duration-200">Logout</button></li>
            </ul>
        </div>
    </div>
</div>

<!-- 2. MAIN CONTENT: BOOKING HISTORY -->
<main class="px-4 md:px-6 py-12 max-w-6xl mx-auto">
    
    <h1 class="text-4xl main-header font-bold mb-10 text-white">
        My Booking History
    </h1>
        
    <!-- Card Grid for Bookings -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
    
        @if(isset($bookings) && $bookings->isEmpty())
            <div class="lg:col-span-2 text-center p-12 card-dark-bg rounded-lg">
                <p class="text-xl text-white/80 font-medium">You have no bookings yet.</p>
                <a href="#" class="mt-4 inline-block text-lg font-semibold text-[var(--color-accent-orange)] hover:text-white transition-colors">Start your journey here.</a>
            </div>
        @elseif(isset($bookings))
            @foreach($bookings as $booking)
                @php
                    // Define status variables for conditional styling and logic
                    $isPending = $booking->status === 'pending';
                    $isApproved = $booking->status === 'approved';
                    $isCanceled = $booking->status === 'canceled';

                    $statusClass = match($booking->status) {
                        'pending' => 'badge-pending',
                        'approved' => 'badge-approved',
                        'canceled' => 'badge-canceled',
                        default => '',
                    };

                    $buttonText = $isPending ? 'Pay Now' : 'View Details';
                    $buttonDisabled = $isApproved || $isCanceled;
                    $linkDestination = '#'; // Placeholder for route('bookings.show', $booking->id)
                    // Mock Room name for URL encoding (used in image placeholder)
                    
                @endphp
                
                <div class="p-6 card-dark-bg rounded-lg flex flex-col justify-between space-y-4">
                    
                    <!-- Room Image Placeholder -->
                    <div class="w-full h-40 bg-gray-700 rounded-lg overflow-hidden mb-4 shadow-lg">
                        <img 
                            src="{{ 'https://via.placeholder.com/400x200.png?text=' . urlencode($booking->room ? $booking->room->name : 'Room') }}"
                            alt="{{ $booking->room ? $booking->room->name : 'Room' }}"
                            class="w-full h-full object-cover rounded-lg"
                        >
                    </div>

                    <!-- Top Section: Title and Status -->
                    <div class="flex justify-between items-start border-b border-white/10 pb-4">
                        <h2 class="text-2xl font-bold text-white leading-tight">
                            {{ $booking->room ? $booking->room->name : 'Room' }}
                        </h2>
                        <span class="badge badge-base {{ $statusClass }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <!-- Booking Details Grid -->
                    <div class="grid grid-cols-2 gap-y-4 text-sm">
                        
                        <!-- Row 1: Dates -->
                        <div>
                            <p class="text-white/60">Check-in</p>
                            <p class="font-medium text-white">{{ \Carbon\Carbon::parse($booking->book_date)->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-white/60">Check-out</p>
                            <p class="font-medium text-white">{{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</p>
                        </div>

                        <!-- Row 2: Duration and Price/Night -->
                        <div>
                            <p class="text-white/60">Nights</p>
                            <p class="font-medium text-white">{{ $booking->num_days }}</p>
                        </div>
                        <div>
                            <p class="text-white/60">Price/Night</p>
                            <p class="font-medium text-white">${{ number_format($booking->room_price, 2) }}</p>
                        </div>

                    </div>

                    <!-- Bottom Section: Total and Action Button -->
                    <div class="pt-4 flex justify-between items-center border-t border-white/10 mt-4">
                        <div>
                            <p class="text-lg text-white/60">Total Cost</p>
                            <p class="text-3xl font-extrabold text-[var(--color-accent-orange)]">${{ number_format($booking->total, 2) }}</p>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="{{ $linkDestination }}" 
                           class="btn btn-sm md:btn-md btn-accent-color font-semibold border-none 
                                  {{ $buttonDisabled ? 'disabled' : 'hover:opacity-80' }}"
                           @if($buttonDisabled) disabled @endif
                           tabindex="{{ $buttonDisabled ? '-1' : '0' }}"
                           aria-disabled="{{ $buttonDisabled ? 'true' : 'false' }}">
                            {{ $buttonText }}
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
        
    </div>
    <!-- End Card Grid -->

</main>

</body>
</html>