<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang - Sistem Inventaris</title>
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
        .card { background-color: #FFFFFF; padding: 30px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); max-width: 600px; }
        .card h2 { font-size: 22px; color: #111827; margin-bottom: 24px; border-bottom: 1px solid #E5E7EB; padding-bottom: 15px; }
        .detail-row { display: flex; margin-bottom: 16px; align-items: center; }
        .detail-label { width: 150px; font-weight: 600; color: #6B7280; font-size: 15px; }
        .detail-value { flex: 1; color: #111827; font-size: 16px; }
        .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background-color: #F3F4F6; color: #4B5563; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 25px; transition: background-color 0.2s; }
        .back-btn:hover { background-color: #E5E7EB; }
        .badge { background-color: #EFF6FF; color: #1E3A8A; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 14px; }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .content { padding: 20px; }
        }
        @media (max-width: 640px) {
            .sidebar { transform: translateX(-100%); z-index: 1000; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>INVENTARIS</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ url('/karyawan/dashboard') }}" class="menu-item">Dashboard</a>
            <a href="{{ url('/karyawan/barang') }}" class="menu-item active">Lihat Barang</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Detail Barang</h1>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}</div>
        </div>

        <div class="content">
            <div class="card">
                <h2>Informasi Barang</h2>
                
                <div class="detail-row">
                    <div class="detail-label">Nama Barang</div>
                    <div class="detail-value"><strong>{{ $data->nama_barang }}</strong></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Kode Barang</div>
                    <div class="detail-value">{{ $data->kode_barang }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Stok Tersedia</div>
                    <div class="detail-value"><span class="badge">{{ $data->stok }}</span></div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label">Lokasi</div>
                    <div class="detail-value">{{ $data->lokasi }}</div>
                </div>

                <a href="{{ url('/karyawan/barang') }}" class="back-btn">
                    &larr; Kembali ke Daftar Barang
                </a>
            </div>
        </div>
    </div>
</body>
</html>