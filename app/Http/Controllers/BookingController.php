<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
     public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'booker_id' => 'required|integer',
            'room_id' => 'required|integer',
            'book_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $booking = Booking::create([
            'booker_id' => $validated['booker_id'],
            'room_id' => $validated['room_id'],
            'book_date' => $validated['book_date'],
            'end_date' =>$validated['end_date'],
        ]);

        return view('bookings.created', ['booking' => $booking]);
    }
}


