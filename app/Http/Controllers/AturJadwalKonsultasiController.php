<?php

namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class AturJadwalKonsultasiController extends Controller
{
    public function index()
    {
        // Get existing schedules to display in the calendar
        $jadwalKonsultasi = AturJadwalKonsultasi::all();

        return view('pages.mentor.atur_jadwal_konsultasi', compact('jadwalKonsultasi'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tanggal' => 'required|date|after_or_equal:today',
                'jam' => 'required|date_format:H:i',
            ], [
                'tanggal.required' => 'Tanggal konsultasi harus dipilih',
                'tanggal.after_or_equal' => 'Tanggal tidak boleh di masa lalu',
                'jam.required' => 'Jam konsultasi harus diisi',
                'jam.date_format' => 'Format jam tidak valid'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validasi gagal'
                ], 422);
            }

            // Validasi jam 08:00-17:00
            $hour = (int)explode(':', $request->jam)[0];
            if ($hour < 8 || $hour > 17) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jam konsultasi harus antara 08:00 - 17:00'
                ], 422);
            }

            // Cek jadwal duplikat
            if (AturJadwalKonsultasi::where('tanggal', $request->tanggal)
                ->where('jam', $request->jam)
                ->exists()
            ) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal pada tanggal dan jam tersebut sudah ada'
                ], 409);
            }

            // Simpan jadwal
            AturJadwalKonsultasi::create([
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'mentor' => auth()->user()->name,  // Menyimpan nama mentor yang login
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal konsultasi berhasil disimpan!'
            ]);
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $jadwal = AturJadwalKonsultasi::findOrFail($id);
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->route('kelola_permintaan_jadwal')->with('success', 'Status updated successfully');
    }
}
