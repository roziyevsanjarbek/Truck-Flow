<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'login'])->name('login');

Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/cargo-requests', [HomeController::class, 'cargoRequest'])->name('cargo-requests');
