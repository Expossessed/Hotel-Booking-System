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
        // Prefer an explicit room_id (from clicking a specific room card)
        $roomId   = $request->query('room_id');
        $roomType = $request->query('room_type');

        $room = null;
        if ($roomId) {
            $room = Rooms::where('room_id', $roomId)->first();
        } elseif ($roomType) {
            // Fallback: first room matching this type (e.g. from navbar dropdown)
            $room = Rooms::where('room_type', $roomType)->first();
        }

        return view('Booking.createBooking', [
            'room_id'    => $room?->room_id,
            'room_type'  => $room?->room_type,
            'room_price' => $room?->room_price,
        ]);
    }

    public function createBooking(Request $request)
    {
        $validated = $request->validate([
            'room_id'   => 'required|integer|exists:rooms,room_id',
            'book_date' => 'required|date',
            'num_days'  => 'required|integer|min:1',
        ]);

        $room   = Rooms::where('room_id', $validated['room_id'])->firstOrFail();
        $roomId = $room->room_id;
        $roomType = $room->room_type;
        $roomPrice = $room->room_price;

        $start    = Carbon::parse($validated['book_date']);
        $numDays  = (int) $validated['num_days'];
        $end      = (clone $start)->addDays($numDays);

        // How many bookings already overlap this date range for this room type?
        $overlappingBookings = Booking::where('room_id', $roomId)
            ->where('book_date', '<', $end->toDateString())
            ->where('end_date', '>', $start->toDateString())
            ->count();

        $remainingRooms = $room->available_rooms - $overlappingBookings;

        // Do not allow bookings against room types that are globally marked unavailable
        if (!$room->is_available) {
            return back()
                ->withErrors(['room_id' => 'This room type is currently not available for booking.'])
                ->withInput();
        }

        if ($remainingRooms <= 0) {
            return back()
                ->withErrors(['room_id' => 'No rooms of this type are available for the selected dates.'])
                ->withInput();
        }

        $total = $roomPrice * $numDays;

        // First step: show confirmation overlay on the same booking page
        if (!$request->input('confirm')) {
            return view('Booking.createBooking', [
                'room_id'             => $roomId,
                'room_type'           => $roomType,
                'room_price'          => $roomPrice,
                'preview'             => true,
                'preview_room_type'   => $roomType,
                'preview_book_date'   => $start->toDateString(),
                'preview_end_date'    => $end->toDateString(),
                'preview_num_days'    => $numDays,
                'preview_room_price'  => $roomPrice,
                'preview_total'       => $total,
                'preview_user_name'   => $request->user()->name,
                'preview_user_email'  => $request->user()->email,
                'preview_remaining'   => $remainingRooms,
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

    public function userHistory(Request $request)
    {
        $bookings = Booking::with('room')
            ->where('booker_id', $request->user()->id)
            ->orderByDesc('book_date')
            ->get();

        return view('user.checkHistory', [
            'bookings' => $bookings,
        ]);
    }

    public function adminHistory()
    {
        $bookings = Booking::with(['room', 'user'])
            ->orderByDesc('book_date')
            ->get();

        return view('admin.history', [
            'bookings' => $bookings,
        ]);
    }
    public function viewBookings()
    {
        $bookings = Booking::all();
        return view('admin.viewBookings', compact('users'));
    }
}
