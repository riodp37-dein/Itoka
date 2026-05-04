<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

trait BuildsLaporanData
{
    protected function buildLaporanData(Request $request): array
    {
        $today = Carbon::today();
        $startDate = $request->input('start_date', $today->copy()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', $today->toDateString());

        $validated = validator(
            ['start_date' => $startDate, 'end_date' => $endDate],
            [
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            ]
        )->validate();

        $start = Carbon::parse($validated['start_date'])->startOfDay();
        $end = Carbon::parse($validated['end_date'])->endOfDay();

        $baseQuery = Transaksi::query()->whereBetween('transaksis.created_at', [$start, $end]);

        $transaksiMasuk = (clone $baseQuery)
            ->with(['barang', 'user'])
            ->where('jenis', 'masuk')
            ->latest()
            ->get();

        $transaksiKeluar = (clone $baseQuery)
            ->with(['barang', 'user'])
            ->where('jenis', 'keluar')
            ->latest()
            ->get();

        $rekapBarang = (clone $baseQuery)
            ->join('barangs', 'transaksis.barang_id', '=', 'barangs.id')
            ->select(
                'barangs.id',
                'barangs.kode_barang',
                'barangs.nama_barang',
                'barangs.lokasi',
                'barangs.stok',
                DB::raw("SUM(CASE WHEN transaksis.jenis = 'masuk' THEN transaksis.jumlah ELSE 0 END) as total_masuk"),
                DB::raw("SUM(CASE WHEN transaksis.jenis = 'keluar' THEN transaksis.jumlah ELSE 0 END) as total_keluar")
            )
            ->groupBy('barangs.id', 'barangs.kode_barang', 'barangs.nama_barang', 'barangs.lokasi', 'barangs.stok')
            ->orderBy('barangs.nama_barang')
            ->get();

        return [
            'filters' => [
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
            ],
            'jumlahTransaksiMasuk' => $transaksiMasuk->count(),
            'jumlahTransaksiKeluar' => $transaksiKeluar->count(),
            'totalBarangMasuk' => $transaksiMasuk->sum('jumlah'),
            'totalBarangKeluar' => $transaksiKeluar->sum('jumlah'),
            'transaksiMasuk' => $transaksiMasuk,
            'transaksiKeluar' => $transaksiKeluar,
            'rekapBarang' => $rekapBarang,
        ];
    }
}
