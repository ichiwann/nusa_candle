<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // ← Ganti dari 'users' ke 'user'
    protected $primaryKey = 'id_user'; // ← Ganti dari 'id' ke 'id_user'

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'alamat',
        'no_telepon', // ← TAMBAHKAN INI
        'password',
        'role',
        'total_poin',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'dibuat_pada' => 'datetime',
        ];
    }
}