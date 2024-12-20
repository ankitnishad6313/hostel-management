<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\{User, Hostel, City, Bed, Booking, Features, Fee, PopularHostel, Review, Enquiry};
class OwnerHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hostels = Hostel::with('user')->where('user_id', Auth::user()->id)->get();
        return view('owner.hostel.list', compact('hostels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cities'] = City::all();
        $data['features'] = Features::orderBy('serial', 'asc')->get();
        return view('owner.hostel.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required|max:100',
            'property_type' => 'required',
            'gender_type' => 'required',
            'hostel_images.*' => 'required|image',
            'city' => 'required',
            'hostel_address' => 'required',
            // 'hostel_features' => 'required',
            // 'youtube_video_link' => 'required',
            // 'hostel_policy' => 'required',
            // 'hostel_description' => 'required',
        ]);

        $hostel = new Hostel;
        $hostel->user_id = Auth::user()->id;
        $hostel->hostel_name = $request->hostel_name;
        $hostel->lock_in_period = $request->lock_in_period;
        $hostel->property_type = $request->property_type;
        $hostel->gender_type = $request->gender_type;
        $hostel->city = $request->city;
        $hostel->hostel_address = $request->hostel_address;
        $hostel->hostel_features = $request->hostel_features;
        $hostel->youtube_video_link = $request->youtube_video_link;
        $hostel->hostel_policy = $request->hostel_policy;
        $hostel->hostel_description = $request->hostel_description;
        $hostel->hospitals = $request->hospitals;
        $hostel->coachings = $request->coachings;
        $hostel->shopping_malls = $request->shopping_malls;
        $hostel->restaurants = $request->restaurants;
        if ($request->hasFile('hostel_images')) {
            foreach ($request->file('hostel_images') as $image) {
                $imageName = time() . "_" . rand(1, 10000) . $image->getClientOriginalName();
                $upload_path = "uploads/hostel_image/";
                $image->move(public_path("uploads/hostel_image/"), $imageName);
                $image_url = $upload_path . $imageName;
                $images[] = $image_url;
            }
            $hostel->hostel_images = $images;
        }

        if($hostel->save()){
            assignFreePackagetoHostel($hostel->id);
            return redirect()->route('owner-list-hostel')->with('success', 'Hostel Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['hostel'] = Hostel::with('user','room','bed')->find($id);
        $data['bed'] = Bed::where('hostel_id', $id)->with('room')->get();
        $data['booking'] = Booking::with('user')->where('hostel_id', $id)->where('check_out_date', ">=", now())->get();
        // dd($data);
        return view('owner.hostel.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['hostel'] = Hostel::find($id);
        $data['users'] = User::where('role', 'owner')->orWhere('role', 'owner')->get();
        $data['cities'] = City::all();
        $data['features'] = Features::orderBy('serial', 'asc')->get();
        return view('owner.hostel.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'hostel_name' => 'required|max:100',
            'property_type' => 'required',
            'gender_type' => 'required',
            'hostel_images.*' => 'nullable|image',
            'city' => 'required',
            'hostel_address' => 'required',
            'lock_in_period' => 'required|in:1,2,3',
            // 'hostel_features' => 'required',
            // 'youtube_video_link' => 'required',
            // 'hostel_policy' => 'required',
            // 'hostel_description' => 'required',
        ]);

        $hostel = Hostel::find($id);
        $hostel_images = Hostel::find($id)->hostel_images;
        $hostel->hostel_name = $request->hostel_name;
        $hostel->lock_in_period = $request->lock_in_period;
        $hostel->property_type = $request->property_type;
        $hostel->gender_type = $request->gender_type;
        $hostel->city = $request->city;
        $hostel->hostel_address = $request->hostel_address;
        $hostel->hostel_features = $request->hostel_features;
        $hostel->youtube_video_link = $request->youtube_video_link;
        $hostel->hostel_policy = $request->hostel_policy;
        $hostel->hostel_description = $request->hostel_description;
        $hostel->hospitals = $request->hospitals;
        $hostel->coachings = $request->coachings;
        $hostel->shopping_malls = $request->shopping_malls;
        $hostel->restaurants = $request->restaurants;
        if ($request->hasFile('hostel_images')) {
            foreach ($request->file('hostel_images') as $image) {
                $imageName = time() . "_" . rand(1, 10000) . "." . $image->getClientOriginalExtension();
                $image->move(public_path("uploads/hostel_image/"), $imageName);
                $images[] = $imageName;
            }
            if ($hostel_images != null) {
                $old_img_arr = removeImagePathFromArray($hostel_images);
                foreach ($images as $image) {
                    array_push($old_img_arr, $image);
                }
                $hostel->hostel_images = $old_img_arr;
            }else{
                $hostel->hostel_images = $images;
            }
        }

        if($hostel->save()){
            return redirect()->route('owner-list-hostel')->with('success', 'Hostel Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hostel = Hostel::find($id);
        Booking::where('hostel_id', $id)->delete();
        Enquiry::where('hostel_id', $id)->delete();
        Review::where('hostel_id', $id)->delete();
        Fee::where('hostel_id', $id)->delete();
        PopularHostel::where('hostel_id', $id)->delete();
        $hostel->delete();
        return redirect()->back()->with('success', 'Hostel Deleted successfully!');
    }

    public function deleteImage(Request $request, $id)
    {
        deleteHostelImage($id, $request->key, $request->image);
        return redirect()->back()->with('success', 'Image Deleted successfully!');
    }
}

