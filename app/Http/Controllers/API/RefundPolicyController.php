<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RefundPolicy;
use Illuminate\Http\Request;

class RefundPolicyController extends Controller
{
    public function refundPolicy(){
        $data = RefundPolicy::find(1);
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Refund Policy",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Data Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
