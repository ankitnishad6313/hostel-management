<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Hostel;
use Illuminate\Http\Request;
use Validator;

class FilterHostelController extends Controller
{
    public function filterHostel(Request $request){
        $validator = Validator::make($request->all(), [
            // "city_or_hostel" => "required",
            "date" => "required",
            "gender" => "required|string|in:boys,girls"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $checkInDate = $request->date;
        $genderType = ucfirst($request->gender);

        // Query to filter hostels based on search criteria
        $data['hostel'] = Hostel::whereHas('room.bed', function ($query) use ($checkInDate) {
            $query->whereDoesntHave('booking', function ($query) use ($checkInDate) {
                $query->where('check_in_date', '<=', $checkInDate)
                    ->where('check_out_date', '>=', $checkInDate);
            });
        })
            ->where('gender_type', $genderType)
            // ->orWhere('city', $searchTerms)
            // ->orWhere('hostel_name', $searchTerms)
            ->withCount('reviews')
            ->with([
                'reviews' => function ($query) {
                    $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                        ->groupBy('hostel_id');
                }
            ])
            ->orderBy('package_id')
            ->get();
        $city = $data['hostel'][0]->city;
        $gender_type = $data['hostel'][0]->gender_type;

        $data['banner'] = Banner::where('city', 'LIKE', "%$city%")->get();
        $data['suggestions'] = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('city', $city)->where('gender_type', $gender_type)->where('hostel_status', 'active')
        ->orderBy('package_id')
        ->get();

        if ($data['hostel']->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => $data['hostel']->count() . " Hostels Found.",
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
