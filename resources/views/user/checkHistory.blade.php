@extends('layouts.grandoria')

@section('body_class', 'history-page bg-gray-100')

@push('head')
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
    <main class="px-6 py-8 max-w-5xl mx-auto bg-gray-100">
        <h1 class="text-3xl font-bold mb-6">Your Booking History</h1>

        @if ($bookings->isEmpty())
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <p class="text-gray-600">You have no bookings yet.</p>
                <a href="{{ route('rooms.list') }}" class="btn btn-primary mt-4">Browse Rooms</a>
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="table w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Room</th>
                            <th class="px-4 py-2">Start Date</th>
                            <th class="px-4 py-2">End Date</th>
                            <th class="px-4 py-2">Nights</th>
                            <th class="px-4 py-2">Price/Night</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-t">
                                <td class="px-4 py-2">
                                    {{ optional($booking->room)->room_type ?? 'Room deleted' }}
                                </td>
                                <td class="px-4 py-2">{{ $booking->book_date }}</td>
                                <td class="px-4 py-2">{{ $booking->end_date }}</td>
                                <td class="px-4 py-2">{{ $booking->num_days }}</td>
                                <td class="px-4 py-2">${{ $booking->room_price }}</td>
                                <td class="px-4 py-2 font-semibold">
                                    ${{ $booking->room_price * $booking->num_days }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
@endsection
