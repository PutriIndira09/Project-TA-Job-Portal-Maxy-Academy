<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenLamaran extends Model
{
    use HasFactory;

    protected $table = 'dokumen_lamaran';
    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'cv',
        'portofolio',
        'link_instagram',
        'link_linkedin',
        // 'status'
    ];

    // Accessor untuk link
    public function getInstagramAttribute()
    {
        return $this->link_instagram;
    }

    public function getLinkedinAttribute()
    {
        return $this->link_linkedin;
    }
}