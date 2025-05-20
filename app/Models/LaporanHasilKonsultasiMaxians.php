<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilKonsultasiMaxians extends Model
{
    use HasFactory;

    protected $table = 'laporan_hasil_konsultasi_karir_maxians';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'tanggal_konsultasi',
        'jam_konsultasi',
        'nama_mentor',
        'komentar',
        'file_bukti'
    ];

    protected $appends = ['file_bukti_url'];

    /**
     * Mendapatkan URL file bukti konsultasi
     *
     * @return string|null
     */
    public function getFileBuktiUrlAttribute()
    {
        if ($this->file_bukti) {
            // Pastikan path file yang disimpan di database adalah 'images/filename.jpg'
            return asset($this->file_bukti); // Hanya menyertakan path relatif 'images/filename.jpg'
        }
        return null;
    }
}
