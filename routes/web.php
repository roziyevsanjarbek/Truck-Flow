<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/', [HomeController::class, 'cargoRequest'])->name('cargo-request');
