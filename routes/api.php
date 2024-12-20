<?php

use App\Http\Controllers\API\{AuthController, AboutController, BookingController, BlogController, CityController, HostelController, PackageController, PopularHostelController, PrivacyAndPolicyController, TermsAndConditionController, SliderController, StudentController, RefundPolicyController, SiteSettingController};

use App\Http\Controllers\API\FeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth Module
Route::group(['controller' => AuthController::class], function () {
    Route::post('/getOtp', 'getOtp');
    Route::post('/verifyOtp', 'verifyOtp');
    Route::post('/register', 'register');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
});

// Hostel Module
Route::group(['prefix' => '/hostels', 'controller' => HostelController::class], function () {
    Route::get('/nearest-hostels', 'getNearestHostel');
    Route::get('/', 'hostels'); // All Hostels
    Route::get('/new-added-hostels', 'newAddedHostels'); // All Hostels
    Route::get('/view/{id}', 'show')->middleware('auth:sanctum'); // Hostel Details
    Route::get('/get-suggestion', 'suggestionCityAndHostel'); // Hostel and City Suggestion
    Route::get('/by-city-name/{cityname}', 'hostelByCityName'); // Hostel By City Name
    Route::get('/by-city-gender/{cityname}/{gender_type}', 'hostelByCityNameAndGender'); // Hostel By City Name and Gender Type
    Route::post('/by-city-hostel-date-gender', 'filterHostel'); // Hostel By City Name and Gender Type
    Route::post('/get-available-beds', 'getAvailableBedsCount')->middleware('auth:sanctum'); // Get Available Beds By Date
    Route::post('/get-available-data', 'showBookingData')->middleware('auth:sanctum'); // Get Available Data for booking
});

Route::get('/cities', [CityController::class, 'cities']); // All Cities
Route::get('/blogs', [BlogController::class, 'blogs']); // All Blogs
Route::get('/blogs/{id}', [BlogController::class, 'show']); // Blog Details
Route::get('/sliders', [SliderController::class, 'sliders']); // All Sliders
Route::get('/about', [AboutController::class, 'about']); // About Us
Route::get('/privacy-and-policy', [PrivacyAndPolicyController::class, 'privacyAndPolicy']); // Privacy And Policy
Route::get('/packages', [PackageController::class, 'packages']); // Packages
Route::get('/terms-and-condition', [TermsAndConditionController::class, 'termsAndCondition']); // Terms And Condition
Route::get('/refund-policy', [RefundPolicyController::class, 'refundPolicy']); // Refund Policy
Route::get('/site-setting', [SiteSettingController::class, 'siteSetting']); // Site Settings
Route::get('/popular-hostels', [PopularHostelController::class, 'popularHostels']); // Popular Hostel

// Student Modules
Route::group(['prefix' => '/student', 'middleware' => ['auth:sanctum']], function () {

    Route::controller(StudentController::class)->group(function () {
        Route::get('/dashboard', 'dashboard');
        Route::post('/store-enquiry', 'storeEnquiry');
        Route::post('/store-review', 'storeReview');
        Route::post('/edit-profile', 'edit');
        Route::get('/booking-history', 'bookingHistory');
    });

    Route::controller(BookingController::class)->group(function () {
        Route::get('/list-booking', 'index');
        Route::get('/add-booking', 'create');
        Route::post('/add-booking', 'store');
        Route::get('/edit-booking/{id}', 'edit');
        Route::post('/edit-booking/{id}', 'update');
        Route::get('/view-booking/{id}', 'show');
        Route::get('/delete-booking/{id}', 'destroy');
    });

    Route::controller(FeeController::class)->group(function () {
        Route::get('/payment-history', 'index');
    });
});



// // Route for handling unauthenticated requests
// Route::fallback(function () {
//     return response()->json(['error' => 'Unauthenticated.'], 401);
// });

require __DIR__ . '/filter.php';