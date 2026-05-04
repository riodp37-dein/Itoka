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
        .sidebar-header h2 { font-size: 22px; font-weight: 700; letter-spacing: 2px; }
        .sidebar-menu { flex: 1; padding: 30px 0; }
        .menu-item { padding: 15px 25px; color: #FFFFFF; text-decoration: none; display: block; border-left: 4px solid transparent; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255, 255, 255, 0.15); border-left-color: #FFFFFF; }
        .logout-btn { padding: 15px 25px; margin: 20px; background-color: rgba(255, 255, 255, 0.1); border: 2px solid rgba(255, 255, 255, 0.3); color: white; border-radius: 10px; cursor: pointer; font-size: 15px; }
        .main-content { margin-left: 250px; flex: 1; }
        .header { background-color: #1E3A8A; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 32px; color: #FFFFFF; font-weight: 700; }
        .user-avatar { width: 45px; height: 45px; background-color: #FFFFFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1E3A8A; font-size: 18px; font-weight: 700; }
        .content { padding: 40px; display: flex; justify-content: center; align-items: flex-start; min-height: calc(100vh - 85px); }
        .form-card { background-color: #FFFFFF; padding: 40px 50px; border-radius: 15px; width: 100%; max-width: 650px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); }
        .error-list { background-color: #FFE5E5; color: #C62828; padding: 15px 20px; border-radius: 10px; margin-bottom: 25px; border-left: 4px solid #C62828; }
        .error-list ul { list-style: none; }
        .error-list li { padding: 5px 0; font-size: 14px; }
        .form-group { margin-bottom: 25px; }
        .form-group label { display: block; font-size: 16px; color: #2D2424; margin-bottom: 10px; font-weight: 700; }
        .form-group input, .form-group select { width: 100%; padding: 12px 16px; border: 2px solid #CCCCCC; border-radius: 8px; font-size: 15px; background-color: #FFFFFF; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #1E3A8A; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1); }
        .helper { margin-top: 8px; font-size: 13px; color: #666; }
        .form-actions { display: flex; gap: 15px; margin-top: 35px; }
        .btn { flex: 1; padding: 15px; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; display: flex; align-items: center; justify-content: center; }
        .btn-primary { background-color: #1E3A8A; color: white; }
        .btn-secondary { background-color: transparent; color: #1E3A8A; border: 2px solid #1E3A8A; }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .header h1 { font-size: 24px; }
            .content { padding: 20px; }
            .form-card { padding: 30px 25px; }
            .form-actions { flex-direction: column; }
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
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>

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

                <form method="POST" action="{{ $jenis === 'masuk' ? route('admin.transaksi.masuk.store') : route('admin.transaksi.keluar.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="barang_id">Pilih Barang</label>
                        <select id="barang_id" name="barang_id" required>
                            <option value="">Pilih barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                    {{ $barang->kode_barang }} - {{ $barang->nama_barang }} (stok: {{ $barang->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" min="1" value="{{ old('jumlah') }}" required>
                        <div class="helper">
                            @if($jenis === 'masuk')
                                Jumlah ini akan menambah stok barang secara otomatis.
                            @else
                                Jumlah ini akan mengurangi stok barang secara otomatis.
                            @endif
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                        <a href="{{ $jenis === 'masuk' ? route('admin.transaksi.masuk.index') : route('admin.transaksi.keluar.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
