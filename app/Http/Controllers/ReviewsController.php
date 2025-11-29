<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;

class ReviewsController extends Controller
{
   public function showReviewForm(Request $request)
   {
       $roomId = $request->query('room_id');
       return view('Reviews.createReview', ['room_id' => $roomId]);
   }
    
   public function storeReview(Request $request)
   {
       $validatedData = $request->validate([
           'room_id' => 'required|integer|exists:rooms,room_id',
           'rating' => 'required|integer|min:1|max:5',
           'comment' => 'nullable|string',
       ]);

       $review = new Reviews();
       $review->room_id = $validatedData['room_id'];
       $review->user_id = $request->user()->id;
       $review->rating = $validatedData['rating'];
       $review->comment = $validatedData['comment'] ?? null;
       $review->save();

       return redirect()->route('rooms.view', ['id' => $validatedData['room_id']])
                        ->with('success', 'Review submitted successfully.');
   }

   public function view(Request $request, $room_id = null)
   {
       if ($room_id) {
           $reviews = Reviews::where('room_id', $room_id)->with('user')->get();
       } else {
           $reviews = Reviews::with('user')->get();
       }

       return view('Reviews.listReviews', ['reviews' => $reviews]);
   }



}
