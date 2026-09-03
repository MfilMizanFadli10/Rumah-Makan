<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = [
        'nama_rumah_makan',
        'alamat',
        'jam_operasional',
        'no_hp',
        'tagline',
        'banner',
        'whatsapp',
        'logo',
        'email',
        'maps',

        // Pembayaran
        'qris',
        'nama_bank',
        'nomor_rekening',
        'atas_nama',


    ];
}