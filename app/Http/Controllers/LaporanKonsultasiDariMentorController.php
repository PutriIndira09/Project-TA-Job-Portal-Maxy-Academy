<?php

namespace App\Http\Controllers;

use App\Models\LaporanHasilKonsultasiMentor;
use Illuminate\Http\Request;

class LaporanKonsultasiDariMentorController extends Controller
{
    public function index()
    {
        $laporanKonsultasi = LaporanHasilKonsultasiMentor::orderBy('created_at', 'desc')->get();
        return view('pages.admin.laporan_hasil_konsultasi_karir_mentor', compact('laporanKonsultasi'));
    }
}
