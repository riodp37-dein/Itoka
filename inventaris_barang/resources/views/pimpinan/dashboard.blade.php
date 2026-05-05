<h1>Dashboard Pimpinan</h1>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan - Sistem Inventaris</title>
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
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
        .stat-card, .info-card { background-color: #FFFFFF; padding: 24px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .stat-card h3 { font-size: 14px; color: #6B7280; margin-bottom: 10px; }
        .stat-card .number { font-size: 32px; font-weight: 700; color: #111827; }
        .info-card h2 { font-size: 20px; color: #111827; margin-bottom: 12px; }
        .info-card p { color: #4B5563; line-height: 1.6; margin-bottom: 16px; }
        .report-link { display: inline-block; padding: 12px 18px; border-radius: 10px; text-decoration: none; background-color: #1E3A8A; color: #FFFFFF; font-weight: 700; }
        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
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
            <a href="{{ route('pimpinan.dashboard') }}" class="menu-item active">Dashboard</a>
            <a href="{{ route('pimpinan.laporan.index') }}" class="menu-item">Laporan</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard Pimpinan</h1>
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

            <div class="info-card">
                <h2>Laporan Inventaris</h2>
                <p>Gunakan halaman laporan untuk melihat rekap barang masuk, barang keluar, dan detail transaksi berdasarkan rentang tanggal tertentu.</p>
                <a href="{{ route('pimpinan.laporan.index') }}" class="report-link">Buka Laporan</a>
            </div>
        </div>
    </div>
</body>
</html>
