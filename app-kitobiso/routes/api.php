<?php

use App\Models\Funding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AuthController;
use App\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/menu', function(Request $request) {
    return response()->json(['Home', 'Profile', 'About', 'Contact Us']);
});

Route::get('/donatur', function(Request $request) {
    return response()->json([
        [
            'id' => 1,
            'nama' => 'Nur Rachmat',
        ],
        [
            'id' => 2,
            'nama' => 'Fatimah',
        ],
        [
            'id' => 3,
            'nama' => 'Chandra',
        ]
    ]);
});
// method in routes: get, post, put, patch, delete


// Buat route menuju url /donatur dengan method get
// buat response berupa data json seperti berikut
/*
[
    {
        "id": 1,
        "nama": "Nur Rachmat",
    },
    {
        "id": 2,
        "nama": "Fatimah",
    },
    {
        "id": 3,
        "nama": "Rahmat",
    }
]
*/

Route::group(['middleware' => 'auth:sanctum'], function() {
   // API CRUD Funding
    Route::get('/fundings', [FundingController::class, 'index']); // get all data
    Route::post('/fundings', [FundingController::class, 'store']); // create new data
    Route::get('/fundings/{id}', [FundingController::class, 'show']); // get data by id
    Route::put('/fundings/{id}', [FundingController::class, 'update']); // update data by id
    Route::delete('/fundings/{id}', [FundingController::class, 'destroy']); // delete data by id

    // API CRUD Donation
    // Route::get('/donations', [DonationController::class, 'index']); // get all data
    Route::apiResource('donations', DonationController::class); // create new data
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);