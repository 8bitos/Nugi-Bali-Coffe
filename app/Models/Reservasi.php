<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservasi extends Model
{
    use SoftDeletes;

    protected $table = 'reservasi';

    protected $fillable = [
        'user_id',
        'meja_id',
        'nama_pemesan',
        'kontak_pemesan',
        'country_code',
        'tanggal_reservasi',
        'jam_reservasi',
        'jam_selesai',
        'jumlah_orang',
        'status',
        'catatan',
        'payment_method',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function meja(): BelongsTo
    {
        return $this->belongsTo(Meja::class);
    }
}
