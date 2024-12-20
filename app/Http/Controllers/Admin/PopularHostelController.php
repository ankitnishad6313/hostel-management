<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\PopularHostel;
use App\Models\User;
use Illuminate\Http\Request;

class PopularHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['owners'] = User::where('role', 'owner')->orWhere('role', 'admin')->get();
        $data['hostels'] = PopularHostel::with('user', 'hostel')->get();
        // dd($data);
        return view('admin.popularhostel.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function getHostel(Request $request)
    {
        $hostels = Hostel::where('user_id', $request->id)->get();
        return response()->json($hostels);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hostel_id' => 'required|unique:popular_hostels,hostel_id|exists:hostels,id',
        ]);

        $add = new PopularHostel;
        $add->create([
            'user_id' => $request->user_id,
            'hostel_id' => $request->hostel_id,
        ]);

        return redirect()->back()->with('success', 'Added successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $status = PopularHostel::find($id);
        $status->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status Changed Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = PopularHostel::find($id);
        $status->delete();
        return redirect()->back()->with('success', 'Deleted Successfully!');
    }
}
