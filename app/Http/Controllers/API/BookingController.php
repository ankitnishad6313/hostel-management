<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{Bed, Booking, Hostel, Room, User};
use App\Rules\CheckOutDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class BookingController extends Controller
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
    $validator = Validator::make($request->all(), [
        "transaction_id" => "required|unique:bookings,transaction_id",
        "plateform_fee" => "required",
        "hostel_id" => "required|exists:hostels,id",
        "owner_id" => "required|exists:users,id",
        "room_id" => "required|array",
        "room_id.*" => "required|exists:rooms,id",
        "bed_id" => "required|array",
        "bed_id.*" => "required|exists:beds,id",
        'check_in_date' => 'required|date_format:Y-m-d|after_or_equal:today',
        'check_out_date' => [
            'required',
            'date_format:Y-m-d',
            'after:check_in_date',
            new CheckOutDate($request->check_in_date)
        ],
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $user = User::find($request->user()->id);

    foreach ($request->room_id as $index => $roomId) {
        $room = Room::find($roomId);
        $bedId = $request->bed_id[$index];

        $booking = new Booking;
        $booking->order_id = $request->transaction_id; // Order ID same as Transaction ID
        $booking->transaction_id = $request->transaction_id;
        $booking->plateform_fee = $request->plateform_fee;
        $booking->user_id = $user->id;
        $booking->owner_id = $request->owner_id;
        $booking->hostel_id = $request->hostel_id;
        $booking->room_id = $roomId;
        $booking->bed_id = $bedId;
        $booking->check_in_date = $request->check_in_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->rent = $room->room_price;
        $booking->security_amount = Hostel::find($request->hostel_id)->security_amount;
        $booking->payment = 0;
        $booking->due_payment = 0;
        $booking->payment_status = "success";
        $booking->payment_mode = "online";
        $booking->lock_in_period_date = now()->addMonths(Hostel::find($request->hostel_id)->lock_in_period)->format('Y-m-d');
        $booking->next_due_date = Carbon::parse($request->check_in_date)->addMonths(1)->format('Y-m-d');

        if ($booking->save()) {
            Bed::where('id', $bedId)->update(['bed_status' => 'booked']);
            $count = Bed::where('room_id', $roomId)->where('bed_status', 'available')->count();

            if ($count == 0) {
                Room::find($roomId)->update(['room_status' => 'booked']);
            }

            $responseCode = 200;
            $response = [
                'message' => "Hostel Booked",
                'status' => 1,
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'Something went wrong!!',
                'status' => 0,
            ];
        }
    }

    return response()->json($response, $responseCode);
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
