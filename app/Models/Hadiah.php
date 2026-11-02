<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    protected $table = 'hadiah';
    protected $primaryKey = 'id_hadiah';

    protected $fillable = [
        'id_produk',
        'poin_dibutuhkan',
    ];
}
