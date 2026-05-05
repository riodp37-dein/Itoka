<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang - Sistem Inventaris</title>
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
            color: #2D2424;
            font-weight: 700;
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
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: calc(100vh - 85px);
        }

        /* Form Card */
        .form-card {
            background-color: #FFFFFF;
            padding: 40px 50px;
            border-radius: 15px;
            border: none;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        /* Error Messages */
        .error-list {
            background-color: #FFE5E5;
            color: #C62828;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #C62828;
        }

        .error-list ul {
            list-style: none;
            padding: 0;
        }

        .error-list li {
            padding: 5px 0;
            font-size: 14px;
        }

        .error-list li:before {
            content: "⚠ ";
            margin-right: 5px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            color: #2D2424;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #CCCCCC;
            border-radius: 8px;
            font-size: 15px;
            background-color: #FFFFFF;
            transition: all 0.3s;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #8B7675;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(139, 118, 117, 0.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #B4A4A3;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            flex: 1;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: #8B8B8B;
            color: white;
        }

        .btn-primary:hover {
            background-color: #7A7A7A;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            background-color: transparent;
            color: #6B5B5A;
            border: 2px solid #6B5B5A;
        }

        .btn-secondary:hover {
            background-color: #6B5B5A;
            color: white;
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

            .form-card {
                padding: 30px 25px;
            }

            .form-actions {
                flex-direction: column;
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
            <a href="{{ route('admin.transaksi.masuk.index') }}" class="menu-item">Barang Masuk</a>
            <a href="{{ route('admin.transaksi.keluar.index') }}" class="menu-item">Barang Keluar</a>
            <a href="{{ route('admin.laporan.index') }}" class="menu-item">Laporan</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
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
            <h1>Tambah Data Barang</h1>
            <div class="user-avatar">👤</div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="form-card">
                @if($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.barang.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input 
                            type="text" 
                            id="kode_barang" 
                            name="kode_barang" 
                            placeholder="Masukkan kode barang"
                            value="{{ old('kode_barang') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input 
                            type="text" 
                            id="nama_barang" 
                            name="nama_barang" 
                            placeholder="Masukkan nama barang"
                            value="{{ old('nama_barang') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="stok">Jumlah</label>
                        <input 
                            type="number" 
                            id="stok" 
                            name="stok" 
                            placeholder="Masukkan jumlah stok"
                            value="{{ old('stok') }}"
                            min="0"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input 
                            type="text" 
                            id="lokasi" 
                            name="lokasi" 
                            placeholder="Masukkan lokasi penyimpanan"
                            value="{{ old('lokasi') }}"
                        >
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                        <a href="{{ route('admin.barang.index') }}" class="btn btn-secondary">
                            ← Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
