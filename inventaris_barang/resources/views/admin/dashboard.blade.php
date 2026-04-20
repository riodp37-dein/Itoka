<h1>Dashboard Admin</h1>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<a href="{{ route('admin.barang.index') }}">Kelola Barang</a>

<br><br>

<form action="/logout" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>