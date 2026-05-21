<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Sistem Inventaris</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center px-4 py-10 text-slate-800">
    <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/70">
        <div class="mb-8">
            <div class="inline-flex rounded-full bg-amber-100 px-3 py-1 text-xs font-bold uppercase tracking-[0.2em] text-amber-700">Inventaris</div>
            <h1 class="mt-4 text-3xl font-black text-slate-900">Reset Password</h1>
            <p class="mt-2 text-sm font-medium leading-6 text-slate-500">
                Masukkan email dan password baru untuk akun Anda.
            </p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <label for="email" class="mb-2 block text-sm font-bold text-slate-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $request->email) }}"
                    required
                    class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-medium outline-none transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
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
                >
            </div>

            <button type="submit" class="w-full rounded-2xl bg-amber-500 px-4 py-3 text-sm font-bold uppercase tracking-wide text-slate-950 transition hover:bg-amber-400">
                Simpan Password Baru
            </button>
        </form>
    </div>
</body>
</html>
