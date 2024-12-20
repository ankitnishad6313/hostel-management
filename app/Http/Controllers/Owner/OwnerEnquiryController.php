<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Hostel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OwnerEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enquiries = Enquiry::with('hostel')->select('hostel_id', \DB::raw('COUNT(*) as enquiry_count'))->where('user_id', Auth::user()->id)->groupBy('hostel_id')->get();
        return view('owner.enquiry.list', compact('enquiries'));
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
        //    
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
        return view('owner.enquiry.view', compact('enquiries', 'hostel_name'));
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
        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|exists:enquiries,id'],
            [
                'id.required' => 'ID is required', 
                'id.exists' => 'ID does not exist',
            ]
        );
        

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        Enquiry::find($id)->deleteOrFail();
        return redirect()->back()->with('success', 'Enquiry has been Deleted Successfully!!');
    }
}
