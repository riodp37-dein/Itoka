# README Aplikasi Inventaris Barang

## Gambaran Singkat
Folder ini berisi source code aplikasi utama SITOKA, yaitu sistem inventaris barang kantor berbasis Laravel. Aplikasi mendukung pengelolaan barang, transaksi stok masuk dan keluar, dashboard berdasarkan role, serta laporan yang dapat diekspor ke PDF.

## Stack yang Digunakan
- PHP 8.3
- Laravel 13
- MySQL atau database relasional lain yang didukung Laravel
- Blade
- Tailwind CSS 4
- Vite
- Axios
- DomPDF

## Modul Utama
- Autentikasi login dan logout
- Reset password sederhana
- Manajemen akun pengguna
- Manajemen data barang
- Transaksi barang masuk
- Transaksi barang keluar
- Dashboard admin
- Dashboard pimpinan
- Dashboard karyawan
- Laporan periode dan export PDF

## Struktur Entitas
### `User`
Mewakili akun sistem dengan role:
- `admin`
- `pimpinan`
- `karyawan`

### `Barang`
Mewakili data inventaris:
- nama barang
- kode barang
- stok
- lokasi

### `Transaksi`
Mewakili riwayat perubahan stok:
- barang masuk
- barang keluar
- jumlah transaksi
- pengguna yang melakukan transaksi

## Aturan Sistem
- Stok barang bertambah saat transaksi `masuk` dibuat.
- Stok barang berkurang saat transaksi `keluar` dibuat.
- Stok tidak boleh minus.
- Penghapusan transaksi akan menyinkronkan stok kembali.
- Barang dengan stok `<= 5` masuk kategori stok menipis.
- Akses route dibatasi oleh middleware role.

## Setup Cepat
```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Untuk mode development paralel, tersedia script:

```bash
composer run dev
```

## Akun Awal
Seeder membuat tiga akun default:

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@gmail.com` | `123` |
| Pimpinan | `pimpinan@gmail.com` | `123` |
| Karyawan | `karyawan@gmail.com` | `123` |

## Testing
Jalankan pengujian dengan:

```bash
php artisan test
```

## Catatan
Penjelasan dokumentasi proyek yang lebih lengkap tersedia pada file root [`../Readme.md`](../Readme.md).
