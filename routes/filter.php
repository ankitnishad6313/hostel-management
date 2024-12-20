<?php

use App\Http\Controllers\API\FilterHostelController;


Route::group(['prefix' => '/hostels', 'controller' => FilterHostelController::class], function () {
    Route::post('filter-hostel', 'filterHostel');
});