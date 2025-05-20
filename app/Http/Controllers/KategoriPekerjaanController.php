<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use App\Models\TagLowonganKerja;
use Illuminate\Http\Request;

class KategoriPekerjaanController extends Controller
{
    public function index()
    {
        try {
            $kategoris = KategoriPekerjaan::with('tags')->orderBy('created_at', 'desc')->get();
            return view('pages.perusahaan.kategori_lowongan_kerja', compact('kategoris'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memuat data kategori pekerjaan.' . $e->getMessage());
        }
    }

    public function create()
    {
        // return view('pages.perusahaan.add_kategori_lowongan_kerja');
        // $tags = TagLowonganKerja::all(); // Mengambil semua tag
        // Ambil tag yang belum dimiliki oleh kategori apapun (id_kategori masih null)
        $availableTags = TagLowonganKerja::whereNull('id_kategori')->get();

        // Cek apakah semua tag sudah dipakai
        $allTagsUsed = TagLowonganKerja::whereNotNull('id_kategori')->count() === TagLowonganKerja::count();

        // return view('pages.perusahaan.add_kategori_lowongan_kerja', compact('tags'));
        return view('pages.perusahaan.add_kategori_lowongan_kerja', compact('availableTags', 'allTagsUsed'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'tags' => 'array|max:3', // Membatasi pemilihan tag hingga 3
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tags' => 'array|max:3', // Membatasi pemilihan tag hingga 3
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'tags.max' => 'Maksimal 3 tag yang dapat dipilih.'
        ]);

        // try {
        //     KategoriPekerjaan::create($request->all());
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('success', 'Kategori pekerjaan berhasil ditambahkan!');
        // } catch (\Exception $e) {
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('error', 'Gagal menambahkan kategori pekerjaan.');
        // }
        try {
            // $kategori = KategoriPekerjaan::create($request->only('nama_kategori', 'deskripsi'));
            // $kategori->tags()->attach($request->tags); // Menyimpan relasi banyak ke banyak dengan tabel pivot
            // Simpan kategori
            $kategori = KategoriPekerjaan::create([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            // Jika ada tag yang dipilih
            if ($request->has('tags')) {
                // Update tag yang dipilih dengan id_kategori baru
                TagLowonganKerja::whereIn('id_tag_pekerjaan', $request->tags)
                    ->update(['id_kategori' => $kategori->id_kategori]);
            }

            return redirect()->route('kategori_lowongan_kerja')
                ->with('success', 'Kategori pekerjaan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('kategori_lowongan_kerja')
                ->with('error', 'Gagal menambahkan kategori pekerjaan.' . $e->getMessage());
        }
    }

    public function edit($id_kategori)
    {
        //     try {
        //         $kategori = KategoriPekerjaan::findOrFail($id_kategori);
        //         $tags = TagLowonganKerja::all(); // Mengambil semua tag
        //         return view('pages.perusahaan.edit_kategori_lowongan_kerja', compact('kategori', 'tags'));
        //     } catch (\Exception $e) {
        //         return redirect()->route('kategori_lowongan_kerja')
        //             ->with('error', 'Kategori pekerjaan tidak ditemukan.');
        //     }
        // }
        try {
            $kategori = KategoriPekerjaan::with('tags')->findOrFail($id_kategori);

            // Ambil tag yang tersedia (belum dimiliki kategori lain)
            $availableTags = TagLowonganKerja::whereNull('id_kategori')
                ->orWhere('id_kategori', $id_kategori)
                ->get();

            return view('pages.perusahaan.edit_kategori_lowongan_kerja', compact('kategori', 'availableTags'));
        } catch (\Exception $e) {
            return redirect()->route('kategori_lowongan_kerja')
                ->with('error', 'Kategori pekerjaan tidak ditemukan.');
        }
    }

    public function update(Request $request, $id_kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tags' => 'array|max:3', // Membatasi pemilihan tag hingga 3

        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'tags.max' => 'Maksimal 3 tag yang dapat dipilih.'
        ]);

        // try {
        //     $kategori = KategoriPekerjaan::findOrFail($id_kategori);
        //     $kategori->update($request->all());
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('success', 'Kategori pekerjaan berhasil diupdate!');
        // } catch (\Exception $e) {
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('error', 'Gagal mengupdate kategori pekerjaan coba lagi.');
        // }
        // try {
        //     $kategori = KategoriPekerjaan::findOrFail($id_kategori);
        //     $kategori->update($request->only('nama_kategori', 'deskripsi'));
        //     $kategori->tags()->sync($request->tags); // Menyinkronkan tag yang dipilih

        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('success', 'Kategori pekerjaan berhasil diupdate!');
        // } catch (\Exception $e) {
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('error', 'Gagal mengupdate kategori pekerjaan.');
        // }
        try {
            $kategori = KategoriPekerjaan::findOrFail($id_kategori);
            $kategori->update([
                'nama_kategori' => $request->nama_kategori,
                'deskripsi' => $request->deskripsi,
            ]);

            // Reset id_kategori semua tag yang sebelumnya milik kategori ini
            TagLowonganKerja::where('id_kategori', $id_kategori)
                ->update(['id_kategori' => null]);

            // Jika ada tag yang dipilih
            if ($request->has('tags')) {
                // Update tag yang dipilih dengan id_kategori baru
                TagLowonganKerja::whereIn('id_tag_pekerjaan', $request->tags)
                    ->update(['id_kategori' => $id_kategori]);
            }

            return redirect()->route('kategori_lowongan_kerja')
                ->with('success', 'Kategori pekerjaan berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->route('kategori_lowongan_kerja')
                ->with('error', 'Gagal mengupdate kategori pekerjaan: ' . $e->getMessage());
        }
    }

    public function destroy($id_kategori)
    {
        // try {
        //     $kategori = KategoriPekerjaan::findOrFail($id_kategori);
        //     $kategori->delete();
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('success', 'Kategori pekerjaan berhasil dihapus!');
        // } catch (\Exception $e) {
        //     return redirect()->route('kategori_lowongan_kerja')
        //         ->with('error', 'Gagal menghapus kategori pekerjaan. Coba lagi.');
        // }
        try {
            // Reset id_kategori tag yang terkait dengan kategori ini sebelum menghapus
            TagLowonganKerja::where('id_kategori', $id_kategori)
                ->update(['id_kategori' => null]);

            $kategori = KategoriPekerjaan::findOrFail($id_kategori);
            $kategori->delete();

            return redirect()->route('kategori_lowongan_kerja')
                ->with('success', 'Kategori pekerjaan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('kategori_lowongan_kerja')
                ->with('error', 'Gagal menghapus kategori pekerjaan. Coba lagi.');
        }
    }
}
