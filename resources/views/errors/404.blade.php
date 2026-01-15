<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-zinc-100 relative overflow-hidden font-sans antialiased">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('image/gedungA.jpg') }}" alt="Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-zinc-900/70 backdrop-blur-[2px]"></div>
    </div>

    <!-- Content Card -->
    <div
        class="relative z-10 w-full max-w-lg p-8 md:p-12 mx-4 bg-white rounded-3xl shadow-2xl shadow-black/20 text-center animate-in fade-in zoom-in-95 duration-300">
        <!-- Logo -->
        <div class="mb-8">
            <img src="{{ asset('image/itats-biru.png') }}" alt="ITATS Logo" class="h-16 mx-auto object-contain">
        </div>

        <!-- Error Content -->
        <div class="space-y-4 mb-8">
            <h1 class="text-7xl font-black text-zinc-900 tracking-tighter">404</h1>
            <h2 class="text-2xl font-bold text-zinc-800 tracking-tight">Halaman Tidak Ditemukan</h2>
            <p class="text-zinc-500 leading-relaxed max-w-sm mx-auto">
                Maaf, halaman yang Anda cari tidak tersedia atau mungkin telah dipindahkan.
            </p>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <button onclick="history.back()"
                class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl border border-zinc-200 text-zinc-700 font-semibold hover:bg-zinc-50 hover:border-zinc-300 transition-all focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2">
                <i class="fas fa-arrow-left mr-2 text-xs"></i>
                Kembali
            </button>
            <a href="{{ url('/dashboard') }}"
                class="inline-flex items-center justify-center px-6 py-2.5 rounded-xl bg-zinc-900 text-white font-semibold hover:bg-zinc-800 transition-all shadow-lg shadow-zinc-900/20 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2">
                <i class="fas fa-home mr-2 text-xs"></i>
                Ke Beranda
            </a>
        </div>
    </div>

    <!-- Footer Credit -->
    <div class="absolute bottom-6 w-full text-center z-10 text-white/40 text-xs">
        &copy; {{ date('Y') }} Institut Teknologi Adhi Tama Surabaya. All rights reserved.
    </div>
</body>

</html>
