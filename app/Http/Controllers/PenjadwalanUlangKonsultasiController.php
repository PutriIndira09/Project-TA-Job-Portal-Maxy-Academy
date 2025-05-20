<?php

namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PenjadwalanUlangKonsultasiController extends Controller
{
    public function index()
    {
        $jadwalKonsultasi = AturJadwalKonsultasi::select([
            'id_jadwal_konsultasi',
            'maxians',
            'tanggal',
            'jam',
            'tanggal_baru',
            'jam_baru',
            'alasan',
        ])
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('pages.mentor.penjadwalan_ulang_konsultasi', compact('jadwalKonsultasi'));
    }

    public function edit($id_jadwal_konsultasi)
    {
        $jadwal = AturJadwalKonsultasi::findOrFail($id_jadwal_konsultasi);
        return view('pages.mentor.edit_penjadwalan_ulang_konsultasi', compact('jadwal'));
    }

    public function update(Request $request, $id_jadwal_konsultasi)
    {
        $validated = $request->validate([
            'maxians' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'tanggal_baru' => 'required|date|after_or_equal:today',
            'jam_baru' => 'required',
            'alasan' => 'required|string|max:500',
        ]);

        try {
            $jadwal = AturJadwalKonsultasi::findOrFail($id_jadwal_konsultasi);

            $jadwal->update([
                'maxians' => $request->maxians,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'tanggal_baru' => $request->tanggal_baru,
                'jam_baru' => $request->jam_baru,
                'alasan' => $request->alasan,
            ]);

            Log::info('Session data:', session()->all());
            return redirect()->route('penjadwalan_ulang_konsultasi')
                ->with('success', 'Penjadwalan ulang konsultasi berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui jadwal: ' . $e->getMessage());
        }
    }
}
