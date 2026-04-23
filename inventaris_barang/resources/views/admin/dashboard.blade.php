<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Inventaris</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: repeating-linear-gradient(
                90deg,
                #F5E6E8 0px,
                #F5E6E8 40px,
                #FFEEF1 40px,
                #FFEEF1 80px
            );
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: repeating-linear-gradient(
                90deg,
                #8B7675 0px,
                #8B7675 40px,
                #9A8584 40px,
                #9A8584 80px
            );
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
            background-color: rgba(107, 91, 90, 0.3);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .sidebar-menu {
            flex: 1;
            padding: 30px 0;
        }

        .menu-item {
            padding: 15px 25px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            font-size: 15px;
            border-left: 4px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: #F5E6E8;
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
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid rgba(139, 118, 117, 0.1);
        }

        .header h1 {
            font-size: 28px;
            color: #2D2424;
            font-weight: 700;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background-color: #8B7675;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            border: 3px solid #6B5B5A;
        }

        /* Content Area */
        .content {
            padding: 30px 40px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            border: 3px solid #E8D4D6;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #8B7675;
        }

        .stat-card h3 {
            font-size: 15px;
            color: #6B5B5A;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .stat-card .number {
            font-size: 36px;
            color: #2D2424;
            font-weight: 700;
        }

        /* Chart and Tables Container */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            border: 3px solid #E8D4D6;
        }

        .card-full {
            grid-column: 1 / -1;
        }

        .card h2 {
            font-size: 20px;
            color: #2D2424;
            margin-bottom: 20px;
            font-weight: 700;
        }

        /* Chart Placeholder */
        .chart-container {
            background: repeating-linear-gradient(
                90deg,
                #6B5B5A 0px,
                #6B5B5A 40px,
                #7A6968 40px,
                #7A6968 80px
            );
            height: 200px;
            border-radius: 10px;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            gap: 10px;
            margin-bottom: 15px;
        }

        .chart-bar {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 5px;
            transition: all 0.3s;
        }

        .chart-bar:hover {
            background-color: rgba(255, 255, 255, 0.5);
        }

        .chart-legend {
            display: flex;
            gap: 20px;
            justify-content: center;
            font-size: 14px;
            color: #6B5B5A;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #8B7675;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 14px;
            font-weight: 600;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #E8D4D6;
            font-size: 14px;
            color: #2D2424;
        }

        table tr:hover {
            background-color: rgba(139, 118, 117, 0.05);
        }

        .view-all {
            text-align: center;
            margin-top: 15px;
        }

        .view-all a {
            color: #6B5B5A;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .view-all a:hover {
            color: #5A4A49;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 15px 20px;
            }

            .content {
                padding: 20px;
            }
        }

        @media (max-width: 640px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
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
            <a href="{{ route('admin.dashboard') }}" class="menu-item active">Dashboard</a>
            <a href="{{ route('admin.barang.index') }}" class="menu-item">Data Barang</a>
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
            <h1>Dashboard Inventaris</h1>
            <div class="user-profile">
                <div class="user-avatar">👤</div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Barang</h3>
                    <div class="number">{{ $totalBarang ?? 999 }}</div>
                </div>
                <div class="stat-card">
                    <h3>Barang Masuk</h3>
                    <div class="number">{{ $barangMasuk ?? 999 }}</div>
                </div>
                <div class="stat-card">
                    <h3>Barang Keluar</h3>
                    <div class="number">{{ $barangKeluar ?? 999 }}</div>
                </div>
                <div class="stat-card">
                    <h3>Barang Menipis</h3>
                    <div class="number">{{ $barangMenipis ?? 999 }}</div>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Chart -->
                <div class="card">
                    <h2>Grafik Stok Barang</h2>
                    <div class="chart-container">
                        <div class="chart-bar" style="height: 60%;"></div>
                        <div class="chart-bar" style="height: 80%;"></div>
                        <div class="chart-bar" style="height: 45%;"></div>
                        <div class="chart-bar" style="height: 70%;"></div>
                        <div class="chart-bar" style="height: 55%;"></div>
                        <div class="chart-bar" style="height: 90%;"></div>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #8B7675;"></div>
                            <span>Barang Masuk</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #A8B5C2;"></div>
                            <span>Barang Keluar</span>
                        </div>
                    </div>
                </div>

                <!-- Stok Menipis -->
                <div class="card">
                    <h2>Stok Menipis</h2>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>11111</td>
                                    <td>As Kruk</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>222222</td>
                                    <td>Noken As</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>333333</td>
                                    <td>Membran</td>
                                    <td>12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="view-all">
                        <a href="#">Lihat Semua</a>
                    </div>
                </div>
            </div>

            <!-- Data Tables -->
            <div class="dashboard-grid">
                <div class="card">
                    <h2>Data Masuk</h2>
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
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>11111</td>
                                    <td>As Kruk</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>222222</td>
                                    <td>Noken As</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>333333</td>
                                    <td>Membran</td>
                                    <td>12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="view-all">
                        <a href="#">Lihat Semua</a>
                    </div>
                </div>

                <div class="card">
                    <h2>Data Keluar</h2>
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
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>11111</td>
                                    <td>As Kruk</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>222222</td>
                                    <td>Noken As</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>01-01-2026</td>
                                    <td>333333</td>
                                    <td>Membran</td>
                                    <td>12</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="view-all">
                        <a href="#">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>