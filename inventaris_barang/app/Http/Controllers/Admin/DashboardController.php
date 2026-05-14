<?php

namespace App\Http\Controllers\Admin;

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

        $stokMenipis = Barang::lowStock()
            ->orderBy('stok')
            ->limit(5)
            ->get();

        $transaksiMasukTerbaru = Transaksi::with('barang')
            ->where('jenis', 'masuk')
            ->latest()
            ->limit(5)
            ->get();

        $transaksiKeluarTerbaru = Transaksi::with('barang')
            ->where('jenis', 'keluar')
            ->latest()
            ->limit(5)
            ->get();

        $stokTerbanyak = Barang::orderByDesc('stok')
            ->limit(6)
            ->get();

        $stokChart = $this->buildStockChartData($stokTerbanyak, [
            'stock' => '#1E3A8A',
            'minimum' => '#FCA5A5',
        ]);

        return view('admin.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'barangMenipis',
            'stokMenipis',
            'transaksiMasukTerbaru',
            'transaksiKeluarTerbaru',
            'stokTerbanyak',
            'stokChart',
        ));
    }
}
