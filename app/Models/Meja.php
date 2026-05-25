<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meja extends Model
{
    protected $table = 'meja';

    protected $fillable = [
        'nomor_meja',
        'kapasitas',
        'harga',
        'status',
    ];

    public function reservasi(): HasMany
    {
        return $this->hasMany(Reservasi::class);
    }
}
