<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pekerjaan';
    protected $primaryKey = 'id_kategori';
    // protected $fillable = ['id_kategori', 'id_tag_pekerjaan', 'nama_kategori', 'deskripsi'];
    protected $fillable = ['nama_kategori', 'deskripsi'];

    // app/Models/KategoriPekerjaan.php
    public function tags()
    {
        // return $this->belongsTo(TagLowonganKerja::class, 'id_tag_pekerjaan', 'id_tag_pekerjaan');
        return $this->hasMany(TagLowonganKerja::class, 'id_kategori', 'id_kategori');
    }

    public function daftarLowonganKerja()
    {
        return $this->hasMany(DaftarLowonganKerjaPerusahaan::class, 'nama_kategori', 'nama_kategori');
    }
}
