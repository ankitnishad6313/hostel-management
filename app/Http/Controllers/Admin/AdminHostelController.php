<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Booking;
use App\Models\City;
use App\Models\Enquiry;
use App\Models\Features;
use App\Models\Fee;
use App\Models\Hostel;
use App\Models\PopularHostel;
use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use File;
use Illuminate\Http\Request;

class AdminHostelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Hostel::query();

        if (isset($request->address) && ($request->address !=null)){
            $query->where('hostel_address', 'LIKE', "%$request->address%");
        }

        if (isset($request->city) && ($request->city !=null)){
            $query->where('city', 'LIKE', "%$request->city%");
        }

        if (isset($request->property_type) && ($request->property_type != "on")){
            $query->where('property_type', $request->property_type);
        }

        if (isset($request->gender_type) && ($request->gender_type != "on")){
            $query->where('gender_type', $request->gender_type);
        }

        $hostels = $query->with('user')->get();
        $cities = City::all();
        return view('admin.hostel.list', compact('hostels', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['users'] = User::where('role', 'owner')->get();
        $data['cities'] = City::all();
        $data['features'] = Features::orderBy('serial', 'asc')->get();
        return view('admin.hostel.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'hostel_name' => 'required|max:100',
            'property_type' => 'required',
            'gender_type' => 'required',
            'hostel_status' => 'required|in:active,inactive',
            'isVerified' => 'required|bool',
            'hostel_images.*' => 'required|image',
            'city' => 'required',
            'hostel_address' => 'required',
            'single_bed_rent' => 'required',
            'double_bed_rent' => 'required',
            'triple_bed_rent' => 'required',
            // 'hostel_description' => 'required',
        ]);

        $hostel = new Hostel;
        $hostel->user_id = $request->user_id;
        $hostel->hostel_name = $request->hostel_name;
        $hostel->property_type = $request->property_type;
        $hostel->gender_type = $request->gender_type;
        $hostel->hostel_status = $request->hostel_status;
        $hostel->isVerified = $request->isVerified;
        $hostel->city = $request->city;
        $hostel->hostel_address = $request->hostel_address;
        $hostel->single_bed_rent = $request->single_bed_rent;
        $hostel->double_bed_rent = $request->double_bed_rent;
        $hostel->triple_bed_rent = $request->triple_bed_rent;
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
                $imageName = time() . "_" . rand(1, 10000) . $image->getClientOriginalExtension();
                $image->move(public_path("uploads/hostel_image/"), $imageName);
                $images[] = $imageName;
            }
            $hostel->hostel_images = $images;
        }

        if ($hostel->save()) {
            assignFreePackagetoHostel($hostel->id);
            return redirect()->route('admin-list-hostel')->with('success', 'Hostel Added Successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['hostel'] = Hostel::with('user', 'room', 'bed')->find($id);
        $data['bed'] = Bed::with('room')->where('hostel_id', $id)->get();
        
        $data['booking'] = User::join('bookings', 'users.id', '=', 'bookings.user_id')
            ->join('hostels', 'bookings.hostel_id', '=', 'hostels.id')
            ->join('beds', 'bookings.bed_id', '=', 'beds.id')
            ->whereIn('bookings.boarding_status', ['pending', 'onboarding'])
            ->where('users.role', 'student')
            ->where('bookings.hostel_id', $id)
            ->select('users.*', 'hostels.hostel_name', 'bookings.*')
            ->get();
        return view('admin.hostel.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['hostel'] = Hostel::find($id);
        $data['users'] = User::where('role', 'owner')->orWhere('role', 'admin')->get();
        $data['cities'] = City::all();
        $data['features'] = Features::orderBy('serial', 'asc')->get();
        // dd($data['hostel']);
        return view('admin.hostel.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'hostel_name' => 'required|max:100',
            'property_type' => 'required',
            'gender_type' => 'required',
            'hostel_status' => 'required|in:active,inactive',
            'isVerified' => 'required|bool',
            'hostel_images.*' => 'nullable|image',
            'city' => 'required',
            'hostel_address' => 'required',
            'single_bed_rent' => 'required',
            'double_bed_rent' => 'required',
            'triple_bed_rent' => 'required',
            // 'hostel_description' => 'required',
        ]);

        $hostel = Hostel::find($id);
        $hostel_images = Hostel::find($id)->hostel_images;
        $hostel->user_id = $request->user_id;
        $hostel->hostel_name = $request->hostel_name;
        $hostel->property_type = $request->property_type;
        $hostel->gender_type = $request->gender_type;
        $hostel->hostel_status = $request->hostel_status;
        $hostel->isVerified = $request->isVerified;
        $hostel->city = $request->city;
        $hostel->hostel_address = $request->hostel_address;
        $hostel->single_bed_rent = $request->single_bed_rent;
        $hostel->double_bed_rent = $request->double_bed_rent;
        $hostel->triple_bed_rent = $request->triple_bed_rent;
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
            } else {
                $hostel->hostel_images = $images;
            }
        }

        if ($hostel->save()) {
            return redirect()->route('admin-list-hostel')->with('success', 'Hostel Updated Successfully!');
        } else {
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
        Room::where('hostel_id', $id)->delete();
        Bed::where('hostel_id', $id)->delete();
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
