<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Fee, Hostel};
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $hostels = Hostel::where('user_id', auth()->user()->id)->where('hostel_membership', '!=', 'FREE')->get();
        return view('owner.fee.add', compact('hostels'));
    }
    public function getBooking(Request $request)
    {   
        $bookings = Booking::select('users.name', 'users.id')->join('users', 'bookings.user_id', 'users.id')->
        where('owner_id', auth()->user()->id)->where('hostel_id', $request->id)->where('boarding_status', '!=', 'checked_out')->get();
        return response()->json($bookings);
    }
    public function getStudentData(Request $request)
    {   
        
        $studentdata = Booking::select('users.name', 'users.father_name', 'users.mother_name', 'users.email', 'users.phone', 'bookings.*')
        ->join('users', 'bookings.user_id', 'users.id')
        ->where('user_id', $request->id)->where('boarding_status', '!=', 'checked_out')->first();
        return response()->json($studentdata);
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
    public function store(Request $request)
    {
        $fee = new Fee;
        $fee->user_id = $request->student_id;
        $fee->hostel_id = $request->student_id;
        $fee->amount = $request->payment;
        $fee->due_amount = $request->due_amount;
        $fee->payment_mode = $request->payment_mode;
        if($fee->save()){
            return redirect()->back()->with('success', 'Fee Submitted Successfully!!');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong!!');
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
        //
    }
}
