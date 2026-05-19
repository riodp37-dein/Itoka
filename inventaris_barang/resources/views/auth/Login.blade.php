<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden antialiased text-gray-800">
    <!-- Left Section -->
    <div class="hidden lg:flex lg:w-[45%] xl:w-1/2 bg-[#1E3A8A] flex-col justify-center items-center p-12 xl:p-16 text-white relative">
        <!-- Optional Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
            <svg class="absolute w-[800px] h-[800px] -top-20 -left-20 text-white" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="50" cy="50" r="50"></circle>
            </svg>
        </div>

        <div class="max-w-lg z-10">
            <div class="mb-8">
                <h2 class="text-2xl font-extrabold tracking-widest uppercase mb-2">INVENTARIS</h2>
                <div class="w-16 h-1.5 bg-blue-400 rounded-full"></div>
            </div>
            <h1 class="text-4xl xl:text-5xl font-black mb-6 leading-tight">Selamat Datang di Sistem Inventaris</h1>
            <p class="text-blue-100 text-lg leading-relaxed font-medium">
                Kelola data barang, stok masuk, dan stok keluar secara otomatis dan efisien. Tingkatkan produktivitas dengan sistem inventaris digital yang cepat, akurat, dan mudah digunakan.
            </p>
        </div>
    </div>

    <!-- Right Section - Login Form -->
    <div class="w-full lg:w-[55%] xl:w-1/2 flex items-center justify-center p-6 sm:p-12 xl:p-20 bg-white relative overflow-y-auto">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden mb-10 text-center">
                <h2 class="text-3xl font-extrabold tracking-widest text-[#1E3A8A] uppercase">INVENTARIS</h2>
                <div class="w-16 h-1.5 bg-[#2563EB] rounded-full mx-auto mt-3"></div>
            </div>

            <div class="mb-10 text-left">
                <h2 class="text-3xl font-black text-gray-900 mb-3">Selamat Datang Kembali!</h2>
                <p class="text-gray-500 font-medium text-sm sm:text-base">Silakan masuk ke akun Anda untuk melanjutkan pengelolaan inventaris.</p>
            </div>

            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-red-700 font-semibold text-sm">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            @if(session('status'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-emerald-700 font-semibold text-sm">{{ session('status') }}</span>
                </div>
            </div>
            @endif

            <form method="POST" action="/login" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Masukkan email Anda"
                        required
                        value="{{ old('email') }}"
                        class="w-full px-5 py-3.5 rounded-xl border border-gray-300 focus:border-[#2563EB] focus:ring-4 focus:ring-blue-500/20 outline-none transition-all duration-200 bg-gray-50 focus:bg-white text-gray-800 text-sm font-medium"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                            class="w-full px-5 py-3.5 rounded-xl border border-gray-300 focus:border-[#2563EB] focus:ring-4 focus:ring-blue-500/20 outline-none transition-all duration-200 bg-gray-50 focus:bg-white text-gray-800 text-sm font-medium pr-12"
                        >
                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-[#1E3A8A] focus:outline-none transition-colors" onclick="togglePassword()">
                            <svg id="eye-icon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" class="h-4.5 w-4.5 text-[#2563EB] focus:ring-blue-500 border-gray-300 rounded cursor-pointer transition-colors">
                        <label for="remember" class="ml-2.5 block text-sm text-gray-600 font-semibold cursor-pointer">Ingat Saya</label>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-bold text-[#2563EB] hover:text-[#1D4ED8] transition duration-200">Lupa password?</a>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold py-3.5 px-4 rounded-xl shadow-[0_8px_20px_-8px_rgba(37,99,235,0.6)] transform transition-all duration-200 hover:-translate-y-1 mt-6 text-sm uppercase tracking-wide">
                    Login
                </button>
            </form>

            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-semibold">atau lanjutkan dengan</span>
                </div>
            </div>

            <button onclick="alert('Fitur Google Login belum tersedia')" class="w-full mt-6 bg-white border-2 border-gray-100 hover:bg-gray-50 hover:border-gray-300 text-gray-700 font-bold py-3 px-4 rounded-xl transition-all duration-200 flex items-center justify-center gap-3 shadow-sm text-sm">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M19.8 10.2273C19.8 9.51819 19.7364 8.83637 19.6182 8.18182H10.2V12.05H15.6109C15.3727 13.3 14.6636 14.3591 13.6045 15.0682V17.5773H16.8273C18.7091 15.8364 19.8 13.2727 19.8 10.2273Z" fill="#4285F4"/>
                    <path d="M10.2 20C12.9 20 15.1709 19.1045 16.8273 17.5773L13.6045 15.0682C12.7091 15.6682 11.5636 16.0227 10.2 16.0227C7.59545 16.0227 5.38182 14.2636 4.58636 11.9H1.25455V14.4909C2.90182 17.7591 6.30909 20 10.2 20Z" fill="#34A853"/>
                    <path d="M4.58636 11.9C4.38636 11.3 4.27273 10.6591 4.27273 10C4.27273 9.34091 4.38636 8.7 4.58636 8.1V5.50909H1.25455C0.572727 6.85909 0.2 8.38636 0.2 10C0.2 11.6136 0.572727 13.1409 1.25455 14.4909L4.58636 11.9Z" fill="#FBBC04"/>
                    <path d="M10.2 3.97727C11.6864 3.97727 13.0182 4.48182 14.0636 5.47273L16.9182 2.61818C15.1664 0.986364 12.8955 0 10.2 0C6.30909 0 2.90182 2.24091 1.25455 5.50909L4.58636 8.1C5.38182 5.73636 7.59545 3.97727 10.2 3.97727Z" fill="#EA4335"/>
                </svg>
                Google
            </button>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>
