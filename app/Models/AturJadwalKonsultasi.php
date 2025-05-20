<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturJadwalKonsultasi extends Model
{
    use HasFactory;

    protected $table = 'atur_jadwal_konsultasi';
    protected $primaryKey = 'id_jadwal_konsultasi';

    protected $fillable = [
        'maxians',
        'mentor',
        'tanggal',
        'jam',
        'tanggal_baru',
        'jam_baru',
        'alasan',
        'pertanyaan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date:Y-m-d',
        'tanggal_baru' => 'date:Y-m-d',
        'jam' => 'datetime:H:i:s',
        'jam_baru' => 'datetime:H:i:s'
    ];
}
