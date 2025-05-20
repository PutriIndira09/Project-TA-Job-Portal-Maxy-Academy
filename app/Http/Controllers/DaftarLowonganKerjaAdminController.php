<?php

namespace App\Http\Controllers;

use App\Models\DaftarLowonganKerjaPerusahaan;
use Illuminate\Http\Request;

class DaftarLowonganKerjaAdminController extends Controller
{
    // Menampilkan daftar lowongan kerja untuk admin
    public function index()
    {
        try {
            $lowongans = DaftarLowonganKerjaPerusahaan::with('kategoriPekerjaan')
                            ->orderBy('created_at', 'desc')
                            ->get();
            return view('pages.admin.daftar_lowongan_kerja', compact('lowongans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data lowongan kerja: ' . $e->getMessage());
        }
    }
}