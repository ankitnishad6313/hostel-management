<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsAndConditionController extends Controller
{
    public function termsAndCondition(){
        $data = TermsAndCondition::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Terms And Condition",
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
