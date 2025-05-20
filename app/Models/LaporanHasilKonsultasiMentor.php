<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilKonsultasiMentor extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'laporan_hasil_konsultasi_mentor';
    protected $primaryKey = 'id_laporan_mentor';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal',
        'jam',
        'nama_maxians',
        'komentar',
        'bukti_konsultasi'
    ];
}
