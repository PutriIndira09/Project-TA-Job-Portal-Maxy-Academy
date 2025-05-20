<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesSeleksiPelamar extends Model
{
    use HasFactory;

    protected $table = 'tes_seleksi';  // Pastikan ini sesuai dengan nama tabel

    protected $primaryKey = 'id_tes';  // Specify the new primary key column

    protected $fillable = ['nama_tes'];  // Kolom yang boleh diisi
}
