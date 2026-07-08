<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function driver()
    {
        return view('drivers');
    }

    public function cargoRequest()
    {
        return view('cargo-request.index');
    }
}
