<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
     protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_pesanan',
        'metode_pembayaran',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    // Relasi ke Pesanan
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    // Helper: Label metode pembayaran
    public function getMetodeLabelAttribute(): string
    {
        return match ($this->metode_pembayaran) {
            'bca' => 'BCA VA',
            'mandiri' => 'Mandiri',
            'gopay' => 'GoPay',
            'dana' => 'DANA',
            'shopeepay' => 'ShopeePay',
            'cash' => 'Manual',
            default => ucfirst($this->metode_pembayaran),
        };
    }

    // Helper: Label status pembayaran
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_pembayaran) {
            'menunggu' => 'Menunggu Pembayaran',
            'berhasil' => 'Berhasil',
            'gagal' => 'Gagal',
            default => ucfirst($this->status_pembayaran),
        };
    }
}
