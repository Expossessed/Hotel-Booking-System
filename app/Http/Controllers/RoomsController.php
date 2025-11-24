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
            'room_type' => 'required|string|max:255',
            'room_desc' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'available_rooms' => 'required|integer',
            'is_available' => 'sometimes|boolean',
        ]);

        Rooms::create([
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
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
        $request->validate([
            'room_type' => 'required|string|max:255',
            'room_desc' => 'required|string|max:255',
            'room_price' => 'required|numeric',
            'available_rooms' => 'required|integer',
            'is_available' => 'sometimes|boolean',
        ]);

        $rooms = Rooms::findOrFail($id);
        $rooms->update([
            'room_type' => $request->room_type,
            'room_desc' => $request->room_desc,
            'room_price' => $request->room_price,
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

    public function showRooms()
{
    $rooms = Rooms::all();
    return view('user.home', compact('rooms'));
}
}