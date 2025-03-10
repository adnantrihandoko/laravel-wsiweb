<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    function index(Request $request){
        if($request->segment(2) !== null){
            echo $request->segment(2);
        } else {
            abort(403);
        }
    }
}
