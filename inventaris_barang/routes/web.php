<?php

use App\Http\Controllers\Auth\LoginController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\BarangController as AdminBarang;

// Pimpinan
use App\Http\Controllers\Pimpinan\DashboardController as PimpinanDashboard;

// Karyawan
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboard;
use App\Http\Controllers\Karyawan\BarangController as KaryawanBarang;

Route::get('/', function () {
    return view('landing');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('admin.dashboard'); 
    Route::resource('/barang', AdminBarang::class)
            ->names('admin.barang');
});

// PIMPINAN
Route::middleware(['auth','role:pimpinan'])->prefix('pimpinan')->group(function(){
    Route::get('/dashboard', [PimpinanDashboard::class, 'index']);
});

// KARYAWAN
Route::middleware(['auth','role:karyawan'])->prefix('karyawan')->group(function(){
    Route::get('/dashboard',[KaryawanDashboard::class,'index']);
    Route::get('/barang',[KaryawanBarang::class,'index']);
    Route::get('/barang/{id}',[KaryawanBarang::class,'show']);
});
