<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(){
        $user_id = request()->user()->id;

        $fees = Fee::join('hostels', 'fees.hostel_id', '=', 'hostels.id')
        ->select('hostels.hostel_name', 'fees.amount', 'fees.due_amount', 'fees.payment_mode', 'fees.created_at ')->where('fees.user_id', $user_id)->get();

        if ($fees->isNotEmpty()) {
            $responseCode = 200;
            $response = [
                'message' => "Payment Record.",
                'status' => 1,
                'data' => $fees
            ];
        } else {
            $responseCode = 200;
            $response = [
                'message' => 'No Record Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
