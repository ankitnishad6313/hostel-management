<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about(){
        $data = About::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "About.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No About Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
