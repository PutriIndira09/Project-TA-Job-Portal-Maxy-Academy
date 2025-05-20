<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TagLowonganKerjaController;
use App\Http\Controllers\AktivasiAkunController;
use App\Http\Controllers\KategoriPekerjaanController;
use App\Http\Controllers\DaftarLowonganKerjaPerusahaanController;
use App\Http\Controllers\TesSeleksiPelamarController;
use App\Http\Controllers\AturJadwalKonsultasiController;
use App\Http\Controllers\CekKetersediaanJadwalController;
use App\Http\Controllers\LaporanHasilKonsultasiMentorController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DaftarLowonganKerjaAdminController;
use App\Http\Controllers\LaporanKonsultasiDariMentorController;
use App\Http\Controllers\LaporanKonsultasiDariMaxiansController;
use App\Http\Controllers\DokumenLamaranController;
use App\Http\Controllers\PenjadwalanUlangKonsultasiController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\DaftarJadwalKonsultasiKarirController;
use App\Http\Controllers\DaftarPenjadwalanUlangKonsultasiKarirController;
use App\Http\Controllers\JadwalKonsultasiController;
use App\Http\Controllers\ViewJadwalKonsultasiKarirMentorController;
use App\Http\Controllers\LaporanHasilKonsultasiKarirMaxiansController;
use App\Http\Controllers\DokumenLamaranKerjaMaxiansController;
use App\Http\Controllers\DaftarLowonganKerjaMaxiansController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\DasborController;
use App\Models\KategoriPekerjaan;
use App\Models\AturJadwalKonsultasi;
use App\Models\Lamaran;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application. These    |
| routes are loaded by the RouteServiceProvider within a group which       |
| contains the "web" middleware group. Now create something great!         |
|--------------------------------------------------------------------------|
*/

Route::get('/test-hash', function () {
    return [
        'admin' => bcrypt('valid123'),
        'triputra' => bcrypt('123123'),
        'mentor' => bcrypt('123123'),
        'maxians' => bcrypt('123123')
    ];
});

// Mengarahkan ke middleware
Route::middleware(['guest'])->group(function () {
    // Route register
    // Route register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

    // Mengarahkan root halaman login
    Route::get('/login', [UsersController::class, 'index'])->name('login');

    // Mengarahkan root halaman login
    Route::post('/login', [UsersController::class, 'login'])->name('login.post');
});

Route::get('/home', function () {
    return redirect('/admin');
});

Route::middleware(['auth', 'inactivity'])->group(function () {

    Route::get('/', function () {
        if (Auth::user()->role == 'company relationship') {
            return redirect('/admin');
        } elseif (Auth::user()->role == 'perusahaan') {
            return redirect('/perusahaan');
        } elseif (Auth::user()->role == 'mentor') {
            return redirect('/mentor');
        } elseif (Auth::user()->role == 'maxians') {
            return redirect('/maxians');
        }
    });

    // Logout inactive
    Route::get('/logout-inactive', function () {
        Auth::logout();
        return redirect('/login')->with('message', 'Anda telah logout karena tidak ada aktivitas dalam waktu yang cukup lama.');
    })->name('logout.inactive');
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
});

// Halaman untuk menampilkan form lupa password
Route::get('forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Halaman untuk mengirimkan email reset password
Route::post('forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Halaman untuk menampilkan form reset password
Route::get('reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');

// Mengubah password pengguna
Route::post('reset-password', [PasswordController::class, 'reset'])->name('password.update');

// Ganti password di halaman profil pengguna
Route::get('change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('change-password', [PasswordController::class, 'updatePassword'])->name('password.update');



// // Mengarahkan root ke /admin
// Route::get('/', function () {
//     return redirect('admin');
// });

// Route dengan prefix 'admin'
Route::prefix('admin')->middleware(['auth', 'userAkses:company relationship'])->group(function () {
    // Halaman utama admin (root)
    // Route::get('/', function () {
    //     return view('partials.partials_admin.layout');
    // });

    // Halaman untuk dasbor admin
    // Route::get('/dasbor', function () {
    //     return view('pages.admin.dasbor');
    // })->name('dasbor_admin');
    // Halaman untuk dasbor admin
    Route::get('dasbor', [DasborController::class, 'admin'])->name('dasbor_admin');

    // Menampilkan data statistik pelamar masuk pada dasbor admin
    Route::get('/statistik-lamaran', [PelamarController::class, 'getStatistikLamaran']);

    // Halaman tag lowongan kerja
    Route::get('tag-lowongan-kerja', [TagLowonganKerjaController::class, 'index'])->name('tag_lowongan_kerja');

    // Menampilkan halaman tambah tag lowongan kerja
    Route::get('tag-lowongan-kerja/add', [TagLowonganKerjaController::class, 'create'])->name('add_tag_lowongan_kerja');

    // Halaman menambahkan data tag lowongan kerja
    Route::post('tag-lowongan-kerja/add', [TagLowonganKerjaController::class, 'store'])->name('store_tag_lowongan_kerja');

    // Route untuk halaman edit data tag lowongan kerja
    Route::get('tag-lowongan-kerja/edit/{id_tag_pekerjaan}', [TagLowonganKerjaController::class, 'edit'])->name('edit_tag_lowongan_kerja');

    // Route untuk update data tag lowongan kerja
    Route::post('tag-lowongan-kerja/edit/{id_tag_pekerjaan}', [TagLowonganKerjaController::class, 'update'])->name('update_tag_lowongan_kerja');

    // Route untuk menghapus data tag lowongan kerja
    Route::delete('tag-lowongan-kerja/delete/{id_tag_pekerjaan}', [TagLowonganKerjaController::class, 'destroy'])->name('delete_tag_lowongan_kerja');

    // // Halaman aktivasi akun pengguna
    // Route::get('aktivasi-akun-pengguna', function () {
    //     return view('pages.admin.aktivasi_akun');
    // })->name('aktivasi_akun');

    // // Halaman aktivasi akun pengguna
    // Route::get('aktivasi-akun-pengguna/add', function () {
    //     return view('pages.admin.add_aktivasi_akun');
    // })->name('add_aktivasi_akun');

    // Halaman daftar lowongan kerja
    Route::get('daftar-lowongan-kerja-admin', [DaftarLowonganKerjaAdminController::class, 'index'])->name('daftar_lowongan_kerja_admin');

    // Halaman aktivasi akun pengguna
    Route::get('aktivasi-akun-pengguna', [AktivasiAkunController::class, 'index'])->name('aktivasi_akun');

    // Halaman tambah data aktivasi akun pengguna
    Route::get('aktivasi-akun-pengguna/add', [AktivasiAkunController::class, 'create'])->name('add_aktivasi_akun');

    // Proses tambah data aktivasi akun pengguna
    Route::post('aktivasi-akun-pengguna/add', [AktivasiAkunController::class, 'store'])->name('store_aktivasi_akun');

    // Route untuk halaman edit data aktivasi akun pengguna
    Route::get('aktivasi-akun-pengguna/{id_pengguna}/edit', [AktivasiAkunController::class, 'edit'])->name('edit_aktivasi_akun');

    // Route untuk halaman update data aktivasi akun pengguna
    Route::put('aktivasi-akun-pengguna/{id_pengguna}', [AktivasiAkunController::class, 'update'])->name('update_aktivasi_akun');

    // Route untuk menghapus data tag lowongan kerja
    Route::delete('aktivasi-akun-pengguna/{id_pengguna}', [AktivasiAkunController::class, 'destroy'])->name('delete_aktivasi_akun');

    // Mmperbarui status aktivasi akun pengguna
    Route::put('/aktivasi-akun/status/{id_pengguna}', [AktivasiAkunController::class, 'updateStatus'])->name('update_status');

    // Halaman daftar jadwal konsultasi karir
    // routes/web.php
    Route::get('daftar-jadwal-konsultasi-karir', [DaftarJadwalKonsultasiKarirController::class, 'index'])->name('daftar_jadwal_konsultasi_karir_mentor');

    // Halaman daftar penjadwalan ulang konsultasi karir
    Route::get('daftar-penjadwalan-ulang-konsultasi-karir', [DaftarPenjadwalanUlangKonsultasiKarirController::class, 'index'])
        ->name('daftar_penjadwalan_ulang_konsultasi_karir');

    // Halaman laporan hasil konsultasi karir mentor
    Route::get('laporan-hasil-konsultasi-karir-mentor', [LaporanKonsultasiDariMentorController::class, 'index'])
        ->name('laporan_hasil_konsultasi_karir_mentor');

    // Route untuk menampilkan laporan hasil konsultasi Maxians pada role admin
    Route::get('/admin/laporan-hasil-konsultasi-maxians', [LaporanKonsultasiDariMaxiansController::class, 'index'])
        ->name('laporan_hasil_konsultasi_karir_maxians');

    Route::get('update-status-pelamar', function () {
        $lamarans = Lamaran::all(); // Hapus where clause
        return view('pages.perusahaan.daftar_pelamar_masuk', ['lamarans' => $lamarans]);
    })->name('update_status_pelamar_masuk');

    // Route untuk menampilkan daftar lamaran masuk dari maxians dan perusahaan
    Route::get('/daftar-pelamar', [PelamarController::class, 'index'])
        ->name('daftar_pelamar_masuk_perusahaan');


    // Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
});

// Mengarahkan root ke /perusahaan
Route::get('perusahaan', function () {
    return redirect('perusahaan');
});

// Route dengan prefix 'perusahaan'
Route::prefix('perusahaan')->middleware(['auth', 'userAkses:perusahaan'])->group(function () {
    // Route::get('/', function () {
    //     return view('partials.partials_perusahaan.layout');
    // });

    // Halaman dasbor perusahaan
    // Route::get('dasbor', function () {
    //     return view('pages.perusahaan.dasbor');
    // })->name('dasbor_perusahaan');

    // Halaman dasbor perusahaan
    Route::get('dasbor', [DasborController::class, 'perusahaan'])->name('dasbor_perusahaan');

    // Halaman kategori lowongan kerja
    Route::get('kategori-lowongan-kerja', [KategoriPekerjaanController::class, 'index'])->name('kategori_lowongan_kerja');

    // Menampilkan halaman tambah kategori lowongan kerja
    Route::get('kategori-lowongan-kerja/add', [KategoriPekerjaanController::class, 'create'])->name('add_kategori_lowongan_kerja');

    // Halaman menambahkan data kategori lowongan kerja
    Route::post('kategori-lowongan-kerja/add', [KategoriPekerjaanController::class, 'store'])->name('store_kategori_lowongan_kerja');

    // Route untuk halaman edit data kategori lowongan kerja
    Route::get('kategori-lowongan-kerja/edit/{id_kategori}', [KategoriPekerjaanController::class, 'edit'])->name('edit_kategori_lowongan_kerja');

    // Route untuk update data kategori lowongan kerja
    Route::put('kategori-lowongan-kerja/edit/{id_kategori}', [KategoriPekerjaanController::class, 'update'])->name('update_kategori_lowongan_kerja');

    // Route untuk menghapus data kategori lowongan kerja
    Route::delete('kategori-lowongan-kerja/delete/{id_kategori}', [KategoriPekerjaanController::class, 'destroy'])->name('delete_kategori_lowongan_kerja');

    // Halaman daftar lowongan kerja
    Route::get('daftar-lowongan-kerja-perusahaan', [DaftarLowonganKerjaPerusahaanController::class, 'index'])->name('daftar_lowongan_kerja_perusahaan');

    // Menampilkan halaman tambah daftar lowongan kerja
    Route::get('daftar-lowongan-kerja-perusahaan/add', [DaftarLowonganKerjaPerusahaanController::class, 'create'])->name('add_daftar_lowongan_kerja_perusahaan');

    // Halaman menambahkan data daftar lowongan kerja
    Route::post('daftar-lowongan-kerja-perusahaan/add', [DaftarLowonganKerjaPerusahaanController::class, 'store'])->name('store_daftar_lowongan_kerja_perusahaan');

    // Route untuk halaman edit data daftar lowongan kerja
    Route::get('daftar-lowongan-kerja-perusahaan/edit/{id_lowongan}', [DaftarLowonganKerjaPerusahaanController::class, 'edit'])->name('edit_daftar_lowongan_kerja_perusahaan');

    // Route untuk update data daftar lowongan kerja
    Route::put('daftar-lowongan-kerja-perusahaan/edit/{id_lowongan}', [DaftarLowonganKerjaPerusahaanController::class, 'update'])->name('update_daftar_lowongan_kerja_perusahaan');

    // Route::get('/api/kategori/{id_kategori}', function ($id_kategori) {
    //     $kategori = App\Models\KategoriPekerjaan::findOrFail($id_kategori);
    //     return response()->json($kategori);
    // });

    // Halaman tes seleksi pelamar
    Route::get('tes-seleksi-pelamar', [TesSeleksiPelamarController::class, 'index'])->name('tes_seleksi_pelamar');

    // Menampilkan halaman tambah tes seleksi pelamar
    Route::get('tes-seleksi-pelamar/add', [TesSeleksiPelamarController::class, 'create'])->name('add_tes_seleksi_pelamar');

    // Halaman menambahkan datates seleksi pelamar
    Route::post('tes-seleksi-pelamar/add', [TesSeleksiPelamarController::class, 'store'])->name('store_tes_seleksi_pelamar');

    // Route untuk halaman edit data tes seleksi pelamar
    Route::get('tes-seleksi-pelamar/edit/{id_tes}', [TesSeleksiPelamarController::class, 'edit'])->name('edit_tes_seleksi_pelamar');

    // Route untuk update data tes seleksi pelamar
    Route::post('tes-seleksi-pelamar/edit/{id_tes}', [TesSeleksiPelamarController::class, 'update'])->name('update_tes_seleksi_pelamar');

    // Route untuk menghapus data tes seleksi pelamar
    Route::delete('tes-seleksi-pelamar/delete/{id_tes}', [TesSeleksiPelamarController::class, 'destroy'])->name('delete_tes_seleksi_pelamar');

    // Route untuk menampilkan daftar pelamar yang masuk
    Route::get('daftar-pelamar-masuk', [PelamarController::class, 'daftarPelamarMasuk'])->name('daftar_pelamar_masuk');

    // // Route untuk update status pelamar
    // Route::put('/pelamar/update-status/{id_lamaran}', [PelamarController::class, 'updateStatusLamaran'])->name('update_status_pelamar');

    Route::get('update-status-pelamar', function () {
        $lamarans = Lamaran::all(); // Hapus where clause
        return view('pages.perusahaan.daftar_pelamar_masuk', ['lamarans' => $lamarans]);
    })->name('update_status_pelamar_masuk');

    // Route to update the status of the consultation
    Route::put('update-status-pelamar/{id_lamaran}', [PelamarController::class, 'updateStatusLamaran'])->name('update_status_pelamar');
});

// Halaman dokumen lamaran maxians
Route::get('dokumen-lamaran-maxians', [DokumenLamaranController::class, 'Maxians'])
    ->name('dokumen_lamaran_maxians');
// Routes untuk dokumen
Route::get('dokumen/{id}', [DokumenLamaranController::class, 'show'])->name('dokumen.show');
Route::get('dokumen/download/cv/{id}', [DokumenLamaranController::class, 'downloadCV'])->name('dokumen.download.cv');
Route::get('dokumen/download/portofolio/{id}', [DokumenLamaranController::class, 'downloadPortfolio'])->name('dokumen.download.portofolio');
Route::get('dokumen/preview/{type}/{id}', [DokumenLamaranController::class, 'previewPDF'])->name('dokumen.preview');

// Halaman daftar pelamar masuk
// Route::get('daftar-pelamar-masuk', function () {
//     return view('pages.perusahaan.daftar_pelamar_masuk');
// })->name('daftar_pelamar_masuk');


// Mengarahkan root ke /mentor
Route::get('mentor', function () {
    return redirect('mentor');
});

// Route dengan prefix 'mentor'
Route::prefix('mentor')->middleware(['auth', 'userAkses:mentor'])->group(function () {
    // Route::get('/', function () {
    //     return view('partials.partials_mentor.layout');
    // });

    // // Halaman dasbor mentor
    // Route::get('dasbor', function () {
    //     return view('pages.mentor.dasbor');
    // })->name('dasbor_mentor');

    // Halaman dasbor mentor
    Route::get('dasbor', [DasborController::class, 'mentor'])->name('dasbor_mentor');

    // // Halaman kalendar jadwal konsultasi
    // Route::get('atur-jadwal-konsultasi', function () {
    //     return view('pages.mentor.atur_jadwal_konsultasi');
    // })->name('atur_jadwal_konsultasi');

    // Halaman atur jadwal konsultasi
    Route::get('atur-jadwal-konsultasi', [AturJadwalKonsultasiController::class, 'index'])->name('atur_jadwal_konsultasi');

    // Menyimpan data jadwal konsultasi
    Route::post('atur-jadwal-konsultasi/add', [AturJadwalKonsultasiController::class, 'store'])->name('store_atur_jadwal_konsultasi');

    // // routes/web.php
    // Route::prefix('fullcalendar')->group(function () {
    //     Route::get('/', [FullCalendarController::class, 'index'])->name('fullcalendar.index');
    //     Route::post('/', [FullCalendarController::class, 'store'])->name('fullcalendar.store');
    //     Route::put('/', [FullCalendarController::class, 'update'])->name('fullcalendar.update');
    //     Route::delete('/', [FullCalendarController::class, 'destroy'])->name('fullcalendar.destroy');
    // });


    // Halaman cek ketersediaan jadwal
    Route::get('cek-ketersediaan-jadwal', [CekKetersediaanJadwalController::class, 'index'])->name('cek_ketersediaan_jadwal');

    // Route::get('/jadwal-konsultasi', [CekKetersediaanJadwalController::class, 'getJadwalApi']);
    // Route::get('/jadwal-konsultasi-web', [CekKetersediaanJadwalController::class, 'getJadwalWeb']);

    // // Halaman cek ketersediaan jadwal
    // Route::get('cek-ketersediaan-jadwal', [CekKetersediaanJadwalController::class, 'index'])->name('cek_ketersediaan_jadwal');

    // Halaman penjadwalan ulang konsultasi
    Route::get('penjadwalan-ulang-konsultasi', [PenjadwalanUlangKonsultasiController::class, 'index'])->name('penjadwalan_ulang_konsultasi');

    // Route untuk halaman edit data penjadwalan ulang konsultasi
    Route::get('penjadwalan-ulang-konsultasi/edit/{id_jadwal_konsultasi}', [PenjadwalanUlangKonsultasiController::class, 'edit'])->name('edit_penjadwalan_ulang_konsultasi');

    // Route untuk halaman update data penjadwalan ulang konsultasi
    Route::put('penjadwalan-ulang-konsultasi/{id_jadwal_konsultasi}', [PenjadwalanUlangKonsultasiController::class, 'update'])->name('update_penjadwalan_ulang_konsultasi');

    // Halaman kelola permintaan jadwal
    Route::get('kelola-permintaan-jadwal', function () {
        return view('pages.mentor.kelola_permintaan_jadwal');
    })->name('kelola_permintaan_jadwal');

    Route::get('kelola-permintaan-jadwal', function () {
        $permintaanJadwal = AturJadwalKonsultasi::all(); // Hapus where clause
        return view('pages.mentor.kelola_permintaan_jadwal', ['permintaanJadwal' => $permintaanJadwal]);
    })->name('kelola_permintaan_jadwal');

    // Route to update the status of the consultation
    Route::put('update-status-permintaan-jadwal/{id}', [AturJadwalKonsultasiController::class, 'updateStatus'])->name('update_status_permintaaan_jadwal_konsultasi_karir');

    // // Halaman laporan hasil konsultasi karir
    // Route::get('laporan-hasil-konsultasi', function () {
    //     return view('pages.mentor.laporan_hasil_konsultasi');
    // })->name('laporan_hasil_konsultasi');

    // Halaman hasil konsultasi mentor
    Route::get('laporan-hasil-konsultasi-mentor', [LaporanHasilKonsultasiMentorController::class, 'index'])->name('laporan_hasil_konsultasi_mentor');

    // Menampilkan halaman tambah konsultasi mentor
    Route::get('laporan-hasil-konsultasi-mentor/add', [LaporanHasilKonsultasiMentorController::class, 'create'])->name('add_laporan_hasil_konsultasi_mentor');

    // Halaman menambahkan data konsultasi mentor
    Route::post('laporan-hasil-konsultasi-mentor/add', [LaporanHasilKonsultasiMentorController::class, 'store'])->name('store_laporan_hasil_konsultasi_mentor');

    // Route untuk halaman edit data konsultasi mentor
    Route::get('laporan-hasil-konsultasi-mentor/edit/{id_laporan_mentor}', [LaporanHasilKonsultasiMentorController::class, 'edit'])->name('edit_laporan_hasil_konsultasi_mentor');

    // Route untuk update data konsultasi mentor
    Route::put('laporan-hasil-konsultasi-mentor/edit/{id_laporan_mentor}', [LaporanHasilKonsultasiMentorController::class, 'update'])->name('update_laporan_hasil_konsultasi_mentor');

    // Route untuk menghapus data konsultasi mentor
    Route::delete('laporan-hasil-konsultasi-mentor/delete/{id_laporan_mentor}', [LaporanHasilKonsultasiMentorController::class, 'destroy'])->name('delete_laporan_hasil_konsultasi_mentor');
});

Route::prefix('maxians')->middleware(['auth', 'userAkses:maxians'])->group(function () {
    Route::get('/', function () {
        return view('pages.maxians.index');
    })->name('home');

    // Role Maxians
    // Halaman utama
    Route::get('/', function () {
        return view('pages.maxians.index');
    })->name('home');

    // Halaman Konsultasi Karir Bagian Daftar Mentor
    Route::get('/konsultasi-karir/daftar-mentor', function () {
        return view('pages.maxians.daftar_mentor');
    })->name('daftar_mentor');

    // // Halaman Konsultasi Karir Bagian Daftar Jadwal Konsultasi Karir
    // Route::get('/konsultasi-karir/daftar-jadwal-konsultasi-karir', function () {
    //     return view('pages.maxians.daftar_jadwal_konsultasi_karir');
    // })->name('daftar_jadwal_konsultasi_karir');

    // // Halaman Konsultasi Karir Bagian Daftar Jadwal Konsultasi Karir
    // Route::get(
    //     '/konsultasi-karir/daftar-jadwal-konsultasi-karir',
    //     [ViewJadwalKonsultasiKarirMentorController::class, 'index']
    // )
    //     ->name('daftar_jadwal_konsultasi_karir');

    // // API untuk mendapatkan jadwal berdasarkan tanggal
    // Route::get(
    //     '/api/jadwal-konsultasi',
    //     [ViewJadwalKonsultasiKarirMentorController::class, 'getJadwalByTanggal']
    // )->name('api.jadwal_konsultasi');

    // Halaman Konsultasi Karir Bagian Daftar Jadwal Konsultasi Karir
    Route::get(
        '/konsultasi-karir/daftar-jadwal-konsultasi-karir',
        [ViewJadwalKonsultasiKarirMentorController::class, 'index']
    )->name('daftar_jadwal_konsultasi_karir');

    // Route::get(
    //     '/konsultasi-karir/daftar-jadwal-konsultasi-karir',
    //     [ViewJadwalKonsultasiKarirMentorController::class, 'jam']
    // )->name('daftar_jadwal_konsultasi_karir');

    // API untuk mendapatkan jadwal berdasarkan tanggal
    // API untuk mendapatkan jadwal berdasarkan tanggal
    Route::get(
        '/api/jadwal-konsultasi',
        [ViewJadwalKonsultasiKarirMentorController::class, 'getJadwalByTanggal']
    )->name('api.jadwal_konsultasi');

    // Route untuk submit jadwal konsultasi
    Route::post('/submit-jadwal-konsultasi', [JadwalKonsultasiController::class, 'store'])->name('submit_jadwal_konsultasi');

    // // API untuk mendapatkan jam berdasarkan tanggal
    // Route::get('/api/jam-konsultasi', [ViewJadwalKonsultasiKarirMentorController::class, 'getJamByTanggal'])
    //     ->name('api.jam_konsultasi');

    // routes/web.php
    // Route::get('/api/jam-konsultasi', [ViewJadwalKonsultasiKarirMentorController::class, 'getJamByTanggal']);

    // Halaman Konsultasi Karir Bagian Pengajuan Jadwal Konsultasi Karir
    Route::get('/konsultasi-karir/pengajuan-jadwal-konsultasi-karir', function () {
        return view('pages.maxians.pengajuan_jadwal_konsultasi_karir');
    })->name('pengajuan_jadwal_konsultasi_karir');

    // Halaman riwyat pengajuan jadwal konsultasi karir
    Route::get('/konsultasi-karir/riwayat-pengajuan-jadwal-konsultasi', [JadwalKonsultasiController::class, 'showRiwayatPengajuan'])
        ->name('riwayat_pengajuan_jadwal_konsultasi');


    // // Halaman Konsultasi Karir Bagian Laporan Hasil Konsultasi Karir
    // Route::get('/konsultasi-karir/laporan-hasil-konsultasi-karir', function () {
    //     return view('pages.maxians.laporan_hasil_konsultasi_karir');
    // })->name('laporan_hasil_konsultasi_karir');

    // Halaman Konsultasi Karir Bagian Laporan Hasil Konsultasi Karir
    Route::get('/konsultasi-karir/laporan-hasil-konsultasi-karir', [LaporanHasilKonsultasiKarirMaxiansController::class, 'index'])->name('laporan_hasil_konsultasi_karir');

    // Untuk menyimpan laporan hasil konsultasi
    Route::post('/konsultasi-karir/laporan-hasil-konsultasi-karir', [LaporanHasilKonsultasiKarirMaxiansController::class, 'store']);

    Route::get('/lowongan-kerja/daftar-lowongan-kerja', [DaftarLowonganKerjaMaxiansController::class, 'index'])->name('daftar_lowongan_kerja');

    // // mengambil data dari model KategoriPekerjaan role admin
    // Route::get('/lowongan-kerja/daftar-lowongan-kerja', function () {
    //     $kategoris = KategoriPekerjaan::all();  // Mengambil semua tag lowongan kerja
    //     return view('pages.maxians.daftar_lowongan_kerja', compact('kategoris'));
    // })->name('daftar_lowongan_kerja');

    // Halaman Detail Lowongan Kerja
    Route::get('/lowongan-kerja/detail-lowongan-kerja/{id}', [DaftarLowonganKerjaMaxiansController::class, 'show'])->name('detail_lowongan_kerja');

    Route::post('/lowongan-kerja/melamar/{id_lowongan}', [DaftarLowonganKerjaMaxiansController::class, 'melamar'])->name('melamar');


    // // Halaman Status Lamaran Kerja
    // Route::get('/lowongan-kerja/status-lamaran-kerja', function () {
    //     return view('pages.maxians.status_lamaran_kerja');
    // })->name('status_lamaran_kerja');
    Route::get('/lowongan-kerja/status-lamaran-kerja', [LamaranController::class, 'status'])->name('status_lamaran_kerja');

    // // Halaman Dokumen Lamaran Kerja
    // Route::get('/lowongan-kerja/dokumen-lamaran-kerja', function () {
    //     return view('pages.maxians.dokumen_lamaran_kerja');
    // })->name('dokumen_lamaran_kerja');

    // Halaman Dokumen Lamaran Kerja
    Route::get('/lowongan-kerja/dokumen-lamaran-kerja', [DokumenLamaranKerjaMaxiansController::class, 'showForm'])->name('dokumen_lamaran_kerja');

    Route::post('/lowongan-kerja/dokumen-lamaran-kerja', [DokumenLamaranKerjaMaxiansController::class, 'store'])->name('dokumen_lamaran_store');

    // View hasil upload dokumen lamaran kerja
    Route::get('/lowongan-kerja/dokumen-lamaran-kerja/hasil', [DokumenLamaranKerjaMaxiansController::class, 'showResults'])->name('dokumen_lamaran_hasil');

    // Halaman Profil Maxians
    Route::get('/profil', function () {
        return view('pages.maxians.profil_maxians');
    })->name('profil_maxians');
});
