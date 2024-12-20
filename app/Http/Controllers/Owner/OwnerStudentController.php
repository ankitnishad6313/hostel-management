<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Bed, Document, Hostel, Room, User};
use App\Models\Fee;
use DB;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class OwnerStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owner_id = auth()->user()->id;
        $bookings = Booking::select('hostel_id', 'boarding_status', DB::raw('COUNT(*) as booking_count'))
            ->where('owner_id', $owner_id)
            ->groupBy('hostel_id', 'boarding_status')
            ->get();

        $bookingsGrouped = $bookings->groupBy('hostel_id')->map(function ($group) {
            return $group->pluck('booking_count', 'boarding_status');
        });

        return view('owner.student.hostel-list', compact('bookingsGrouped'));
    }
    public function cancel($id)
    {
        $students = Booking::with('hostel', 'room', 'bed')
            ->where('owner_id', auth()->user()->id)
            ->where('booking_status', "cancel")
            ->where('hostel_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('owner.student.cancelled-bookings', compact('students'));
    }
    public function onboarding($id)
    {
        $students = Booking::with('hostel', 'room', 'bed')
            ->where('owner_id', auth()->user()->id)
            ->where('boarding_status', "onboarding")
            ->where('hostel_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('owner.student.list', compact('students'));
    }
    public function pending($id)
    {
        $students = Booking::with('hostel', 'room', 'bed')
            ->where('owner_id', auth()->user()->id)
            ->where('boarding_status', "pending")
            ->where('hostel_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('owner.student.pending-students', compact('students'));
    }
    public function history($id)
    {
        $students = Booking::with('hostel', 'room', 'bed')
            ->where('owner_id', auth()->user()->id)
            ->where('boarding_status', "checked_out")
            ->where('hostel_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view('owner.student.history', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hostels = Hostel::with('user')->where('user_id', Auth::user()->id)->get();
        return view('owner.student.add', compact('hostels'));
    }

    public function getRoom(Request $request)
    {
        $rooms = Room::select('rooms.*', 'hostels.security_amount', 'hostels.lock_in_period')
        ->join('hostels', 'rooms.hostel_id', '=', 'hostels.id')
        ->where('rooms.hostel_id', $request->id)->where('rooms.room_status', 'available')->get();
        return response()->json($rooms);
    }
    public function getBed(Request $request)
    {
        $beds = Bed::select('beds.*', 'rooms.room_price')
        ->join('rooms', 'beds.room_id', '=', 'rooms.id')
        ->where('beds.room_id', $request->id)->where('beds.bed_status', 'available')->get();return response()->json($beds);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'phone' => 'required|digits:10|unique:users,phone',
            'email' => 'required|email|max:100|unique:users,email',
            'gender' => 'required|in:Male,Female',
            'father_mobile_no' => 'required|digits:10|unique:users,father_mobile_no',
            'mother_mobile_no' => 'nullable|digits:10|unique:users,mother_mobile_no',
            'alternate_no' => 'nullable|digits:10|unique:users,alternate_no',
            'status' => 'required',
            'dob' => 'required',
            'address' => 'required|max:150',
            'current_address' => 'required|max:150',
            'country' => 'required|max:50',
            'aadhar_no' => 'required|digits:12|unique:users,aadhar_no',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'aadhar_front' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'aadhar_back' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'payment' => 'required',
            'payment_mode' => 'required',
            'hostel_id' => 'required|exists:hostels,id',
            'room_id' => 'required|exists:rooms,id',
            'bed_id' => 'required|exists:beds,id',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make(123456);
        $user->dob = $request->dob;
        $user->status = $request->status;
        $user->father_mobile_no = $request->father_mobile_no;
        $user->mother_mobile_no = $request->mother_mobile_no;
        $user->alternate_no = $request->alternate_no;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->current_address = $request->current_address;
        $user->country = $request->country;
        $user->aadhar_no = $request->aadhar_no;
        $user->image = $this->uploadImage($request, 'image', 'uploads/student/');
        $user->aadhar_front = $this->uploadImage($request, 'aadhar_front', 'uploads/student/');
        $user->aadhar_back = $this->uploadImage($request, 'aadhar_back', 'uploads/student/');
        $user->role = "student";
        $user->added_by = auth()->user()->id;

        if ($user->save()) {
            $room = Room::with('bed')->find($request->room_id);
            $booking = new Booking;
            $rendom_id = uniqid();
            $booking->order_id = $rendom_id;
            $booking->transaction_id = $rendom_id;
            $booking->user_id = $user->id;
            $booking->owner_id = Hostel::find($request->hostel_id)->user_id;
            $booking->hostel_id = $request->hostel_id;
            $booking->room_id = $request->room_id;
            $booking->bed_id = $request->bed_id;
            $booking->check_in_date = $request->check_in_date;
            $booking->check_out_date = $request->check_out_date;
            $booking->rent = $room->room_price;
            $booking->payment = $request->payment;
            $booking->due_payment = $room->room_price - $request->payment;
            $booking->payment_status = "success";
            $booking->payment_mode = $request->payment_mode;
            $booking->booking_status = $request->booking_status;
            $booking->boarding_status = $request->boarding_status;
            $booking->lock_in_period_date = $request->lock_in_period_date;
            $booking->next_due_date = $request->next_due_date;
            $booking->plateform_fee = 200;
            if ($booking->save()) {
                Bed::where('id', $request->bed_id)->update(['bed_status' => 'booked']);
                $count = Bed::where('room_id', $request->room_id)
                    ->where('bed_status', 'available')->count();
                if ($count == 0) {
                    Room::where('id', $request->room_id)->update(['room_status' => 'booked']);
                }
                return redirect()->route('owner-list-student')->with('success', 'Student Added Successfully!');
            } else {
                return redirect()->back()->with('error', 'Student Added! But Booking Data not Saved!');
            }
        } else {
            return redirect()->back()->with('error', 'Student not Added!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Booking::with('user', 'hostel', 'room', 'bed')->where('user_id', $id)->first();
        $booking = Booking::with('hostel', 'room', 'bed')->where('user_id', $id)->orderBy('id', 'desc')->get();
        $payments = Fee::join('hostels', 'fees.hostel_id', '=', 'hostels.id')
            ->select('hostels.hostel_name', 'fees.id', 'fees.amount', 'fees.due_amount', 'fees.payment_mode', 'fees.created_at')->where('fees.user_id', $id)->orderBy('fees.id', 'desc')->get();
        return view('owner.student.view', compact('data', 'booking', 'payments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::find($id);
        return view('owner.student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */

    private function updateImage($request, $filename, $path, $id)
    {
        if ($request->hasFile($filename)) {
            $image = $request->file($filename);
            $newName = uniqid() . md5(microtime()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $newName);
            return $path . $newName;
        }
        return str_replace(url('/'), '', User::find($id)->$filename);
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'phone' => "required|digits:10|unique:users,phone,$id",
            'email' => "required|email|max:100|unique:users,email,$id",
            'gender' => 'required|in:Male,Female',
            'father_mobile_no' => "required|digits:10|unique:users,father_mobile_no,$id",
            'mother_mobile_no' => "nullable|digits:10|unique:users,mother_mobile_no,$id",
            'alternate_no' => "nullable|digits:10|unique:users,alternate_no,$id",
            'status' => 'required',
            'dob' => 'required',
            'address' => 'required|max:150',
            'current_address' => 'required|max:150',
            'country' => 'required|max:50',
            'aadhar_no' => "required|digits:12|unique:users,aadhar_no,$id",
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'aadhar_front' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'aadhar_back' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->father_mobile_no = $request->father_mobile_no;
        $user->mother_mobile_no = $request->mother_mobile_no;
        $user->alternate_no = $request->alternate_no;
        $user->status = $request->status;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->current_address = $request->current_address;
        $user->country = $request->country;
        $user->aadhar_no = $request->aadhar_no;

        $user->image = $this->updateImage($request, 'image', 'uploads/student/', $id);
        $user->aadhar_front = $this->updateImage($request, 'aadhar_front', 'uploads/student/', $id);
        $user->aadhar_back = $this->updateImage($request, 'aadhar_back', 'uploads/student/', $id);

        if ($user->save()) {
            return redirect()->back()->with('success', 'Student Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Student not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|exists:bookings,id'],
            [
                'id.required' => 'ID is required',
                'id.exists' => 'ID does not exist',
            ]
        );


        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with("success", "Moved to Trashed!");
    }

    public function booking($id)
    {
        $validator = Validator::make(
            ['id' => $id],
            ['id' => 'required|exists:bookings,id'],
            [
                'id.required' => 'ID is required',
                'id.exists' => 'ID does not exist',
            ]
        );


        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        $data = Booking::with('user', 'hostel', 'room', 'bed')->find($id);
        return view('owner.student.confirm-booking', compact('data'));
    }

    public function confirmBooking(Request $request, $id)
    {
        $booking = Booking::find($id);
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->payment = $request->payment;
        $booking->due_payment = $request->new_due_amount;
        $booking->payment_mode = $request->payment_mode;
        $booking->lock_in_period_date = $request->lock_in_period_date;
        $booking->next_due_date = $request->next_due_date;
        $booking->booking_status = $request->booking_status;
        $booking->boarding_status = $request->boarding_status;
        if ($booking->save()) {
            $user = User::find($booking->user_id);
            $user->name = $request->name;
            $user->father_name = $request->father_name;
            $user->mother_name = $request->mother_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->aadhar_no = $request->aadhar_no;
            $user->image = $this->updateImage($request, 'image', 'uploads/student/', $booking->user_id);
            $user->aadhar_front = $this->updateImage($request, 'aadhar_front', 'uploads/student/', $booking->user_id);
            $user->aadhar_back = $this->updateImage($request, 'aadhar_back', 'uploads/student/', $booking->user_id);
            if ($user->save()) {
                return redirect()->route('owner-list-student')->with('success', 'Booking Confirmed');
            } else {
                return redirect()->back()->with('error', 'Booking data saved but User data not saved!!');
            }
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong!!');
        }
    }

    private function uploadImage($request, $filename, $path)
    {
        if ($request->hasFile($filename)) {
            $image = $request->file($filename);
            $newName = uniqid() . md5(microtime()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path($path), $newName);
            return $path . $newName;
        }
        return NULL;
    }
}
