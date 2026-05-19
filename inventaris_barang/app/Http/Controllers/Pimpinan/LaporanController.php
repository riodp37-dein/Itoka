<?php

namespace App\Http\Controllers\Pimpinan;

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
        return view('pimpinan.laporan.index', array_merge(
            $this->buildLaporanData($request),
            [
                'pageTitle' => 'Laporan Pimpinan',
                'dashboardRoute' => 'pimpinan.dashboard',
                'barangRoute' => null,
                'masukRoute' => null,
                'keluarRoute' => null,
                'laporanRoute' => 'pimpinan.laporan.index',
                'exportPdfRoute' => 'pimpinan.laporan.export.pdf',
                'roleLabel' => 'Pimpinan',
            ]
        ));
    }

    public function exportPdf(Request $request): Response
    {
        $data = array_merge(
            $this->buildLaporanData($request),
            [
                'pageTitle' => 'Laporan Pimpinan',
                'roleLabel' => 'Pimpinan',
            ]
        );

        $pdf = Pdf::loadView('laporan.pdf', $data)->setPaper('a4', 'portrait');
        $filename = 'laporan-pimpinan-' . $data['filters']['start_date'] . '-sampai-' . $data['filters']['end_date'] . '.pdf';

        return $pdf->download($filename);
    }
}
