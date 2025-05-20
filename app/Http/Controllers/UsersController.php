<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AktivasiAkun;

class UsersController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function admin()
    {
        return view('auth.login');
    }

    public function perusahaan()
    {
        return view('auth.login');
    }

    public function mentor()
    {
        return view('auth.login');
    }

    public function maxians()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);

        $user = AktivasiAkun::where('email', $request->email)->first();

        if ($user && $user->status == 'tidak aktif') {
            return redirect()->route('login')->withErrors(['email' => 'Akun Anda telah dinonaktifkan. Silakan hubungi admin.']);
        }

        // Pastikan login jika valid
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Menyimpan role dalam session setelah login
            session(['role' => Auth::user()->role]);

            $role = Auth::user()->role;

            // Memastikan rute yang sesuai berdasarkan role pengguna yang login
            switch ($role) {
                case 'company relationship':
                    return redirect()->route('dasbor_admin');
                case 'perusahaan':
                    return redirect()->route('dasbor_perusahaan');
                case 'mentor':
                    return redirect()->route('dasbor_mentor');
                case 'maxians':
                    return redirect()->route('home');
                default:
                    return redirect('/'); // Redirect default
            }
        } else {
            return redirect()->route('login')->withErrors(['email' => 'Email atau password salah.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}
