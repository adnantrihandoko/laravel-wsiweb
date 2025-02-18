<?php

use App\Http\Controllers\ManagementUser;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/omah', function(){
    return "Ini halaman home";
})->name('rumah');

Route::view('/dashboard', 'dashboard');

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

Route::get('/berubah', function(){
    return "Halaman redirect";
});
Route::get('/berhasilRedirect', function(){
    return "Berhasil ke redirect";
});
Route::redirect('/berubah', '/berhasilRedirect');
Route::redirect('/berubahLagi', '/berhasilRedirect', 302);

Route::get('/pengguna/{name}', [UserController::class, 'regex'])->where('name', '[A-Z]+');
Route::get('/pengguna/{name}/{cobaGlobalConstraints}', function($name, $cobaGlobalConstrainsts){
    return "Global constraints" . $name . $cobaGlobalConstrainsts;
});

Route::view('/wong/daftar', 'user.create')->name('pendaftaran');
Route::post('/api/user/create', function (Request $request) {
    return response()->json([
        'nama' => $request->input('nama'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ]);
});

Route::resource("/rumah", ManagementUser::class);