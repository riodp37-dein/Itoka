<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Sistem Inventaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #E8E8E8;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #1E3A8A;
            color: white;
            padding: 0;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            padding: 25px 20px;
            background-color: rgba(0, 0, 0, 0.15);
            border-bottom: none;
        }

        .sidebar-header h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
            color: #FFFFFF;
        }

        .sidebar-menu {
            flex: 1;
            padding: 30px 0;
        }

        .menu-item {
            padding: 15px 25px;
            color: #FFFFFF;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            font-size: 15px;
            border-left: 4px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: #FFFFFF;
            color: white;
        }

        .logout-btn {
            padding: 15px 25px;
            margin: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 0;
        }

        /* Header */
        .header {
            background-color: #1E3A8A;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .header h1 {
            font-size: 32px;
            color: #FFFFFF;
            font-weight: 700;
        }

        .header h1 {
            font-size: 32px;
            color: #FFFFFF;
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .add-btn {
            background-color: #B8B8B8;
            color: #333;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            background-color: #A8A8A8;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background-color: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1E3A8A;
            font-size: 28px;
            border: 2px solid #FFFFFF;
        }

        /* Content Area */
        .content {
            padding: 30px 40px;
        }

        /* Success Message */
        .success-message {
            background-color: #D4EDDA;
            color: #155724;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #28A745;
            font-size: 15px;
        }

        /* Table Card */
        .table-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            border: none;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #1E3A8A;
        }

        table th {
            padding: 18px 15px;
            text-align: left;
            font-size: 15px;
            font-weight: 700;
            color: #FFFFFF;
            border-bottom: 2px solid #1E3A8A;
        }

        table td {
            padding: 18px 15px;
            border-bottom: 1px solid #F0F0F0;
            font-size: 14px;
            color: #333;
        }

        table tbody tr {
            transition: all 0.3s;
        }

        table tbody tr:hover {
            background-color: #F8F8F8;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid;
            background-color: transparent;
            font-size: 16px;
        }

        .btn-edit {
            color: #666;
            border-color: #999;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #999;
            color: white;
        }

        .btn-delete {
            color: #DC2626;
            border-color: #DC2626;
        }

        .btn-delete:hover {
            background-color: #DC2626;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6B5B5A;
        }

        .empty-state-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 15px;
            color: #8B7675;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 20px;
            }

            table th,
            table td {
                padding: 12px 10px;
                font-size: 13px;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .main-content {
                margin-left: 0;
            }

            .header-actions {
                flex-direction: column;
                align-items: flex-end;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>INVENTARIS</h2>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">Dashboard</a>
            <a href="{{ route('admin.barang.index') }}" class="menu-item active">Data Barang</a>
            <a href="#" class="menu-item">Barang Masuk</a>
            <a href="#" class="menu-item">Barang Keluar</a>
            <a href="#" class="menu-item">Laporan</a>
        </nav>
        <form action="/logout" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">
                <span>↩</span> Logout
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Data Barang</h1>
            <div class="header-actions">
                <a href="{{ route('admin.barang.create') }}" class="add-btn">
                    <span>+</span> Tambah Barang
                </a>
                <div class="user-avatar">👤</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @if(session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $d->created_at ? $d->created_at->format('d-m-Y') : '-' }}</td>
                                <td>{{ $d->kode_barang }}</td>
                                <td>{{ $d->nama_barang }}</td>
                                <td>{{ $d->stok }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.barang.edit', $d->id) }}" class="btn-icon btn-edit" title="Edit">
                                            ✏️
                                        </a>
                                        <form method="POST" action="{{ route('admin.barang.destroy', $d->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-delete" onclick="return confirm('Yakin ingin menghapus barang ini?')" title="Hapus">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">📦</div>
                    <h3>Belum Ada Data Barang</h3>
                    <p>Klik tombol "Tambah Barang" untuk menambahkan data barang baru</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
