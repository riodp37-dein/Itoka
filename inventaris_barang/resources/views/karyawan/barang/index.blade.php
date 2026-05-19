<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Sistem Inventaris</title>
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
        .alert { padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background-color: #DCFCE7; color: #166534; border: 1px solid #86EFAC; }
        .table-container { overflow-x: auto; background-color: #FFFFFF; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        table { width: 100%; border-collapse: collapse; }
        table th { background-color: #1E3A8A; color: #FFFFFF; padding: 15px; text-align: left; font-size: 14px; }
        table td { padding: 15px; border-bottom: 1px solid #E5E7EB; font-size: 14px; color: #1F2937; }
        .action-cell { white-space: nowrap; }
        .action-link { color: #1E3A8A; text-decoration: none; font-weight: 600; background-color: #EFF6FF; padding: 8px 12px; border-radius: 6px; display: inline-block; }
        .action-link:hover { background-color: #DBEAFE; }
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
            <h1>Data Barang</h1>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}</div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kode</th>
                            <th>Stok</th>
                            <th>Lokasi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{ $d->nama_barang }}</td>
                            <td>{{ $d->kode_barang }}</td>
                            <td>{{ $d->stok }}</td>
                            <td>{{ $d->lokasi }}</td>
                            <td class="action-cell">
                                <a href="{{ route('karyawan.barang.show', $d->id) }}" class="action-link">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
