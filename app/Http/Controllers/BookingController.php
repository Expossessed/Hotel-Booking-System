<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Rooms;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class BookingController extends Controller
{
    public function showForm(Request $request)
    {

        $roomId   = $request->query('room_id');
        $roomType = $request->query('room_type');

        $room = null;
        if ($roomId) {
            $room = Rooms::where('room_id', $roomId)->first();
        } elseif ($roomType) {

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

        $booking = Booking::create([
            'booker_id'  => $request->user()->id,
            'room_id'    => $roomId,
            'book_date'  => $start->toDateString(),
            'end_date'   => $end->toDateString(),
            'room_price' => $roomPrice,
            'num_days'   => $numDays,
            'total'   => $total,
        ]);

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

        // If admin confirmed the booking, create a transaction record (avoid duplicates)
        if ($booking->status === 'confirmed' && !Transactions::where('booking_id', $booking->booking_id)->exists()) {
            Transactions::create([
                'booking_id' => $booking->booking_id,
                'booker_id' => $booking->booker_id,
                'room_id' => $booking->room_id,
                'payment_method' => $request->input('payment_method', 'admin_confirm'),
                'price_paid' => $booking->total,
                'num_days' => $booking->num_days,
                'book_date' => $booking->book_date,
                'end_date' => $booking->end_date,
                'total' => $booking->total,
            ]);
        }

        return redirect()->route('admin.history')->with('success', 'Booking status updated successfully.');
    }

    public function checkBookingHistory(Request $request)
    {
        $userId = $request->user()->id;
        $bookings = Booking::where('booker_id', $userId)->get();

        return view('user.checkHistory', compact('bookings'));
    }

    public function viewPendingReservations(Request $request)
    {
        $query = Booking::with('room')
            ->where('booker_id', $request->user()->id)
            ->orderByDesc('book_date');

        if (Schema::hasColumn('bookings', 'status')) {
            $query->where('status', 'pending');
        }

        $bookings = $query->get();

        return view('user.pendingReservation', [
            'bookings' => $bookings,
        ]);
    }

    public function showPending(Request $request, $id)
    {
        $booking = Booking::with('room', 'user')->findOrFail($id);

        if ($booking->booker_id !== $request->user()->id && !$request->user()->is_admin) {
            return redirect()->route('bookings.pending')->with('error', 'Unauthorized access.');
        }

        return view('user.viewPending', [
            'booking' => $booking,
        ]);
    }


    public function viewOrPay(Request $request, $id)
    {
        $booking = Booking::with('room', 'user')->findOrFail($id);

        if ($booking->booker_id !== $request->user()->id && !$request->user()->is_admin) {
            return redirect()->route('bookings.pending')->with('error', 'Unauthorized access.');
        }

        return view('user.viewOrPayBooking', [
            'booking' => $booking,
        ]);
    }

    public function payFromView(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->booker_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }


        $validated = $request->validate([
            'payment_method' => 'required|in:balance,card,paypal,bank',
        ]);

        $user = $request->user();

        if ($validated['payment_method'] === 'balance') {
            if ($user->balance < $booking->total) {
                return redirect()->back()->with('error', 'Insufficient balance. Please add funds.');
            }


            $user->balance -= $booking->total;
            $user->save();
        }


        if (Schema::hasColumn('bookings', 'status')) {
            $booking->status = 'confirmed';
        }
        $booking->save();

        // create a transaction record for this confirmed booking if one doesn't already exist
        if (!Transactions::where('booking_id', $booking->booking_id)->exists()) {
            Transactions::create([
                'booking_id' => $booking->booking_id,
                'booker_id' => $booking->booker_id,
                'room_id' => $booking->room_id,
                'payment_method' => $validated['payment_method'] ?? 'unknown',
                'price_paid' => $booking->total,
                'num_days' => $booking->num_days,
                'book_date' => $booking->book_date,
                'end_date' => $booking->end_date,
            ]);
        }

        return redirect()->route('bookings.history')->with('success', 'Booking confirmed successfully!');
    }


    public function payPendingReservation(Request $request)
    {
        $request->validate([

            'booking_id' => 'required|integer|exists:bookings,booking_id',
            'payment_method' => 'required|in:balance,card,paypal,bank',
        ]);

        $booking = Booking::findOrFail($request->input('booking_id'));


        if ($booking->booker_id !== $request->user()->id) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }


        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'balance') {
            if ($user->balance < $booking->total) {
                return redirect()->back()->with('error', 'Insufficient balance. Please add funds or choose another payment method.');
            }


            $user->balance -= $booking->total;
            $user->save();
        }

        if (Schema::hasColumn('bookings', 'status')) {
            $booking->status = 'confirmed';
        }
        $booking->save();

        // create a transaction record for this confirmed booking if one doesn't already exist
        if (!Transactions::where('booking_id', $booking->booking_id)->exists()) {
            Transactions::create([
                'booking_id' => $booking->booking_id,
                'booker_id' => $booking->booker_id,
                'room_id' => $booking->room_id,
                'payment_method' => $paymentMethod ?? 'unknown',
                'price_paid' => $booking->total,
                'num_days' => $booking->num_days,
                'book_date' => $booking->book_date,
                'end_date' => $booking->end_date,
            ]);
        }

        return redirect()->route('bookings.history')->with('success', 'Booking confirmed successfully!');
    }

    
}
