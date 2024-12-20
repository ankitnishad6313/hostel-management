<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function cities(){
        $data = City::select('id', 'city', 'image')->where('status', 'active')->get();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are ". $data->count() . " Cities Found.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Cities Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
