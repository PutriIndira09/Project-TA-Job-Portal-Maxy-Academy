<?php

namespace App\Http\Controllers;

use App\Models\DaftarLowonganKerjaPerusahaan;
use App\Models\KategoriPekerjaan;
use App\Models\lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarLowonganKerjaMaxiansController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Query dasar untuk lowongan kerja aktif
            $query = DaftarLowonganKerjaPerusahaan::where('is_active', true)
                ->with('kategoriPekerjaan');

            // Filter berdasarkan kategori jika dipilih
            if ($request->filled('id_kategori')) {
                $query->whereHas('kategoriPekerjaan', function ($q) use ($request) {
                    $q->where('id_kategori', $request->id_kategori);
                });
            }

            // Filter berdasarkan pencarian alamat
            if ($request->filled('alamat')) {
                $searchTerm = $request->alamat;
                $query->where('alamat', 'LIKE', '%' . $searchTerm . '%');
            }


            // Filter berdasarkan jenis kontrak
            if ($request->has('jenis_kontrak')) {
                $jenisKontrak = $request->input('jenis_kontrak');
                $query->whereIn('jenis_kontrak', $jenisKontrak);
            }

            // Filter berdasarkan lokasi penempatan (WFH, WFO, Hybrid)
            if ($request->has('lokasi')) {
                $lokasi = $request->input('lokasi');
                $query->whereIn('lokasi', $lokasi);
            }

            // Sorting berdasarkan yang terbaru jika dipilih
            if ($request->input('sort') === 'baru') {
                $query->orderBy('created_at', 'desc');
            } else {
                // Default sorting (relevan)
                $query->orderBy('created_at', 'asc');
            }

            // Ambil data
            $lowongans = $query->get();
            $kategoris = KategoriPekerjaan::all();

            // Tambahkan parameter filter ke view untuk menandai checkbox yang aktif
            $activeFilters = [
                'id_kategori' => $request->input('id_kategori', ''),
                'jenis_kontrak' => $request->input('jenis_kontrak', []),
                'lokasi' => $request->input('lokasi', []),
                'sort' => $request->input('sort', 'relevan')
            ];


            // Pilih view berdasarkan parameter query 'view'
            $view = $request->query('view', 'daftar_lowongan_kerja'); // default ke daftar_lowongan_kerja

            if ($view === 'index') {
                return view('pages.maxians.index', compact('lowongans', 'kategoris', 'activeFilters'));
            }

            // Default view
            return view('pages.maxians.daftar_lowongan_kerja', compact('lowongans', 'kategoris', 'activeFilters'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data lowongan kerja.' . $e->getMessage());
        }
    }

    public function show($id_lowongan)
    {
        try {
            $lowongan = DaftarLowonganKerjaPerusahaan::with('kategoriPekerjaan')
                ->findOrFail($id_lowongan);
            return view('pages.maxians.detail_lowongan_kerja', compact('lowongan'));
        } catch (\Exception $e) {
            return redirect()->route('daftar_lowongan_kerja')
                ->with('error', 'Lowongan kerja tidak ditemukan.');
        }
    }

    public function melamar(Request $request, $id_lowongan)
    {
        // Cek apakah lowongan tersebut sudah dilamar
        $existingLamaran = Lamaran::where('id_lowongan', $id_lowongan)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingLamaran) {
            return redirect()->route('detail_lowongan_kerja', $id_lowongan)
                ->with('error', 'Anda sudah melamar pekerjaan ini.');
        }

        // Simpan lamaran
        Lamaran::create([
            'id_lowongan' => $id_lowongan,
            'user_id' => Auth::id(),
            'status_lamaran' => 'diproses',
        ]);

        return redirect()->route('detail_lowongan_kerja', $id_lowongan)
            ->with('success', 'Lamaran Anda telah berhasil diajukan!');
    }
}
