<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\DokumenLamaran;
use App\Models\AturJadwalKonsultasi;
use App\Http\Controllers\DokumenLamaranController;
use App\Http\Controllers\CekKetersediaanJadwalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Add CORS headers middleware
header('Access-Control-Allow-Origin: http://127.0.0.1:8000');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/dokumen-lamaran', function () {
//     return response()->json([
//         'data' => \App\Models\DokumenLamaran::all()
//     ]);
// });

Route::get('/jadwal-konsultasi', [CekKetersediaanJadwalController::class, 'getJadwalApi']);

Route::get('/jadwal-konsultasi', function () {
    try {
        $data = \App\Models\AturJadwalKonsultasi::where('status', 'available')
            ->orderBy('tanggal')
            ->orderBy('jam')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id_jadwal_konsultasi,
                    'tanggal' => $item->tanggal,
                    'jam' => substr($item->jam, 0, 5), // Format HH:MM
                    'display_tanggal' => \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y'),
                    'display_jam' => substr($item->jam, 0, 5) . ' WIB'
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan server'
        ], 500);
    }
});

// routes/api.php
Route::get('/simplified-jadwal', function () {
    try {
        // Data dummy untuk testing
        $dummyData = [
            [
                'id' => 1,
                'tanggal' => '2025-03-01',
                'jam' => '08:00',
                'display' => '01 Maret 2025 - 08:00 WIB'
            ],
            [
                'id' => 2,
                'tanggal' => '2025-03-01',
                'jam' => '10:00',
                'display' => '01 Maret 2025 - 10:00 WIB'
            ]
        ];

        return response()->json([
            'status' => 'success',
            'data' => $dummyData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

// Route::post('/dokumen/store', [DokumenLamaranController::class, 'storeApi']);

Route::get('/jadwal-konsultasi', [CekKetersediaanJadwalController::class, 'getJadwalApi']);

// Handle preflight requests
Route::options('/{any}', function () {
    return response()->json();
})->where('any', '.*');
Route::options('/{any}', function () {
    return response('', 200)
        ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type');
})->where('any', '.*');
