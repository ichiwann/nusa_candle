<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';

    public $incrementing = false; 
    protected $keyType = 'int';

    // Hanya kolom yang ada di database
    protected $fillable = [
        'nama_produk',
        'stok',
        'harga',
        'gambar',
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga' => 'integer',
    ];
}
