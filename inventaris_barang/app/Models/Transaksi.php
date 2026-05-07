<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    public const JENIS_MASUK = 'masuk';
    public const JENIS_KELUAR = 'keluar';

    public const JENIS_OPTIONS = [
        self::JENIS_MASUK,
        self::JENIS_KELUAR,
    ];

    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'jenis',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeJenis(Builder $query, string $jenis): Builder
    {
        return $query->where('jenis', $jenis);
    }

    public function scopeMasuk(Builder $query): Builder
    {
        return $query->jenis(self::JENIS_MASUK);
    }

    public function scopeKeluar(Builder $query): Builder
    {
        return $query->jenis(self::JENIS_KELUAR);
    }

    public function isMasuk(): bool
    {
        return $this->jenis === self::JENIS_MASUK;
    }

    public function isKeluar(): bool
    {
        return $this->jenis === self::JENIS_KELUAR;
    }
}
