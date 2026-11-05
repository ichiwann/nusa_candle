<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeRedeem extends Model
{
    protected $table = 'kode_redeem';
    protected $primaryKey = 'id_kode';

    protected $fillable = [
        'id_user',
        'kode',
        'poin',
        'status',
        'berlaku_hingga',
        'dipakai_pada',
    ];

    protected $casts = [
        'poin' => 'integer',
        'berlaku_hingga' => 'date',
        'dipakai_pada' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Helper: Label status
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'tersedia' => 'Tersedia',
            'terpakai' => 'Terpakai',
            default => ucfirst($this->status),
        };
    }
}
