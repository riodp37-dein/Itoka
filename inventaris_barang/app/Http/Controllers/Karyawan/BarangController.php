<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\Barang;
use App\Http\Controllers\Controller;

class BarangController extends Controller
{
    public function index(){
        $data = Barang::all();
        return view('karyawan.barang.index', compact('data'));
    }

    public function show($id){
        $data = Barang::findOrFail($id);
        return view('karyawan.barang.show', compact('data'));
    }
}