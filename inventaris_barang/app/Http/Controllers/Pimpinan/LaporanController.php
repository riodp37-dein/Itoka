<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Concerns\BuildsLaporanData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    use BuildsLaporanData;

    public function index(Request $request): View
    {
        return view('pimpinan.laporan.index', array_merge(
            $this->buildLaporanData($request),
            [
                'pageTitle' => 'Laporan Pimpinan',
                'dashboardRoute' => 'pimpinan.dashboard',
                'barangRoute' => null,
                'masukRoute' => null,
                'keluarRoute' => null,
                'laporanRoute' => 'pimpinan.laporan.index',
                'roleLabel' => 'Pimpinan',
            ]
        ));
    }
}
