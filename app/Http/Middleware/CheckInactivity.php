<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CheckInactivity
{
    public function handle(Request $request, Closure $next)
    {
        // Skip middleware for login route
        if ($request->is('login') || $request->is('register')) {
            return $next($request);
        }

        // Periode inaktivitas dalam menit (bisa disesuaikan)
        $inactivityTimeout = 20; // 20 menit

        if (Auth::check()) {
            $lastActivity = session('last_activity');

            // Jika melebihi timeout atau belum ada session last_activity dan langsung mengarah ke logout
            if (!$lastActivity || (Carbon::now()->diffInMinutes(Carbon::parse($lastActivity)) >= $inactivityTimeout)) {
                Auth::logout();
                session()->flush();
                return redirect('/login')->with('message', 'Anda telah logout karena tidak ada aktivitas selama ' . $inactivityTimeout . ' menit.');
            }

            // Update waktu untuk aktivitas terakhir di sistem
            session(['last_activity' => Carbon::now()]);
        }

        return $next($request);
    }
}
