<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_lamaran';
    protected $table = 'lamaran';
    protected $fillable = ['id_lowongan', 'user_id', 'status_lamaran'];

    // Relasi ke Lowongan Kerja
    public function lowongan()
    {
        return $this->belongsTo(DaftarLowonganKerjaPerusahaan::class, 'id_lowongan', 'id_lowongan');
    }

    // Relasi ke User (Maxians yang melamar)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
