<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Inventaris</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4 py-10 text-slate-800">
    <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70">
        <div class="mb-8">
            <div class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-blue-700">Inventaris</div>
            <h1 class="mt-4 text-3xl font-black text-slate-900">Lupa Password</h1>
            <p class="mt-2 text-sm font-medium leading-6 text-slate-500">
                Untuk akun dummy, masukkan email yang terdaftar lalu buat password baru secara langsung.
            </p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-medium outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                    placeholder="nama@email.com"
                >
                @error('email')
                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-bold text-slate-700">Password Baru</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-medium outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                    placeholder="Minimal 8 karakter"
                >
                @error('password')
                    <p class="mt-2 text-sm font-medium text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">Konfirmasi Password Baru</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-medium outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                    placeholder="Ulangi password baru"
                >
            </div>

            <button type="submit" class="w-full rounded-2xl bg-blue-600 px-4 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-blue-700">
                Reset Password
            </button>
        </form>

        <div class="mt-6 text-center text-sm font-semibold text-slate-500">
            <a href="{{ route('login') }}" class="text-blue-600 transition hover:text-blue-700">Kembali ke login</a>
        </div>
    </div>
</body>
</html>
