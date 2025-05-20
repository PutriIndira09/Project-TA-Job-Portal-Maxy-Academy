<?php

namespace App\Http\Controllers;

use App\Models\LaporanHasilKonsultasiMaxians;
use Illuminate\Http\Request;

class LaporanHasilKonsultasiKarirMaxiansController extends Controller
{

    public function index()
    {
        // Mengembalikan view halaman laporan hasil konsultasi
        return view('pages.maxians.laporan_hasil_konsultasi_karir');
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanggal_konsultasi' => 'required|date',
            'jam_konsultasi' => 'required|date_format:H:i',
            'nama_mentor' => 'required|string|max:255',
            'komentar' => 'required|string',
            'file_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi ukuran dan jenis file
        ]);

        // Menyimpan data laporan ke database
        $laporan = new LaporanHasilKonsultasiMaxians();
        $laporan->tanggal_konsultasi = $request->tanggal_konsultasi;
        $laporan->jam_konsultasi = $request->jam_konsultasi;
        $laporan->nama_mentor = $request->nama_mentor;
        $laporan->komentar = $request->komentar;

        // Handle file upload
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');

            // Tentukan nama file baru dan lokasi penyimpanan di folder public/images
            $fileName = time() . '-' . $file->getClientOriginalName(); // Menambahkan timestamp untuk menghindari duplikasi
            $destinationPath = public_path('images'); // Tentukan folder tujuan di folder public

            // Pindahkan file ke folder public/images
            $file->move($destinationPath, $fileName);

            // Simpan path file relatif ke dalam database
            $laporan->file_bukti = 'images/' . $fileName;
        }
        // Simpan laporan
        $laporan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan berhasil disimpan!');
    }
}
