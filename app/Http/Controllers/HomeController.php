<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function driver()
    {
        return view('drivers');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function cargoRequest()
    {
        return view('cargo-request.index');
    }

    public function login()
    {
        return view('login.login');
    }
}
