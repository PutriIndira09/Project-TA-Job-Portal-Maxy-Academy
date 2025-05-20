<?php

//Controller khusus role maxians untuk menampilkan jadwal konsultasi karir dari mentor
namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ViewJadwalKonsultasiKarirMentorController extends Controller
{
    /**
     * Menampilkan daftar jadwal konsultasi karir mentor
     */
    // ViewJadwalKonsultasiKarirMentorController.php
    public function index()
    {
        // Ambil tanggal unik dari jadwal yang memiliki tanggal valid
        $dates = AturJadwalKonsultasi::whereNotNull('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get()
            ->unique('tanggal')
            ->pluck('tanggal');

        return view('pages.maxians.daftar_jadwal_konsultasi_karir', [
            'dates' => $dates
        ]);
    }

    /**
     * API untuk mendapatkan jadwal berdasarkan tanggal (untuk AJAX)
     */
    public function getJadwalByTanggal(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);

        $jadwal = AturJadwalKonsultasi::where('tanggal', $request->tanggal)
            ->where('status', 'available')
            ->orderBy('jam', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $jadwal->map(function ($item) {
                return [
                    'jam' => Carbon::parse($item->jam)->format('H:i') . ' WIB',
                    'raw_jam' => $item->jam
                ];
            })
        ]);
    }
}
