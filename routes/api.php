<?php

use App\Http\Controllers\API\Hospital\AppointmentController;
use App\Http\Controllers\API\Hospital\HospitalRegisterController;
use App\Http\Controllers\API\Hospital\SignInController;
use App\Http\Controllers\API\Hospital\SignUpController;
use App\Http\Controllers\API\Patient\RegisterController;
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
    Route::get('/user-details/{id}', [SignInController::class, 'getUserDetails'])->name('user-details');
    Route::post('/avatar-upload', [SignUpController::class, 'uploadAvatar'])->name('user-avatar');

    //hospital user registration
    Route::get('/feature-list', [HospitalRegisterController::class, 'getFeatureList'])->name('getFeatureList');
    Route::get('/amenity-list', [HospitalRegisterController::class, 'getAmenityList'])->name('getAmenityList');

    Route::post('/hospital-register', [HospitalRegisterController::class, 'hospitalRegister'])->name('hospital-register');
    Route::post('/hospital-update/{id}', [HospitalRegisterController::class, 'hospitalUpdate'])->name('hospital-update');

    // Hospital List
    Route::get('/hospital-list', [HospitalRegisterController::class, 'getHospitalList']);
    Route::get('/hospital-show/{id?}', [HospitalRegisterController::class, 'getHospitalById']);
    Route::get('/hospital-byuser/{id?}', [HospitalRegisterController::class, 'getHospitalByUserId'])->name('hospital-byuserid');

     // appointment
    Route::post('/appointment', [AppointmentController::class, 'bookAppointment'])->name('appointment-create');
    Route::get('/appointment-list/{profileId}', [AppointmentController::class, 'getAppointmentListByHospital'])->name('appointment-list');
    Route::get('/appointment-show/{id?}', [AppointmentController::class, 'getAppointment'])->name('appointment-show');
    Route::get('/appointment-byuser/{id?}', [AppointmentController::class, 'getAppointmentByUser'])->name('appointment-byuserid');
    Route::get('/appointment-accept/{id?}', [AppointmentController::class, 'acceptAppointment'])->name('appointment-accept');
    Route::post('/appointment-cancel', [AppointmentController::class, 'cancelAppointment'])->name('appointment-cancel');
    Route::post('/appointment-completed', [AppointmentController::class, 'completedAppointment'])->name('appointment-completed');

    // Patient App Api

     // appointment
    Route::prefix('patient')->group(function () {
        Route::post('/checkmobile', [RegisterController::class, 'checkMobile'])->name('check-mobile');
        Route::post('/register', [RegisterController::class, 'signUp'])->name('register-patient');
        Route::post('/update', [RegisterController::class, 'userUpdate'])->name('patient-update');
        Route::post('/password', [RegisterController::class, 'changePassword'])->name('patient-change-password');
        Route::get('/details/{id}', [RegisterController::class, 'getUserDetails'])->name('patient-details');

        //get Appointment
        Route::get('/appointment/{userid?}', [AppointmentController::class, 'getAppointmentByPatientUser'])->name('appointment-patient');
        //upload image
        Route::post('/avatar', [RegisterController::class, 'uploadAvatar'])->name('patient-avatar');
    });


});
