<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewsController extends Controller
{
   public function showReviewForm(Request $request)
   {
       $roomId = $request->query('room_id');
       $roomName = $request->query('room_name');

       return view('Reviews.createReview', ['room_id' => $roomId, 'room_name' => $roomName]);
   }
    
   public function storeReview(Request $request)
   {

       $ratingRules = 'required|integer|min:1|max:5';

       $validatedData = $request->validate([
           'rating' => $ratingRules,
           'comment' => 'nullable|string',
       ]);

       $roomId = $request->input('room_id');
       $roomName = $request->input('room_name');

       if (!$roomId && $roomName) {

           $room = \App\Models\Rooms::whereRaw('lower(room_name) = ?', [strtolower($roomName)])->first();
           if (!$room) {
               return $request->wantsJson() ? response()->json(['success' => false, 'message' => 'No room found with that name.'], 422)
                                           : redirect()->back()->withErrors(['room_name' => 'No room found with that name.']);
           }
           $roomId = $room->room_id;
       }

       if (!$roomId) {
           return $request->wantsJson() ? response()->json(['success' => false, 'message' => 'room_id or room_name is required.'], 422)
                                       : redirect()->back()->withErrors(['room_id' => 'room_id or room_name is required.']);
       }

       $exists = \App\Models\Rooms::where('room_id', $roomId)->exists();
       if (!$exists) {
           return $request->wantsJson() ? response()->json(['success' => false, 'message' => 'Room not found.'], 404)
                                       : redirect()->back()->withErrors(['room_id' => 'Room not found.']);
       }

       $review = new Reviews();
       $review->room_id = $roomId;
       $review->user_id = $request->user()->id;
    $review->rating = $validatedData['rating'];
    $review->comment = $validatedData['comment'] ?? null;
       $review->save();

       if ($request->wantsJson() || $request->expectsJson() || $request->ajax()) {
           $review->load('user');
           return response()->json([
               'success' => true,
               'message' => 'Review submitted successfully.',
               'review' => $review,
           ], 201);
       }

    return redirect()->route('rooms.view', ['id' => $roomId])
               ->with('success', 'Review submitted successfully.');
   }

   public function view(Request $request, $room_identifier = null)
   {

       $roomName = $request->query('room_name');
       $identifier = $room_identifier ?? $roomName;

    if ($identifier) {
           $room = \App\Models\Rooms::whereRaw('lower(room_name) = ?', [strtolower($identifier)])->first();
           if ($room) {
               $reviews = Reviews::where('room_id', $room->room_id)->with('user')->get();
               $room_id = $room->room_id;
               $room_name = $room->room_name;
           } elseif (is_numeric($identifier)) {
               $reviews = Reviews::where('room_id', intval($identifier))->with('user')->get();
               $room_id = intval($identifier);
               $room_name = null;
           } else {
               $reviews = collect();
               $room_id = null;
               $room_name = $identifier;
           }
       } else {
           $reviews = Reviews::with('user')->get();
           $room_id = null;
           $room_name = null;
       }

       return view('Reviews.viewReviews', ['reviews' => $reviews, 'room_id' => $room_id, 'room_name' => $room_name]);
   }

   public function viewReviews($id)
    {

        $reviews = Reviews::all()->where('room_id', $id);
        return view('admin.viewReviews', compact('reviews'));
    }

}
