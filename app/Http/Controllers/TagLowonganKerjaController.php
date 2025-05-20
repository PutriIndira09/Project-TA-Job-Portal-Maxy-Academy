<?php

// app/Http/Controllers/TagLowonganKerjaController.php
namespace App\Http\Controllers;

use App\Models\TagLowonganKerja;
use Illuminate\Http\Request;


class TagLowonganKerjaController extends Controller
{
    public function index()
    {
        // Mengambil semua tag lowongan kerja
        // $tags = TagLowonganKerja::all();
        $tags = TagLowonganKerja::orderBy('created_at', 'desc')->get();
        // Debugging, memastikan variabel $tags berisi data yang benar
        // dd($tags);
        return view('pages.admin.tag_lowongan_kerja', compact('tags'));
    }

    // Menampilkan halaman form tambah tag lowongan kerja
    public function create()
    {
        return view('pages.admin.add_tag_lowongan_kerja'); // Tampilkan form tambah tag
    }

    // app/Http/Controllers/TagLowonganKerjaController.php

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tag' => 'required|string|max:255',
        ], [
            'nama_tag.required' => 'Nama tag pekerjaan wajib diisi.',
            'nama_tag.string' => 'Nama tag pekerjaan harus berupa teks.',
            'nama_tag.max' => 'Nama tag pekerjaan tidak boleh lebih dari 255 karakter.',
        ]);

        try {
            // Simpan data tag lowongan kerja ke database
            TagLowonganKerja::create([
                'nama_tag' => $request->nama_tag,
                'created_at' => now(),
            ]);

            // Redirect ke halaman tag_lowongan_kerja dengan pesan sukses
            return redirect()->route('tag_lowongan_kerja')->with('success', 'Tag lowongan kerja berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Jika ada kesalahan saat menyimpan, redirect dengan pesan error
            return redirect()->route('tag_lowongan_kerja')->with('error', 'Gagal menambahkan tag lowongan kerja.'  . $e->getMessage());
        }
    }

    // Menampilkan form untuk edit tag lowongan kerja
    public function edit($id_tag_pekerjaan)
    {
        $tag = TagLowonganKerja::findOrFail($id_tag_pekerjaan); // Ambil data tag berdasarkan ID
        return view('pages.admin.edit_tag_lowongan_kerja', compact('tag')); // Kirim data tag ke view
    }

    // Mengupdate tag lowongan kerja
    public function update(Request $request, $id_tag_pekerjaan)
    {
        $validated = $request->validate([
            'nama_tag' => 'required|string|max:255',
        ]);

        try {
            // Cari data tag berdasarkan ID
            $tag = TagLowonganKerja::findOrFail($id_tag_pekerjaan);

            // Update data tag lowongan kerja
            $tag->nama_tag = $request->nama_tag;
            $tag->save(); // Simpan perubahan

            // Jika berhasil, redirect dengan pesan sukses
            return redirect()->route('tag_lowongan_kerja')->with('success', 'Tag lowongan kerja berhasil diupdate!');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->route('tag_lowongan_kerja')->with('error', 'Gagal mengupdate tag lowongan kerja coba lagi!');
        }
    }

    // app/Http/Controllers/TagLowonganKerjaController.php

    public function destroy($id_tag_pekerjaan)
    {
        try {
            $tag = TagLowonganKerja::findOrFail($id_tag_pekerjaan); // Mencari data berdasarkan ID
            $tag->delete(); // Menghapus data tag lowongan kerja

            // Redirect ke halaman tag_lowongan_kerja dengan pesan sukses
            return redirect()->route('tag_lowongan_kerja')->with('success', 'Tag lowongan kerja berhasil dihapus!');
        } catch (\Exception $e) {
            // Jika terjadi error, redirect dengan pesan error
            return redirect()->route('tag_lowongan_kerja')->with('error', 'Gagal menghapus tag lowongan kerja. Coba lagi!');
        }
    }
}
