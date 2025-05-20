<?php

//Untuk role admin yang datanya diambil dari role mentor

namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DaftarJadwalKonsultasiKarirController extends Controller
{
    public function index()
    {
        $jadwalKonsultasi = AturJadwalKonsultasi::orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('pages.admin.daftar_jadwal_konsultasi_karir', compact('jadwalKonsultasi'));
    }
}
