<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Barang;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        $periodeHarian = collect();
        $cursor = $start->copy()->startOfDay();
        $lastDay = $end->copy()->startOfDay();

        while ($cursor->lte($lastDay)) {
            $periodeHarian->push($cursor->copy());
            $cursor->addDay();
        }

        $transaksiHarian = (clone $baseQuery)
            ->selectRaw("DATE(transaksis.created_at) as tanggal")
            ->selectRaw("SUM(CASE WHEN jenis = 'masuk' THEN jumlah ELSE 0 END) as total_masuk")
            ->selectRaw("SUM(CASE WHEN jenis = 'keluar' THEN jumlah ELSE 0 END) as total_keluar")
            ->groupBy(DB::raw("DATE(transaksis.created_at)"))
            ->orderBy(DB::raw("DATE(transaksis.created_at)"))
            ->get()
            ->keyBy('tanggal');

        $trenTransaksiChart = [
            'labels' => $periodeHarian->map(fn (Carbon $date) => $date->format('d M'))->values(),
            'masuk' => $periodeHarian->map(
                fn (Carbon $date) => (int) optional($transaksiHarian->get($date->toDateString()))->total_masuk
            )->values(),
            'keluar' => $periodeHarian->map(
                fn (Carbon $date) => (int) optional($transaksiHarian->get($date->toDateString()))->total_keluar
            )->values(),
        ];

        $topBarangChartSource = $rekapBarang
            ->sortByDesc(fn ($barang) => ($barang->total_masuk + $barang->total_keluar))
            ->take(8)
            ->values();

        $rekapBarangChart = [
            'labels' => $topBarangChartSource->map(fn ($barang) => Str::limit($barang->nama_barang, 12))->values(),
            'masuk' => $topBarangChartSource->map(fn ($barang) => (int) $barang->total_masuk)->values(),
            'keluar' => $topBarangChartSource->map(fn ($barang) => (int) $barang->total_keluar)->values(),
            'stok' => $topBarangChartSource->map(fn ($barang) => (int) $barang->stok)->values(),
        ];

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
            'trenTransaksiChart' => $trenTransaksiChart,
            'rekapBarangChart' => $rekapBarangChart,
        ];
    }
}
