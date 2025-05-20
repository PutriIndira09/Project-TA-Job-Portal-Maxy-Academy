<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AktivasiAkun;
use App\Models\Lamaran;
use App\Models\DaftarLowonganKerjaPerusahaan;
use App\Models\AturJadwalKonsultasi;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DasborController extends Controller
{
    public function admin()
    {
        // Total akun berdasarkan role
        $totalActiveMaxians = AktivasiAkun::where('role', 'Maxians')
            ->where('status', 'aktif')
            ->count();

        // Previous period Maxians count
        $previousPeriodMaxians = AktivasiAkun::where('role', 'Maxians')
            ->where('status', 'aktif')
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        // Calculate maxians trend
        $maxiansTrend = 0;
        if ($previousPeriodMaxians > 0) {
            $maxiansTrend = (($totalActiveMaxians - $previousPeriodMaxians) / $previousPeriodMaxians) * 100;
        }

        $totalMentors = AktivasiAkun::where('role', 'Mentor')
            ->where('status', 'aktif')
            ->count();

        // Previous period Mentors count
        $previousPeriodMentors = AktivasiAkun::where('role', 'Mentor')
            ->where('status', 'aktif')
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        // Calculate mentors trend
        $mentorsTrend = 0;
        if ($previousPeriodMentors > 0) {
            $mentorsTrend = (($totalMentors - $previousPeriodMentors) / $previousPeriodMentors) * 100;
        }

        $totalPerusahaan = AktivasiAkun::where('role', 'Perusahaan')
            ->where('status', 'aktif')
            ->count();

        // Previous period Perusahaan count
        $previousPeriodPerusahaan = AktivasiAkun::where('role', 'Perusahaan')
            ->where('status', 'aktif')
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        // Calculate perusahaan trend
        $perusahaanTrend = 0;
        if ($previousPeriodPerusahaan > 0) {
            $perusahaanTrend = (($totalPerusahaan - $previousPeriodPerusahaan) / $previousPeriodPerusahaan) * 100;
        }

        $totalLamaran = Lamaran::count();

        // Previous period Lamaran count
        $previousPeriodLamaran = Lamaran::where('created_at', '<', Carbon::now()->subMonth())
            ->count();

        // Calculate lamaran trend
        $lamaranTrend = 0;
        if ($previousPeriodLamaran > 0) {
            $lamaranTrend = (($totalLamaran - $previousPeriodLamaran) / $previousPeriodLamaran) * 100;
        }

        // Retrieve latest activities
        $latestActivities = DaftarLowonganKerjaPerusahaan::latest()->take(5)->get();

        // Total lowongan kerja aktif dan tidak aktif
        $totalLowonganAktif = DaftarLowonganKerjaPerusahaan::where('is_active', '1')->count();
        $totalLowonganNonAktif = DaftarLowonganKerjaPerusahaan::where('is_active', '0')->count();

        // Count consultation schedules
        $totalJadwalKonsultasi = AturJadwalKonsultasi::count();
        $jadwalMendatang = AturJadwalKonsultasi::where('tanggal', '>=', Carbon::today())->count();
        $jadwalBerlalu = AturJadwalKonsultasi::where('tanggal', '<', Carbon::today())->count();

        // Calculate total keseluruhan akun (all roles combined)
        $totalAkun = AktivasiAkun::where('status', 'aktif')->count(); // Total active accounts

        return view('pages.admin.dasbor', [
            'totalActiveMaxians' => $totalActiveMaxians,
            'maxiansTrend' => $maxiansTrend, // Pass maxians trend
            'totalMentors' => $totalMentors,
            'mentorsTrend' => $mentorsTrend, // Pass mentors trend
            'totalPerusahaan' => $totalPerusahaan,
            'perusahaanTrend' => $perusahaanTrend, // Pass perusahaan trend
            'totalLamaran' => $totalLamaran,
            'lamaranTrend' => $lamaranTrend, // Pass lamaran trend
            'latestActivities' => $latestActivities, // Pass the latest activities
            'totalLowonganAktif' => $totalLowonganAktif,
            'totalLowonganNonAktif' => $totalLowonganNonAktif,
            'totalJadwalKonsultasi' => $totalJadwalKonsultasi,
            'jadwalMendatang' => $jadwalMendatang,
            'jadwalBerlalu' => $jadwalBerlalu,
            'totalAkun' => $totalAkun, // Pass total akun to the view
        ]);
    }

    public function perusahaan()
    {
        try {
            // Hitung total pelamar berdasarkan status
            $totalPelamarDiproses = Lamaran::where('status_lamaran', 'diproses')->count();
            $totalPelamarDiterima = Lamaran::where('status_lamaran', 'diterima')->count();
            $totalPelamarDitolak = Lamaran::where('status_lamaran', 'ditolak')->count();
            $totalPelamar = Lamaran::count();

            // Ambil data pelamar per kategori dengan relasi yang benar
            $pelamarPerKategori = Lamaran::query()
                ->join('daftar_lowongan_kerja_perusahaan', 'lamaran.id_lowongan', '=', 'daftar_lowongan_kerja_perusahaan.id_lowongan')
                ->join('kategori_pekerjaan', 'daftar_lowongan_kerja_perusahaan.nama_kategori', '=', 'kategori_pekerjaan.nama_kategori')
                ->selectRaw('kategori_pekerjaan.nama_kategori as kategori, count(*) as total')
                ->groupBy('kategori_pekerjaan.nama_kategori')
                ->orderBy('total', 'desc')
                ->get();

            return view('pages.perusahaan.dasbor', [
                'totalPelamarDiproses' => $totalPelamarDiproses,
                'totalPelamarDiterima' => $totalPelamarDiterima,
                'totalPelamarDitolak' => $totalPelamarDitolak,
                'totalPelamar' => $totalPelamar,
                'pelamarPerKategori' => $pelamarPerKategori
            ]);
        } catch (\Exception $e) {
            Log::error('Error di DasborController::perusahaan: ' . $e->getMessage());

            return view('pages.perusahaan.dasbor', [
                'totalPelamarDiproses' => 0,
                'totalPelamarDiterima' => 0,
                'totalPelamarDitolak' => 0,
                'totalPelamar' => 0,
                'pelamarPerKategori' => collect()
            ]);
        }
    }

    public function mentor()
    {
        // Ambil data jadwal konsultasi terdekat
        $jadwalKonsultasiTerdekat = AturJadwalKonsultasi::whereDate('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->take(5) // Ambil 5 jadwal terdekat
            ->get();

        // Hitung total permintaan jadwal secara keseluruhan
        $totalPermintaanJadwal = AturJadwalKonsultasi::count();

        // Hitung total permintaan berdasarkan status
        $totalDiproses = AturJadwalKonsultasi::where('status', 'diproses')->count();
        $totalDisetujui = AturJadwalKonsultasi::where('status', 'disetujui')->count();
        $totalReschedule = AturJadwalKonsultasi::where('status', 'reschedule')->count();

        // Ambil data statistik aktivitas per bulan
        $aktivitasPerBulan = AturJadwalKonsultasi::select(
            DB::raw('YEAR(tanggal) as year'),
            DB::raw('MONTH(tanggal) as month'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy(DB::raw('YEAR(tanggal)'), DB::raw('MONTH(tanggal)'))
            ->orderBy(DB::raw('YEAR(tanggal)'), 'asc')
            ->orderBy(DB::raw('MONTH(tanggal)'), 'asc')
            ->get();

        // Siapkan data untuk grafik
        $bulanLabels = [];
        $aktivitasData = [];

        foreach ($aktivitasPerBulan as $aktivitas) {
            $bulanLabels[] = Carbon::createFromFormat('Y-m', $aktivitas->year . '-' . $aktivitas->month)->format('F Y');
            $aktivitasData[] = $aktivitas->total;
        }

        return view('pages.mentor.dasbor', [
            'jadwalKonsultasiTerdekat' => $jadwalKonsultasiTerdekat,
            'totalPermintaanJadwal' => $totalPermintaanJadwal,
            'totalDiproses' => $totalDiproses,
            'totalDisetujui' => $totalDisetujui,
            'totalReschedule' => $totalReschedule,
            'bulanLabels' => $bulanLabels,
            'aktivitasData' => $aktivitasData,
        ]);
    }
}
