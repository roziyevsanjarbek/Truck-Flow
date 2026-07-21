<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/debug-file', function () {
    return Storage::disk('public')->response('document/passport_6a5f1d912d0b7.jpg');
});

Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/', [HomeController::class, 'cargoRequest'])->name('cargo-request');
