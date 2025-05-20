<?php

namespace App\Http\Controllers;

use App\Models\LaporanHasilKonsultasiMaxians;
use Illuminate\Http\Request;

class LaporanKonsultasiDariMaxiansController extends Controller
{
    // Menampilkan daftar laporan yang sudah diupload oleh Maxians
    public function index()
    {
        // Ambil semua data laporan hasil konsultasi yang disimpan oleh Maxians
        $laporanKonsultasi = LaporanHasilKonsultasiMaxians::orderBy('created_at', 'desc')
            ->get(); // Ambil semua laporan yang ada

        // Kirim data laporan ke view admin
        return view('pages.admin.laporan_hasil_konsultasi_karir_maxians', compact('laporanKonsultasi'));
    }
}
