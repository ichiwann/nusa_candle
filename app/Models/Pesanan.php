<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailPesanan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $incrementing = true;

    protected $fillable = [
        'id_user',
        'total_harga',
        'status_pesanan',
    ];

    protected $casts = [
        'total_harga' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===== RELASI =====

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_pesanan', 'id_pesanan');
    }

    // ===== ACCESSOR =====

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_pesanan) {
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'diproses'            => 'Sedang Diproses',
            'dikirim'             => 'Dikirim',
            'selesai'             => 'Selesai',
            'dibatalkan'          => 'Dibatalkan',
            default               => ucfirst(str_replace('_', ' ', $this->status_pesanan)),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status_pesanan) {
            'menunggu_pembayaran' => 'bg-yellow-100 text-yellow-800',
            'diproses'            => 'bg-[#FCE4EC] text-[#8B1E1E]',
            'dikirim'             => 'bg-green-100 text-green-800',
            'selesai'             => 'bg-green-100 text-green-800',
            'dibatalkan'          => 'bg-red-100 text-red-800',
            default               => 'bg-gray-100 text-gray-800',
        };
    }
}
