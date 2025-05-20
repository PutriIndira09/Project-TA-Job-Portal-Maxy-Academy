<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AktivasiAkun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi dengan pengecekan UNIQUE di kedua tabel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
                Rule::unique('aktivasi_akun', 'email')
            ],
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:perusahaan,mentor,maxians',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar di sistem',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak sesuai',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
            'profile_image.image' => 'File harus berupa gambar untuk foto profil',
            'profile_image.mimes' => 'Format foto profil harus JPG, JPEG, atau PNG',
            'profile_image.max' => 'Ukuran foto profil tidak boleh lebih dari 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Gunakan transaction untuk atomic operation
        DB::beginTransaction();

        try {
            $photoPath = null;

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');

                // Validasi file
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Simpan di public/photo_profil_users
                    $file->move(public_path('photo_profil_users'), $filename);

                    // Path yang digunakan untuk database
                    $photoPath = 'photo_profil_users/' . $filename; // Gunakan path relatif ke folder public
                } else {
                    Log::error('File upload tidak valid: ' . $file->getErrorMessage());
                }
            }

            // Buat user dan pastikan username diisi dengan name
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'foto_profil' => $photoPath,
                'is_active' => true,
            ]);

            // Buat record aktivasi_akun
            AktivasiAkun::create([
                'foto_profil' => $photoPath,
                'email' => $user->email,
                'password' => $user->password,
                'role' => $user->role,
                'is_active' => true
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
        } catch (\Exception $e) {

            DB::rollBack();

            // Hapus file dari public/images jika transaksi gagal
            if (isset($photoPath) && file_exists(public_path($photoPath))) {
                unlink(public_path($photoPath));
            }

            return redirect()->back()
                ->withErrors(['general' => 'Terjadi kesalahan sistem: ' . $e->getMessage()])
                ->withInput();
        }
    }
}
