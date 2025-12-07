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

        $total = $roomPrice * $numDays;

        // First step: show confirmation overlay on the same booking page
        if (!$request->input('confirm')) {
            return view('Booking.createBooking', [
                'room_id'           => $roomId,
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
            'total'   => $total,
        ]);

        // Redirect to the user-facing room listing (user home) so the user lands
        // on the page they expect after booking and can continue browsing.
        return redirect()->route('rooms.list')->with('success', 'Booking created successfully.');

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
        return view('admin.viewBookings', compact('bookings'));
    }
    
    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->input('status');
        $booking->save();

        return redirect()->route('admin.history')->with('success', 'Booking status updated successfully.');
    }

    //check booking history for user
    public function checkBookingHistory(Request $request)
    {
        $userId = $request->user()->id;
        $bookings = Booking::where('booker_id', $userId)->get();

        return view('user.checkHistory', compact('bookings'));
    }

    // View pending reservations for the current user
    public function viewPendingReservations(Request $request)
    {
        $bookings = Booking::with('room')
            ->where('booker_id', $request->user()->id)
            ->where('status', 'pending')
            ->orderByDesc('book_date')
            ->get();

        return view('user.pendingReservation', [
            'bookings' => $bookings,
        ]);
    }

    // Pay for a pending reservation
    public function payPendingReservation(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        $booking = Booking::findOrFail($request->input('booking_id'));

        // Ensure the booking belongs to the current user
        if ($booking->booker_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Check if user has sufficient balance
        $user = $request->user();
        if ($user->account_balance < $booking->total) {
            return redirect()->back()->with('error', 'Insufficient balance. Please add funds.');
        }

        // Deduct from user balance and mark booking as confirmed
        $user->account_balance -= $booking->total;
        $user->save();

        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('bookings.history')->with('success', 'Booking confirmed successfully!');
    }

    
}
