<?php
use App\Models\Assignment;
use App\Models\{Banner, Hostel, Package, SiteSetting, User};
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function active_if_match($path)
{
    return Request::is($path . '*') ? 'show' : '';
}
function remove_collapsed_if_match($path)
{
    return Request::is($path . '*') ? '' : 'collapsed';
}

function active_if_full_match($path)
{
    return Request::is($path) ? 'active' : '';
}

function getProfiePic()
{
    $profile_pic = Auth::user()->image;
    if ($profile_pic == NULL) {
        return "/assets/img/avatar.webp";
    } else {
        return $profile_pic;
    }
}
function getImage($id, $image)
{
    if ($image == url('/assets/img/avatar.webp')) {
            return url('/assets/img/avatar.webp');
    } else {
        return $image;
    }
}

function getDob($value, $formate)
{
    return date($formate, strtotime($value));
}

function getFormatedDate($value, $formate)
{
    return date($formate, strtotime($value));
}

function getOwnerName($id)
{
    return User::find($id)->name;
}

function get_option($option_key, $default = NULL)
{
    $system_settings = config('settings.site-setting');

    if ($option_key && isset($system_settings[$option_key])) {
        return $system_settings[$option_key];
    } elseif ($option_key && isset($system_settings[strtolower($option_key)])) {
        return $system_settings[strtolower($option_key)];
    } elseif ($option_key && isset($system_settings[strtoupper($option_key)])) {
        return $system_settings[strtoupper($option_key)];
    } else {
        return $default;
    }
}

function checkFeature($array, $value)
{
    if (!empty($array)) {
        if (in_array($value, $array)) {
            return "checked";
        } else {
            return "";
        }
    } else {
        return "";
    }

}

function SiteSetting()
{
    $data = SiteSetting::find(1);
    return $data;
}
function removeSubstring($url)
{
    return str_replace(url("uploads/hostel_image/"), "", $url);
}
function removeImagePathFromArray($arr)
{
    return array_map("removeSubstring", $arr);
}

function deleteHostelImage($id, $key, $image)
{
    $hostel = Hostel::find($id);
    $oldImagesArray = Hostel::find($id)->hostel_images;
    array_splice($oldImagesArray, $key, 1);
    $oldImages = removeImagePathFromArray(array_values($oldImagesArray));
    $picturePath = str_replace(url('/') . "/", "", $image);

    if (File::exists($picturePath)) {
        File::delete($picturePath);
    }
    $hostel->hostel_images = $oldImages;
    $hostel->save();
}

function adsBanner($location)
{
    $location_array = explode(" ", $location);
    $query = Banner::query();
    foreach ($location_array as $key => $value) {
        if ($key == 0) {
            $query->where('city', 'LIKE', "%$value");
        } else {
            $query->orWhere('city', 'LIKE', "%$value");
        }
    }
    return $query->select('city', 'link', 'banner')->get();

}

function assignFreePackagetoHostel($hostel_id)
{
    $package = Package::where('package', 'FREE')->first();
    $hostel = Hostel::find($hostel_id);

    $assign = new Assignment();
    $assign->package_id = $package->id;
    $assign->user_id = $hostel->user_id;
    $assign->hostel_id = $hostel_id;
    $assign->start_date = Carbon::now();
    $assign->end_date = Carbon::now()->addDays($package->validity);
    $assign->save();


    $hostel->package_id = $package->id;
    $hostel->hostel_membership = "FREE";
    $hostel->save();
}

// Send OTP to User for Login and Register
function sendOtp($mobile, $otp)
{
    // Validate mobile number
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "Invalid mobile number.";
        return false;
    }

    // Initialize Guzzle client
    $client = new Client();
    
    // API credentials and message
    $username = 'TAISPL';
    $password = 'TAISPL';
    $sendername = 'INEARM';
    $templateid = '1707171949625757044';
    $message = "Dear User, This is your One Time Password OTP $otp for mobile number verification in NearMeHostels. Please do not share it with anyone. Team NearMe India.";

    // Construct the URL with the encoded message
    $url = "http://priority.muzztech.in/sms_api/sendsms.php?username=$username&password=$password&mobile=$mobile&sendername=$sendername&message=" . urlencode($message) . "&templateid=$templateid";

    try {
        // Send GET request to the API
        $response = $client->request('GET', $url);

        // Check if the status code is 200 (OK) and the body contains 'success'
        if ($response->getStatusCode() == 200) {
            return true;
        } else {
            // Log the error message
            error_log("Request failed with status code: " . $response->getStatusCode());
            echo "Request failed with status code: " . $response->getStatusCode();
            return false;
        }
    } catch (RequestException $e) {
        // Log the exception message
        error_log("HTTP request failed: " . $e->getMessage());
        echo "HTTP request failed: " . $e->getMessage();
        return false;
    }
}

function getSecurityAmount($id){
    return Hostel::find($id)->security_amount;
}

function getHostelName($id){
    return Hostel::find($id)->hostel_name;
}

function agentDetails($id){
    $html = "";
    if($id != null){
        $user = User::find($id);
        return $html = "
        <span class='d-block fw-bold'>$user->name</span>
        <span class='d-block fw-bold'><a herf='tel:+91 {{$user->phone}}'>$user->phone</a></span>
        ";
    }
}