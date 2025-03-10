<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PendidikanController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Backend\PengalamanKerjaController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UploadFilesController;
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

Route::get('session/create', [SessionController::class, 'create']);
Route::get('session/show', [SessionController::class, 'show']);
Route::get('session/delete', [SessionController::class, 'delete']);
Route::get('pegawai/{nama}', [PegawaiController::class, 'index']);
Route::get('formulir', [PegawaiController::class, 'formulir']);
Route::post('formulir/proses', [PegawaiController::class, 'proses']);

Route::get('validasi/formulir', [PegawaiController::class, 'indexValidasi']);
Route::post('validasi/proses', [PegawaiController::class, 'prosesValidasi']);

Route::get('cobaerror/{nama?}', [CobaController::class, 'index']);

Route::get('upload', [UploadFilesController::class, 'index']);
Route::post('upload/proses', [UploadFilesController::class, 'proses'])->name('upload.proses');

Route::get('upload/resize', [UploadFilesController::class, 'indexResize']);
Route::post('upload/resize/proses', [UploadFilesController::class, 'resize_upload'])->name('upload.resize');