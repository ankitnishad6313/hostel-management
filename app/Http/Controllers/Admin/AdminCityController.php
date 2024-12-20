<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AdminCityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = City::all();
        return view('admin.city.list', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.add');
    }

    /**
     * Store a newly created resource in storage.
     */

    
    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $city = new City;
        $city->create([
            'city' => ucwords($request->city),
            'image' => $this->uploadImage($request)
        ]);

        return redirect()->route('admin-list-city')->with('success', 'City added successfully!');
    }

    private function uploadImage(Request $request, $id = null)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/city'), $imageName);
            return 'uploads/admin/city/' . $imageName;
        }
        $url = url('/')."/";
        $image = City::find($id)->image;
        return str_replace($url,"",$image);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.city.view');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'city' => 'required|string|max:100',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'required'
        ]);

        $city = City::find($id);
        $city->update([
            'city' => ucwords($request->city),
            'image' => $this->uploadImage($request, $id),
            'status' => $request->status
        ]);

        return redirect()->route('admin-list-city')->with('success', 'City Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $city = City::find($id);
        if ($city->image) {
            $url = url('/')."/";
            $image = $city->image;
            $picturePath = str_replace($url,"",$image);

            if (File::exists($picturePath)) {
                File::delete($picturePath);
            }
            $city->delete();
        }
        
        return redirect()->back()->with('success', 'City Deleted successfully!');

    }
}
