<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\TableNumber\TableNumberController;
use App\Http\Controllers\Reservations\ReservationsController;
use App\Http\Controllers\ReportReservations\ReportReservationsController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', [Authentication::class, 'register']);
Route::post('login', [Authentication::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    // Master : table Exis number
    // Route::get('tableNumber/getDataAll', [TableNumberController::class, 'getDataAll']);
    Route::get('tableNumber/getDataSelectAll', [TableNumberController::class, 'getDataSelectAll']);
    Route::post('tableNumber/Insert', [TableNumberController::class, 'Insert']);
    Route::post('tableNumber/Update', [TableNumberController::class, 'Update']);
    Route::post('tableNumber/CheckField', [TableNumberController::class, 'CheckField']);
    Route::delete('tableNumber/destroy', [TableNumberController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Reservations 
    Route::get('reservations/getDataSelectAll', [ReservationsController::class, 'getDataSelectAll']);
    Route::post('reservations/Insert', [ReservationsController::class, 'Insert']);
    Route::post('reservations/Update', [ReservationsController::class, 'Update']);
    Route::post('reservations/CheckField', [ReservationsController::class, 'CheckField']);
    Route::delete('reservations/destroyOrder', [ReservationsController::class, 'destroyOrder']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Report Reservations 
    Route::get('reportReservations/getDataSelectAll', [ReportReservationsController::class, 'getDataSelectAll']);
});