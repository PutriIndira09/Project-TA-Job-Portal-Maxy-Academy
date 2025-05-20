<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PelamarController extends Controller
{

    public function index()
    {
        try {
            // Ambil semua data pelamar dengan urutan terbaru
            $lamarans = Lamaran::with('lowongan')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('pages.admin.daftar_pelamar_masuk', compact('lamarans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pelamar.' . $e->getMessage());
        }
    }

    // Menampilkan daftar pelamar yang masuk
    public function daftarPelamarMasuk()
    {
        try {
            // Ambil semua data pelamar tanpa memfilter status_lamaran
            $lamarans = Lamaran::with('lowongan')
                ->orderBy('created_at', 'desc')->get();

            return view('pages.perusahaan.daftar_pelamar_masuk', compact('lamarans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data pelamar.' . $e->getMessage());
        }
    }

    // Update status lamaran
    public function updateStatusLamaran(Request $request, $id_lamaran)
    {
        // Proses pembaruan status
        $lamaran = Lamaran::findOrFail($id_lamaran);

        // Lakukan pembaruan status
        $lamaran->status_lamaran = $request->status;
        $lamaran->updated_at = now();
        $lamaran->save();

        return redirect()->route('update_status_pelamar_masuk')->with('success', 'Status updated successfully');
    }

    public function hitungTotalLamaran()
    {
        try {
            $totalLamaran = Lamaran::count();
            return $totalLamaran;
        } catch (\Exception $e) {
            Log::error('Gagal menghitung total lamaran: ' . $e->getMessage());
            return 0;
        }
    }


    // public function updateStatusLamaran(Request $request, $id_lamaran)
    // {
    //     $lamaran = Lamaran::findOrFail($id_lamaran);
    //     $lamaran->status_lamaran = $request->status_lamaran;
    //     $lamaran->save();

    //     return redirect()->route('update_status_pelamar')->with('success', 'Status updated successfully');
    // }
}
