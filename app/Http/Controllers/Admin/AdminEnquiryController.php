<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Hostel;
use App\Models\User;
use Illuminate\Http\Request;

class AdminEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enquiries = Enquiry::with('hostel')->select('hostel_id', \DB::raw('COUNT(*) as enquiry_count'))->groupBy('hostel_id')->get();
        return view('admin.enquiry.list', compact('enquiries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'owner')->get();
        return view('admin.enquiry.add', compact('users'));
    }

    public function getHostels(Request $request)
    {
        $hostels = Hostel::where('user_id', $request->id)->get();
        // dd($hostels);
        return response()->json($hostels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hostel_id' => 'required|exists:hostels,id',
            'name' => 'required|string|max:100',
            // 'email' => 'required|email',
            'phone' => 'required|min:10|max:10',
            // 'description' => 'required',
            // 'ac' => 'required',
            // 'room_type' => 'required',
            // 'date' => 'required',
            // 'time' => 'required',
        ]);

        $enquiry = new Enquiry;
        $enquiry->create($request->all());
        
        return redirect()->back()->with('success', 'Enquiry has been Submitted Successfully!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $request->validate([
            'from_date' => 'sometimes|before_or_equal:to_date',
            'to_date' => 'sometimes|after_or_equal:from_date',
        ]);

        $hostel_name = Hostel::find($id)->hostel_name;

        $query = Enquiry::query();
        if(isset($request->from_date) && isset($request->to_date)){
            $query->where('created_at', '>=', $request->from_date)->where('created_at', '<=', $request->to_date);
        }
        $enquiries = $query->where('hostel_id', $id)->orderBy('id', 'desc')->get();
        return view('admin.enquiry.view', compact('enquiries', 'hostel_name'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enquiry = Enquiry::find($id);
        $enquiry->delete();
        return redirect()->back()->with('success', 'Enquiry has been Deleted Successfully!!');
    }
}
