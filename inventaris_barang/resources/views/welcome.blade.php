<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris - Selamat Datang</title>
    
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
            background-color: #F8FAFC;
        }
    </style>
</head>
<body class="text-gray-800 antialiased overflow-x-hidden">
    <!-- Navbar -->
    <nav class="bg-[#1E3A8A] w-full px-6 md:px-12 py-5 flex justify-between items-center shadow-md relative z-20">
        <div class="text-white font-extrabold text-xl md:text-2xl tracking-widest uppercase">
            INVENTARIS
        </div>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/login') }}" class="bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold py-2 px-8 rounded-lg transition duration-300 shadow-sm">LOGIN</a>
                <!-- @else
                    <a href="{{ route('login') }}" class="bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold py-2 px-8 rounded-lg transition duration-300 shadow-sm text-sm md:text-base">LOGIN</a>
                @endif -->
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mx-auto px-6 py-16 md:py-28 flex flex-col-reverse md:flex-row items-center relative z-10">
        <div class="md:w-1/2 mt-12 md:mt-0 flex flex-col items-start px-4 md:px-8 lg:px-16">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-[#111827] mb-6 uppercase tracking-tight leading-tight">SELAMAT DATANG</h1>
            <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-sm leading-relaxed font-medium">
                Kelola Stok Barang Dengan Mudah Dan Efisien
            </p>
        </div>
        <div class="md:w-1/2 flex justify-center lg:justify-end lg:pr-16">
            <!-- Hero Image -->
            <div class="relative w-64 h-64 md:w-80 md:h-80 lg:w-[400px] lg:h-[400px] rounded-[2.5rem] shadow-2xl border-[12px] border-blue-100 overflow-hidden">
                <img src="{{ asset('images/hero.png') }}" alt="Ilustrasi Inventaris" class="w-full h-full object-cover">
            </div>
        </div>
    </div>

    <!-- Fitur Utama Section -->
    <div class="bg-white py-16 shadow-[0_10px_30px_-15px_rgba(0,0,0,0.1)] relative z-20">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-2xl font-black text-[#111827] mb-10 text-left">FITUR UTAMA</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center gap-5 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="bg-blue-50 text-[#1E3A8A] p-3.5 rounded-xl flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    </div>
                    <span class="font-extrabold text-[#111827] leading-tight text-sm md:text-base">Manajemen<br>Barang</span>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center gap-5 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="bg-blue-50 text-[#1E3A8A] p-3.5 rounded-xl flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <span class="font-extrabold text-[#111827] leading-tight text-sm md:text-base">Barang<br>Masuk</span>
                </div>

                <!-- Card 3 -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center gap-5 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="bg-blue-50 text-[#1E3A8A] p-3.5 rounded-xl flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <span class="font-extrabold text-[#111827] leading-tight text-sm md:text-base">Barang<br>Keluar</span>
                </div>

                <!-- Card 4 -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 flex items-center gap-5 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                    <div class="bg-blue-50 text-[#1E3A8A] p-3.5 rounded-xl flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="font-extrabold text-[#111827] leading-tight text-sm md:text-base">Laporan</span>
                </div>

            </div>
        </div>
    </div>

    <!-- Tampilan Sistem Section -->
    <div class="container mx-auto px-6 py-24 relative z-10">
        <h2 class="text-2xl font-black text-[#111827] mb-12 px-4 lg:px-16 text-left">TAMPILAN SISTEM</h2>
        
        <div class="flex flex-col lg:flex-row items-center gap-16 px-4 lg:px-16">
            
            <!-- Left Cards List -->
            <div class="w-full lg:w-[55%] space-y-6">
                <!-- Item 1 -->
                <div class="bg-white rounded-3xl p-6 lg:p-8 flex gap-6 items-center shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="bg-blue-50 text-[#1E3A8A] p-5 rounded-2xl flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-xl text-[#111827] mb-2">Manajemen Barang</h3>
                        <p class="text-gray-600 text-sm leading-relaxed font-medium">Memudahkan pengguna dalam menambah, mengubah, menghapus, dan melihat data barang secara lengkap dan terstruktur.</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-3xl p-6 lg:p-8 flex gap-6 items-center shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="bg-blue-50 text-[#1E3A8A] p-5 rounded-2xl flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-xl text-[#111827] mb-2">Barang Masuk</h3>
                        <p class="text-gray-600 text-sm leading-relaxed font-medium">Mencatat setiap barang yang masuk ke dalam gudang atau inventaris untuk memastikan stok selalu terupdate.</p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white rounded-3xl p-6 lg:p-8 flex gap-6 items-center shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="bg-blue-50 text-[#1E3A8A] p-5 rounded-2xl flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-xl text-[#111827] mb-2">Barang Keluar</h3>
                        <p class="text-gray-600 text-sm leading-relaxed font-medium">Mengelola proses pengeluaran barang dengan pencatatan jumlah, tanggal, dan tujuan penggunaan barang.</p>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white rounded-3xl p-6 lg:p-8 flex gap-6 items-center shadow-xl border border-gray-100 hover:shadow-2xl transition duration-300">
                    <div class="bg-blue-50 text-[#1E3A8A] p-5 rounded-2xl flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-xl text-[#111827] mb-2">Laporan</h3>
                        <p class="text-gray-600 text-sm leading-relaxed font-medium">Menyajikan laporan data inventaris, barang masuk, barang keluar secara cepat dan akurat.</p>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="w-full lg:w-[45%] flex justify-center lg:justify-end">
                <div class="relative w-64 h-64 md:w-96 md:h-96 lg:w-[450px] lg:h-[450px] rounded-[3rem] shadow-2xl border-[16px] border-blue-100 overflow-hidden">
                    <img src="{{ asset('images/hero.png') }}" alt="Mockup Dashboard" class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>

    <!-- Mengapa Memilih Kami -->
    <div class="bg-white py-24 relative shadow-[0_-10px_30px_-15px_rgba(0,0,0,0.05)] z-20">
        <div class="container mx-auto px-6 lg:px-16">
            <h2 class="text-3xl lg:text-4xl font-black text-[#111827] mb-16 px-4 text-left">Mengapa Memilih Kami?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                
                <!-- Benefit 1 -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-gray-50 flex flex-col items-center text-center hover:-translate-y-2 transition duration-300">
                    <div class="bg-blue-50 p-5 rounded-2xl mb-6 shadow-inner">
                        <svg class="w-10 h-10 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-xl text-[#111827] mb-4">Akurasi Tinggi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed font-medium">Membantu meminimalkan kesalahan dari pencatatan data fisik barang.</p>
                </div>

                <!-- Benefit 2 -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-gray-50 flex flex-col items-center text-center hover:-translate-y-2 transition duration-300">
                    <div class="bg-blue-50 p-5 rounded-2xl mb-6 shadow-inner">
                        <svg class="w-10 h-10 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="font-black text-xl text-[#111827] mb-4">Proses Cepat</h3>
                    <p class="text-gray-600 text-sm leading-relaxed font-medium">Mempercepat proses input dan pencarian data inventaris.</p>
                </div>

                <!-- Benefit 3 -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgba(0,0,0,0.08)] border border-gray-50 flex flex-col items-center text-center hover:-translate-y-2 transition duration-300">
                    <div class="bg-blue-50 p-5 rounded-2xl mb-6 shadow-inner">
                        <svg class="w-10 h-10 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="font-black text-xl text-[#111827] mb-4">Keamanan Data</h3>
                    <p class="text-gray-600 text-sm leading-relaxed font-medium">Data tersimpan dengan aman dan mudah diakses sesuai kebutuhan pengguna.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#F8FAFC] pt-20 pb-12 relative z-10 border-t border-gray-200">
        <div class="container mx-auto px-6 lg:px-20 grid grid-cols-1 md:grid-cols-2 gap-16 mb-8">
            
            <!-- Tentang Kami -->
            <div>
                <h3 class="font-black text-2xl text-[#111827] mb-6">Tentang Kami</h3>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-lg font-medium">
                    Website ini dibuat sebagai solusi digital untuk mempermudah pengelolaan inventaris barang, mulai dari pencatatan data barang, stok masuk, stok keluar, hingga penyajian laporan inventaris secara terstruktur dan efisien.
                </p>
            </div>

            <!-- Hubungi Kami -->
            <div class="md:pl-16">
                <h3 class="font-black text-2xl text-[#111827] mb-6">Hubungi Kami</h3>
                <ul class="space-y-5">
                    <li class="flex items-center gap-4">
                        <svg class="w-6 h-6 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="text-gray-700 text-sm md:text-base font-semibold">xxxx@gmail.com</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <svg class="w-6 h-6 text-[#1E3A8A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span class="text-gray-700 text-sm md:text-base font-semibold">828xxxxxxxxx</span>
                    </li>
                </ul>
            </div>
        </div>
        
    </footer>

</body>
</html>
