<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AktivasiAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AktivasiAkunController extends Controller
{
    public function index()
    {
        // Gabungkan data dari tabel aktivasi_akun dengan tabel users
        $accounts = DB::table('aktivasi_akun')
            ->leftJoin('users', 'aktivasi_akun.email', '=', 'users.email')
            ->select(
                'aktivasi_akun.*',
                'users.name as user_name'
            )
            ->whereNotNull('aktivasi_akun.foto_profil')
            ->orderBy('aktivasi_akun.created_at', 'desc')
            ->get();

        return view('pages.admin.aktivasi_akun', compact('accounts'));
    }

    public function create()
    {
        // Ambil daftar user yang belum memiliki akun di aktivasi_akun
        $availableUsers = User::whereNotIn('email', function($query) {
            $query->select('email')->from('aktivasi_akun');
        })->get();
        
        return view('pages.admin.add_aktivasi_akun', compact('availableUsers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'required',
                'email',
                Rule::unique('aktivasi_akun', 'email')->whereNull('deleted_at'),
                Rule::exists('users', 'email')
            ],
            'password' => 'required|string|min:8',
            'role' => 'required|in:Mentor,Perusahaan,Maxians',
            'last_login' => 'nullable|date',
            'is_active' => 'sometimes|boolean'
        ]);

        try {
            // Dapatkan nama dari tabel users berdasarkan email
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                return redirect()->back()
                    ->with('error', 'Email tidak ditemukan dalam tabel users.')
                    ->withInput();
            }

            // Handle file upload - simpan ke public/images
            $photoName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('photo_profil_users'), $photoName);

            $account = AktivasiAkun::create([
                'foto_profil' => 'photo_profil_users/' . $photoName,
                'email' => $request->email,
                'name' => $user->name, // Menggunakan nama dari tabel users
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'last_login' => $request->last_login,
                'is_active' => $request->boolean('is_active'),
                'status' => 'aktif' // Menambahkan status default
            ]);

            return redirect()->route('aktivasi_akun')
                ->with('success', 'Akun berhasil ditambahkan!')
                ->with('new_account', $account);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan Akun. ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id_pengguna)
    {
        $account = AktivasiAkun::findOrFail($id_pengguna);
        
        // Cari data user berdasarkan email
        $user = User::where('email', $account->email)->first();
        
        return view('pages.admin.edit_aktivasi_akun', compact('account', 'user'));
    }

    public function update(Request $request, $id_pengguna)
    {
        $validatedData = $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => [
                'required',
                'email',
                Rule::unique('aktivasi_akun', 'email')
                    ->ignore($id_pengguna, 'id_pengguna')
                    ->whereNull('deleted_at'),
                Rule::exists('users', 'email')
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Mentor,Perusahaan,Maxians',
            'last_login' => 'nullable|date',
            'is_active' => 'required|boolean'
        ]);

        try {
            $account = AktivasiAkun::findOrFail($id_pengguna);
            
            // Dapatkan nama dari tabel users berdasarkan email
            $user = User::where('email', $validatedData['email'])->first();
            
            if (!$user) {
                return redirect()->back()
                    ->with('error', 'Email tidak ditemukan dalam tabel users.')
                    ->withInput();
            }

            // Jika akun dinonaktifkan, hapus data dari tabel
            if ($request->is_active == false) {
                $account->delete(); // Menghapus data akun dari tabel aktivasi_akun
                return redirect()->route('aktivasi_akun')
                    ->with('success', 'Akun telah dinonaktifkan dan dihapus.');
            }

            // Jika akun diaktifkan kembali, pulihkan data
            $account->email = $validatedData['email'];
            $account->name = $user->name; // Menggunakan nama dari tabel users
            $account->role = $validatedData['role'];
            $account->last_login = $validatedData['last_login'];
            $account->is_active = (bool)$request->is_active;
            $account->status = 'aktif';

            // Handle photo update
            if ($request->hasFile('photo')) {
                // Hapus foto lama jika ada
                if ($account->foto_profil && file_exists(public_path($account->foto_profil))) {
                    unlink(public_path($account->foto_profil));
                }
                
                // Upload foto baru
                $photoName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('photo_profil_users'), $photoName);
                $account->foto_profil = 'photo_profil_users/' . $photoName;
            }

            // Handle password update
            if ($request->filled('password')) {
                $account->password = bcrypt($request->password);
            }

            $account->save();

            return redirect()->route('aktivasi_akun')
                ->with('success', 'Akun berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui akun: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id_pengguna)
    {
        try {
            $account = AktivasiAkun::findOrFail($id_pengguna);

            // Hapus file dari public/images
            if ($account->foto_profil && file_exists(public_path($account->foto_profil))) {
                unlink(public_path($account->foto_profil));
            }

            $account->delete();

            return redirect()->route('aktivasi_akun')
                ->with('success', 'Akun berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('aktivasi_akun')
                ->with('error', 'Gagal menghapus akun: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id_pengguna)
    {
        try {
            $account = AktivasiAkun::findOrFail($id_pengguna);

            // Update status akun
            $account->status = $request->input('is_active') == 'on' ? 'aktif' : 'tidak aktif';
            $account->save();

            // Jika akun dinonaktifkan, tampilkan SweetAlert
            if ($account->status == 'tidak aktif') {
                return redirect()->route('aktivasi_akun')->with('error', 'Akun yang dipilih telah dinonaktifkan');
            }

            return redirect()->route('aktivasi_akun')->with('success', 'Status akun berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status akun: ' . $e->getMessage());
        }
    }

    // Fungsi-fungsi untuk dasbor admin berupa total akun maxians, perusahaan, dan mentor yang aktif
    public function viewDasbor()
    {
        return view('pages.admin.dasbor', [
            'totalActiveMaxians' => $this->hitungMaxiansAktif(),
            'totalMentors' => $this->hitungMentorAktif(),
            'totalPerusahaan' => $this->hitungPerusahaanAktif()
        ]);
    }

    private function hitungMaxiansAktif()
    {
        return AktivasiAkun::where('role', 'Maxians')
            ->where('status', 'aktif')
            ->count();
    }

    private function hitungMentorAktif()
    {
        return AktivasiAkun::where('role', 'Mentor')
            ->where('status', 'aktif')
            ->count();
    }

    private function hitungPerusahaanAktif()
    {
        return AktivasiAkun::where('role', 'Perusahaan')
            ->where('status', 'aktif')
            ->count();
    }
}