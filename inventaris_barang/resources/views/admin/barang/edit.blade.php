<h1>Edit Barang</h1>

@if($errors->any())
<ul style="color:red">
@foreach($errors->all() as $e)
<li>{{ $e }}</li>
@endforeach
</ul>
@endif

<form method="POST" action="/admin/barang/{{ $data->id }}">
@csrf
@method('PUT')

<label>Nama Barang</label><br>
<input type="text" name="nama_barang" value="{{ $data->nama_barang }}"><br><br>

<label>Kode Barang</label><br>
<input type="text" name="kode_barang" value="{{ $data->kode_barang }}"><br><br>

<label>Stok</label><br>
<input type="number" name="stok" value="{{ $data->stok }}"><br><br>

<label>Lokasi</label><br>
<input type="text" name="lokasi" value="{{ $data->lokasi }}"><br><br>

<button type="submit">Update</button>
</form>

<br>
<a href="/admin/barang">Kembali</a>