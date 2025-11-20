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
            'price_per_night' => 'required|numeric',
            'avavailable_rooms' => 'required|integer',
            'is_available' => 'required|boolean',
        ]);

        Rooms::create([
            'room_type' => $request->room_type,
            'price_per_night' => $request->price_per_night,
            'available_rooms' => $request->available_rooms,
            'is_available' => $request->is_available,
        ]);

        return redirect()->route('rooms.hotelfront')->with('success', 'Room created successfully.');
    }

    public function listRooms()
    {
        $rooms = Rooms::all();
        return view('rooms.hotelfront', compact('rooms'));
    }
}