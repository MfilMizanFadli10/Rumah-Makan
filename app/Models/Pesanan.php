<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'kode_pesanan',
        'nama_pelanggan',
        'no_hp',
        'meja_id',
        'tanggal_pesanan',
        'jam_pesanan',
        'jumlah_orang',
        'total_harga',
        'status',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
        'catatan',
    ];

    public function meja(): BelongsTo
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

   public function testimonis(): HasMany
    {
        return $this->hasMany(Testimoni::class, 'pesanan_id');
    }
}