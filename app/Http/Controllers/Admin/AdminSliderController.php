<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Sliders::all();
        return view('admin.slider.list', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'slider_image' => 'required|image'
        ]);

        $slider = new Sliders;
        $slider->link = $request->link;
        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $imageName);
            $slider->slider_image = 'uploads/sliders/' . $imageName;
        }
        if($slider->save()){
            return redirect()->route('admin-list-slider')->with('Slider Added Successfully!!');
        }else{
            return redirect()->back()->with('Something went Wrong!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $slider = Sliders::find($id);
        return view('admin.slider.view', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Sliders::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'link' => 'required',
            'slider_image' => 'sometimes|image'
        ]);

        $slider = Sliders::find($id);
        $slider->link = $request->link;
        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/sliders'), $imageName);
            $slider->slider_image = 'uploads/sliders/' . $imageName;
        }
        if($slider->save()){
            return redirect()->route('admin-list-slider')->with('Slider Updated Successfully!!');
        }else{
            return redirect()->back()->with('Something went Wrong!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Sliders::find($id);
        $slider->delete();
        return redirect()->back()->with("success", "Slider Deleted Successfully");
    }
}
