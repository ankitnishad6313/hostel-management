<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
      public function siteSetting()
    {
        $data = SiteSetting::find(1);

        if ($data->count() > 0) {
            $responseCode = 200;
            $response = [
                'message' => "Site Settings",
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
