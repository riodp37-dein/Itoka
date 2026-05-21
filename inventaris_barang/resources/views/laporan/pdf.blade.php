<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageTitle }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        .header { margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; margin-bottom: 4px; }
        .subtitle { font-size: 11px; color: #4B5563; }
        .stats { width: 100%; border-collapse: separate; border-spacing: 10px 0; margin: 18px 0 20px; }
        .stats td { width: 25%; background: #F3F4F6; border: 1px solid #D1D5DB; padding: 12px; vertical-align: top; }
        .stats-label { font-size: 11px; color: #6B7280; margin-bottom: 6px; }
        .stats-value { font-size: 18px; font-weight: bold; color: #111827; }
        h2 { font-size: 14px; margin: 18px 0 8px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #D1D5DB; padding: 7px 8px; text-align: left; vertical-align: top; }
        th { background: #1E3A8A; color: #FFFFFF; font-size: 11px; }
        .muted { color: #6B7280; }
        .page-break { page-break-before: always; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $pageTitle }}</div>
        <div class="subtitle">Role: {{ $roleLabel }}</div>
        <div class="subtitle">Periode: {{ \Carbon\Carbon::parse($filters['start_date'])->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($filters['end_date'])->format('d-m-Y') }}</div>
        <div class="subtitle">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</div>
    </div>

    <table class="stats">
        <tr>
            <td>
                <div class="stats-label">Transaksi Masuk</div>
                <div class="stats-value">{{ $jumlahTransaksiMasuk }}</div>
            </td>
            <td>
                <div class="stats-label">Total Unit Masuk</div>
                <div class="stats-value">{{ $totalBarangMasuk }}</div>
            </td>
            <td>
                <div class="stats-label">Transaksi Keluar</div>
                <div class="stats-value">{{ $jumlahTransaksiKeluar }}</div>
            </td>
            <td>
                <div class="stats-label">Total Unit Keluar</div>
                <div class="stats-value">{{ $totalBarangKeluar }}</div>
            </td>
        </tr>
    </table>

    <h2>Rekap Per Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Lokasi</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Stok Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekapBarang as $barang)
                <tr>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->lokasi }}</td>
                    <td>{{ $barang->total_masuk }}</td>
                    <td>{{ $barang->total_keluar }}</td>
                    <td>{{ $barang->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="muted">Tidak ada transaksi pada rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2>Detail Barang Masuk</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiMasuk as $transaksi)
                <tr>
                    <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                    <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $transaksi->jumlah }}</td>
                    <td>{{ $transaksi->user->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="muted">Belum ada transaksi masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Detail Barang Keluar</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksiKeluar as $transaksi)
                <tr>
                    <td>{{ $transaksi->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                    <td>{{ $transaksi->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $transaksi->jumlah }}</td>
                    <td>{{ $transaksi->user->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="muted">Belum ada transaksi keluar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
