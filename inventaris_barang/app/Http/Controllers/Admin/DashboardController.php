<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBarang = Barang::count();
        $barangMasuk = Transaksi::where('jenis', 'masuk')->sum('jumlah');
        $barangKeluar = Transaksi::where('jenis', 'keluar')->sum('jumlah');
        $barangMenipis = Barang::where('stok', '<=', 5)->count();

        $stokMenipis = Barang::where('stok', '<=', 5)
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

        return view('admin.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'barangMenipis',
            'stokMenipis',
            'transaksiMasukTerbaru',
            'transaksiKeluarTerbaru',
            'stokTerbanyak',
        ));
    }
}
