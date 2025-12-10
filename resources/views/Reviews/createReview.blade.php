<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
        <link rel="icon" type="image/x-icon" href="https://scontent.fceb6-1.fna.fbcdn.net/v/t1.15752-9/429922800_726758146106956_6258299385019235663_n.png?_nc_cat=105&ccb=1-7&_nc_sid=9f807c&_nc_eui2=AeGLLP_iy6tVlltPnmHV6JmIXc3yic1PhchdzfKJzU-FyJvdZQoDDzahDVeGmyTPU0kAEYcq6lAN0P4hcqV_-3o6&_nc_ohc=_cnpXDv9QbkQ7kNvwGK4Yem&_nc_oc=AdkBE7ZXUgfi__RfcbEkmw81RMgQzyRtJGr0wLEt_PlghJw_MQ_7NES5kWrRv2CLSnI&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&oh=03_Q7cD4AEA6Qkyj9JAWVUOiRYz5QGOqm5dYus_Wav8lIBj0nXc6w&oe=69612B37">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" />
    
    <style>
        /* 🎨 STYLING: Based on the Main UI (Dark Brown & White/Orange) */

        /* Define Core Colors */
        :root {
            --color-dark-brown: #3C2A21; /* Rich dark brown for background/side panel */
            --color-accent-orange: #C45B3A; /* Reddish-orange accent (like the button/bed runner) */
            --color-text-light: #F7F7F7; /* Near-white for text */
            --color-card-bg: rgba(0, 0, 0, 0.4); /* Dark card background */
        }

        /* 1. Reset Body Background and Text */
        body {
            background-color: var(--color-dark-brown);
            min-height: 100vh;
            color: var(--color-text-light);
        }

        /* 2. Form Container Style (Darker background for contrast) */
        .review-card-style {
            background-color: var(--color-card-bg); 
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* 3. Accent Button Style (Orange/Brown) */
        .btn-accent-color {
            background-color: var(--color-accent-orange);
            border-color: var(--color-accent-orange);
            color: var(--color-text-light);
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            /* Match button style from main UI */
            border-radius: 0; 
        }
        .btn-accent-color:hover {
            background-color: #A94E31; 
            border-color: #A94E31;
        }

        /* 4. Input/Select/Textarea Styling */
        .form-input-style {
            background-color: rgba(255, 255, 255, 0.05); /* Very dark, slight transparency */
            color: var(--color-text-light);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 0; /* Match main UI's sharp corners */
            transition: border-color 0.3s ease;
        }
        .form-input-style:focus {
            outline: none;
            border-color: var(--color-accent-orange);
            box-shadow: 0 0 0 2px rgba(196, 91, 58, 0.5); /* Ring effect */
        }
        .form-input-style::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .form-input-style option {
            background-color: var(--color-dark-brown); /* Ensure dropdown options match dark theme */
            color: var(--color-text-light);
        }

        /* 5. Text Adjustments */
        .text-dark {
            color: var(--color-text-light);
        }
        .text-secondary {
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body class="relative">
    <div class="min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-lg review-card-style rounded-lg shadow-2xl p-8">
            <h1 class="text-3xl font-serif font-bold mb-6 text-center text-white">Share Your Experience</h1>
            
            @if(isset($room_name) && $room_name)
                <p class="text-center text-secondary mb-4">For room: <strong class="text-white">{{ $room_name }}</strong></p>
            @elseif(isset($room_id) && $room_id)
                <p class="text-center text-secondary mb-4">For room id: <strong class="text-white">{{ $room_id }}</strong></p>
            @endif

            @if(session('success'))
                <div id="review-toast" class="fixed top-6 right-6 z-50">
                    <div class="bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg font-semibold">
                        {{ session('success') }}
                    </div>
                </div>
                <script>
                    // auto-hide toast after 3s
                    setTimeout(function(){
                        const el = document.getElementById('review-toast');
                        if(el) el.style.display = 'none';
                    }, 3000);
                </script>
            @endif

            <form id="create-review-form" action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="room_id" value="{{ isset($room_id) ? $room_id : request('room_id') }}">
                <input type="hidden" name="room_name" value="{{ isset($room_name) ? $room_name : request('room_name') }}">

                <div class="mb-4">
                    <label for="rating" class="block text-lg font-medium mb-2 text-white">Rating (1-5):</label>
                    <select id="rating" name="rating" required
                            class="w-full form-input-style px-3 py-2 rounded-none">
                        <option value="" disabled selected>Select rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="comment" class="block text-lg font-medium mb-2 text-white">Comment:</label>
                    <textarea id="comment" name="comment" rows="4" required
                              class="w-full form-input-style px-3 py-2 rounded-none"
                              placeholder="Write your review here..."></textarea>
                </div>

                <div class="flex justify-center pt-2">
                    <button type="submit"
                            class="btn btn-accent-color btn-lg w-full rounded-none font-semibold shadow-lg">
                        Submit Review
                    </button>
                </div>
            </form>
            <script>
                // Your original AJAX logic to handle form submission with SweetAlert
                (function(){
                    const form = document.getElementById('create-review-form');
                    if (!form) return;

                    form.addEventListener('submit', function(e){
                        e.preventDefault();
                        const fd = new FormData(form);

                        // Show a loading indicator
                        Swal.fire({
                            title: 'Submitting...',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading(),
                            background: '#312620',
                            color: '#F7F7F7',
                            iconColor: '#C45B3A'
                        });

                        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                        const csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : null;

                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                                , ...(csrfToken ? {'X-CSRF-TOKEN': csrfToken} : {})
                            },
                            // ensure cookies (session) are included for auth
                            credentials: 'same-origin',
                            body: fd
                        }).then(async res => {
                            const data = await res.json().catch(() => ({}));
                            if (res.ok) {
                                Swal.close();
                                Swal.fire({
                                    icon: 'success',
                                    title: data.message || 'Review submitted',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    background: '#312620',
                                    color: '#F7F7F7',
                                    iconColor: '#22c55e'
                                }).then(() => {
                                    // Redirect to room page so the user can see the review in context.
                                    let redirectId = (data && data.review && data.review.room_id) ? data.review.room_id : window.initialRoomId;
                                    if (redirectId) {
                                        window.location.href = '/user/rooms/' + encodeURIComponent(redirectId);
                                    } else {
                                        // This assumes 'home' is a defined route
                                        window.location.href = "{{ route('home') }}";
                                    }
                                });
                                return;
                            }

                            // On validation errors, show them with SweetAlert
                            let message = 'Could not submit review.';
                            if (data.errors) {
                                const errs = Object.values(data.errors).flat().join('\n');
                                message = errs || message;
                            } else if (data.message) {
                                message = data.message;
                            }

                            Swal.fire({ 
                                icon: 'error', 
                                title: 'Error', 
                                text: message,
                                background: '#312620',
                                color: '#F7F7F7',
                                iconColor: '#ef4444'
                            });
                        }).catch(err => {
                            Swal.fire({ icon: 'error', title: 'Network error', text: 'Please try again.' });
                        });
                    });
                })();
            </script>
        </div>
    </div>
</body>
</html>