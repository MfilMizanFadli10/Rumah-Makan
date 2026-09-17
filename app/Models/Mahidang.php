<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahidang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_mahidang',
        'nama_pelanggan',
        'no_hp',
        'meja_id',
        'catatan',
        'status',
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }
}