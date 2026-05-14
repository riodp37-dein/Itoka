<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function index(): View
    {
        $data = Barang::all();
        return view('karyawan.barang.index', compact('data'));
    }

    public function show($id): View
    {
        $data = Barang::findOrFail($id);
        return view('karyawan.barang.show', compact('data'));
    }

    public function storePengeluaran(Request $request, Barang $barang): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($barang, $validated): void {
            $lockedBarang = Barang::lockForUpdate()->findOrFail($barang->id);

            if ($lockedBarang->stok < $validated['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok barang tidak mencukupi untuk dikeluarkan.',
                ]);
            }

            Transaksi::create([
                'user_id' => auth()->id(),
                'barang_id' => $lockedBarang->id,
                'jumlah' => $validated['jumlah'],
                'jenis' => Transaksi::JENIS_KELUAR,
            ]);

            $lockedBarang->decrement('stok', $validated['jumlah']);
        });

        return redirect()
            ->route('karyawan.barang.show', $barang)
            ->with('success', 'Barang berhasil dikeluarkan dan stok telah diperbarui.');
    }
}
