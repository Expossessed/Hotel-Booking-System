<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" />
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-6">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-xl p-8">
            <h1 class="text-3xl font-bold mb-6 text-center">Create a Review</h1>
            @if(isset($room_name) && $room_name)
                <p class="text-center text-gray-600 mb-4">For room: <strong>{{ $room_name }}</strong></p>
            @elseif(isset($room_id) && $room_id)
                <p class="text-center text-gray-600 mb-4">For room id: <strong>{{ $room_id }}</strong></p>
            @endif

            @if(session('success'))
                <div id="review-toast" class="fixed top-6 right-6 z-50">
                    <div class="bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg">
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

            <form id="create-review-form" action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="room_id" value="{{ isset($room_id) ? $room_id : request('room_id') }}">
        <input type="hidden" name="room_name" value="{{ isset($room_name) ? $room_name : request('room_name') }}">

        <div class="mb-4">
            <label for="rating" class="block text-lg font-medium mb-2">Rating (1-5):</label>
            <select id="rating" name="rating" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="" disabled selected>Select rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-lg font-medium mb-2">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Write your review here..."></textarea>
        </div>

        <div class="flex justify-center">
            <button type="submit"
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Submit Review
            </button>
        </div>
    </form>
    <script>
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
                    didOpen: () => Swal.showLoading()
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
                            timer: 1500
                        }).then(() => {
                            // Redirect to room page so the user can see the review in context.
                            // Prefer the room_id returned by the server if available.
                            let redirectId = (data && data.review && data.review.room_id) ? data.review.room_id : @json($room_id ?? null);
                            if (redirectId) {
                                window.location.href = '/user/rooms/' + encodeURIComponent(redirectId);
                            } else {
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

                    Swal.fire({ icon: 'error', title: 'Error', text: message });
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