<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Hostel;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'user_id' => 'required|exists:users,id',
            'hostel_id' => 'required|exists:hostels,id',
        ]);

        // dd($request->all());
        $package = Package::find($request->package_id);
        $assign = new Assignment;
        $assign->package_id = $request->package_id;
        $assign->user_id = $request->user_id;
        $assign->hostel_id = $request->hostel_id;
        $assign->start_date = Carbon::now();
        $assign->end_date = Carbon::now()->addDays($package->validity);
        if ($assign->save()) {
            $hostel = Hostel::find($request->hostel_id);
            $hostel->package_id = $package->id;
            $hostel->hostel_membership = $package->package;
            $hostel->save();
            return redirect()->back()->with('success', 'Package Assigned successfully!');
        } else {
            return redirect()->back()->with('error', 'Package not Assigned!');
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
