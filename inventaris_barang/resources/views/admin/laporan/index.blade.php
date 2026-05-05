<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Sistem Inventaris</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #F3F4F6; min-height: 100vh; display: flex; }
        .sidebar { width: 250px; background-color: #1E3A8A; color: white; display: flex; flex-direction: column; position: fixed; height: 100vh; left: 0; top: 0; }
        .sidebar-header { padding: 25px 20px; background-color: rgba(0, 0, 0, 0.15); }
        .sidebar-header h2 { font-size: 22px; font-weight: 700; letter-spacing: 2px; }
        .sidebar-menu { flex: 1; padding: 30px 0; }
        .menu-item { padding: 15px 25px; color: #FFFFFF; text-decoration: none; display: block; border-left: 4px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.15); border-left-color: #FFFFFF; }
        .logout-btn { padding: 15px 25px; margin: 20px; background-color: rgba(255, 255, 255, 0.1); border: 2px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 10px; cursor: pointer; font-size: 15px; }
        .main-content { margin-left: 250px; flex: 1; }
        .header { background-color: #1E3A8A; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 28px; color: #FFFFFF; font-weight: 700; }
        .user-avatar { width: 45px; height: 45px; background-color: #FFFFFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1E3A8A; font-size: 18px; font-weight: 700; }
        .content { padding: 30px 40px; }
        .filter-card, .stats-card, .table-card { background-color: #FFFFFF; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .filter-card, .table-card { padding: 24px; margin-bottom: 24px; }
        .filter-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; align-items: end; }
        .form-group label { display: block; font-size: 14px; font-weight: 700; color: #374151; margin-bottom: 8px; }
        .form-group input { width: 100%; padding: 12px 14px; border: 1px solid #D1D5DB; border-radius: 10px; font-size: 14px; }
        .filter-btn { padding: 12px 18px; border: none; background-color: #1E3A8A; color: white; border-radius: 10px; cursor: pointer; font-weight: 700; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
        .stats-card { padding: 24px; }
        .stats-card h3 { font-size: 14px; color: #6B7280; margin-bottom: 10px; }
        .stats-card .number { font-size: 32px; font-weight: 700; color: #111827; }
        .section-title { font-size: 20px; color: #111827; margin-bottom: 18px; }
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        table th { background-color: #1E3A8A; color: white; padding: 12px; text-align: left; font-size: 14px; }
        table td { padding: 12px; border-bottom: 1px solid #E5E7EB; font-size: 14px; color: #1F2937; }
        .split-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .empty-text { color: #6B7280; font-size: 14px; }
        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .split-grid, .filter-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .content { padding: 20px; }
        }
        @media (max-width: 640px) {
            .sidebar { transform: translateX(-100%); z-index: 1000; }
            .main-content { margin-left: 0; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>INVENTARIS</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route($dashboardRoute) }}" class="menu-item">Dashboard</a>
            <a href="{{ route($barangRoute) }}" class="menu-item">Data Barang</a>
            <a href="{{ route($masukRoute) }}" class="menu-item">Barang Masuk</a>
            <a href="{{ route($keluarRoute) }}" class="menu-item">Barang Keluar</a>
            <a href="{{ route($laporanRoute) }}" class="menu-item active">Laporan</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>{{ $pageTitle }}</h1>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>

        <div class="content">
            <div class="filter-card">
                <h2 class="section-title">Filter Tanggal</h2>
                <form method="GET" action="{{ route($laporanRoute) }}">
                    <div class="filter-grid">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai</label>
                            <input type="date" id="start_date" name="start_date" value="{{ $filters['start_date'] }}" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir</label>
                            <input type="date" id="end_date" name="end_date" value="{{ $filters['end_date'] }}" required>
                        </div>
                        <button type="submit" class="filter-btn">Tampilkan Laporan</button>
                    </div>
                </form>
            </div>

            <div class="stats-grid">
                <div class="stats-card">
                    <h3>Transaksi Masuk</h3>
                    <div class="number">{{ $jumlahTransaksiMasuk }}</div>
                </div>
                <div class="stats-card">
                    <h3>Total Unit Masuk</h3>
                    <div class="number">{{ $totalBarangMasuk }}</div>
                </div>
                <div class="stats-card">
                    <h3>Transaksi Keluar</h3>
                    <div class="number">{{ $jumlahTransaksiKeluar }}</div>
                </div>
                <div class="stats-card">
                    <h3>Total Unit Keluar</h3>
                    <div class="number">{{ $totalBarangKeluar }}</div>
                </div>
            </div>

            <div class="table-card">
                <h2 class="section-title">Rekap Per Barang</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Lokasi</th>
                                <th>Masuk</th>
                                <th>Keluar</th>
                                <th>Stok Saat Ini</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekapBarang as $barang)
                                <tr>
                                    <td>{{ $barang->kode_barang }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->lokasi }}</td>
                                    <td>{{ $barang->total_masuk }}</td>
                                    <td>{{ $barang->total_keluar }}</td>
                                    <td>{{ $barang->stok }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada transaksi pada rentang tanggal ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="split-grid">
                <div class="table-card">
                    <h2 class="section-title">Detail Barang Masuk</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiMasuk as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                        <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                        <td>{{ $transaksi->jumlah }}</td>
                                        <td>{{ $transaksi->user->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Belum ada transaksi masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-card">
                    <h2 class="section-title">Detail Barang Keluar</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiKeluar as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                        <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                        <td>{{ $transaksi->jumlah }}</td>
                                        <td>{{ $transaksi->user->name ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Belum ada transaksi keluar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
