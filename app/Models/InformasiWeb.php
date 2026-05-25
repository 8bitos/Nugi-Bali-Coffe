<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiWeb extends Model
{
    protected $table = 'informasi_web';

    protected $fillable = [
        'nama_web',
        'profil',
        'kontak_email',
        'kontak_telepon',
        'alamat',
        'lokasi_url',
        'instagram_url',
        'logo',
        'hero_image',
        'tentang_image',
        'lokasi_image',
        'landing_title',
        'landing_subtitle',
        'landing_cta_text',
        'landing_cta_url',
        'landing_slides',
    ];

    protected $casts = [
        'landing_slides' => 'array',
    ];
}
