<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'floor' => 'required|integer',
            'capacity' => 'required|integer|min:1',
            'monthly_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,full,maintenance',
        ]);

        $validated['occupied_beds'] = 0;

        Room::create($validated);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully.');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'floor' => 'required|integer',
            'capacity' => 'required|integer|min:1',
            'occupied_beds' => 'required|integer|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'status' => 'required|in:available,full,maintenance',
        ]);

        $room->update($validated);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}
