<?php

namespace App\Http\Controllers;

use App\Models\TesSeleksiPelamar;
use Illuminate\Http\Request;

class TesSeleksiPelamarController extends Controller
{
    public function index()
    {
        // Mengambil semua data tes seleksi pelamar
        $tesSeleksi = TesSeleksiPelamar::orderBy('created_at', 'desc')->get(); //$tesSeleksi diambil dari compact(), compact() diambil dari @foreach tes_seleksi_pelamar.blade.php
        // Debugging, memastikan variabel $tesSeleksi berisi data yang benar
        // dd($tesSeleksi);
        return view('pages.perusahaan.tes_seleksi_pelamar', compact('tesSeleksi'));
    }

    // Menampilkan halaman form tambah tes seleksi pelamar
    public function create()
    {
        return view('pages.perusahaan.add_tes_seleksi_pelamar'); // Tampilkan form tambah tes seleksi
    }

    // app/Http/Controllers/TagLowonganKerjaController.php

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tes' => 'required|string|max:255',
        ], [
            'nama_tes.required' => 'Nama tes seleksi wajib diisi.',
            'nama_tes.string' => 'Nama tes seleksi harus berupa teks.',
            'nama_tes.max' => 'Nama tes seleksi tidak boleh lebih dari 255 karakter.',
        ]);

        try {
            // Simpan data tes seleksi ke database
            TesSeleksiPelamar::create([
                'nama_tes' => $request->nama_tes,
            ]);

            // Redirect ke halaman tes_seleksi_pelamar dengan pesan sukses
            return redirect()->route('tes_seleksi_pelamar')->with('success', 'Tes seleksi pelamar berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat menyimpan, redirect dengan pesan error
            return redirect()->route('tes_seleksi_pelamar')->with('error', 'Gagal menambahkan tes seleksi pelamar.'  . $e->getMessage());
        }
    }

    // Menampilkan form untuk edit tag lowongan kerja
    public function edit($id_tes)
    {
        $tesSeleksi  = TesSeleksiPelamar::findOrFail($id_tes); // Ambil data tag berdasarkan ID
        return view('pages.perusahaan.edit_tes_seleksi_pelamar', compact('tesSeleksi')); // Kirim data tag ke view
    }

    // Mengupdate tag lowongan kerja
    public function update(Request $request, $id_tes)
    {
        $validated = $request->validate([
            'nama_tes' => 'required|string|max:255',
        ]);

        try {
            // Cari data tag berdasarkan ID
            $tesSeleksi  = TesSeleksiPelamar::findOrFail($id_tes);

            // Update data tag lowongan kerja
            $tesSeleksi->nama_tes = $request->nama_tes;
            $tesSeleksi->save(); // Simpan perubahan

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('tes_seleksi_pelamar')->with('success', 'Tes seleksi pelamar berhasil diupdate!');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->route('tes_seleksi_pelamar')->with('error', 'Gagal mengupdate tes seleksi pelamar coba lagi!');
        }
    }

    // app/Http/Controllers/TagLowonganKerjaController.php

    public function destroy($id_tes)
    {
        try {
            $tesSeleksi  = TesSeleksiPelamar::findOrFail($id_tes); // Mencari data berdasarkan ID
            $tesSeleksi->delete(); // Menghapus data tag lowongan kerja

            // Redirect ke halaman tag_lowongan_kerja dengan pesan sukses
            return redirect()->route('tes_seleksi_pelamar')->with('success', 'Tes seleksi pelamar berhasil dihapus!');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->route('tes_seleksi_pelamar')->with('error', 'Gagal menghapus tes seleksi pelamar. Coba lagi!');
        }
    }
}
