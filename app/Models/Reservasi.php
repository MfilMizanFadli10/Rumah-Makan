<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Meja;

class Reservasi extends Model
{
    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'meja_id',
        'tanggal_pesanan',
        'jam_pesanan',
        'jumlah_orang',
        'catatan',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}