<?php

// role maxians untuk mengajukan jadwal konsultasi karir yang disediakan oleh mentor
namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class JadwalKonsultasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'pertanyaan' => 'required|string|max:255',
        ]);

        try {
            // Simpan data ke database
            $jadwal = AturJadwalKonsultasi::create([
                'maxians' => auth()->user()->name, // Asumsi user sudah login
                'tanggal' => $request->tanggal,
                'jam' => '00:00:00', // Default, bisa diubah sesuai kebutuhan
                'pertanyaan' => $request->pertanyaan,
            ]);

            // Mengirimkan data tanggal dan pertanyaan ke view melalui session flash
            session()->flash('tanggal', $jadwal->tanggal);
            session()->flash('pertanyaan', $jadwal->pertanyaan);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal konsultasi karir berhasil dikirim! Silahkan tunggu informasi selanjutnya melalui email.',
                'redirect' => route('pengajuan_jadwal_konsultasi_karir')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengajukan jadwal: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function showPengajuanJadwal($id_jadwal_konsultasi)
    {
        $jadwal = AturJadwalKonsultasi::find($id_jadwal_konsultasi); // Ambil data jadwal dari database berdasarkan ID
        return view('pages.maxians.pengajuan_jadwal_konsultasi_karir', compact('jadwal'));
    }

    public function showRiwayatPengajuan()
    {
        // Mengambil semua data pengajuan jadwal konsultasi dari tabel
        $riwayatJadwal = AturJadwalKonsultasi::all();

        // Mengirimkan data ke view
        return view('pages.maxians.riwayat_pengajuan_jadwal_konsultasi', compact('riwayatJadwal'));
    }
}
