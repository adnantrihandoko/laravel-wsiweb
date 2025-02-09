<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class UserController
{
    public function showID(string $id = "Tidak Ada"){
        return "ID Adnan = ".$id;
    }

    public function regex(string $id = "Tidak Ada"){
        return "Regex routes = ".$id;
    }
}