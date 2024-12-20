<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{Banner, Bed, Booking, Hostel, Room, Sliders};
use App\Models\City;
use App\Models\Enquiry;
use App\Models\Review;
use App\Rules\CheckOutDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class HostelController extends Controller
{
    public function getNearestHostel(Request $request)
    {
        $userLatitude = $request->latitude; /* User's latitude */
        $userLongitude = $request->longitude; /* User's longitude */

        $radius = 10; // 10km radius

        $hostels = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])
            ->select('hostels.*', \DB::raw('( 6371 * acos( cos( radians(' . $userLatitude . ') ) *
                cos( radians( latitude ) ) *
                cos( radians( longitude ) - radians(' . $userLongitude . ') ) +
                sin( radians(' . $userLatitude . ') ) *
                sin( radians( latitude ) ) ) ) AS distance'))
            ->having('distance', '<', $radius)
            ->orderBy('package_id')
            ->orderBy('distance')
            ->get();

        if ($hostels->isNotEmpty()) {
            $cityname = $hostels[0]->city;
            $banner = Banner::where('city', 'LIKE', "%$cityname")->get();
            $response_code = 200;
            $response = [
                'success' => 1,
                'message' => $hostels->count() . ' Nearest Hostel!!',
                'data' => $hostels->toArray(),
                'banner' => $banner
            ];
        } else {
            $response_code = 404;
            $response = [
                'success' => 0,
                'message' => 'No Hostel Found!!',
            ];
        }

        return response()->json($response, $response_code);
    }
    public function hostels()
    {
        $data = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('hostel_status', 'active')->get();

        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are " . $data->count() . " Hostels Found.",
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

    public function suggestionCityAndHostel()
    {
        $data['cities'] = City::select('city')->get();
        $data['hostels'] = Hostel::select('hostel_name', 'hostel_address')->get();

        if ($data) {
            $responseCode = 200;
            $response = [
                'message' => "Suggestions",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No suggestions Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function hostelByCityName($cityname)
    {
        $data['hostel'] = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('city', 'LIKE', "%$cityname%")->orWhere('hostel_name', 'LIKE', "%$cityname%")->where('hostel_status', 'active')
            ->orderBy('package_id')
            ->get();

        $data['banner'] = Banner::where('city', 'LIKE', "%$cityname%")->get();
        $data['suggestions'] = Hostel::where('city', $data['hostel'][0]->city)->orWhere('gender_type', $data['hostel'][0]->gender_type)->get();

        if ($data['hostel']->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => $data['hostel']->count() . " Hostels in " . ucwords($cityname),
                'status' => 1,
                'data' => $data,
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

    public function hostelByCityNameAndGender($cityname, $gender_type)
    {
        $data = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('city', 'LIKE', "%$cityname%")->where('gender_type', $gender_type)->where('hostel_status', 'active')
            ->orderBy('package_id')
            ->get();

        $cityname = $data[0]->city;
        $data['banner'] = Banner::where('city', 'LIKE', "%$cityname")->get();

        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => $data->count() . " Hostels in " . ucwords($cityname),
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

    public function show(Request $request, $id)
    {
        $data = Hostel::find($id);
        $data['total_reviews'] = Review::where('hostel_id', $id)->count();
        $rating = Review::where('hostel_id', $id)->avg('star');
        $data['average_ratings'] = round($rating, 1);
        $data['banner'] = Banner::where('city', 'LIKE', "%$data->cityname%")->orWhere('city', 'LIKE', "%$data->hostel_address%")->get();
        $data['reviews'] = Review::select('users.name', 'users.image', 'reviews.star', 'reviews.description', 'reviews.created_at')
            ->join('users', 'users.id', '=', 'reviews.user_id')
            ->where('hostel_id', $id)
            ->get()
            ->map(function ($review) {
                if ($review->image == NULL) {
                    $img = url("/assets/img/avatar.webp");
                } else {
                    $img = url("$review->image");
                }
                $review->image = $img;
                return $review;
            });

        $user = $request->user();

        $enq = new Enquiry;
        $enq->user_id = $data->user_id;
        $enq->hostel_id = $id;
        $enq->name = $user->name;
        $enq->email = $user->email;
        $enq->phone = $user->phone;
        $enq->description = "This person visited your Hostel";
        $enq->save();

        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Hostel Details",
                'status' => 1,
                'data' => $data
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Details Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    // Hostel By City or Hostel Name, Gender Type and Date

    public function filterHostel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "city_or_hostel" => "required",
            // "date" => "required",
            "gender" => "required|string|in:boys,girls"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $searchTerms = ucwords($request->city_or_hostel);
        // $checkInDate = $request->date;
        $genderType = ucfirst($request->gender);

        $data['hostel'] = Hostel::where(function ($query) use ($searchTerms, $genderType) {
            $query->where('city', $searchTerms)
                ->orWhere('hostel_name', $searchTerms);
        })
        ->where('gender_type', $genderType) // Ensure gender filter applies to all results
        // ->whereHas('room.bed', function ($query) use ($checkInDate) {
        //     $query->whereDoesntHave('booking', function ($query) use ($checkInDate) {
        //         $query->where('check_in_date', '<=', $checkInDate)
        //             ->where('check_out_date', '>=', $checkInDate);
        //     });
        // })
        ->withCount('reviews')
        ->with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])
        ->orderBy('hostels.package_id')
        ->get();
        
        $city = $data['hostel'][0]->city;
        $gender_type = $data['hostel'][0]->gender_type;

        $data['banner'] = Banner::where('city', 'LIKE', "%$city%")->get();
        $data['suggestions'] = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('city', $city)->where('gender_type', $gender_type)->where('hostel_status', 'active')->get();

        if ($data['hostel']->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => $data['hostel']->count() . " Hostels in " . ucwords($city),
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

    public function getAvailableBedsCount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hostel_id" => "required",
            'check_in_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'check_out_date' => [
                'required',
                'date_format:Y-m-d',
                'after:check_in_date',
                new CheckOutDate($request->check_in_date)
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hostelId = $request->hostel_id;
        $checkInDate = $request->check_in_date;
        $checkOutDate = $request->check_out_date;

        $available_beds = Bed::select('rooms.floor', 'rooms.bed_type', DB::raw('COUNT(beds.id) as count'))
            ->leftJoin('rooms', 'rooms.id', '=', 'beds.room_id')
            ->where('rooms.hostel_id', $hostelId)
            ->whereNotExists(function ($query) use ($checkInDate, $checkOutDate) {
                $query->select(DB::raw(1))
                    ->from('bookings')
                    ->whereRaw('bookings.bed_id = beds.id')
                    ->where(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('bookings.check_in_date', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('bookings.check_out_date', [$checkInDate, $checkOutDate])
                            ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                                $query->where('bookings.check_in_date', '<=', $checkInDate)
                                    ->where('bookings.check_out_date', '>=', $checkOutDate);
                            });
                    });
            })
            ->groupBy('rooms.floor', 'rooms.bed_type')
            ->orderBy('rooms.floor')
            ->orderBy('rooms.bed_type')
            ->get();


        $formatted_response = [];

        $floorMap = [
            'ground' => 'Ground Floor',
            'first' => 'First Floor',
            'second' => 'Second Floor'
        ];

        $bedTypeMap = [
            '1' => 'Single Bed',
            '2' => 'Double Bed',
            '3' => 'Triple Bed'
        ];

        foreach ($available_beds as $bed) {
            $floor = $floorMap[$bed->floor];
            $bedType = $bedTypeMap[$bed->bed_type];

            if (!isset($formatted_response[$floor])) {
                $formatted_response[$floor] = [
                    'floor' => $floor,
                    'seats' => []
                ];
            }

            $formatted_response[$floor]['seats'][] = [
                'type' => $bedType,
                'available' => $bed->count
            ];
        }

        $formatted_response = array_values($formatted_response);

        if ($formatted_response) {
            $responseCode = 200;
            $response = [
                'message' => "Available Beds",
                'status' => 1,
                'hostel_id' => $hostelId,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'available_beds' => $formatted_response,
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Beds Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function showBookingData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "hostel_id" => "required",
            "floor" => 'required',
            "bed_type" => 'required',
            'check_in_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'check_out_date' => [
                'required',
                'date_format:Y-m-d',
                'after:check_in_date',
                new CheckOutDate($request->check_in_date)
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $hostelId = $request->hostel_id;
        $bed_type = $request->bed_type;
        $floor = $request->floor;

        // Convert bed_type to numerical values
        if ($bed_type == 'Single Bed') {
            $bed_type = 1;
        } elseif ($bed_type == 'Double Bed') {
            $bed_type = 2;
        } else {
            $bed_type = 3;
        }

        // Convert floor to specific values
        if ($floor == 'Ground Floor') {
            $floor = 'ground';
        } elseif ($floor == 'First Floor') {
            $floor = 'first';
        } elseif ($floor == 'Second Floor') {
            $floor = 'second';
        }

        $checkInDate = $request->check_in_date;
        $checkOutDate = $request->check_out_date;

        $bookingData = Bed::select('rooms.id as room_id', 'rooms.floor', 'rooms.bed_type', 'beds.id as bed_id')
            ->leftJoin('rooms', 'rooms.id', '=', 'beds.room_id')
            ->where('rooms.hostel_id', $hostelId)
            ->where('rooms.floor', $floor)
            ->where('rooms.bed_type', $bed_type)
            ->whereNotExists(function ($query) use ($checkInDate, $checkOutDate) {
                $query->select(DB::raw(1))
                    ->from('bookings')
                    ->whereRaw('bookings.bed_id = beds.id')
                    ->where(function ($query) use ($checkInDate, $checkOutDate) {
                        $query->whereBetween('bookings.check_in_date', [$checkInDate, $checkOutDate])
                            ->orWhereBetween('bookings.check_out_date', [$checkInDate, $checkOutDate])
                            ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                                $query->where('bookings.check_in_date', '<=', $checkInDate)
                                    ->where('bookings.check_out_date', '>=', $checkOutDate);
                            });
                    });
            })
            ->orderBy('rooms.floor')
            ->orderBy('rooms.bed_type')
            ->get();

        $owner_id = Hostel::find($hostelId)->user_id;

        if ($bookingData->isNotEmpty()) {
            $responseCode = 200;
            $response = [
                'message' => "Available Beds",
                'status' => 1,
                'hostel_id' => $hostelId,
                'owner_id' => $owner_id,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'data' => $bookingData,
            ];
        } else {
            $responseCode = 404;
            $response = [
                'message' => 'No Beds Found.',
                'status' => 0,
            ];
        }
        return response()->json($response, $responseCode);
    }


    public function newAddedHostels(){
        $data = Hostel::with([
            'reviews' => function ($query) {
                $query->select('hostel_id', \DB::raw('round(AVG(star),1) as average_rating'))
                    ->groupBy('hostel_id');
            }
        ])->where('hostel_status', 'active')
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();

        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "There are " . $data->count() . " Hostels Found.",
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