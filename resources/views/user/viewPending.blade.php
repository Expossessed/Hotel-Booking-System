@extends('layouts.hotel')

@section('body_class', 'history-page')

@section('content')
@include('layouts.hotelNav')

<main class="px-6 py-8 max-w-3xl mx-auto" style="background-color: #3C2A21; min-height: 100vh; color: #F7F7F7;">
    <h1 class="text-2xl font-bold mb-4 text-white">Pending Booking</h1>

    <div class="shadow-md rounded-lg p-6" style="background-color: #312620; border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-white">Room</h2>
            <p class="text-white/70">{{ optional($booking->room)->room_type ?? 'Room deleted' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <h3 class="font-medium text-white">Start Date</h3>
                <p class="text-white/70">{{ $booking->book_date }}</p>
            </div>
            <div>
                <h3 class="font-medium text-white">End Date</h3>
                <p class="text-white/70">{{ $booking->end_date }}</p>
            </div>
            <div>
                <h3 class="font-medium text-white">Nights</h3>
                <p class="text-white/70">{{ $booking->num_days }}</p>
            </div>
            <div>
                <h3 class="font-medium text-white">Price / Night</h3>
                <p class="text-white/70">${{ $booking->room_price }}</p>
            </div>
        </div>

        <div class="mb-6 border-t border-white/10 pt-4">
            <h3 class="font-semibold text-white">Total</h3>
            <p class="text-xl font-bold" style="color: #C45B3A;">${{ $booking->total }}</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('bookings.pending') }}" class="btn btn-outline text-white border-white/40 hover:bg-white/10 rounded-none">Back</a>

            <form action="{{ route('bookings.payPending') }}" method="POST" onsubmit="return confirm('Pay ${{ $booking->total }} for this booking?');">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->booking_id ?? $booking->id ?? '' }}">
                <button type="submit" class="btn rounded-none text-white font-semibold" style="background-color: #C45B3A; border-color: #C45B3A;">Pay Now</button>
            </form>
        </div>
    </div>
</main>
@endsection
