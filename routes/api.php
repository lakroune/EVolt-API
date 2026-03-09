<?php

use App\Http\Controllers\api\ChargingStationController;
use App\Http\Controllers\api\ReservationController as ApiReservationController;
use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/stations/search', [ChargingStationController::class, 'search']);

Route::get('/stations', [ChargingStationController::class, 'index']);
Route::get('/stations/{chargingStation}', [ChargingStationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('reservations', ApiReservationController::class);

    Route::middleware('can:admin-only')->group(function () {
        Route::post('/stations', [ChargingStationController::class, 'store']);
        Route::put('/stations/{chargingStation}', [ChargingStationController::class, 'update']);
        Route::delete('/stations/{chargingStation}', [ChargingStationController::class, 'destroy']);
    });
});
