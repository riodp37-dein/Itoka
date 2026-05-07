<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    public const LOW_STOCK_THRESHOLD = 5;

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

    public function scopeLowStock(Builder $query, ?int $threshold = null): Builder
    {
        return $query->where('stok', '<=', $threshold ?? self::LOW_STOCK_THRESHOLD);
    }
}
