<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class DashboardController extends Controller
{
    public function index()
    {
        //hitung total barang
        $totalBarang = Barang::count();

        // barang hampir habis (stok <= 5)
        $hampirHabis = Barang::where('stok', '<=', 5)->get();

        return view('karyawan.dashboard', compact('totalBarang', 'hampirHabis'));
    }
}