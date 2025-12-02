<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" />
<style>
    body {
        background: linear-gradient(135deg, #3C2A21, #C45B3A);
        min-height: 100vh;
        font-family: 'Inter', sans-serif;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        font-size: 1.5rem;
        font-weight: 600;
        text-align: center;
        background: #198754;
        border-bottom: none;
    }
    .list-group-item {
        background-color: #f8f9fa;
        border: none;
        font-size: 0.95rem;
    }
    .list-group-item strong {
        color: #C45B3A;
    }
    .btn-primary {
        background-color: #C45B3A;
        border-color: #C45B3A;
    }
    .btn-primary:hover {
        background-color: #A94E31;
        border-color: #A94E31;
    }
</style>
@endpush

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg w-75">
        <div class="card-header text-white">
            ✅ Booking Confirmed
        </div>
        <div class="card-body text-center">
            <p class="lead mb-4">Your booking has been created successfully 🎉</p>

            <div class="table-responsive">
                <table class="table table-bordered text-start">
                    <tbody>
                        <tr>
                            <th>Customer Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Customer Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Booking ID</th>
                            <td>{{ $booking->booking_id }}</td>
                        </tr>
                        <tr>
                            <th>Room ID</th>
                            <td>{{ $booking->room_id }}</td>
                        </tr>
                        <tr>
                            <th>Room Price per Night</th>
                            <td>₱{{ number_format($booking->room_price, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Number of Days</th>
                            <td>{{ $booking->num_days }}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $booking->book_date }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $booking->end_date }}</td>
                        </tr>
                        <tr class="table-success">
                            <th>Total Price</th>
                            <td><strong>₱{{ number_format($booking->room_price * $booking->num_days, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('rooms.list') }}" class="btn btn-primary btn-lg">
                    ← Back to Rooms
                </a>
            </div>
        </div>
    </div>
</div>
</html>
