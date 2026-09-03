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
    'lokasi',
    'tipe',
    'status',
];


    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'meja_id');
    }
}