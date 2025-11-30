<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;

class RoomsController extends Controller
{
    public function createRoomForm()
    {
        return view('admin.createRoom');
    }

    public function createRoom(Request $request)
    {
        $request->validate([
            
            'room_desc' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'image_link' => 'required|string|max:255',
            'room_type' => 'required|in:single,family,VIP',
            'room_name' => 'required|string|max:255',
            'available_rooms' => 'required|integer',
            'is_available' => 'sometimes|boolean',
            'room_image1' => 'nullable|string|max:255',
            'room_image2' => 'nullable|string|max:255',
            'room_image3' => 'nullable|string|max:255',
            'free_items' => 'nullable|array',
        ]);

        

        Rooms::create([
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
            'image_link' => $request->image_link,
            'room_type' => $request->room_type,
            'room_name' => $request->room_name,
            'available_rooms' => $request->available_rooms,
            'room_image1' => $request->room_image1,
            'room_image2' => $request->room_image2,
            'room_image3' => $request->room_image3,
            'is_available' => $request->has('is_available') ? 1 : 0,
            'free_items' => $request->free_items ?? [],
        ]);

        return redirect()->route('admin.front')->with('success', 'Room created successfully.');
    }

    public function listRooms()
    {
        $rooms = Rooms::all();
        return view('admin.front', compact('rooms'));
    }

    public function viewRoom($id)
    {

        $rooms = Rooms::findOrFail($id);
        return view('admin.viewRoom', compact('rooms'));
    }

    public function updateRoomForm($id)
    {
        $rooms = Rooms::findOrFail($id);
        return view('admin.update', compact('rooms'));
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_type' => 'required|in:single,family,VIP',
            'room_desc' => 'required|string|max:255',
            'room_name' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'image_link' => 'required|string|max:255',
            'room_images_link' => 'nullable|string|max:255',
            'available_rooms' => 'required|integer',
            'room_image1' => 'nullable|string|max:255',
            'room_image2' => 'nullable|string|max:255',
            'room_image3' => 'nullable|string|max:255',
            'is_available' => 'sometimes|boolean',
            'free_items' => 'nullable|array',
        ]);

        $rooms = Rooms::findOrFail($id);
        $rooms->update([
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
            'room_name' => $request->room_name,
            'image_link' => $request->image_link,
            'room_images_link' => $request->room_images_link,
            'available_rooms' => $request->available_rooms,
            'room_image1' => $request->room_image1,
            'room_image2' => $request->room_image2,
            'room_image3' => $request->room_image3,
            'is_available' => $request->has('is_available') ? 1 : 0,
            'free_items' => $request->free_items ?? [],
        ]);

        return redirect()->route('admin.front')->with('success', 'Room updated successfully.');
    }

    public function deleteRoom($id)
    {
        $rooms = Rooms::findOrFail($id);
        $rooms->delete();

        return redirect()->route('admin.front')->with('success', 'Room deleted successfully.');
    }

    public function showRooms(Request $request)
    {
        // Admin users should not view the user-facing listing. Send them to admin dashboard.
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('admin.front');
        }
        $query = Rooms::query();

        // Filter: only available rooms
        if ($request->query('filter') === 'available') {
            $query->where('is_available', 1);
        }

        // Sort by price
        $sort = $request->query('sort');
        if ($sort === 'price_low') {
            $query->orderBy('room_price', 'asc');
        } elseif ($sort === 'price_high') {
            $query->orderBy('room_price', 'desc');
        }

        $rooms = $query->get();

        return view('user.userhome', [
            'rooms' => $rooms,
            'currentFilter' => $request->query('filter'),
            'currentSort' => $sort,
        ]);
    }

    public function view($id)
    {
        // Eager load reviews (including the user who left each review)
        $room = Rooms::where('room_id', $id)->with(['reviews.user'])->firstOrFail();

        // compute average rating (0..5) with one decimal place
        $averageRating = $room->reviews->avg('rating') ? round($room->reviews->avg('rating'), 1) : 0;

        return view('user.viewRoom', compact('room', 'averageRating'));
    }
}
