<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} - Sistem Inventaris</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #E8E8E8; min-height: 100vh; display: flex; }
        .sidebar { width: 250px; background-color: #1E3A8A; color: white; display: flex; flex-direction: column; position: fixed; height: 100vh; left: 0; top: 0; }
        .sidebar-header { padding: 25px 20px; background-color: rgba(0, 0, 0, 0.15); }
        .sidebar-header h2 { font-size: 22px; font-weight: 700; letter-spacing: 2px; color: #FFFFFF; }
        .sidebar-menu { flex: 1; padding: 30px 0; }
        .menu-item { padding: 15px 25px; color: #FFFFFF; text-decoration: none; display: block; transition: all 0.3s; font-size: 15px; border-left: 4px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.15); border-left-color: #FFFFFF; }
        .logout-btn { padding: 15px 25px; margin: 20px; background-color: rgba(255, 255, 255, 0.1); border: 2px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 10px; cursor: pointer; font-size: 15px; }
        .main-content { margin-left: 250px; flex: 1; }
        .header { background-color: #1E3A8A; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 32px; color: #FFFFFF; font-weight: 700; }
        .header-actions { display: flex; align-items: center; gap: 15px; }
        .add-btn { background-color: #B8B8B8; color: #333; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-size: 15px; font-weight: 600; }
        .add-btn:hover { background-color: #A8A8A8; }
        .user-avatar { width: 45px; height: 45px; background-color: #FFFFFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1E3A8A; font-size: 18px; font-weight: 700; }
        .content { padding: 30px 40px; }
        .success-message, .error-message { padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; font-size: 15px; }
        .success-message { background-color: #D4EDDA; color: #155724; border-left: 4px solid #28A745; }
        .error-message { background-color: #FFE5E5; color: #C62828; border-left: 4px solid #C62828; }
        .table-card { background-color: #FFFFFF; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .table-container { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        table thead { background-color: #1E3A8A; }
        table th { padding: 18px 15px; text-align: left; font-size: 15px; font-weight: 700; color: #FFFFFF; }
        table td { padding: 18px 15px; border-bottom: 1px solid #F0F0F0; font-size: 14px; color: #333; }
        table tbody tr:hover { background-color: #F8F8F8; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; }
        .badge-masuk { background-color: #D4EDDA; color: #155724; }
        .badge-keluar { background-color: #FEE2E2; color: #991B1B; }
        .btn-delete { background: transparent; border: 1px solid #DC2626; color: #DC2626; border-radius: 8px; padding: 8px 12px; cursor: pointer; }
        .btn-delete:hover { background-color: #DC2626; color: #FFFFFF; }
        .empty-state { text-align: center; padding: 60px 20px; color: #6B5B5A; }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .header h1 { font-size: 24px; }
            .content { padding: 20px; }
        }
        @media (max-width: 640px) {
            .sidebar { transform: translateX(-100%); z-index: 1000; }
            .main-content { margin-left: 0; }
            .header-actions { flex-direction: column; align-items: flex-end; }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>INVENTARIS</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">Dashboard</a>
            <a href="{{ route('admin.barang.index') }}" class="menu-item">Data Barang</a>
            <a href="{{ route('admin.transaksi.masuk.index') }}" class="menu-item {{ $jenis === 'masuk' ? 'active' : '' }}">Barang Masuk</a>
            <a href="{{ route('admin.transaksi.keluar.index') }}" class="menu-item {{ $jenis === 'keluar' ? 'active' : '' }}">Barang Keluar</a>
            <a href="{{ route('admin.laporan.index') }}" class="menu-item">Laporan</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>{{ $pageTitle }}</h1>
            <div class="header-actions">
                <a href="{{ $jenis === 'masuk' ? route('admin.transaksi.masuk.create') : route('admin.transaksi.keluar.create') }}" class="add-btn">
                    Tambah Transaksi
                </a>
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error-message">{{ $errors->first() }}</div>
            @endif

            <div class="table-card">
                @if($data->count() > 0)
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Petugas</th>
                                    <th>Jenis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                                        <td>{{ $transaksi->barang->kode_barang ?? '-' }}</td>
                                        <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                                        <td>{{ $transaksi->jumlah }}</td>
                                        <td>{{ $transaksi->user->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $transaksi->jenis === 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                                                {{ ucfirst($transaksi->jenis) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" onclick="return confirm('Hapus transaksi ini? Stok barang akan disesuaikan ulang.')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <h3>Belum ada transaksi {{ $jenis }}</h3>
                        <p>Tambah transaksi baru agar stok barang langsung sinkron dengan database.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
