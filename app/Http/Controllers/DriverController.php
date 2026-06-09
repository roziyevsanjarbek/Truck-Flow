<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::query()->with('documents')->get();

        return response()->json([
            'data' => $driver,
            'message' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $driver = Driver::query()->find($id);
        $driver->delete();
        return response()->json([
            'message' => 'success'
        ]);

    }
}
