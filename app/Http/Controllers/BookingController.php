<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Rooms;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function showForm(Request $request)
    {
        // room_type can be passed in the query string
        $roomType = $request->query('room_type');

        $room = null;
        if ($roomType) {
            $room = Rooms::where('room_type', $roomType)->first();
        }

        // Map constants by room type
        $roomPrice = $roomType ? $this->priceForRoomType($roomType) : null;

        return view('Booking.createBooking', [
            'room_type'  => $roomType ?? ($room->room_type ?? null),
            'room_price' => $roomPrice,
        ]);
    }

    protected function priceForRoomType(string $roomType): int
    {
        return match (strtolower($roomType)) {
            'suite'  => 999,
            'solo'   => 1999,
            'duo'    => 2999,
            'family' => 3999,
            default  => 0,
        };
    }

    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'room_type' => 'required|string',
            'book_date' => 'required|date',
            'num_days'  => 'required|integer|min:1',
        ]);

        $roomType = $validated['room_type'];
        $start    = Carbon::parse($validated['book_date']);
        $numDays  = (int) $validated['num_days'];
        $end      = (clone $start)->addDays($numDays);

        $roomPrice = $this->priceForRoomType($roomType);

        // Choose a room for this type (gracefully handle missing rooms)
        $room = Rooms::where('room_type', $roomType)->first();
        if (!$room) {
            return back()->withErrors([
                'room_type' => 'No room is available for the selected room type. Please choose a different type.',
            ])->withInput();
        }
        $roomId = $room->room_id;

        $total = $roomPrice * $numDays;

        // First step: show confirmation overlay on the same booking page
        if (!$request->input('confirm')) {
            return view('Booking.createBooking', [
                'room_type'         => $roomType,
                'room_price'        => $roomPrice,
                'preview'           => true,
                'preview_room_type' => $roomType,
                'preview_book_date' => $start->toDateString(),
                'preview_end_date'  => $end->toDateString(),
                'preview_num_days'  => $numDays,
                'preview_room_price'=> $roomPrice,
                'preview_total'     => $total,
                'preview_user_name' => $request->user()->name,
                'preview_user_email'=> $request->user()->email,
            ]);
        }

        // Second step: actually create the booking
        $booking = Booking::create([
            'booker_id'  => $request->user()->id,
            'room_id'    => $roomId,
            'book_date'  => $start->toDateString(),
            'end_date'   => $end->toDateString(),
            'room_price' => $roomPrice,
            'num_days'   => $numDays,
        ]);

        return view('Booking.created', [
            'booking' => $booking,
            'user'    => $request->user(),
        ]);
    }
}
