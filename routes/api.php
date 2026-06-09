<?php

use App\Http\Controllers\CargoRequestController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/telegram/webhook', [TelegramController::class, 'webhook']);


Route::get('/drivers', [DriverController::class, 'index']);
Route::delete('/drivers/{driverId}', [DriverController::class, 'destroy']);

Route::get('/drivers/cargo-requests', [CargoRequestController::class, 'index']);
