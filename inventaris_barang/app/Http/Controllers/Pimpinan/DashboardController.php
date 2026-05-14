<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Concerns\BuildsDashboardChartData;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use BuildsDashboardChartData;

    public function index(): View
    {
        $totalBarang = Barang::count();
        $barangMasuk = Transaksi::masuk()->sum('jumlah');
        $barangKeluar = Transaksi::keluar()->sum('jumlah');
        $barangMenipis = Barang::lowStock()->count();
        $stokTerbanyak = Barang::orderByDesc('stok')
            ->limit(6)
            ->get();

        $stokChart = $this->buildStockChartData($stokTerbanyak);
        $ringkasanPersediaanChart = $this->buildSupplySummaryChartData($totalBarang, $barangMenipis);

        return view('pimpinan.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'barangMenipis',
            'stokChart',
            'ringkasanPersediaanChart',
        ));
    }
}
