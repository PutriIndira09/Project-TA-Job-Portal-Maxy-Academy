<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AktivasiAkun extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'aktivasi_akun';
    protected $primaryKey = 'id_pengguna';

    protected $fillable = [
        'foto_profil',
        'email',
        'name',
        'password',
        'role',
        'last_login',
        'is_active',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'is_active' => 'boolean'
    ];
}
