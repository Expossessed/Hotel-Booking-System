<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Bookie | Room Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
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
            font-family: sans-serif;
        }
        
        .navbar-top {
            background-color: #312620; 
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

        .dark-card {
            background-color: #312620; 
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--color-text-light);
        }
        .dark-card-inner {
            background-color: #3C2A21;
        }

        input[readonly],
        textarea[readonly],
        input:disabled,
        textarea:disabled {
            pointer-events: none;
            cursor: default;
            caret-color: transparent;
        }
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        input,
        textarea {
            -webkit-user-select: text;
            -moz-user-select: text;
            user-select: text;
        }
    </style>
</head>

<body class="relative">

    @include('layouts.hotelNav')

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false,

                    customClass: {
                        popup: 'bg-[#312620] text-white rounded-none border border-green-400',
                        title: 'text-white',
                        content: 'text-green-300'
                    },
                    background: '#312620',
                });
            });
        </script>
    @endif

    <div class="container mx-auto py-12 px-4">
        <h1 class="text-5xl md:text-6xl font-bold text-center text-white mb-12">Room Details</h1>

        <div class="flex flex-col lg:flex-row gap-12 items-start dark-card shadow-2xl rounded-xl p-8">

            <div class="w-full lg:w-1/2">
                <img src="{{ $room->image_link }}" 
                    alt="{{ $room->room_name }}" 
                    class="rounded-xl shadow-md w-full object-cover h-[400px]">
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-between gap-8">
                
                <div>
                    <h2 class="text-4xl md:text-5xl font-serif text-accent-orange mb-2 tracking-wide">
                        {{ $room->room_name }}
                    </h2>
                    <h3 class="text-2xl md:text-3xl font-semibold text-white/90 mb-4">
                        <span class="text-accent-orange">₱{{ $room->room_price }}</span>/Day
                    </h3>

                    <div class="flex items-center mb-4">
                        @php $avg = $averageRating ?? 0; $full = floor($avg); @endphp
                        <div class="text-yellow-400 mr-3">
                            @for ($i = 0; $i < $full; $i++)
                                <span class="text-3xl">&#9733;</span>
                            @endfor
                            @for ($i = $full; $i < 5; $i++)
                                <span class="text-gray-600 text-3xl">&#9733;</span>
                            @endfor
                        </div>
                        <span class="ml-2 text-white/70 text-lg">({{ $averageRating }}/5)</span>
                    </div>

                    <p class="text-lg md:text-xl text-white font-bold">
                        {{ strtoupper($room->room_type) }}
                    </p>
                    <p class="text-lg md:text-xl text-white/70 mt-1 line-clamp-3 width-30">
                        {{ $room->room_desc }}
                    </p>

                    <div class="mt-8 flex flex-col gap-4">
                        
                        <a href="{{ route('reviews.createReview', ['room_name' => $room->room_name]) }}" 
                           class="btn btn-outline-accent btn-lg w-full text-lg rounded-none">
                            Add a Review
                        </a>
                        
                        <a href="{{ route('bookings.form', ['room_id' => $room->room_id]) }}" 
                           class="btn btn-accent-color btn-lg w-full text-xl rounded-none font-semibold">
                            Book Now!
                        </a>

                        <button type="button" 
                                class="btn btn-ghost text-white/80 hover:bg-white/10 w-full text-lg rounded-none"
                                onclick="document.getElementById('freeItems').classList.toggle('hidden')">
                            Free Items Included (Click to Toggle)
                        </button>

                        <div id="freeItems" class="hidden mt-2 dark-card-inner rounded-lg p-4">
                            <ul class="list-disc list-inside text-white/80 text-lg">
                                @foreach($room->free_items as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-12 px-4">
        <h2 class="text-4xl font-bold text-center text-white mb-8">Inside the Room</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="dark-card shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image1 }}" 
                    alt="Room Interior 1" 
                    class="w-full h-64 object-cover transition duration-300 hover:scale-[1.02]">
                <div class="p-4">
                    <p class="text-white/80">Cozy bedroom with modern furniture.</p>
                </div>
            </div>

            <div class="dark-card shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image2 }}" 
                    alt="Room Interior 2" 
                    class="w-full h-64 object-cover transition duration-300 hover:scale-[1.02]">
                <div class="p-4">
                    <p class="text-white/80">Spacious bathroom with elegant design.</p>
                </div>
            </div>

            <div class="dark-card shadow-lg rounded-xl overflow-hidden">
                <img src="{{ $room->room_image3 }}" 
                    alt="Room Interior 3" 
                    class="w-full h-64 object-cover transition duration-300 hover:scale-[1.02]">
                <div class="p-4">
                    <p class="text-white/80">Beautiful view from the balcony.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-8 px-4">
        <h2 class="text-3xl font-bold text-center text-white mb-6">Guest Reviews</h2>

        @php
            $reviews = $room->reviews ?? collect();
            $totalReviews = $reviews->count();
            $initialReviews = $reviews->slice(0, 10);
            $extraReviews = $reviews->slice(10);
        @endphp

        @if($reviews->isEmpty())
            <p class="text-white/60 text-center">No reviews yet — be the first to leave one!</p>
        @else
            <div class="space-y-4 max-w-3xl mx-auto" id="reviews-list">
                @foreach($initialReviews as $review)
                    <div class="dark-card p-4 rounded-lg shadow-md review-item">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <strong class="text-white">{{ $review->user?->name ?? 'Guest' }}</strong>
                                <div class="text-yellow-400 inline-block ml-3">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        &#9733;
                                    @endfor
                                    @for ($i = $review->rating; $i < 5; $i++)
                                        <span class="text-gray-600">&#9734;</span>
                                    @endfor
                                </div>
                            </div>
                            <div class="text-sm text-white/50">{{ $review->created_at->format('F j, Y') }}</div>
                        </div>
                        <p class="text-white/80">{{ $review->comment }}</p>
                    </div>
                @endforeach

                @if($extraReviews->isNotEmpty())
                    <div id="extra-reviews" style="display:none;" class="space-y-4 mt-4">
                        @foreach($extraReviews as $review)
                            <div class="dark-card p-4 rounded-lg shadow-md review-item">
                                <div class="flex items-center justify-between mb-2">
                                    <div>
                                        <strong class="text-white">{{ $review->user?->name ?? 'Guest' }}</strong>
                                        <div class="text-yellow-400 inline-block ml-3">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                &#9733;
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                <span class="text-gray-600">&#9734;</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="text-sm text-white/50">{{ $review->created_at->format('F j, Y') }}</div>
                                </div>
                                <p class="text-white/80">{{ $review->comment }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-6">
                        <button id="toggle-reviews-btn" data-hidden-count="{{ $extraReviews->count() }}" class="btn btn-outline-accent text-white px-6 py-2 rounded-none hover:text-white">
                            Show more ({{ $extraReviews->count() }} more)
                        </button>
                    </div>
                @endif
            </div>
        @endif

        @if($extraReviews->isNotEmpty())
            <script>
                (function(){
                    const btn = document.getElementById('toggle-reviews-btn');
                    const extra = document.getElementById('extra-reviews');
                    let shown = false;
                    if(!btn || !extra) return;
                    btn.addEventListener('click', function(){
                        shown = !shown;
                        if(shown) {
                            extra.style.display = '';
                            btn.textContent = 'Show less';
                        } else {
                            extra.style.display = 'none';
                            btn.textContent = 'Show more (' + btn.dataset.hiddenCount + ' more)';
                            window.scrollTo({ top: extra.getBoundingClientRect().top + window.scrollY - 100, behavior: 'smooth' });
                        }
                    });
                })();
            </script>
        @endif
    </div>

</body>

</html>