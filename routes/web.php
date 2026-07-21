<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/debug-file', function () {
    $path = 'document/passport_6a5f1d912d0b7.jpg';

    return response()->json([
        'exists' => Storage::disk('public')->exists($path),
        'path' => Storage::disk('public')->path($path),
        'url' => Storage::disk('public')->url($path),
    ]);
});

Route::get('/drivers', [HomeController::class, 'driver'])->name('driver');
Route::get('/', [HomeController::class, 'cargoRequest'])->name('cargo-request');
