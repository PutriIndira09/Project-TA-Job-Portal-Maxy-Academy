<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\DaftarLowonganKerjaPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    public function status()
    {
        // Ambil semua lamaran pengguna yang sedang login
        $lamarans = Lamaran::with('lowongan')  // Mengambil data lowongan terkait lamaran
            ->where('user_id', Auth::id())    // Filter berdasarkan pengguna yang sedang login
            ->get();

        return view('pages.maxians.status_lamaran_kerja', compact('lamarans'));
    }
}
