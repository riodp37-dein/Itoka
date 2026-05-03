<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #F5F5F5; min-height: 100vh; display: flex; }
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
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background-color: #FFFFFF; padding: 24px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .stat-card h3 { font-size: 14px; color: #6B7280; margin-bottom: 10px; }
        .stat-card .number { font-size: 34px; color: #111827; font-weight: 700; }
        .dashboard-grid { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 24px; margin-bottom: 24px; }
        .card { background-color: #FFFFFF; padding: 24px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .card h2 { font-size: 20px; color: #111827; margin-bottom: 18px; }
        .chart-container { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; align-items: end; height: 220px; padding-top: 8px; }
        .chart-group { display: flex; align-items: end; gap: 6px; height: 100%; }
        .chart-bar { flex: 1; border-radius: 10px 10px 0 0; min-height: 18px; }
        .bar-stock { background: linear-gradient(180deg, #3B82F6 0%, #1E3A8A 100%); }
        .bar-min { background: linear-gradient(180deg, #FCA5A5 0%, #DC2626 100%); }
        .chart-label { margin-top: 10px; font-size: 12px; color: #6B7280; text-align: center; }
        .chart-legend { display: flex; gap: 18px; margin-top: 16px; font-size: 14px; color: #4B5563; }
        .legend-item { display: flex; align-items: center; gap: 8px; }
        .legend-color { width: 16px; height: 16px; border-radius: 4px; }
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        table th { background-color: #1E3A8A; color: #FFFFFF; padding: 12px; text-align: left; font-size: 14px; }
        table td { padding: 12px; border-bottom: 1px solid #E5E7EB; font-size: 14px; color: #1F2937; }
        .quick-links { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .quick-link { display: block; padding: 16px; border-radius: 12px; background-color: #F8FAFC; border: 1px solid #E5E7EB; text-decoration: none; color: #111827; }
        .quick-link strong { display: block; margin-bottom: 6px; }
        .muted { color: #6B7280; font-size: 13px; }
        .empty-text { color: #6B7280; font-size: 14px; }
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .dashboard-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .content { padding: 20px; }
            .quick-links { grid-template-columns: 1fr; }
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">Dashboard</a>
            <a href="{{ route('admin.barang.index') }}" class="menu-item">Data Barang</a>
            <a href="{{ route('admin.transaksi.masuk.index') }}" class="menu-item">Barang Masuk</a>
            <a href="{{ route('admin.transaksi.keluar.index') }}" class="menu-item">Barang Keluar</a>
            <a href="{{ route('admin.laporan.index') }}" class="menu-item">Laporan</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard Inventaris</h1>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>

        <div class="content">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Jenis Barang</h3>
                    <div class="number">{{ $totalBarang }}</div>
                </div>
                <div class="stat-card">
                    <h3>Total Barang Masuk</h3>
                    <div class="number">{{ $barangMasuk }}</div>
                </div>
                <div class="stat-card">
                    <h3>Total Barang Keluar</h3>
                    <div class="number">{{ $barangKeluar }}</div>
                </div>
                <div class="stat-card">
                    <h3>Stok Menipis</h3>
                    <div class="number">{{ $barangMenipis }}</div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <h2>Ringkasan Stok</h2>
                    @if($stokTerbanyak->count() > 0)
                        @php
                            $maxStock = max($stokTerbanyak->max('stok'), 1);
                        @endphp
                        <div class="chart-container">
                            @foreach($stokTerbanyak as $barang)
                                <div>
                                    <div class="chart-group">
                                        <div class="chart-bar bar-stock" style="height: {{ max(($barang->stok / $maxStock) * 100, 12) }}%;"></div>
                                        <div class="chart-bar bar-min" style="height: {{ $barang->stok <= 5 ? 100 : 12 }}%;"></div>
                                    </div>
                                    <div class="chart-label">{{ \Illuminate\Support\Str::limit($barang->nama_barang, 10) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #1E3A8A;"></div>
                                <span>Stok saat ini</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #DC2626;"></div>
                                <span>Indikator stok kritis</span>
                            </div>
                        </div>
                    @else
                        <p class="empty-text">Belum ada data barang untuk ditampilkan.</p>
                    @endif
                </div>

                <div class="card">
                    <h2>Menu Utama</h2>
                    <div class="quick-links">
                        <a href="{{ route('admin.barang.index') }}" class="quick-link">
                            <strong>Data Barang</strong>
                            <span class="muted">Kelola master barang dan stok awal.</span>
                        </a>
                        <a href="{{ route('admin.transaksi.masuk.index') }}" class="quick-link">
                            <strong>Barang Masuk</strong>
                            <span class="muted">Tambah riwayat barang masuk dan stok otomatis naik.</span>
                        </a>
                        <a href="{{ route('admin.transaksi.keluar.index') }}" class="quick-link">
                            <strong>Barang Keluar</strong>
                            <span class="muted">Catat barang keluar dan stok otomatis berkurang.</span>
                        </a>
                        <a href="{{ route('admin.laporan.index') }}" class="quick-link">
                            <strong>Laporan</strong>
                            <span class="muted">Filter tanggal dan lihat rekap barang masuk maupun keluar.</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="card">
                    <h2>Stok Menipis</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stokMenipis as $barang)
                                    <tr>
                                        <td>{{ $barang->kode_barang }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        <td>{{ $barang->stok }}</td>
                                        <td>{{ $barang->lokasi }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Tidak ada barang dengan stok menipis.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <h2>Barang Masuk Terbaru</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksiMasukTerbaru as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                        <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                        <td>{{ $transaksi->jumlah }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Belum ada transaksi barang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <h2>Barang Keluar Terbaru</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiKeluarTerbaru as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                    <td>{{ $transaksi->barang->kode_barang ?? '-' }}</td>
                                    <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $transaksi->jumlah }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada transaksi barang keluar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
