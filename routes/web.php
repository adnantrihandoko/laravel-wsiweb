<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PengalamanKerjaController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckEmailVerified;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('home', ['nama' => 'Adnan', 'pelajaran' => ['Matematika', 'Kimia', 'Biologi', 'Sejarah']]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard/employee', [EmployeeController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class);
});
Route::post('/employees/{employee}/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

Route::group(['namespace'=>'App\Http\Controllers\Frontend'], function(){
    Route::resource('home', 'HomeController')->name('get', 'home');
});

Route::get('/middleware/checkage/{age}')->middleware(CheckAge::class);


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pendidikan', PendidikanController::class);
    Route::resource('pengalaman_kerja', PengalamanKerjaController::class);
});
