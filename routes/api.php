<?php

use App\Http\Controllers\API\Hospital\HospitalRegisterController;
use App\Http\Controllers\API\Hospital\SignInController;
use App\Http\Controllers\API\Hospital\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function ($router) {

    Route::get('/state-list', [SignUpController::class, 'getState'])->name('getState');
    Route::get('/city-list/{id?}', [SignUpController::class, 'getCity'])->name('getCity');

    //hospital user registration
    Route::post('/signUp', [SignUpController::class, 'signUp'])->name('signUp');
    Route::post('/sigin', [SignInController::class, 'signIn'])->name('signIn');
    Route::post('/user-update', [SignUpController::class, 'userUpdate'])->name('user-update');
    Route::post('/change-password', [SignUpController::class, 'changePassword'])->name('change-password');
    Route::get('/logout', [SignInController::class, 'logout'])->name('logout');

    //hospital user registration
    Route::get('/feature-list', [HospitalRegisterController::class, 'getFeatureList'])->name('getFeatureList');
    Route::get('/amenity-list', [HospitalRegisterController::class, 'getAmenityList'])->name('getAmenityList');

    Route::post('/hospital-register', [HospitalRegisterController::class, 'hospitalRegister'])->name('hospital-register');
    Route::post('/hospital-update/{id}', [HospitalRegisterController::class, 'hospitalUpdate'])->name('hospital-update');

    // Hospital List
    Route::get('/hospital-list', [HospitalRegisterController::class, 'getHospitalList'])->name('hospital-list');
    Route::get('/hospital-show/{id?}', [HospitalRegisterController::class, 'getHospitalById'])->name('hospital-show');
    Route::get('/hospital-byuser/{id?}', [HospitalRegisterController::class, 'getHospitalByUserId'])->name('hospital-byuserid');

});
