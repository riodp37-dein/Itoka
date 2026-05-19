# SITOKA - Sistem Inventaris Barang Kantor

## Tim Pengembang
Proyek ini dikerjakan oleh `Team Sotok Software Development (SITOKA)`.

### Anggota Tim
- Rio Dwi Prayoga `[2313020009]`
- Krisna Mukti `[2313020034]`
- Ego Didan Triwanda `[2313020016]`

### Mata Kuliah
Software Development

## Deskripsi Aplikasi
SITOKA adalah aplikasi web manajemen inventaris barang kantor yang digunakan untuk mencatat data barang, memantau stok, mengelola transaksi barang masuk dan barang keluar, serta menghasilkan laporan periodik. Aplikasi ini dibuat untuk membantu proses administrasi inventaris agar lebih terstruktur, transparan, dan mudah dipantau oleh setiap peran pengguna.

Source code utama aplikasi berada di folder [`inventaris_barang`](./inventaris_barang).

## Tujuan Sistem
- Mendigitalisasi pencatatan inventaris barang kantor.
- Mengurangi kesalahan pencatatan stok barang.
- Mempermudah pemantauan barang masuk dan barang keluar.
- Menyediakan laporan inventaris yang dapat difilter berdasarkan periode.
- Memisahkan hak akses pengguna sesuai tugas masing-masing.

## Konsep Sistem
Sistem bekerja dengan model inventaris berbasis stok. Setiap barang memiliki identitas unik berupa kode barang, nama barang, jumlah stok, dan lokasi penyimpanan. Perubahan stok tidak dilakukan secara sembarangan, tetapi melalui transaksi yang tercatat di database.

Alur dasarnya sebagai berikut:
- Admin menambahkan data master barang.
- Admin mencatat transaksi barang masuk untuk menambah stok.
- Admin atau karyawan mencatat pengeluaran barang untuk mengurangi stok.
- Setiap transaksi disimpan sebagai riwayat dengan informasi pengguna, barang, jumlah, jenis transaksi, dan waktu transaksi.
- Pimpinan memantau ringkasan dashboard dan mengunduh laporan PDF untuk evaluasi.

## Role Pengguna
### 1. Admin
Admin memiliki akses penuh terhadap pengelolaan data operasional aplikasi.

Fungsi admin:
- Login ke sistem.
- Mengelola akun pengguna.
- Menambah, mengubah, dan menghapus data barang.
- Mencatat barang masuk.
- Mencatat barang keluar.
- Menghapus transaksi dengan sinkronisasi ulang stok.
- Melihat dashboard inventaris.
- Melihat dan mengekspor laporan PDF.

### 2. Pimpinan
Pimpinan berfokus pada monitoring dan evaluasi data inventaris.

Fungsi pimpinan:
- Login ke sistem.
- Melihat dashboard ringkasan inventaris.
- Melihat laporan transaksi dan rekap barang berdasarkan periode.
- Mengunduh laporan dalam format PDF.

### 3. Karyawan
Karyawan berfokus pada penggunaan barang dan pencatatan pengeluaran barang.

Fungsi karyawan:
- Login ke sistem.
- Melihat daftar barang.
- Melihat detail barang.
- Mengeluarkan barang dari stok.
- Melihat riwayat pengeluaran terbaru pada barang tertentu.
- Melihat notifikasi barang dengan stok menipis.

## Fitur Utama
### Autentikasi dan Otorisasi
- Login sesuai akun pengguna.
- Logout dengan invalidasi session.
- Middleware role untuk membatasi akses halaman berdasarkan peran.
- Reset password sederhana berdasarkan email yang terdaftar.

### Manajemen Pengguna
- Admin dapat membuat akun baru.
- Admin dapat mengubah nama, email, role, dan password pengguna.
- Admin dapat menghapus akun pengguna.
- Sistem menjaga agar admin terakhir tidak bisa dihapus atau diubah ke role lain.
- Pengguna yang sedang login tidak bisa menghapus akunnya sendiri.

### Manajemen Data Barang
- Tambah barang baru.
- Edit data barang.
- Hapus data barang.
- Validasi kode barang agar unik.
- Penyimpanan informasi nama barang, kode barang, stok, dan lokasi.

### Manajemen Transaksi Inventaris
- Pencatatan barang masuk.
- Pencatatan barang keluar.
- Penyesuaian stok dilakukan otomatis saat transaksi disimpan.
- Validasi agar barang keluar tidak melebihi stok yang tersedia.
- Penghapusan transaksi akan menyinkronkan ulang stok.
- Transaksi disimpan lengkap dengan pengguna yang melakukan aksi.

### Dashboard
- Ringkasan total data barang.
- Ringkasan total barang masuk.
- Ringkasan total barang keluar.
- Informasi jumlah barang dengan stok menipis.
- Daftar stok menipis.
- Riwayat transaksi terbaru.
- Visualisasi grafik stok barang.
- Visualisasi ringkasan persediaan untuk pimpinan.

### Laporan
- Filter laporan berdasarkan tanggal awal dan tanggal akhir.
- Menampilkan transaksi masuk per periode.
- Menampilkan transaksi keluar per periode.
- Menampilkan rekap barang per periode.
- Menampilkan tren transaksi harian dalam bentuk grafik.
- Menampilkan barang paling aktif berdasarkan aktivitas transaksi.
- Export laporan ke file PDF.

## Aturan Bisnis Sistem
- Setiap pengguna wajib login sebelum mengakses halaman sesuai rolenya.
- Role pengguna dibagi menjadi `admin`, `pimpinan`, dan `karyawan`.
- Kode barang tidak boleh duplikat.
- Jumlah transaksi harus bilangan bulat dan minimal 1.
- Transaksi barang keluar tidak boleh melebihi stok yang tersedia.
- Penghapusan transaksi akan memperbarui stok agar tetap konsisten.
- Barang dengan stok `<= 5` dianggap stok menipis.

## Struktur Data Inti
### Tabel `users`
Menyimpan data akun pengguna:
- `name`
- `email`
- `password`
- `role`

### Tabel `barangs`
Menyimpan data master inventaris:
- `nama_barang`
- `kode_barang`
- `stok`
- `lokasi`

### Tabel `transaksis`
Menyimpan riwayat pergerakan stok:
- `user_id`
- `barang_id`
- `jumlah`
- `jenis` (`masuk` atau `keluar`)

## Library dan Teknologi
### Backend
- PHP 8.3
- Laravel 13
- Eloquent ORM
- Laravel Validation
- Laravel Middleware
- Laravel Session Authentication

### Frontend
- Blade Template Engine
- Vite
- Tailwind CSS 4
- JavaScript
- Axios

### Library Tambahan
- `barryvdh/laravel-dompdf`
  Digunakan untuk export laporan PDF.
- `laravel/tinker`
  Digunakan untuk debugging dan eksplorasi aplikasi.
- `concurrently`
  Digunakan untuk menjalankan beberapa proses development secara bersamaan.

### Library Development dan Testing
- PHPUnit
- Faker
- Mockery
- Laravel Pint
- Laravel Pail
- Nunomaduro Collision

## Arsitektur Singkat
Proyek ini menggunakan pola arsitektur MVC:
- Model: mengelola data seperti `User`, `Barang`, dan `Transaksi`.
- View: menampilkan antarmuka menggunakan Blade.
- Controller: menangani logika aplikasi seperti dashboard, transaksi, laporan, login, dan manajemen data.

Sistem juga menggunakan:
- Middleware untuk pembatasan hak akses.
- Migration untuk pembentukan struktur database.
- Seeder untuk menyiapkan akun awal.
- Trait untuk membangun data laporan dan data grafik dashboard agar logika dapat dipakai ulang.

## Akun Default Seeder
Setelah menjalankan seeder, akun berikut tersedia:

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@gmail.com` | `123` |
| Pimpinan | `pimpinan@gmail.com` | `123` |
| Karyawan | `karyawan@gmail.com` | `123` |

## Cara Menjalankan Proyek
1. Masuk ke folder aplikasi:

```bash
cd inventaris_barang
```

2. Install dependency backend:

```bash
composer install
```

3. Copy file environment:

```bash
copy .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Atur konfigurasi database pada file `.env`.

6. Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

7. Install dependency frontend:

```bash
npm install
```

8. Jalankan server development:

```bash
php artisan serve
npm run dev
```

## Pengujian
Project sudah memiliki pengujian fitur untuk alur pengeluaran barang oleh karyawan, termasuk:
- Pengeluaran barang berhasil dan stok berkurang.
- Pengeluaran barang gagal jika jumlah melebihi stok.

Perintah menjalankan test:

```bash
php artisan test
```

## Ringkasan
SITOKA merupakan sistem inventaris barang kantor berbasis web yang memusatkan pengelolaan barang, transaksi stok, pemantauan dashboard, serta pelaporan PDF dalam satu aplikasi. Dengan pembagian role yang jelas antara admin, pimpinan, dan karyawan, sistem ini dirancang agar proses inventaris menjadi lebih aman, terukur, dan mudah diawasi.
