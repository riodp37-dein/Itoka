<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun - Sistem Inventaris</title>
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
        .header h1 { font-size: 28px; color: #FFFFFF; font-weight: 700; }
        .user-avatar { width: 45px; height: 45px; background-color: #FFFFFF; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #1E3A8A; font-size: 18px; font-weight: 700; }
        .content { padding: 30px 40px; display: flex; justify-content: center; }
        .form-card { width: 100%; max-width: 680px; background-color: #FFFFFF; padding: 28px; border-radius: 16px; border: 1px solid #E5E7EB; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .form-card h2 { font-size: 20px; color: #111827; margin-bottom: 10px; }
        .muted { color: #6B7280; font-size: 13px; margin-bottom: 20px; }
        .error-message { background-color: #FFE5E5; color: #C62828; padding: 12px 15px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; border-left: 4px solid #C62828; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 14px; color: #374151; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 12px 14px; border: 1px solid #D1D5DB; border-radius: 10px; font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #1E3A8A; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12); }
        .form-actions { display: flex; gap: 12px; margin-top: 8px; }
        .primary-btn, .secondary-btn { padding: 12px 18px; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; cursor: pointer; }
        .primary-btn { background-color: #1E3A8A; color: #FFFFFF; border: none; }
        .secondary-btn { background-color: #FFFFFF; color: #4B5563; border: 1px solid #D1D5DB; }
        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .main-content { margin-left: 200px; }
            .header { padding: 15px 20px; }
            .content { padding: 20px; }
            .form-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .sidebar { transform: translateX(-100%); z-index: 1000; }
            .main-content { margin-left: 0; }
            .form-actions { flex-direction: column; }
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
            <a href="{{ route('admin.users.index') }}" class="menu-item active">Kelola Akun</a>
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
            <h1>Edit Akun</h1>
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>

        <div class="content">
            <div class="form-card">
                <h2>{{ $user->name }}</h2>
                <p class="muted">Kosongkan password jika tidak ingin mengubah password akun ini.</p>

                @if(session('error'))
                    <div class="error-message">{{ session('error') }}</div>
                @endif

                @if($errors->any())
                    <div class="error-message">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name="role" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>{{ $roleLabels[$role] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="primary-btn">Update Akun</button>
                        <a href="{{ route('admin.users.index') }}" class="secondary-btn">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>