<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class TransactionsController extends Controller
{
    public function viewTransactions()
    {
        $transactions = Transactions::all();
        return view('admin.viewTransactions', compact('transactions'));
    }

    public function transactionHistory()
    {
        $transactions = Transactions::all();
        return view('admin.transactionHistory', compact('transactions'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'booker_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,room_id',
            'price_paid' => 'required|integer',
            'book_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:book_date',
        ]);

        Transactions::create($request->all());

        return redirect()->back()->with('success', 'Transaction created successfully!');
    }

    public function updateTransaction(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);

        $transaction->updateTransaction($request->all());

        return redirect()->back()->with('success', 'Transaction updated!');
    }

    public function deleteTransaction($id)
    {
        Transactions::destroy($id);

        return redirect()->back()->with('success', 'Transaction deleted!');
    }

    public function viewPending(Request $request)
    {
        $transactions = Transactions::all();
        $booking = Booking::all()->where('booker_id', $request->user()->id);
        
        
        return view('user.pendingReservation', [
            'bookings' => $booking,
            'transactions' => $transactions,
        ]);
    }

    public function payPending(Request $request)
    {
        $transactions = Transactions::all()->where('booker_id', $request->user()->id);
        $total = $transactions->booker->total;
        $payment = $total - $transactions->booker->user->balance;
    }
    
}
