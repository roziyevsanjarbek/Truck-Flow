<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'login'])->name('login');

Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/cargo-requests', [HomeController::class, 'cargoRequest'])->name('cargo-requests');
Route::get('/approved-cargo-requests', [HomeController::class, 'approvedCargoRequest'])->name('approved-cargo-requests');
Route::get('/rejected-cargo-requests', [HomeController::class, 'rejectedCargoRequest'])->name('rejected-cargo-requests');


//Route::view('/cargo-requests', 'cargo-request.index');
//Route::view('/approved-requests', 'cargo-request.approved');
//Route::view('/rejected-requests', 'cargo-request.rejected');
