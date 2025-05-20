<?php

//Untuk role admin yang datanya diambil dari role mentor

namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DaftarPenjadwalanUlangKonsultasiKarirController extends Controller
{
    public function index()
    {
        $jadwalKonsultasi = AturJadwalKonsultasi::orderBy('tanggal_baru', 'asc')
            ->orderBy('jam_baru', 'asc')
            ->get();

        return view('pages.admin.daftar_penjadwalan_ulang_konsultasi_karir', compact('jadwalKonsultasi'));
    }
}
