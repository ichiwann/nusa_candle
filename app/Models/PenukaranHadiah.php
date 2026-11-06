<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenukaranHadiah extends Model
{
    protected $table = 'penukaran_hadiah';
    protected $primaryKey = 'id_penukaran';

    protected $fillable = [
        'id_user',
        'id_hadiah',
        'poin_ditukar',
        'poin_saat_klaim',
        'status_klaim',
        'catatan',
    ];

    protected $casts = [
        'poin_ditukar' => 'integer',
        'poin_saat_klaim' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /** @return BelongsTo<Hadiah, $this> */
    public function hadiah(): BelongsTo
    {
        return $this->belongsTo(Hadiah::class, 'id_hadiah', 'id_hadiah');
    }
}
