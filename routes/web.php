<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ManagementUser;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('home', ['nama' => 'Adnan', 'pelajaran' => ['Matematika', 'Kimia', 'Biologi', 'Sejarah']]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class);
});
Route::post('/employees/{employee}/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

Route::group([], function(){
    Route::resource('home', HomeController::class);
});

Route::group(['namespace' => 'App\Http\Controllers\Backend'], function(){
    Route::resource('dashboard', 'DashboardController');
});