<h2>Data Barang</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Nama</th>
    <th>Kode</th>
    <th>Stok</th>
    <th>Lokasi</th>
    <th>Detail</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->nama_barang }}</td>
    <td>{{ $d->kode_barang }}</td>
    <td>{{ $d->stok }}</td>
    <td>{{ $d->lokasi }}</td>
    <td>
        <a href="/karyawan/barang/{{ $d->id }}">Lihat</a>
    </td>
</tr>
@endforeach
</table>