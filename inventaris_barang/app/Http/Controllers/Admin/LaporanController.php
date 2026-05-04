<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\BuildsLaporanData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    use BuildsLaporanData;

    public function index(Request $request): View
    {
        return view('admin.laporan.index', array_merge(
            $this->buildLaporanData($request),
            [
                'pageTitle' => 'Laporan Admin',
                'dashboardRoute' => 'admin.dashboard',
                'barangRoute' => 'admin.barang.index',
                'masukRoute' => 'admin.transaksi.masuk.index',
                'keluarRoute' => 'admin.transaksi.keluar.index',
                'laporanRoute' => 'admin.laporan.index',
                'roleLabel' => 'Admin',
            ]
        ));
    }
}
