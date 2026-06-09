<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/cargo-requests', [HomeController::class, 'cargoRequest'])->name('cargo-request');
