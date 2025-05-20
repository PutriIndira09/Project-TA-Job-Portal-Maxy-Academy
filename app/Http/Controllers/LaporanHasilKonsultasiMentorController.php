<?php
// Laporan Hasil Konsultasi Role Mentor

namespace App\Http\Controllers;

use App\Models\LaporanHasilKonsultasiMentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanHasilKonsultasiMentorController extends Controller
{
    // Display all consultation reports
    public function index()
    {
        $laporanKonsultasiMentor = LaporanHasilKonsultasiMentor::all();
        return view('pages.mentor.laporan_hasil_konsultasi_mentor', compact('laporanKonsultasiMentor'));
    }

    // Show the form to create a new consultation report
    public function create()
    {
        return view('pages.mentor.add_laporan_hasil_konsultasi_mentor');
    }

    // Store a newly created consultation report
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'nama_maxians' => 'required|string|max:255',
            'komentar' => 'required|string',
            'bukti_konsultasi' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048', // Max 2MB
        ]);

        try {
            // Handle the file upload - simpan ke public/images
            $file = $request->file('bukti_konsultasi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);

            // Create the report
            LaporanHasilKonsultasiMentor::create([
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'nama_maxians' => $request->nama_maxians,
                'komentar' => $request->komentar,
                'bukti_konsultasi' => 'images/' . $fileName, // Simpan path relatif
            ]);

            return redirect()->route('laporan_hasil_konsultasi_mentor')
                ->with('success', 'Laporan hasil konsultasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan laporan konsultasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Show the form to edit an existing consultation report
    public function edit($id_laporan_mentor)
    {
        $laporan = LaporanHasilKonsultasiMentor::findOrFail($id_laporan_mentor);
        return view('pages.mentor.edit_laporan_hasil_konsultasi_mentor', compact('laporan'));
    }

    // Update an existing consultation report
    public function update(Request $request, $id_laporan_mentor)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'nama_maxians' => 'required|string|max:255',
            'komentar' => 'required|string',
            'bukti_konsultasi' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Max 2MB
        ]);

        try {
            $laporan = LaporanHasilKonsultasiMentor::findOrFail($id_laporan_mentor);

            // Update the report fields
            $laporan->tanggal = $validatedData['tanggal'];
            $laporan->jam = $validatedData['jam'];
            $laporan->nama_maxians = $validatedData['nama_maxians'];
            $laporan->komentar = $validatedData['komentar'];

            // Handle file upload if exists
            if ($request->hasFile('bukti_konsultasi')) {
                // Delete old file if it exists
                if ($laporan->bukti_konsultasi && file_exists(public_path($laporan->bukti_konsultasi))) {
                    unlink(public_path($laporan->bukti_konsultasi));
                }

                // Store new file
                $file = $request->file('bukti_konsultasi');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $fileName);
                $laporan->bukti_konsultasi = 'images/' . $fileName;
            }

            // Save updated report
            $laporan->save();

            return redirect()->route('laporan_hasil_konsultasi_mentor')
                ->with('success', 'Laporan hasil konsultasi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui laporan konsultasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Delete an existing consultation report
    public function destroy($id_laporan_mentor)
    {
        try {
            $laporan = LaporanHasilKonsultasiMentor::findOrFail($id_laporan_mentor);

            // Delete the file if it exists
            if ($laporan->bukti_konsultasi && file_exists(public_path($laporan->bukti_konsultasi))) {
                unlink(public_path($laporan->bukti_konsultasi));
            }

            // Delete the report
            $laporan->delete();

            return redirect()->route('laporan_hasil_konsultasi_mentor')
                ->with('success', 'Laporan hasil konsultasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('laporan_hasil_konsultasi_mentor')
                ->with('error', 'Gagal menghapus laporan konsultasi: ' . $e->getMessage());
        }
    }
}
