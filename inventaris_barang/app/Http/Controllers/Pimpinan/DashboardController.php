<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBarang = Barang::count();
        $barangMasuk = Transaksi::masuk()->sum('jumlah');
        $barangKeluar = Transaksi::keluar()->sum('jumlah');
        $barangMenipis = Barang::lowStock()->count();

        return view('pimpinan.dashboard', compact(
            'totalBarang',
            'barangMasuk',
            'barangKeluar',
            'barangMenipis',
        ));
    }
}
