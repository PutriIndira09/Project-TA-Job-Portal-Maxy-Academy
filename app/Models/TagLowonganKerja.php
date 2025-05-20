<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagLowonganKerja extends Model
{
    use HasFactory;
    protected $table = 'tag_lowongan_kerja';  // Pastikan ini sesuai dengan nama tabel

    protected $primaryKey = 'id_tag_pekerjaan';  // Specify the new primary key column

    // protected $fillable = ['id_tag_pekerjaan', 'nama_tag'];  // Kolom yang boleh diisi
    protected $fillable = ['nama_tag', 'id_kategori'];

    // app/Models/TagLowonganKerja.php
    public function kategori()
    {
        // return $this->hasMany(KategoriPekerjaan::class, 'id_tag_pekerjaan', 'id_tag_pekerjaan');
        return $this->belongsTo(KategoriPekerjaan::class, 'id_kategori', 'id_kategori');
    }
}
