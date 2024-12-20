<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PrivacyAndPolicy;
use Illuminate\Http\Request;

class PrivacyAndPolicyController extends Controller
{
    public function privacyAndPolicy(){
        $data = PrivacyAndPolicy::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Privacy And Policy",
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
