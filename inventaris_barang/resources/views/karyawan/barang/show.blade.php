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
        .layout { display: grid; grid-template-columns: minmax(0, 600px) minmax(0, 420px); gap: 24px; align-items: start; }
        .card { background-color: #FFFFFF; padding: 30px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .card h2 { font-size: 22px; color: #111827; margin-bottom: 24px; border-bottom: 1px solid #E5E7EB; padding-bottom: 15px; }
        .detail-row { display: flex; margin-bottom: 16px; align-items: center; }
        .detail-label { width: 150px; font-weight: 600; color: #6B7280; font-size: 15px; }
        .detail-value { flex: 1; color: #111827; font-size: 16px; }
        .back-btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; background-color: #F3F4F6; color: #4B5563; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 25px; transition: background-color 0.2s; }
        .back-btn:hover { background-color: #E5E7EB; }
        .badge { background-color: #EFF6FF; color: #1E3A8A; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 14px; }
        .alert { padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background-color: #DCFCE7; color: #166534; border: 1px solid #86EFAC; }
        .error-list { background-color: #FEE2E2; color: #B91C1C; border: 1px solid #FCA5A5; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; }
        .error-list ul { margin: 0; padding-left: 18px; }
        .helper { margin-top: 8px; font-size: 13px; color: #6B7280; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 15px; font-weight: 700; color: #111827; margin-bottom: 8px; }
        .form-group input { width: 100%; padding: 12px 14px; border: 1px solid #CBD5E1; border-radius: 10px; font-size: 15px; }
        .form-group input:focus { outline: none; border-color: #1E3A8A; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1); }
        .btn-primary { width: 100%; border: none; border-radius: 10px; background-color: #1E3A8A; color: #FFFFFF; padding: 13px 18px; font-size: 15px; font-weight: 700; cursor: pointer; }
        .btn-primary:disabled { background-color: #94A3B8; cursor: not-allowed; }
        .history-list { display: grid; gap: 12px; }
        .history-item { padding: 14px 16px; border: 1px solid #E5E7EB; border-radius: 12px; background-color: #F8FAFC; }
        .history-item strong { display: block; color: #111827; margin-bottom: 4px; }
        .history-meta { font-size: 13px; color: #6B7280; }
        .empty-state { color: #6B7280; font-size: 14px; }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .content { padding: 20px; }
            .layout { grid-template-columns: 1fr; }
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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="layout">
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

                    <a href="{{ route('karyawan.barang.index') }}" class="back-btn">
                        &larr; Kembali ke Daftar Barang
                    </a>
                </div>

                <div class="card">
                    <h2>Keluarkan Barang</h2>

                    <form method="POST" action="{{ route('karyawan.barang.keluar', $data) }}">
                        @csrf

                        <div class="form-group">
                            <label for="jumlah">Jumlah Keluar</label>
                            <input
                                type="number"
                                id="jumlah"
                                name="jumlah"
                                min="1"
                                max="{{ $data->stok }}"
                                value="{{ old('jumlah', 1) }}"
                                required
                                {{ $data->stok < 1 ? 'disabled' : '' }}
                            >
                            <div class="helper">
                                Maksimal {{ $data->stok }} unit sesuai stok tersedia.
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" {{ $data->stok < 1 ? 'disabled' : '' }}>
                            Simpan Pengeluaran
                        </button>
                    </form>

                    <div style="margin-top: 28px;">
                        <h2 style="font-size: 18px; margin-bottom: 16px;">Riwayat Pengeluaran Terbaru</h2>

                        @if($riwayatPengeluaran->isEmpty())
                            <div class="empty-state">Belum ada transaksi pengeluaran untuk barang ini.</div>
                        @else
                            <div class="history-list">
                                @foreach($riwayatPengeluaran as $transaksi)
                                    <div class="history-item">
                                        <strong>{{ $transaksi->jumlah }} unit dikeluarkan</strong>
                                        <div class="history-meta">
                                            Oleh {{ $transaksi->user?->name ?? 'Pengguna tidak ditemukan' }} pada
                                            {{ $transaksi->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
