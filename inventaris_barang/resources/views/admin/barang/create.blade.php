<h1>Tambah Barang</h1>

@if($errors->any())
<ul style="color:red">
@foreach($errors->all() as $e)
<li>{{ $e }}</li>
@endforeach
</ul>
@endif

<form method="POST" action="/admin/barang">
@csrf

<label>Nama Barang</label><br>
<input type="text" name="nama_barang"><br><br>

<label>Kode Barang</label><br>
<input type="text" name="kode_barang"><br><br>

<label>Stok</label><br>
<input type="number" name="stok"><br><br>

<label>Lokasi</label><br>
<input type="text" name="lokasi"><br><br>

<button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('admin.barang.index') }}">Kembali</a>