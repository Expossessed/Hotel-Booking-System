<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;

class RoomsController extends Controller
{

    public function createRoomForm()
    {
        return view('rooms.create');
    }

    public function createRoom(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'room_desc' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'avavailable_rooms' => 'required|integer',
            'is_available' => 'required|boolean',
        ]);

        Rooms::create([
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'price_per_night' => $request->price_per_night,
            'available_rooms' => $request->available_rooms,
            'is_available' => $request->is_available,
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
        $room = Rooms::findOrFail($id);
        return view('admin.view', compact('room'));
    }

    public function updateRoomForm($id)
    {
        $room = Rooms::findOrFail($id);
        return view('admin.update', compact('room'));
    }

    public function updateRoom(Request $request, $id)
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'room_desc' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'available_rooms' => 'required|integer',
            'is_available' => 'required|boolean',
        ]);

        $room = Rooms::findOrFail($id);
        $room->update([
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'price_per_night' => $request->price_per_night,
            'available_rooms' => $request->available_rooms,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('admin.front')->with('success', 'Room updated successfully.');
    }

    public function deleteRoom($id)
    {
        $room = Rooms::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.front')->with('success', 'Room deleted successfully.');
    }
    public function showRooms()
    {
        $rooms = Rooms::all();
        return view('user.home', compact('rooms'));
    }

    public function view($id)
    {
        $room = Rooms::where('room_id', $id)->firstOrFail();
        return view('user.viewRoom', compact('room'));
    }
}