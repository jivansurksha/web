<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\UsersController;
use App\Http\Controllers\Admin\Commission\CommissionController;
use App\Http\Controllers\Admin\Feature\AmenityController;
use App\Http\Controllers\Admin\Feature\FeatureController;
use App\Http\Controllers\Admin\Hospital\HospitalOverviewController;
use App\Http\Controllers\Admin\Hospital\HospitalProfileController;
use App\Http\Controllers\Admin\Hospital\HospitalRegisterController;
use App\Http\Controllers\Admin\Hospital\HospitalUserController;
use App\Http\Controllers\Landing\HomeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
// Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
////////////////////////////////////////////////////////////////////////////////////////
///*******************************ADMIN*****************////////////////////////////////
//Auth
Route::get('/admin', [AuthController::class, 'index'])->name('login-user');
Route::post('/login', [AuthController::class, 'login'])->name('/login');

Route::group(['prefix' => 'admin', 'middleware' => 'AuthUser'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('/logout');

    Route::prefix('user')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('user-list');
        Route::get('/add', [UsersController::class, 'register'])->name('register-user');
        Route::post('/save', [UsersController::class, 'create'])->name('register-user-save');
        Route::get('/edit/{id?}', [UsersController::class, 'edit'])->name('edit');
        Route::patch('/update', [UsersController::class, 'update'])->name('update');
    });

    //delete record
    Route::delete('/record_delete',[Controller::class,'recordDelete']);
    //Feature
    Route::prefix('feature')->group(function () {
        Route::get('/', [FeatureController::class, 'index'])->name('feature-list');
        Route::get('/add', [FeatureController::class, 'feature'])->name('feature-add');
        Route::post('/save', [FeatureController::class, 'create'])->name('feature-save');
        Route::get('/edit/{id?}', [FeatureController::class, 'edit'])->name('feature-edit');
        Route::patch('/update', [FeatureController::class, 'update'])->name('feature-update');
        Route::get('/delete/{id?}', [FeatureController::class, 'delete'])->name('feature-delete');
    });

    //Amenity
    Route::prefix('amenity')->group(function () {
        Route::get('/', [AmenityController::class, 'index'])->name('amenity-list');
        Route::get('/add', [AmenityController::class, 'amenity'])->name('amenity-add');
        Route::post('/save', [AmenityController::class, 'create'])->name('amenity-save');
        Route::get('/edit/{id?}', [AmenityController::class, 'edit'])->name('amenity-edit');
        Route::patch('/update', [AmenityController::class, 'update'])->name('amenity-update');
        Route::get('/delete/{id?}', [AmenityController::class, 'delete'])->name('amenity-delete');
    });

    //hospital
    Route::prefix('hospital')->group(function () {
        Route::get('/', [HospitalRegisterController::class, 'index'])->name('hospital-list');
        Route::get('/add', [HospitalRegisterController::class, 'hospital'])->name('hospital-add');
        // Route::get('/list', [HospitalRegisterController::class, 'index'])->name('hospital-list');
        Route::post('/save', [HospitalRegisterController::class, 'create'])->name('hospital-save');
        Route::get('/delete/{id?}', [HospitalRegisterController::class, 'delete'])->name('hospital-delete');
        Route::get('/activate/{id?}', [HospitalRegisterController::class, 'activateHospital'])->name('hospital-activate');
        Route::get('/deactivate/{id?}', [HospitalRegisterController::class, 'deactivateHospital'])->name('hospital-deactivate');
        // Route::get('/edit/{id?}', [HospitalUserController::class, 'edit'])->name('hospital-user-edit');
        // Route::patch('/update', [HospitalUserController::class, 'update'])->name('hospital-user-update');

    });

    //profile

    Route::prefix('profile')->group(function () {
        Route::get('/', [HospitalProfileController::class, 'index'])->name('profile');
        Route::get('/add', [HospitalProfileController::class, 'profile'])->name('hospital-profile');
        Route::post('/save', [HospitalProfileController::class, 'create'])->name('hospital-profile-save');
        Route::get('/edit/{id?}', [HospitalProfileController::class, 'edit'])->name('profile-edit');
        Route::patch('/update', [HospitalProfileController::class, 'update'])->name('profile-update');

    });

      //Commssion
      Route::prefix('commission')->group(function () {
        Route::get('/', [CommissionController::class, 'index'])->name('commission-list');
        Route::get('/add', [CommissionController::class, 'commission'])->name('commission-add');
        Route::post('/save', [CommissionController::class, 'create'])->name('commission-save');
        Route::get('/edit/{id?}', [CommissionController::class, 'edit'])->name('commission-edit');
        Route::patch('/update', [CommissionController::class, 'update'])->name('commission-update');
        Route::get('/delete/{id?}', [CommissionController::class, 'delete'])->name('commission-delete');
    });

});


////////////////////////////////////////////////////////////////////////////////////////
///*******************************LANDING*****************////////////////////////////////

Route::get('/', [HomeController::class, 'index'])->name('/');



