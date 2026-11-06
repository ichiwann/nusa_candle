<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;

    protected $fillable = [
        'id_pesanan',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===== RELASI =====

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // ===== ACCESSOR =====

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'menunggu' => 'Menunggu Verifikasi',
            'berhasil' => 'Berhasil',
            'gagal'    => 'Dibatalkan',
            default    => ucfirst($this->status_pembayaran),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'menunggu' => 'bg-yellow-100 text-yellow-800',
            'berhasil' => 'bg-green-100 text-green-800',
            'gagal'    => 'bg-red-100 text-red-800',
            default    => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusIconAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'menunggu' => '⏳',
            'berhasil' => '✓',
            'gagal'    => '✕',
            default    => '•',
        };
    }

    public function getMetodeLabelAttribute(): string
    {
        return match ($this->metode_pembayaran) {
            'bca'       => 'Transfer Bank BCA',
            'mandiri'   => 'Transfer Manual Mandiri',
            'gopay'     => 'GRIS Gopay',
            'dana'      => 'DANA',
            'shopeepay' => 'ShopeePay',
            'cash'      => 'Cash',
            default     => ucfirst($this->metode_pembayaran),
        };
    }
}
