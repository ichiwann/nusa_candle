<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hadiah extends Model
{
    protected $table = 'hadiah';
    protected $primaryKey = 'id_hadiah';

    protected $fillable = [
        'id_produk',
        'poin_dibutuhkan',
    ];

    protected $casts = [
        'poin_dibutuhkan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** @return BelongsTo<Produk, $this> */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /** @return HasMany<PenukaranHadiah, $this> */
    public function penukaran(): HasMany
    {
        return $this->hasMany(PenukaranHadiah::class, 'id_hadiah', 'id_hadiah');
    }
}
