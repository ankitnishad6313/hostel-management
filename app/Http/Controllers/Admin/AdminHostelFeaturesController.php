<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class AdminHostelFeaturesController extends Controller
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
        $features = Features::orderBy('serial', 'asc')->get();
        return view('admin.hostel.features', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $feature = new Features;
        $feature->create(['features' => $request->feature, 'serial' => $request->serial]);
        return redirect()->back()->with('success', 'Feature added successfully!');

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
        $request->validate([
            "edit_serial" => "required|unique:features,serial,$id",
            "edit_feature" => "required",
        ]);

        $feature = Features::find($id);
        $feature->features = $request->edit_feature;
        $feature->serial = $request->edit_serial;
        if($feature->save()){
            return redirect()->back()->with('success', 'Feature updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong!');
        }
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = Features::find($id);
        $feature->delete();
        return redirect()->back()->with('success', 'Feature deleted successfully!');

    }
}
