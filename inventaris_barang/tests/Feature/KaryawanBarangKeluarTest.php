<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KaryawanBarangKeluarTest extends TestCase
{
    use RefreshDatabase;

    public function test_karyawan_dapat_mengeluarkan_barang_dan_stok_berkurang(): void
    {
        $karyawan = User::factory()->create([
            'role' => User::ROLE_KARYAWAN,
        ]);

        $barang = Barang::create([
            'nama_barang' => 'Laptop Lenovo',
            'kode_barang' => 'BRG-001',
            'stok' => 10,
            'lokasi' => 'Gudang A',
        ]);

        $response = $this->actingAs($karyawan)->post(route('karyawan.barang.keluar', $barang), [
            'jumlah' => 3,
        ]);

        $response->assertRedirect(route('karyawan.barang.show', $barang));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('transaksis', [
            'user_id' => $karyawan->id,
            'barang_id' => $barang->id,
            'jumlah' => 3,
            'jenis' => Transaksi::JENIS_KELUAR,
        ]);

        $this->assertDatabaseHas('barangs', [
            'id' => $barang->id,
            'stok' => 7,
        ]);
    }

    public function test_karyawan_tidak_dapat_mengeluarkan_barang_melebihi_stok(): void
    {
        $karyawan = User::factory()->create([
            'role' => User::ROLE_KARYAWAN,
        ]);

        $barang = Barang::create([
            'nama_barang' => 'Mouse Wireless',
            'kode_barang' => 'BRG-002',
            'stok' => 2,
            'lokasi' => 'Gudang B',
        ]);

        $response = $this->from(route('karyawan.barang.show', $barang))
            ->actingAs($karyawan)
            ->post(route('karyawan.barang.keluar', $barang), [
                'jumlah' => 3,
            ]);

        $response->assertRedirect(route('karyawan.barang.show', $barang));
        $response->assertSessionHasErrors('jumlah');

        $this->assertDatabaseMissing('transaksis', [
            'barang_id' => $barang->id,
            'jenis' => Transaksi::JENIS_KELUAR,
        ]);

        $this->assertDatabaseHas('barangs', [
            'id' => $barang->id,
            'stok' => 2,
        ]);
    }
}
