<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function adminAllBookingDetails(){
        $bookings = Booking::with('user', 'hostel')->get();
        return view('admin.bookings', compact('bookings'));
    }
}
