<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $request->validate(['email' => 'required|string', 'password' => 'required|string|min:6']);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return Redirect::route('dashboard');
        }

        return Redirect::route('login')->with(['error' => 'Email/Password Salah!']);
    }

    function register(Request $request)
    {
        // Mendefinisikan aturan validasi secara eksplisit
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'username' => 'required|string|unique:users,username|min:6',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed:password_confirmation|min:6',
        ]);

        // Membuat pengguna baru jika data valid
        User::create([
            'name' => $validatedData['nama'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return Redirect::route('login')->with('success', 'Akun berhasil dibuat');

    }
}
