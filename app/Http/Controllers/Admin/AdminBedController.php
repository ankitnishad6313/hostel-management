<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Booking;
use App\Models\Hostel;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminBedController extends Controller
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
        $rooms = Room::where('hostel_id', $id)->orderBy('floor', 'asc')->get();
        return view('admin.bed.add', compact('hostel', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hostel_id' => 'required|exists:hostels,id',
            'room_id' => 'required|exists:rooms,id',
            'bed_name' => 'required|max:50',
        ]);

        $room = Room::with('bed')->find($request->room_id);
        $room_type = $room->bed_type;
        $added_bed = $room->bed->count();

        if($room_type > $added_bed){
            $bed = new Bed;
            if($bed->create($request->all())){
                return redirect()->back()->with('success', 'Bed Added Successfully!');
            }else{
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        }else{
            return redirect()->back()->with('error', 'Beds Quantity Full in this Room!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $today = date('Y-m-d');
        $student = Booking::with('user')->where('bed_id', $id)->where('check_out_date', '>=', $today)->first();
        return view('admin.bed.view', compact('student'));      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bed = Bed::find($id);
        return view('admin.bed.edit', compact('bed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'bed_name' => 'required|max:50',
        ]);

        $bed = Bed::find($id);
        $bed->bed_name = $request->bed_name;
        if($bed->save()){
            return redirect()->back()->with('success', 'Bed Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bed = Bed::find($id);
        Booking::where('bed_id', $id)->delete();
        $bed->delete();
        return redirect()->back()->with('success', 'Bed Deleted successfully!');
    }
}
