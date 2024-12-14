<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    // View of dashboard

    public function index(Request $request) {

        return view('dashboard');

    }

}
