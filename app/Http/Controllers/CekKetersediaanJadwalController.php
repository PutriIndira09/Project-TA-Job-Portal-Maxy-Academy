<?php

namespace App\Http\Controllers;

use App\Models\AturJadwalKonsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CekKetersediaanJadwalController extends Controller
{
    public function index()
    {
        $jadwalKonsultasi = AturJadwalKonsultasi::orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->get();

        return view('pages.mentor.cek_ketersediaan_jadwal', compact('jadwalKonsultasi'));
    }

    // public function getJadwalWeb()
    // {
    //     try {
    //         Log::info('getJadwalWeb method called');

    //         // Fetch the data
    //         $jadwal = AturJadwalKonsultasi::where('status', 'available')
    //             ->orderBy('tanggal', 'asc')
    //             ->orderBy('jam', 'asc')
    //             ->get();

    //         Log::info('Retrieved jadwal count: ' . $jadwal->count());

    //         // Map the data to the expected format
    //         $formattedJadwal = $jadwal->map(function ($item) {
    //             return [
    //                 'id' => $item->id_jadwal_konsultasi,
    //                 'tanggal' => Carbon::parse($item->tanggal)->translatedFormat('d F Y'),
    //                 'jam' => Carbon::parse($item->jam)->format('H:i') . ' WIB',
    //                 'raw_tanggal' => $item->tanggal,
    //                 'raw_jam' => $item->jam
    //             ];
    //         });

    //         // Return the response
    //         $response = [
    //             'success' => true,
    //             'data' => $formattedJadwal
    //         ];

    //         Log::info('Response data: ', $response);

    //         return response()->json($response);
    //     } catch (\Exception $e) {
    //         Log::error('Error in getJadwalWeb: ' . $e->getMessage());
    //         Log::error($e->getTraceAsString());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengambil data jadwal',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // public function getJadwalApi()
    // {
    //     try {
    //         Log::info('getJadwalApi method called');

    //         // If no data exists, create some dummy data for testing
    //         $count = AturJadwalKonsultasi::count();
    //         Log::info('Current jadwal count: ' . $count);

    //         if ($count == 0) {
    //             Log::info('No data found, creating dummy data for testing');
    //             $this->createDummyData();
    //         }

    //         // Fetch the data
    //         $jadwal = AturJadwalKonsultasi::where('status', 'available')
    //             ->orderBy('tanggal', 'asc')
    //             ->orderBy('jam', 'asc')
    //             ->get();

    //         Log::info('Retrieved jadwal count after potential dummy data creation: ' . $jadwal->count());

    //         // Map the data to the expected format
    //         $formattedJadwal = $jadwal->map(function ($item) {
    //             return [
    //                 'id' => $item->id_jadwal_konsultasi,
    //                 'tanggal' => Carbon::parse($item->tanggal)->translatedFormat('d F Y'),
    //                 'jam' => Carbon::parse($item->jam)->format('H:i') . ' WIB',
    //                 'raw_tanggal' => $item->tanggal,
    //                 'raw_jam' => $item->jam
    //             ];
    //         });

    //         // Return the response
    //         $response = [
    //             'success' => true,
    //             'data' => $formattedJadwal
    //         ];

    //         Log::info('API Response data count: ' . count($response['data']));

    //         return response()->json($response);
    //     } catch (\Exception $e) {
    //         Log::error('Error in getJadwalApi: ' . $e->getMessage());
    //         Log::error($e->getTraceAsString());

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal mengambil data jadwal',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // private function createDummyData()
    // {
    //     // Create some dummy data for testing
    //     $today = Carbon::today();

    //     for ($i = 0; $i < 5; $i++) {
    //         $date = $today->copy()->addDays($i);

    //         // Create 3 time slots for each day
    //         for ($j = 9; $j <= 15; $j += 3) {
    //             AturJadwalKonsultasi::create([
    //                 'maxians' => 'dummy',
    //                 'tanggal' => $date->format('Y-m-d'),
    //                 'jam' => sprintf('%02d:00:00', $j),
    //                 'tanggal_baru' => $date->format('Y-m-d'),
    //                 'jam_baru' => sprintf('%02d:00:00', $j),
    //                 'alasan' => 'Dummy data',
    //                 'status' => 'available'
    //             ]);
    //         }
    //     }
    // }
}
