<?php

namespace App\Http\Controllers;

use App\Models\CargoRequest;
use Illuminate\Http\Request;

class CargoRequestController extends Controller
{
    public function index()
    {
        $cargoRequest = CargoRequest::with([
            'fromCountry',
            'toCountry',
            'fromCity',
            'toCity',
            'driver',
            'files' => function($query) {
            $query->where('type', 'cmr');
            },
        ])->get();

        return response()->json([
            'data' => $cargoRequest,
            'message' => 'success'
        ]);
    }
}
