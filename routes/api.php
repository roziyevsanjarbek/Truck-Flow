<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargoRequestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/drivers', [DriverController::class, 'index']);
    Route::delete('/drivers/{driverId}', [DriverController::class, 'destroy']);


    Route::get('/drivers/cargo-requests', [CargoRequestController::class, 'index']);
    Route::get('/drivers/cargo-requests/{id}/lottery-ticket', [CargoRequestController::class, 'getLotteryTicket']);
    Route::get('/drivers/cargo-requests', [CargoRequestController::class, 'search']);
    Route::get('/drivers/cargo-requests/statistics', [CargoRequestController::class, 'statistics']);
    Route::post('/drivers/cargo-requests/{cargoRequestId}/approve', [CargoRequestController::class, 'approve']);
    Route::post('/drivers/cargo-requests/{cargoRequestId}/reject', [CargoRequestController::class, 'reject']);

});
