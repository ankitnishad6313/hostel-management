<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OwnerReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('hostel')->select('hostel_id', \DB::raw('COUNT(*) as review_count'))->where('owner_id', Auth::user()->id)->groupBy('hostel_id')->get();

        // dd($reviews);
        return view('owner.review.list', compact('reviews'));
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
    public function show(string $id)
    {
        $reviews = Review::with('user', 'hostel')->where('owner_id', Auth::user()->id)->where('hostel_id', $id)->get();
        return view('owner.review.view', compact('reviews'));
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
            ['id' => 'required|exists:reviews,id'],
            [
                'id.required' => 'ID is required', 
                'id.exists' => 'ID does not exist',
            ]
        );
        

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        Review::find($id)->deleteOrFail();
        return redirect()->back()->with('success', 'Review has been Deleted Successfully!!');
    }
}
