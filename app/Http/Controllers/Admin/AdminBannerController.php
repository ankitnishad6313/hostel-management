<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\City;
use Illuminate\Http\Request;

class AdminBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.list', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.banner.add', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'link' => 'sometimes',
            'image' => 'required|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        // dd($request->all());

        $banner = new Banner;
        $banner->city = ($request->city == "custom") ? $request->custom_city : $request->city;
        $banner->link = $request->link;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = substr(explode(" ", microtime())[0], 2) . uniqid() . $image->getClientOriginalExtension();
            $banner->banner = "uploads/banner/" . $imageName;
            $image->move(public_path("uploads/banner"), $imageName);
        }
        if($banner->save()){
            return redirect()->route('admin-list-banner')->with('success', 'Banner Added Successfully');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong');
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
        $banner = Banner::find($id);
        $cities = City::all();
        return view('admin.banner.edit', compact('banner', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'city' => 'required|string',
            'link' => 'sometimes',
            'image' => 'sometimes|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        // dd($request->all());

        $banner = Banner::find($id);
        $banner->city = ($request->city == "custom") ? $request->custom_city : $request->city;;
        $banner->link = $request->link;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . $image->getClientOriginalName();
            $banner->banner = "uploads/banner/" . $imageName;
            $image->move(public_path("uploads/banner"), $imageName);
        }
        if($banner->save()){
            return redirect()->route('admin-list-banner')->with('success', 'Banner Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->back()->with('success', 'Banner Deleted Successfully!!');
    }
}
