<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Memeriksa apakah pengguna terautentikasi dan emailnya terverifikasi
        if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
            // Jika tidak, arahkan ke halaman verifikasi dengan pesan
            return Redirect::route('home');
        }

        // Melanjutkan ke middleware berikutnya atau controller
        return $next($request);
    }
}
