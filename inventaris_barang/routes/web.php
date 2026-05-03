<?php

use App\Http\Controllers\Auth\LoginController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BarangController as AdminBarang;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\TransaksiController as AdminTransaksi;

// Pimpinan
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboard;
use App\Http\Controllers\Pimpinan\LaporanController as PimpinanLaporan;

// Karyawan
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboard;
use App\Http\Controllers\Karyawan\BarangController as KaryawanBarang;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('admin.dashboard'); 
    Route::resource('/barang', AdminBarang::class)
            ->except('show')
            ->names('admin.barang');
    Route::get('/barang-masuk', [AdminTransaksi::class, 'barangMasuk'])
            ->name('admin.transaksi.masuk.index');
    Route::get('/barang-masuk/create', [AdminTransaksi::class, 'createBarangMasuk'])
            ->name('admin.transaksi.masuk.create');
    Route::post('/barang-masuk', [AdminTransaksi::class, 'storeBarangMasuk'])
            ->name('admin.transaksi.masuk.store');
    Route::get('/barang-keluar', [AdminTransaksi::class, 'barangKeluar'])
            ->name('admin.transaksi.keluar.index');
    Route::get('/barang-keluar/create', [AdminTransaksi::class, 'createBarangKeluar'])
            ->name('admin.transaksi.keluar.create');
    Route::post('/barang-keluar', [AdminTransaksi::class, 'storeBarangKeluar'])
            ->name('admin.transaksi.keluar.store');
    Route::delete('/transaksi/{transaksi}', [AdminTransaksi::class, 'destroy'])
            ->name('admin.transaksi.destroy');
    Route::get('/laporan', [AdminLaporan::class, 'index'])
            ->name('admin.laporan.index');
});

// PIMPINAN
Route::middleware(['auth','role:pimpinan'])->prefix('pimpinan')->group(function(){
    Route::get('/dashboard', [PimpinanDashboard::class, 'index'])
            ->name('pimpinan.dashboard');
    Route::get('/laporan', [PimpinanLaporan::class, 'index'])
            ->name('pimpinan.laporan.index');
});

// KARYAWAN
Route::middleware(['auth','role:karyawan'])->prefix('karyawan')->group(function(){
    Route::get('/dashboard',[KaryawanDashboard::class,'index']);
    Route::get('/barang',[KaryawanBarang::class,'index']);
    Route::get('/barang/{id}',[KaryawanBarang::class,'show']);
});
