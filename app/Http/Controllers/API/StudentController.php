<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Otp;
use App\Models\Review;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    public function dashboard(Request $request)
    {
        if ($user = User::find($request->user()->id)) {
            // Fetch booking details
            $booking = Booking::select(
                'hostels.hostel_name',
                'rooms.room_name',
                'rooms.floor',
                'rooms.bed_type',
                'beds.bed_name',
                'bookings.check_in_date',
                'bookings.check_out_date',
                'bookings.rent',
                'bookings.payment',
                'bookings.due_payment',
                'bookings.security_amount',
                'bookings.booking_status',
                'bookings.boarding_status',
                'bookings.lock_in_period_date',
                'bookings.next_due_date'
            )
                ->join('hostels', 'bookings.hostel_id', '=', 'hostels.id')
                ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
                ->join('beds', 'bookings.bed_id', '=', 'beds.id')
                ->where('bookings.user_id', $request->user()->id)
                ->where('bookings.boarding_status', 'onboarding')
                ->get();

            // If no bookings found, return an empty array
            $user['booking'] = $booking->isNotEmpty() ? $booking : [];

            $responseCode = 200;
            $response = [
                'message' => "Student Details",
                'status' => 1,
                'data' => $user
            ];
        } else {
            $responseCode = 401;
            $response = [
                'message' => 'Unauthorized Request',
                'status' => 0,
            ];
        }

        return response()->json($response, $responseCode);
    }


    public function bookingHistory(Request $request)
    {
        $booking = Booking::select('hostels.hostel_name', 'rooms.room_name', 'rooms.floor', 'beds.bed_name', 'bookings.check_in_date', 'bookings.check_out_date', 'bookings.created_at as booking_date')
            ->join('hostels', 'hostels.id', '=', 'bookings.hostel_id')
            ->join('rooms', 'rooms.id', '=', 'bookings.hostel_id')
            ->join('beds', 'beds.id', '=', 'bookings.hostel_id')
            ->where('bookings.user_id', $request->user()->id)->orderBy('bookings.id', 'desc')->get();
        if ($booking) {
            $responseCode = 200;
            $response = [
                'message' => "Booking Details",
                'status' => 1,
                'data' => $booking
            ];
        } else {
            $responseCode = 401;
            $response = [
                'message' => 'No Recored Found',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function edit(Request $request)
    {
        $id = $request->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'email' => "required|email|unique:users,email,$id",
            'phone' => "required|digits:10|unique:users,phone,$id",
            'alternate_no' => "required|digits:10|unique:users,alternate_no,$id",
            'mother_name' => 'required|string|min:3|max:50',
            'mother_mobile_no' => "required|digits:10|unique:users,mother_mobile_no,$id",
            'father_name' => 'required|string|min:3|max:50',
            'father_mobile_no' => "required|digits:10|unique:users,father_mobile_no,$id",
            // 'guardian_name' => 'nullable|string|min:3|max:50',
            // 'guardian_mobile_no' => "nullable|digits:10|unique:users,guardian_mobile_no,$id",
            'dob' => 'required|date',
            'gender' => 'required|string|in:Male,Female',
            // 'blood_group' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'aadhar_front' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'aadhar_back' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'about' => 'nullable|string',
            'address' => 'required|string',
            'current_address' => 'required|string',
            'country' => 'required|string',
            'course_year' => 'nullable|string',
            'university' => 'nullable|string',
            'aadhar_no' => "required|digits:12|unique:users,aadhar_no,$id",
            // 'facebook' => 'nullable|url',
            // 'twitter' => 'nullable|url',
            // 'instagram' => 'nullable|url',
            // 'linkedin' => 'nullable|url',          
        ]);

        // [
        //     'aadhar_front.required' => 'The Aadhar front image is required.',
        //     'aadhar_front.image' => 'The Aadhar front must be an image file.',
        //     'aadhar_front.mimes' => 'The Aadhar front must be a file of type: jpeg, png, jpg.',
        //     'aadhar_front.max' => 'The Aadhar front may not be greater than :max kilobytes.',

        //     'aadhar_back.required' => 'The Aadhar back image is required.',
        //     'aadhar_back.image' => 'The Aadhar back must be an image file.',
        //     'aadhar_back.mimes' => 'The Aadhar back must be a file of type: jpeg, png, jpg.',
        //     'aadhar_back.max' => 'The Aadhar back may not be greater than :max kilobytes.',
        // ]


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = User::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->alternate_no = $request->alternate_no;
        $student->mother_name = $request->mother_name;
        $student->mother_mobile_no = $request->mother_mobile_no;
        $student->father_name = $request->father_name;
        $student->father_mobile_no = $request->father_mobile_no;
        $student->guardian_name = $request->guardian_name;
        $student->guardian_mobile_no = $request->guardian_mobile_no;
        $student->dob = $request->dob;
        $student->gender = $request->gender;
        $student->about = $request->about;
        $student->address = $request->address;
        $student->current_address = $request->current_address;
        $student->country = $request->country;
        $student->course_year = $request->course_year;
        $student->university = $request->university;
        $student->blood_group = $request->blood_group;
        $student->aadhar_no = $request->aadhar_no;
        // $student->facebook = $request->facebook;
        // $student->twitter = $request->twitter;
        // $student->instagram = $request->instagram;
        // $student->linkedin = $request->linkedin;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(1111, 9999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/student'), $imageName);
            $student->image = 'uploads/student/' . $imageName;
        }

        if ($request->hasFile('aadhar_front')) {
            $frontImage = $request->file('aadhar_front');
            $frontImageName = time() . rand(11111, 99999) . 'aadhar_front.' . $frontImage->getClientOriginalExtension();
            $frontImage->move(public_path('uploads/student'), $frontImageName);
            $student->aadhar_front = 'uploads/student/' . $frontImageName;
        }

        if ($request->hasFile('aadhar_back')) {
            $backImage = $request->file('aadhar_back');
            $backImageName = time() . rand(11111, 99999) . 'aadhar_back.' . $backImage->getClientOriginalExtension();
            $backImage->move(public_path('uploads/student'), $backImageName);
            $student->aadhar_back = 'uploads/student/' . $backImageName;
        }

        if ($student->save()) {
            $responseCode = 200;
            $response = [
                'message' => "Profile Updated Successfully!!",
                'status' => 1,
            ];
        } else {
            $responseCode = 400;
            $response = [
                'message' => "Something went wrong. Please try again later!!",
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function storeEnquiry(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'owner_id' => 'required|exists:users,id',
            'hostel_id' => 'required|exists:hostels,id',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $enq = new Enquiry;
        $enq->user_id = $request->owner_id;
        $enq->hostel_id = $request->hostel_id;

        $enq->name = $request->name ?? $user->name;
        $enq->email = $request->email ?? $user->email;
        $enq->phone = $request->phone ?? $user->phone;
        $enq->description = $request->description;
        $enq->room_type = $request->room_type;
        if ($enq->save()) {
            $responseCode = 200;
            $response = [
                'message' => "Enquiry Submitted Successfully!!",
                'status' => 1,
            ];
        } else {
            $responseCode = 400;
            $response = [
                'message' => "Something went wrong. Please try again later!!",
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function storeReview(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'hostel_id' => 'required|exists:hostels,id',
            'star' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $existingReview = Review::where('user_id', $request->user()->id)
            ->where('hostel_id', $request->hostel_id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this hostel.',
                'status' => 0,
            ], 400);
        }

        $review = new Review;
        $review->owner_id = $request->user_id;
        $review->user_id = $request->user()->id;
        $review->hostel_id = $request->hostel_id;

        $review->description = $request->description;
        $review->star = $request->star;

        if ($review->save()) {
            $data['reviews'] = Review::select('users.name', 'users.image', 'reviews.star', 'reviews.description', 'reviews.created_at')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->where('hostel_id', $request->hostel_id)
                ->orderBy('reviews.id', 'desc')
                ->get()
                ->map(function ($review) {
                    if ($review->image == NULL) {
                        $img = url("/assets/img/avatar.webp");
                    } else {
                        $img = url($review->image);
                    }
                    $review->image = $img;
                    return $review;
                });
            $responseCode = 200;
            $response = [
                'message' => "Review Submitted Successfully!!",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 400;
            $response = [
                'message' => "Something went wrong. Please try again later!!",
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
