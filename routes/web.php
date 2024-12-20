<?php
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

// Home Controller (Common)
use App\Http\Controllers\{HomeController, DocumentController};

// Admin Controllers
use App\Http\Controllers\Admin\{AdminController, AdminAgentController, AdminHostelController, AdminRoomController, AdminBedController, AdminBlogController, AdminDocumentController, AdminHostelFeaturesController, AdminOwnerController, AdminStudentController, TermsAndConditionController, TrashController, PrivacyAndPolicyController, AdminRefundPolicyController, PackageController, AdminEnquiryController, AdminCityController, AboutController, AdminReviewController, PopularHostelController, AdminSliderController, AdminBannerController, SiteSettingController, AssignmentController};

// Agent Controllers
use App\Http\Controllers\Agent\{AgentController, AgentHostelController, AgentOwnerController};

// Owner Controller
use App\Http\Controllers\Owner\{OwnerController, OwnerDocumentController, OwnerStudentController, OwnerHostelController, OwnerRoomController, OwnerBedController, OwnerReviewController, OwnerEnquiryController, FeeController as OwnerFeeController};

use App\Http\Controllers\Booking\BookingController;

/*********************************************************************************************************/

// Login, Register, Logout and Forgot Password
Route::controller(HomeController::class)->group(function () {

    // Redirected Dashboard if already Login
    Route::middleware(['guest'])->group(function () {
        Route::get('/', 'loginView')->name('login');
        Route::get('/register', 'registerView')->name('register');
        Route::get('/forget-password', 'forgotPassword')->name('forgot-password');
    });

    Route::post('/login', 'login')->name('login.post');
    Route::post('/register', 'register')->name('register.post');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('/send-top', 'sendOtp')->name('send-otp');
    Route::post('/verify-otp', 'verifyOtp')->name('verify-otp');
    Route::post('/change-password', 'changePassword')->name('change-password');
    Route::get('/searchHostel', 'searchHostel');
    
    Route::get('/checking', 'checking');
});


// Admin Module
Route::middleware(['auth', 'web', 'prevent-back-btn', 'is-admin'])->group(function () {
    // Put the application into maintenance / demo mode:
    Route::get('/web-down', function () {
        Artisan::call('down');
        return 'Application moved into maintenance mode.';
    })->name('down');

    // Admin Dashboard
    Route::group(['prefix' => 'admin', 'controller' => AdminController::class], function () {
        // Admin Profile and Dashboard
        Route::get('/dashboard', 'dashboard')->name('admin-dashboard');
        Route::get('/profile', 'profile')->name('admin-profile');
        Route::put('/update-profile', 'updateProfile')->name('admin-update-profile');
        Route::put('/change-password', 'changePassword')->name('admin-change-password');
        Route::get('/delete-profile-image', 'deleteProfileImage')->name('admin-delete-profile-image');
    });

    // Trash Force Delete and Restore
    Route::group(['prefix' => '/admin', 'controller' => TrashController::class], function () {
        Route::get('/trash', 'trashData')->name('trash');

        // User
        Route::get('/restore-user/{id}', 'restoreUser')->name('restore-user');
        Route::get('/force-delete-user/{id}', 'deleteUser')->name('force-delete-user');

        // Hostel
        Route::get('/restore-hostel/{id}', 'restoreHostel')->name('restore-hostel');
        Route::get('/force-delete-hostel/{id}', 'deleteHostel')->name('force-delete-hostel');

        // Popular Hostels
        Route::get('/restore-popular-hostel/{id}', 'restorePopularHostel')->name('restore-popular-hostel');
        Route::get('/force-delete-popular-hostel/{id}', 'deletePopularHostel')->name('force-delete-popular-hostel');
    });

    // Admin City Module
    Route::group(['prefix' => 'admin/city/', 'controller' => AdminCityController::class], function () {
        Route::get('/list-city', 'index')->name('admin-list-city');
        Route::get('/add-city', 'create')->name('admin-create-city');
        Route::post('/add-city', 'store')->name('admin-store-city');
        Route::get('/edit-city/{id}', 'edit')->name('admin-edit-city');
        Route::post('/edit-city/{id}', 'update')->name('admin-update-city');
        Route::get('/view-city/{id}', 'show')->name('admin-show-city');
        Route::get('/delete-city/{id}', 'destroy')->name('admin-destroy-city');
    });

    // Admin Package Module
    Route::group(['prefix' => 'admin/package/', 'controller' => PackageController::class], function () {
        Route::get('/list-package', 'index')->name('admin-list-package');
        Route::get('/add-package', 'create')->name('admin-create-package');
        Route::post('/add-package', 'store')->name('admin-store-package');
        Route::get('/edit-package/{id}', 'edit')->name('admin-edit-package');
        Route::post('/edit-package/{id}', 'update')->name('admin-update-package');
        Route::get('/view-package/{id}', 'show')->name('admin-show-package');
        Route::get('/delete-package/{id}', 'destroy')->name('admin-destroy-package');
    });

    Route::group(['prefix' => 'assignment', 'controller' => AssignmentController::class], function() {
        Route::post('/assign-package', 'store')->name('admin-assign-package'); // Assign Package
    });

    // Admin Agent Module
    Route::group(['prefix' => 'admin/agent/', 'controller' => AdminAgentController::class], function () {
        Route::get('/list-agent', 'index')->name('admin-list-agent');
        Route::get('/add-agent', 'create')->name('admin-create-agent');
        Route::post('/add-agent', 'store')->name('admin-store-agent');
        Route::get('/edit-agent/{id}', 'edit')->name('admin-edit-agent');
        Route::post('/edit-agent/{id}', 'update')->name('admin-update-agent');
        Route::get('/view-agent/{id}', 'show')->name('admin-show-agent');
        Route::get('/delete-agent/{id}', 'destroy')->name('admin-destroy-agent');
    });

    // Admin Owner Module
    Route::group(['prefix' => 'admin/owner/', 'controller' => AdminOwnerController::class], function () {
        Route::get('/list-owner', 'index')->name('admin-list-owner');
        Route::get('/add-owner', 'create')->name('admin-create-owner');
        Route::post('/add-owner', 'store')->name('admin-store-owner');
        Route::get('/edit-owner/{id}', 'edit')->name('admin-edit-owner');
        Route::post('/edit-owner/{id}', 'update')->name('admin-update-owner');
        Route::get('/view-owner/{id}', 'show')->name('admin-show-owner');
        Route::get('/delete-owner/{id}', 'destroy')->name('admin-destroy-owner');
    });

    // Admin Student Module
    Route::group(['prefix' => 'admin/student/', 'controller' => AdminStudentController::class], function () {
        Route::get('/boarding-student-list', 'boardingStudents')->name('admin-boarding-student');
        Route::get('/register-student-list', 'registerStudents')->name('admin-register-student');
        Route::get('/pending-student-list', 'pendingStudents')->name('admin-pending-student');
        Route::get('/add-student', 'create')->name('admin-create-student');
        Route::post('/add-student', 'store')->name('admin-store-student');
        Route::get('confirm-booking/{id}', 'booking')->name('admin-confirm-booking');
        Route::post('confirm-booking/{id}', 'confirmBooking')->name('admin-confirm-booking-post');
        Route::get('/history-student', 'history')->name('admin-history-student');
        Route::get('/get-room', 'getRoom')->name('admin-get-room');
        Route::get('/get-bed', 'getBed')->name('admin-get-bed');
        Route::get('/edit-student/{id}', 'edit')->name('admin-edit-student');
        Route::post('/edit-student/{id}', 'update')->name('admin-update-student');
        Route::get('/view-student/{id}', 'show')->name('admin-show-student');
        Route::get('/delete-student/{id}', 'destroy')->name('admin-destroy-student');
    });

    // Admin Document Module
    Route::group(['prefix' => 'admin/document/', 'controller' => AdminDocumentController::class], function () {
        Route::get('/list-document', 'index')->name('admin-list-document');
        Route::post('/add-document/{id}', 'store')->name('admin-store-document');
        Route::get('add-edit-document/{id}', 'edit')->name('admin-edit-document');
        Route::post('/edit-document/{id}', 'update')->name('admin-update-document');
        Route::get('/view-document/{id}', 'show')->name('admin-show-document');
        Route::get('/delete-document/{id}', 'destroy')->name('admin-destroy-document');
    });

    // Admin Hostels Module
    Route::group(['prefix' => 'admin/hostel/', 'controller' => AdminHostelController::class], function () {
        Route::get('/list-hostel', 'index')->name('admin-list-hostel');
        Route::get('/add-hostel', 'create')->name('admin-create-hostel');
        Route::post('/add-hostel', 'store')->name('admin-store-hostel');
        Route::get('/edit-hostel/{id}', 'edit')->name('admin-edit-hostel');
        Route::post('/edit-hostel/{id}', 'update')->name('admin-update-hostel');
        Route::get('/view-hostel/{id}', 'show')->name('admin-show-hostel');
        Route::get('/delete-hostel/{id}', 'destroy')->name('admin-destroy-hostel');
        Route::post('/delete-hostel-image/{id}', 'deleteImage')->name('admin-delete-hostel-image');
    });

    // Admin Hostel Feature Module
    Route::group(['prefix' => 'admin/hostel/', 'controller' => AdminHostelFeaturesController::class], function () {
        // Route::get('/list-feature', 'index')->name('admin-list-feature');
        Route::get('/add-feature', 'create')->name('admin-create-feature');
        Route::post('/add-feature', 'store')->name('admin-store-feature');
        Route::get('/edit-feature/{id}', 'edit')->name('admin-edit-feature');
        Route::post('/edit-feature/{id}', 'update')->name('admin-update-feature');
        Route::get('/view-feature/{id}', 'show')->name('admin-show-feature');
        Route::get('/delete-feature/{id}', 'destroy')->name('admin-destroy-feature');
    });

    // Admin Popular Hostel
    Route::group(['prefix' => 'admin/hostel/', 'controller' => PopularHostelController::class], function () {
        Route::get('/list-popular-hostel', 'index')->name('admin-popular-hostel');
        Route::get('/get-hostel', 'getHostel')->name('get_hostel');
        Route::post('/add-popular-hostel', 'store')->name('admin-store-popular-hostel');
        // Route::get('/edit-popular-hostel/{id}', 'edit')->name('admin-edit-popular-hostel');
        Route::post('/edit-popular-hostel/{id}', 'update')->name('admin-update-popular-hostel');
        Route::get('/delete-popular-hostel/{id}', 'destroy')->name('admin-destroy-popular-hostel');
    });

    // Admin Room Module
    Route::group(['prefix' => 'admin/room/', 'controller' => AdminRoomController::class], function () {
        Route::get('/list-room', 'index')->name('admin-list-room');
        Route::get('/add-room/{id}', 'create')->name('admin-create-room');
        Route::post('/add-room/{id}', 'store')->name('admin-store-room');
        Route::get('/edit-room/{id}', 'edit')->name('admin-edit-room');
        Route::post('/edit-room/{id}', 'update')->name('admin-update-room');
        Route::get('/view-room/{id}', 'show')->name('admin-show-room');
        Route::get('/delete-room/{id}', 'destroy')->name('admin-destroy-room');
    });

    // Admin Bed Module
    Route::group(['prefix' => 'admin/bed/', 'controller' => AdminBedController::class], function () {
        Route::get('/list-bed', 'index')->name('admin-list-bed');
        Route::get('/add-bed/{id}', 'create')->name('admin-create-bed');
        Route::post('/add-bed/{id}', 'store')->name('admin-store-bed');
        Route::get('/edit-bed/{id}', 'edit')->name('admin-edit-bed');
        Route::post('/edit-bed/{id}', 'update')->name('admin-update-bed');
        Route::get('/view-bed/{id}', 'show')->name('admin-show-bed');
        Route::get('/delete-bed/{id}', 'destroy')->name('admin-destroy-bed');
    });

    // Admin Booking Module
    Route::group(['prefix' => 'admin/booking/', 'controller' => BookingController::class], function () {
        Route::get('/list-booking', 'adminAllBookingDetails')->name('admin-list-bookings');
    });

    // About Page
    Route::group(['prefix' => 'admin/pages/about', 'controller' => AboutController::class], function () {
        Route::get('/', 'index')->name('admin-about-view');
        Route::get('/edit/{id}', 'edit')->name('admin-about-edit');
        Route::post('/edit/{id}', 'update')->name('admin-about-update');
    });

    // Privacy And Policy Page
    Route::group(['prefix' => 'admin/pages/privacy-and-policy', 'controller' => PrivacyAndPolicyController::class], function () {
        Route::get('/', 'index')->name('privacy-and-policy-view');
        Route::get('/edit/{id}', 'edit')->name('privacy-and-policy-edit');
        Route::post('/edit/{id}', 'update')->name('privacy-and-policy-update');
    });

    // Refund Policy Page
    Route::group(['prefix' => 'admin/pages/refund-policy', 'controller' => AdminRefundPolicyController::class], function () {
        Route::get('/', 'index')->name('refund-policy-view');
        Route::get('/edit/{id?}', 'edit')->name('refund-policy-edit');
        Route::post('/edit/{id?}', 'update')->name('refund-policy-update');
    });

    // Terms And Condition Page
    Route::group(['prefix' => 'admin/pages/terms-and-condition', 'controller' => TermsAndConditionController::class], function () {
        Route::get('/', 'index')->name('terms-and-condition-view');
        Route::get('/edit/{id}', 'edit')->name('terms-and-condition-edit');
        Route::post('/edit/{id}', 'update')->name('terms-and-condition-update');
    });

    // Admin Enquiry Module
    Route::group(['prefix' => 'admin/enquiry/', 'controller' => AdminEnquiryController::class], function () {
        Route::get('/list-enquiry', 'index')->name('admin-list-enquiry');
        Route::get('/add-enquiry', 'create')->name('admin-create-enquiry');
        Route::get('/get_hostel', 'getHostels')->name('getHostels');
        Route::post('/add-enquiry', 'store')->name('admin-store-enquiry');
        Route::get('/edit-enquiry/{id}', 'edit')->name('admin-edit-enquiry');
        Route::post('/edit-enquiry/{id}', 'update')->name('admin-update-enquiry');
        Route::any('/view-enquiry/{id}', 'show')->name('admin-show-enquiry');
        Route::get('/delete-enquiry/{id}', 'destroy')->name('admin-destroy-enquiry');
    });

    // Admin Review Module
    Route::group(['prefix' => 'admin/review/', 'controller' => AdminReviewController::class], function () {
        Route::get('/list-review', 'index')->name('admin-list-review');
        Route::get('/add-review', 'create')->name('admin-create-review');
        Route::post('/add-review', 'store')->name('admin-store-review');
        Route::get('/edit-review/{id}', 'edit')->name('admin-edit-review');
        Route::post('/edit-review/{id}', 'update')->name('admin-update-review');
        Route::get('/view-review/{id}', 'show')->name('admin-show-review');
        Route::get('/delete-review/{id}', 'destroy')->name('admin-destroy-review');
    });

    // Admin Blog Module
    Route::group(['prefix' => 'admin/blog/', 'controller' => AdminBlogController::class], function () {
        Route::get('/list-blog', 'index')->name('admin-list-blog');
        Route::get('/add-blog', 'create')->name('admin-create-blog');
        Route::post('/add-blog', 'store')->name('admin-store-blog');
        Route::get('/edit-blog/{id}', 'edit')->name('admin-edit-blog');
        Route::post('/edit-blog/{id}', 'update')->name('admin-update-blog');
        Route::get('/view-blog/{id}', 'show')->name('admin-show-blog');
        Route::get('/delete-blog/{id}', 'destroy')->name('admin-destroy-blog');
    });

    // Admin Slider Module
    Route::group(['prefix' => 'admin/slider/', 'controller' => AdminSliderController::class], function () {
        Route::get('/list-slider', 'index')->name('admin-list-slider');
        Route::get('/add-slider', 'create')->name('admin-create-slider');
        Route::post('/add-slider', 'store')->name('admin-store-slider');
        Route::get('/edit-slider/{id}', 'edit')->name('admin-edit-slider');
        Route::post('/edit-slider/{id}', 'update')->name('admin-update-slider');
        // Route::get('/view-slider/{id}', 'show')->name('admin-show-slider');
        Route::get('/delete-slider/{id}', 'destroy')->name('admin-destroy-slider');
    });

    // Admin Banner Module
    Route::group(['prefix' => 'admin/banner/', 'controller' => AdminBannerController::class], function () {
        Route::get('/list-banner', 'index')->name('admin-list-banner');
        Route::get('/add-banner', 'create')->name('admin-create-banner');
        Route::post('/add-banner', 'store')->name('admin-store-banner');
        Route::get('/edit-banner/{id}', 'edit')->name('admin-edit-banner');
        Route::post('/edit-banner/{id}', 'update')->name('admin-update-banner');
        // Route::get('/view-banner/{id}', 'show')->name('admin-show-banner');
        Route::get('/delete-banner/{id}', 'destroy')->name('admin-destroy-banner');
    });

    // Admin site-setting Module
    Route::group(['prefix' => 'admin/setting', 'controller' => SiteSettingController::class], function () {
        Route::get('/site-setting', 'index')->name('admin-site-setting');
        Route::post('/site-setting', 'update')->name('admin-update-site-setting');
    });

}); // End Admin Modules

// Agent Module
Route::middleware(['auth', 'web', 'prevent-back-btn', 'is-agent'])->group(function () {

    Route::group(['prefix' => '/agent', 'controller' => AgentController::class], function () {
        Route::get('/dashboard', 'dashboard')->name('agent-dashboard');
        Route::get('/profile', 'profile')->name('agent-profile');
        Route::put('/update-profile', 'updateProfile')->name('agent-update-profile');
        Route::put('/change-password', 'changePassword')->name('agent-change-password');
        Route::get('/delete-profile-image', 'deleteProfileImage')->name('agent-delete-profile-image');
    });

    Route::group(['prefix' => 'agent/document/', 'controller' => DocumentController::class], function () {
        Route::get('/list-document', 'index')->name('agent-list-document');
        Route::post('/add-document', 'store')->name('agent-store-document');
        Route::get('add-edit-document', 'edit')->name('agent-edit-document');
        Route::post('/edit-document/{id}', 'update')->name('agent-update-document');
        Route::get('/view-document/{id}', 'show')->name('agent-show-document');
        Route::get('/delete-document/{id}', 'destroy')->name('agent-destroy-document');
    });

    // Agent Owner Module
    Route::group(['prefix' => 'agent/owner/', 'controller' => AgentOwnerController::class], function () {
        Route::get('/list-owner', 'index')->name('agent-list-owner');
        Route::get('/add-owner', 'create')->name('agent-create-owner');
        Route::post('/add-owner', 'store')->name('agent-store-owner');
        Route::get('/edit-owner/{id}', 'edit')->name('agent-edit-owner');
        Route::post('/edit-owner/{id}', 'update')->name('agent-update-owner');
        Route::get('/view-owner/{id}', 'show')->name('agent-show-owner');
        Route::get('/delete-owner/{id}', 'destroy')->name('agent-destroy-owner');
    });

    // Agent Hostels Module
    Route::group(['prefix' => 'agent/hostel/', 'controller' => AgentHostelController::class], function () {
        Route::get('/list-hostel', 'index')->name('agent-list-hostel');
        Route::get('/add-hostel', 'create')->name('agent-create-hostel');
        Route::post('/add-hostel', 'store')->name('agent-store-hostel');
        Route::get('/edit-hostel/{id}', 'edit')->name('agent-edit-hostel');
        Route::post('/edit-hostel/{id}', 'update')->name('agent-update-hostel');
        Route::get('/view-hostel/{id}', 'show')->name('agent-show-hostel');
        Route::get('/delete-hostel/{id}', 'destroy')->name('agent-destroy-hostel');
    });

}); // End Agent Modules

// Owner Module
Route::middleware(['auth', 'web', 'prevent-back-btn', 'is-owner'])->group(function () {

    Route::group(['prefix' => '/owner', 'controller' => OwnerController::class], function () {
        Route::get('/dashboard', 'dashboard')->name('owner-dashboard');
        Route::get('/profile', 'profile')->name('owner-profile');
        Route::put('/update-profile', 'updateProfile')->name('owner-update-profile');
        Route::put('/change-password', 'changePassword')->name('owner-change-password');
        Route::get('/delete-profile-image', 'deleteProfileImage')->name('owner-delete-profile-image');
    });

    // Self Document Upload
    Route::group(['prefix' => 'owner/document/', 'controller' => DocumentController::class], function () {
        Route::get('/list-document', 'index')->name('owner-list-document');
        Route::post('/add-document', 'store')->name('owner-store-document');
        Route::get('add-edit-document', 'edit')->name('owner-edit-document');
        Route::post('/edit-document/{id}', 'update')->name('owner-update-document');
        Route::get('/view-document/{id}', 'show')->name('owner-show-document');
        Route::get('/delete-document/{id}', 'destroy')->name('owner-destroy-document');
    });

    // Owner Student Module
    Route::group(['prefix' => 'owner/student/', 'controller' => OwnerStudentController::class], function () {
        Route::get('/list-hostel', 'index')->name('owner-list-student');
        Route::get('/hostel-student/{id?}', 'onboarding')->name('owner-student-list')->middleware('check-package');
        Route::get('/pending-booking/{id?}', 'pending')->name('owner-pending-booking')->middleware('check-package');
        Route::get('/cancelled-bookings/{id?}', 'cancel')->name('owner-cancelled-booking')->middleware('check-package');
        Route::get('/history-student/{id?}', 'history')->name('owner-history-student')->middleware('check-package');
        Route::get('/add-student', 'create')->name('owner-create-student');
        Route::post('/add-student', 'store')->name('owner-store-student');
        Route::get('confirm-booking/{id}', 'booking')->name('owner-confirm-booking');
        Route::post('confirm-booking/{id}', 'confirmBooking')->name('owner-confirm-booking-post');
        Route::get('/get-room', 'getRoom')->name('owner-get-room');
        Route::get('/get-bed', 'getBed')->name('owner-get-bed');
        Route::get('/edit-student/{id}', 'edit')->name('owner-edit-student');
        Route::post('/edit-student/{id}', 'update')->name('owner-update-student');
        Route::get('/view-student/{id}', 'show')->name('owner-show-student');
        Route::get('/delete-student/{id}', 'destroy')->name('owner-destroy-student');
    });

    // Owner Hostels Module
    Route::group(['prefix' => 'owner/hostel/', 'controller' => OwnerHostelController::class], function () {
        Route::get('/list-hostel', 'index')->name('owner-list-hostel');
        Route::get('/add-hostel', 'create')->name('owner-create-hostel');
        Route::post('/add-hostel', 'store')->name('owner-store-hostel');
        Route::get('/edit-hostel/{id}', 'edit')->name('owner-edit-hostel');
        Route::post('/edit-hostel/{id}', 'update')->name('owner-update-hostel');
        Route::get('/view-hostel/{id}', 'show')->name('owner-show-hostel')->middleware('check-package');
        Route::get('/delete-hostel/{id}', 'destroy')->name('owner-destroy-hostel');
        Route::post('/delete-hostel-image/{id}', 'deleteImage')->name('owner-delete-hostel-image');
        
        
        // Popular Hostel List
        Route::get('/list-popular-hostel', 'index')->name('owner-popular-hostel');
    });

    // Owner Room Module
    Route::group(['prefix' => 'owner/room/', 'controller' => OwnerRoomController::class], function () {
        Route::get('/list-room', 'index')->name('owner-list-room');
        Route::get('/add-room/{id}', 'create')->name('owner-create-room');
        Route::post('/add-room/{id}', 'store')->name('owner-store-room');
        Route::get('/edit-room/{id}', 'edit')->name('owner-edit-room');
        Route::post('/edit-room/{id}', 'update')->name('owner-update-room');
        Route::get('/view-room/{id}', 'show')->name('owner-show-room');
        Route::get('/delete-room/{id}', 'destroy')->name('owner-destroy-room');
    });

    // Owner Bed Module
    Route::group(['prefix' => 'owner/bed/', 'controller' => OwnerBedController::class], function () {
        Route::get('/list-bed', 'index')->name('owner-list-bed');
        Route::get('/add-bed/{id}', 'create')->name('owner-create-bed');
        Route::post('/add-bed/{id}', 'store')->name('owner-store-bed');
        Route::get('/edit-bed/{id}', 'edit')->name('owner-edit-bed');
        Route::post('/edit-bed/{id}', 'update')->name('owner-update-bed');
        Route::get('/view-bed/{id}', 'show')->name('owner-show-bed');
        Route::get('/delete-bed/{id}', 'destroy')->name('owner-destroy-bed');
    });

    // Owner Enquiry Module
    Route::group(['prefix' => 'owner/enquiry/', 'controller' => OwnerEnquiryController::class], function () {
        Route::get('/list-enquiry', 'index')->name('owner-list-enquiry');
        Route::any('/view-enquiry/{id}', 'show')->name('owner-show-enquiry')->middleware('check-package');
        Route::get('/delete-enquiry/{id}', 'destroy')->name('owner-destroy-enquiry');
        Route::get('/filter-enquiry/{id?}', 'filter')->name('owner-filter-enquiry');
    });

    // Owner Review Module
    Route::group(['prefix' => 'owner/review/', 'controller' => OwnerReviewController::class], function () {
        Route::get('/list-review', 'index')->name('owner-list-review');
        Route::get('/view-review/{id}', 'show')->name('owner-show-review')->middleware('check-package');
        Route::get('/delete-review/{id}', 'destroy')->name('owner-destroy-review');
    });

    // Owner Students Document Module
    Route::group(['prefix' => 'owner/student/document/', 'controller' => OwnerDocumentController::class, 'middleware' => 'check-package'], function () {
        Route::get('/list-document', 'index')->name('owner-student-list-document');
        Route::post('/add-document/{id}', 'store')->name('owner-student-store-document');
        Route::get('add-edit-document/{id}', 'edit')->name('owner-student-edit-document');
        Route::post('/edit-document/{id}', 'update')->name('owner-student-update-document');
        Route::get('/view-document/{id}', 'show')->name('owner-student-show-document');
        Route::get('/delete-document/{id}', 'destroy')->name('owner-student-destroy-document');
    });

    // Owner Students Fee Module
    Route::group(['prefix' => 'owner/student/fee/', 'controller' => OwnerFeeController::class], function () {
        Route::get('/add-fee', 'index')->name('owner-student-fee');
        Route::get('/get-booking', 'getBooking')->name('owner-get-booking');
        Route::get('/get-student-data', 'getStudentData')->name('owner-get-student-data');
        Route::post('/get-store-student-fee', 'store')->name('owner-store-student-fee');
        Route::get('/send-notification', 'sendNotification')->name('owner-send-notification'); // Send remaining fee Notification
    });

}); // End Owner Modules

/*************************************************************************************/

Route::get('send-invoice', [InvoiceController::class, 'invoice'])->name('invoice');


// Route for handling unauthenticated requests
Route::fallback(function () {
    return response()->json(['error' => 'Unauthenticated.'], 401);
});


// optimize-clear:
Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'All Cache has been Cleared';
});

// Bring the application out of maintenance mode:
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/up', function () {
        Artisan::call('up');
        return redirect('/')->with('success', 'Application is now live.');
    });
});

Route::get('cron-run-make-available-bed', function(){
    Artisan::call('app:make-available-bed');
    return 'Bed makes Available';
});

Route::get('cron-run-check-hostel-package', function(){
    Artisan::call('app:check-hostel-package');
    return 'Checks and Updated hostel Package Information.';
});

Route::get('cron-run-check-hostel-package', function(){
    // Artisan::call('app:make-available-room');
    return 'Route Hit Successfully';
});