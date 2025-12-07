<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CashInController extends Controller
{
    /**
     * Show the cash-in page
     */
    public function show()
    {
        return view('user.cashIn', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Process cash-in request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:999999.99',
            'payment_method' => 'required|in:card,paypal,gcash',
        ]);

        $user = $request->user();
        $amount = (float) $validated['amount'];
        $method = $validated['payment_method'];

        // In a real application, you would integrate with a payment gateway here
        // For now, we'll just add the amount to the user's balance
        $user->balance += $amount;
        $user->save();

        return redirect()->back()->with('success', "Successfully added \${$amount} to your account via {$method}!");
    }

    /**
     * Get user balance (for AJAX calls if needed)
     */
    public function getBalance()
    {
        $user = Auth::user();
        return response()->json([
            'balance' => $user->balance ?? 0,
            'formatted_balance' => '$' . number_format($user->balance ?? 0, 2),
        ]);
    }
}
