<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function barangMasuk(): View
    {
        return $this->indexByJenis('masuk');
    }

    public function barangKeluar(): View
    {
        return $this->indexByJenis('keluar');
    }

    public function createBarangMasuk(): View
    {
        return $this->createByJenis('masuk');
    }

    public function createBarangKeluar(): View
    {
        return $this->createByJenis('keluar');
    }

    public function storeBarangMasuk(Request $request): RedirectResponse
    {
        return $this->storeByJenis($request, 'masuk');
    }

    public function storeBarangKeluar(Request $request): RedirectResponse
    {
        return $this->storeByJenis($request, 'keluar');
    }

    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        DB::transaction(function () use ($transaksi): void {
            $barang = Barang::lockForUpdate()->findOrFail($transaksi->barang_id);

            if ($transaksi->jenis === 'masuk') {
                if ($barang->stok < $transaksi->jumlah) {
                    throw ValidationException::withMessages([
                        'transaksi' => 'Transaksi masuk tidak bisa dihapus karena stok saat ini lebih kecil dari jumlah transaksi.',
                    ]);
                }

                $barang->decrement('stok', $transaksi->jumlah);
            } else {
                $barang->increment('stok', $transaksi->jumlah);
            }

            $transaksi->delete();
        });

        $route = $transaksi->jenis === 'masuk'
            ? 'admin.transaksi.masuk.index'
            : 'admin.transaksi.keluar.index';

        return redirect()
            ->route($route)
            ->with('success', 'Transaksi berhasil dihapus dan stok telah disinkronkan.');
    }

    private function indexByJenis(string $jenis): View
    {
        $data = Transaksi::with(['barang', 'user'])
            ->where('jenis', $jenis)
            ->latest()
            ->get();

        return view('admin.transaksi.index', [
            'data' => $data,
            'jenis' => $jenis,
            'pageTitle' => $jenis === 'masuk' ? 'Barang Masuk' : 'Barang Keluar',
        ]);
    }

    private function createByJenis(string $jenis): View
    {
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('admin.transaksi.create', [
            'barangs' => $barangs,
            'jenis' => $jenis,
            'pageTitle' => $jenis === 'masuk' ? 'Tambah Barang Masuk' : 'Tambah Barang Keluar',
        ]);
    }

    private function storeByJenis(Request $request, string $jenis): RedirectResponse
    {
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated, $jenis): void {
            $barang = Barang::lockForUpdate()->findOrFail($validated['barang_id']);

            if ($jenis === 'keluar' && $barang->stok < $validated['jumlah']) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Stok barang tidak mencukupi untuk transaksi keluar.',
                ]);
            }

            Transaksi::create([
                'user_id' => auth()->id(),
                'barang_id' => $barang->id,
                'jumlah' => $validated['jumlah'],
                'jenis' => $jenis,
            ]);

            if ($jenis === 'masuk') {
                $barang->increment('stok', $validated['jumlah']);
            } else {
                $barang->decrement('stok', $validated['jumlah']);
            }
        });

        $route = $jenis === 'masuk'
            ? 'admin.transaksi.masuk.index'
            : 'admin.transaksi.keluar.index';

        return redirect()
            ->route($route)
            ->with('success', 'Transaksi berhasil disimpan dan stok telah diperbarui.');
    }
}
