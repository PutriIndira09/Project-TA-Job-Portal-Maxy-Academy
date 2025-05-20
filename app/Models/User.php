<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto_profil',
        'is_active',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function getIdPenggunaAttribute()
    {
        return $this->id;
    }

    public function hasApplied($lowonganId)
    {
        return $this->lamaran()->where('id_lowongan', $lowonganId)->exists();
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'id_pencari_kerja');
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // Sesuaikan dengan kolom role di tabel users
    }
}
