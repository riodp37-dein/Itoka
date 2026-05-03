<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'stok',
        'lokasi'
    ];

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
