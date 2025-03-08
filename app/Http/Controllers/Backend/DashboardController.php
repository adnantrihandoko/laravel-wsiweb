<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

class DashboardController
{
    public function index(){
        return view('backend.dashboard');
    }
}
