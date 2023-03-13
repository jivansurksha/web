<?php

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
    Route::get('/logout', [SignInController::class, 'logout'])->name('logout');

});
