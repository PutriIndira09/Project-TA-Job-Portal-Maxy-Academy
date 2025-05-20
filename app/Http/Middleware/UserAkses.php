<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // Mengatur hak akses sesuai role masing-masing
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Cek apakah akun aktif
            if ($user->status == 'tidak aktif') {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi admin untuk informasi lebih lanjut.']);
            }

            // Cek role sesuai dengan request
            if ($user->role != $role) {
                return response()->view('errors.role_denied', [], 403);
            }

            return $next($request);
        }

        return redirect()->route('login');
    }
}
