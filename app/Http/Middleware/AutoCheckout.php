<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class AutoCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Only run for authenticated users
        if ($request->user()) {
            $userId = $request->user()->id;

            // Get today's date in Asia/Manila timezone
            $today = Carbon::today('Asia/Manila');

            // Automatically mark bookings as completed (checked out) when end_date is on or before today.
            // Include all statuses: pending, confirmed, null, or any other status
            // -- TEMPORARY DEBUG: log matching bookings before and after update
            try {
                $matchesBefore = Booking::where('booker_id', $userId)
                    ->whereDate('end_date', '<=', $today->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled'])
                    ->get(['booking_id','end_date','status'])
                    ->toArray();

                if (!empty($matchesBefore)) {
                    \Illuminate\Support\Facades\Log::info('[AutoCheckout] matchesBefore for user '.$userId.' : ' . json_encode($matchesBefore));
                } else {
                    \Illuminate\Support\Facades\Log::info('[AutoCheckout] no matchesBefore for user '.$userId.' (today='.$today->toDateString().')');
                }

                Booking::where('booker_id', $userId)
                    ->whereDate('end_date', '<=', $today->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled'])
                    ->update(['status' => 'completed']);

                $matchesAfter = Booking::where('booker_id', $userId)
                    ->whereDate('end_date', '<=', $today->toDateString())
                    ->whereNotIn('status', ['completed', 'cancelled'])
                    ->get(['booking_id','end_date','status'])
                    ->toArray();

                if (!empty($matchesAfter)) {
                    \Illuminate\Support\Facades\Log::warning('[AutoCheckout] matchesAfter (still unmatched) for user '.$userId.' : ' . json_encode($matchesAfter));
                } else {
                    \Illuminate\Support\Facades\Log::info('[AutoCheckout] matchesAfter none for user '.$userId.'');
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('[AutoCheckout] exception: '.$e->getMessage());
            }
        }

        return $next($request);
    }
}
