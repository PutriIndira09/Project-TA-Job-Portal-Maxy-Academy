<?php

namespace App\Http\Controllers;

use App\Models\DaftarLowonganKerjaPerusahaan;
use App\Models\KategoriPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class DaftarLowonganKerjaPerusahaanController extends Controller
{
    // Menampilkan daftar lowongan kerja perusahaan
    public function index()
    {
        try {
            // Mengambil daftar lowongan kerja dengan relasi kategori pekerjaan
            $lowongans = DaftarLowonganKerjaPerusahaan::with('kategoriPekerjaan')
              ->orderBy('created_at', 'desc')->get();
            return view('pages.perusahaan.daftar_lowongan_kerja_perusahaan', compact('lowongans'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data lowongan kerja.' . $e->getMessage());
        }
    }

    // Menampilkan halaman tambah lowongan kerja
    public function create()
    {
        $kategoris = KategoriPekerjaan::all();  // Mengambil semua kategori pekerjaan
        // $lowongan = new DaftarLowonganKerjaPerusahaan(); // jika tidak ada data lowongan, gunakan objek kosong
        // dd($lowongan);
        return view('pages.perusahaan.add_daftar_lowongan_kerja_perusahaan', compact('kategoris'));
    }

    // Menyimpan data lowongan kerja baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'logo_perusahaan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_kategori' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'deskripsi_pekerjaan' => 'required|string|max:5000',  // Validasi input teks deskripsi pekerjaan
            'jenis_kontrak' => 'required|in:Full Time,Part Time,Freelance,Internship,Contract Based',
            'lokasi' => 'required|in:WFO,WFH,Hybrid',
            'gaji' => 'required|numeric',
            // 'status' => 'required|in:Aktif,Tidak aktif',
            'is_active' => 'sometimes|boolean'
        ]);

        // Assign value for status
        $status = $request->has('is_active') && $request->input('is_active') ? 'Aktif' : 'Tidak aktif';

        try {
            $logo = $request->file('logo_perusahaan');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move(public_path('images'), $logoName);

            DaftarLowonganKerjaPerusahaan::create([
                'logo_perusahaan' => 'images/' . $logoName, // make sure $logoPath is set correctly before
                'nama_kategori' => $validatedData['nama_kategori'],
                'nama_perusahaan' => $validatedData['nama_perusahaan'],
                'alamat' => $validatedData['alamat'],
                'email' => $validatedData['email'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'deskripsi_pekerjaan' => $validatedData['deskripsi_pekerjaan'],  // Simpan teks deskripsi pekerjaan
                'jenis_kontrak' => $validatedData['jenis_kontrak'],
                'lokasi' => $validatedData['lokasi'],
                'gaji' => $validatedData['gaji'],
                'is_active' => $request->has('is_active') ? true : false
                // 'status' => $status, // storing the status
            ]);

            return redirect()->route('daftar_lowongan_kerja_perusahaan')
                ->with('success', 'Lowongan kerja berhasil ditambahkan!');
        } catch (\Exception $e) {
            log::error('Error creating job listing: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menambahkan lowongan kerja.' . $e->getMessage())
                ->withInput();
        }
    }

    // Menampilkan halaman edit data lowongan kerja
    public function edit($id_lowongan)
    {
        $lowongan = DaftarLowonganKerjaPerusahaan::findOrFail($id_lowongan);
        $kategoris = KategoriPekerjaan::all();  // Mengambil semua kategori pekerjaan
        return view('pages.perusahaan.edit_daftar_lowongan_kerja_perusahaan', compact('lowongan', 'kategoris'));
    }

    // Update data lowongan kerja
    public function update(Request $request, $id_lowongan)
    {
        $validatedData = $request->validate([
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_kategori' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'deskripsi_pekerjaan' => 'required|string|max:5000',  // Validasi input teks deskripsi pekerjaan
            'jenis_kontrak' => 'required|in:Full Time,Part Time,Freelance,Internship,Contract Based',
            'lokasi' => 'required|in:WFO,WFH,Hybrid',
            'gaji' => 'required|numeric',
            // 'status' => 'required|in:Aktif,Tidak aktif',
            'is_active' => 'required|boolean'

        ]);

        try {
            $lowongan = DaftarLowonganKerjaPerusahaan::findOrFail($id_lowongan);

            // Handle logo upload
            if ($request->hasFile('logo_perusahaan')) {
                // Delete old logo if exists
                if ($lowongan->logo_perusahaan && file_exists(public_path($lowongan->logo_perusahaan))) {
                    unlink(public_path($lowongan->logo_perusahaan));
                }

                // Store new logo
                $logo = $request->file('logo_perusahaan');
                $logoName = time() . '_' . $logo->getClientOriginalName();
                $logo->move(public_path('images'), $logoName);
                $lowongan->logo_perusahaan = 'images/' . $logoName;
            }

            // Update all fields except logo
            $lowongan->update([
                'nama_kategori' => $validatedData['nama_kategori'],
                'nama_perusahaan' => $validatedData['nama_perusahaan'],
                'alamat' => $validatedData['alamat'],
                'email' => $validatedData['email'],
                'nomor_telepon' => $validatedData['nomor_telepon'],
                'deskripsi_pekerjaan' => $validatedData['deskripsi_pekerjaan'],  // Update deskripsi pekerjaan
                'jenis_kontrak' => $validatedData['jenis_kontrak'],
                'lokasi' => $validatedData['lokasi'],
                'gaji' => $validatedData['gaji'],
                'is_active' => $request->boolean('is_active'),
                // 'status' => $validatedData['status']
            ]);

            return redirect()->route('daftar_lowongan_kerja_perusahaan')
                ->with('success', 'Lowongan kerja berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui lowongan kerja: ' . $e->getMessage())
                ->withInput();
        }
    }

    // // Menghapus data lowongan kerja
    // public function destroy($id_lowongan)
    // {
    //     try {
    //         $lowongan = DaftarLowonganKerjaPerusahaan::findOrFail($id_lowongan);

    //         // Delete the logo if exists
    //         if ($lowongan->logo_perusahaan && Storage::exists($lowongan->logo_perusahaan)) {
    //             Storage::delete($lowongan->logo_perusahaan);
    //         }

    //         $lowongan->delete();

    //         return redirect()->route('daftar_lowongan_kerja_perusahaan')
    //             ->with('success', 'Lowongan kerja berhasil dihapus!');
    //     } catch (\Exception $e) {
    //         return redirect()->route('daftar_lowongan_kerja_perusahaan')
    //             ->with('error', 'Gagal menghapus lowongan kerja: ' . $e->getMessage());
    //     }
    // }
}
