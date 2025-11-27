

@section('body_class', 'booking-created-page bg-gray-100')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
    <style>
        /* Make non-editable form controls non-interactive on this page */
        input[readonly],
        textarea[readonly],
        input:disabled,
        textarea:disabled {
            pointer-events: none;
            cursor: default;
            caret-color: transparent;
        }
        /* Disable caret / text selection for non-input text on this page */
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
@endpush

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4>Booking Confirmed</h4>
        </div>
        <div class="card-body">
            <p>Your booking has been created successfully.</p>

            <ul class="list-group mb-4">
                <li class="list-group-item"><strong>Customer Name:</strong> {{ $user->name }}</li>
                <li class="list-group-item"><strong>Customer Email:</strong> {{ $user->email }}</li>
                <li class="list-group-item"><strong>Booking ID:</strong> {{ $booking->booking_id }}</li>
                <li class="list-group-item"><strong>Room ID:</strong> {{ $booking->room_id }}</li>
                <li class="list-group-item"><strong>Room Price per Night:</strong> {{ $booking->room_price }}</li>
                <li class="list-group-item"><strong>Number of Days:</strong> {{ $booking->num_days }}</li>
                <li class="list-group-item"><strong>Start Date:</strong> {{ $booking->book_date }}</li>
                <li class="list-group-item"><strong>End Date:</strong> {{ $booking->end_date }}</li>
                <li class="list-group-item"><strong>Total Price:</strong> {{ $booking->room_price * $booking->num_days }}</li>
            </ul>

            <a href="{{ route('rooms.list') }}" class="btn btn-primary">Back to Rooms</a>
        </div>
    </div>
</div>

</div>
@endsection
