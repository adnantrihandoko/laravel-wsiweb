<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/home', function(){
    return "Ini halaman home";
})->name('rumah');

Route::get('/user/{id}', [UserController::class, 'showID']);

Route::get('/user/{id?}', [UserController::class, 'showID']);

Route::get('/', function(){
    return view("welcome");
})->name("dashboard");

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', function(){
        return "Ini Dashboard Admin";
    });
});