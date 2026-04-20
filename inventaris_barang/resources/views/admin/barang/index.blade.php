<h2>Data Barang</h2>

<a href="/admin/barang/create">+ Tambah Barang</a>
<a href="{{ route('admin.dashboard') }}">← Kembali ke Dashboard</a>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Kode</th>
    <th>Stok</th>
    <th>Lokasi</th>
    <th>Aksi</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->nama_barang }}</td>
    <td>{{ $d->kode_barang }}</td>
    <td>{{ $d->stok }}</td>
    <td>{{ $d->lokasi }}</td>
    <td>
        <a href="/admin/barang/{{ $d->id }}/edit">Edit</a>

        <form method="POST" action="/admin/barang/{{ $d->id }}" style="display:inline">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Yakin hapus?')">Hapus</button>
        </form>
    </td>
</tr>
@endforeach
</table>
