<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function packages(){
        $data = Package::all();
        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are ". $data->count() . " Packages Found.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Packages Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
