<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;

class OwnerRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $hostel = Hostel::with('user')->find($id);
        return view('owner.room.add', compact('hostel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'user_id' => 'required|exists:users,id',
            'floor' => 'required',
            'bed_type' => 'required',
            'room_name' => 'required',
            'room_price' => 'required',
        ]);

        // dd($request->all());

        $room = new Room;
        $room->hostel_id = $request->hostel_id;
        $room->user_id = $request->user_id;
        $room->floor = $request->floor;
        $room->bed_type = $request->bed_type;
        $room->room_name = $request->room_name;
        $room->room_price = $request->room_price;
        if($room->save()){
            return redirect()->back()->with('success', 'Room Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::with('user', 'hostel')->find($id);
        // dd($room);
        return view('owner.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'user_id' => 'required|exists:users,id',
            'floor' => 'required',
            'bed_type' => 'required',
            'room_name' => 'required',
            'room_price' => 'required',
        ]);

        // dd($request->all());

        $room = Room::find($id);
        $room->hostel_id = $request->hostel_id;
        $room->user_id = $request->user_id;
        $room->floor = $request->floor;
        $room->bed_type = $request->bed_type;
        $room->room_name = $request->room_name;
        $room->room_price = $request->room_price;
        if($room->save()){
            return redirect()->back()->with('success', 'Room Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}