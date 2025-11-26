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
            'room_name' => 'required|string|max:255|unique:rooms,room_name',
            'room_type' => 'required|in:solo,family,deluxe_vip',
            'room_desc' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'image_link' => 'required|string|max:255',
            'available_rooms' => 'required|integer|min:0',
            'is_available' => 'sometimes|boolean',
        ]);

        Rooms::create([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
            'image_link' => $request->image_link,
            'available_rooms' => $request->available_rooms,
            'is_available' => $request->has('is_available') ? 1 : 0,
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
        $rooms = Rooms::findOrFail($id);

        $request->validate([
            'room_name' => 'required|string|max:255|unique:rooms,room_name,' . $rooms->room_id . ',room_id',
            'room_type' => 'required|in:solo,family,deluxe_vip',
            'room_desc' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'image_link' => 'required|string|max:255',
            'available_rooms' => 'required|integer|min:0',
            'is_available' => 'sometimes|boolean',
        ]);

        $rooms->update([
            'room_name' => $request->room_name,
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
            'image_link' => $request->image_link,
            'available_rooms' => $request->available_rooms,
            'is_available' => $request->has('is_available') ? 1 : 0,
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

        return view('user.home', [
            'rooms' => $rooms,
            'currentFilter' => $request->query('filter'),
            'currentSort' => $sort,
        ]);
    }

    public function view($id)
    {
        $room = Rooms::where('room_id', $id)->firstOrFail();
        return view('user.viewRoom', compact('room'));
    }
}
