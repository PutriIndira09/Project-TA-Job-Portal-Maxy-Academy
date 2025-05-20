<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLowonganKerjaPerusahaan extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'daftar_lowongan_kerja_perusahaan';

    // Specify the primary key
    protected $primaryKey = 'id_lowongan';

    // Set the primary key type to BIGINT
    protected $keyType = 'bigint';

    // Specify the columns that are mass assignable
    protected $fillable = [
        'id_lowongan',
        'id_perusahaan',
        'logo_perusahaan',
        'nama_kategori',
        'nama_perusahaan',
        'alamat',
        'email',
        'nomor_telepon',
        'deskripsi_pekerjaan',
        'jenis_kontrak',
        'lokasi',
        'gaji',
        'is_active',
    ];

    // Cast kolom id_lowongan menjadi integer
    protected $casts = [
        'id_lowongan' => 'integer',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(User::class, 'id_perusahaan');
    }

    // Relasi ke KategoriPekerjaan (Kategori)
    public function kategoriPekerjaan()
    {
        return $this->belongsTo(KategoriPekerjaan::class, 'nama_kategori', 'nama_kategori');
    }

    // app/Models/Lamaran.php
    public function lowongan()
    {
        return $this->belongsTo(DaftarLowonganKerjaPerusahaan::class, 'id_lowongan', 'id_lowongan');
    }

    // app/Models/KategoriPekerjaan.php
    public function daftarLowonganKerja()
    {
        return $this->hasMany(DaftarLowonganKerjaPerusahaan::class, 'nama_kategori', 'nama_kategori');
    }
}
