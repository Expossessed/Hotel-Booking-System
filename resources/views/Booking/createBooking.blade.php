<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Create New Booking</h4>
        </div>

        <div class="card-body">
           
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some problems with your input:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

         
            <form action="{{ route('bookings.create') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="booker_id" class="form-label">Booker ID</label>
                    <input type="number" name="booker_id" id="booker_id" class="form-control" value="{{ old('booker_id') }}" required>
                </div>

                <div class="mb-3">
                    <label for="room_id" class="form-label">Room ID</label>
                    <input type="number" name="room_id" id="room_id" class="form-control" value="{{ old('room_id') }}" required>
                </div>

                <div class="mb-3">
                    <label for="book_date" class="form-label">Booking Start Date</label>
                    <input type="date" name="book_date" id="book_date" class="form-control" value="{{ old('book_date') }}" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label">Booking End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                </div>

                <button type="submit" class="btn btn-success">Create Booking</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>