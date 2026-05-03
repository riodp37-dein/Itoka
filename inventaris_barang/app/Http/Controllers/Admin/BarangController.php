<?php

namespace App\Http\Controllers\Admin;

use App\Models\Barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Update Kode
class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::latest()->get();
        return view('admin.barang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $r)
    {
        $validated = $r->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs',
            'stok' => 'required|numeric',
            'lokasi' => 'required'
        ]);

        Barang::create($validated);

        return redirect('/admin/barang')->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('data'));
    }

    public function update(Request $r, $id)
    {
        $validated = $r->validate([
            'nama_barang' => 'required',
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $id,
            'stok' => 'required|numeric',
            'lokasi' => 'required'
        ]);

        Barang::findOrFail($id)->update($validated);

        return redirect('/admin/barang')->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return back()->with('success','Data berhasil dihapus');
    }
}
