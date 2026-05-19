<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Concerns\BuildsLaporanData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
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
                'exportPdfRoute' => 'admin.laporan.export.pdf',
                'roleLabel' => 'Admin',
            ]
        ));
    }

    public function exportPdf(Request $request): Response
    {
        $data = array_merge(
            $this->buildLaporanData($request),
            [
                'pageTitle' => 'Laporan Admin',
                'roleLabel' => 'Admin',
            ]
        );

        $pdf = Pdf::loadView('laporan.pdf', $data)->setPaper('a4', 'portrait');
        $filename = 'laporan-admin-' . $data['filters']['start_date'] . '-sampai-' . $data['filters']['end_date'] . '.pdf';

        return $pdf->download($filename);
    }
}
