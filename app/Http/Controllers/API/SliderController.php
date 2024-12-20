<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function sliders(){
        $data = Sliders::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are ". $data->count() . " Sliders Found.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Slider Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
