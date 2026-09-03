<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pesanan;

class Testimoni extends Model
{
    protected $table = 'testimoni';

    protected $fillable = [
        'pesanan_id',
        'rating',
        'isi_testimoni',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
}