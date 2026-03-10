<?php

use App\Http\Controllers\api\ChargingStationController;
use App\Http\Controllers\api\ReservationController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ChargingSessionController;
use App\Http\Controllers\api\ConnectorTypeController;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/stations/search', [ChargingStationController::class, 'search']);
Route::get('/stations', [ChargingStationController::class, 'index']);
Route::get('/stations/{chargingStation}', [ChargingStationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('reservations', ReservationController::class);
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update']);
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel']);

    Route::get('/sessions', [ChargingSessionController::class, 'index']);
    Route::post('/sessions', [ChargingSessionController::class, 'store']);
    Route::get('/sessions/{chargingSession}', [ChargingSessionController::class, 'show']);
    Route::put('/sessions/{chargingSession}', [ChargingSessionController::class, 'update']);
    Route::delete('/sessions/{chargingSession}', [ChargingSessionController::class, 'destroy']);

    Route::middleware('can:admin-only')->group(function () {
        Route::post('/stations', [ChargingStationController::class, 'store']);
        Route::put('/stations/{chargingStation}', [ChargingStationController::class, 'update']);
        Route::get('/stations/stats', [ChargingStationController::class, 'getStats']);
        Route::delete('/stations/{chargingStation}', [ChargingStationController::class, 'destroy']);
        Route::apiResource('connector-types', ConnectorTypeController::class);
    });
});
