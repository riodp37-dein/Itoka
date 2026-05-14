<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Barang;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait BuildsDashboardChartData
{
    protected function buildStockChartData(Collection $barangs, array $colors = []): array
    {
        $stockColor = $colors['stock'] ?? '#1E3A8A';
        $minimumColor = $colors['minimum'] ?? '#93C5FD';

        return [
            'labels' => $barangs->map(fn (Barang $barang) => Str::limit($barang->nama_barang, 12))->values(),
            'datasets' => [
                [
                    'label' => 'Stok Saat Ini',
                    'data' => $barangs->map(fn (Barang $barang) => (int) $barang->stok)->values(),
                    'backgroundColor' => $stockColor,
                    'borderRadius' => 8,
                ],
                [
                    'label' => 'Batas Minimum',
                    'data' => $barangs->map(fn () => Barang::LOW_STOCK_THRESHOLD)->values(),
                    'backgroundColor' => $minimumColor,
                    'borderRadius' => 8,
                ],
            ],
        ];
    }

    protected function buildSupplySummaryChartData(int $totalBarang, int $barangMenipis): array
    {
        return [
            'labels' => ['Stok Aman', 'Stok Menipis'],
            'datasets' => [
                [
                    'data' => [
                        max($totalBarang - $barangMenipis, 0),
                        $barangMenipis,
                    ],
                    'backgroundColor' => ['#2563EB', '#F59E0B'],
                    'borderWidth' => 0,
                ],
            ],
        ];
    }
}
