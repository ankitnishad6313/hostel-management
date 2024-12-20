<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\PopularHostel;
use Illuminate\Http\Request;

class PopularHostelController extends Controller
{
    public function popularHostels(){
        $data = Hostel::join('popular_hostels', 'hostels.id', '=', 'popular_hostels.hostel_id')->with(['reviews' => function ($query) {
            $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                  ->groupBy('hostel_id');
        }])->where('status', 'active')
        ->orderBy('package_id')
        ->get();

        
        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are ". $data->count() . " Hostels Found.",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Hostels Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }
}
