<h1>Dashboard Karyawan</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<hr>

<h3>Total Barang Tersedia</h3>
<p><b>{{ $totalBarang }}</b> barang</p>

<hr>

<h3>Barang Hampir Habis</h3>

@if($hampirHabis->count() > 0)
<table border="1" cellpadding="10">
<tr>
    <th>Nama Barang</th>
    <th>Stok</th>
</tr>

@foreach($hampirHabis as $b)
<tr>
    <td>{{ $b->nama_barang }}</td>
    <td style="color:red; font-weight:bold">{{ $b->stok }}</td>
</tr>
@endforeach

</table>
@else
<p>Semua stok aman ✅</p>
@endif

<hr>

<h3>Menu</h3>

<a href="/karyawan/barang">📦 Lihat Barang</a>

<br><br>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button style="background:red; color:white;">Logout</button>
</form>