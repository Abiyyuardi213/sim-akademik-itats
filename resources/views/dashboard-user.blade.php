<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Akademik WR 1</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('include.navbarUser')

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 md:px-6 py-8">
        <!-- Welcome Section -->
        <div class="mb-8 space-y-2">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900">Dashboard</h1>
            <p class="text-zinc-500">Selamat datang kembali, {{ Auth::guard('users')->user()->username }}. Kelola
                peminjaman Anda.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid gap-4 md:grid-cols-3 mb-8">
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium text-zinc-500">Total Peminjaman</h3>
                    <i class="fas fa-calendar-check text-zinc-400"></i>
                </div>
                <div class="text-2xl font-bold">12</div>
                <p class="text-xs text-zinc-500 mt-1">
                    Semua riwayat peminjaman
                </p>
            </div>
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium text-zinc-500">Menunggu Persetujuan</h3>
                    <i class="fas fa-clock text-zinc-400"></i>
                </div>
                <div class="text-2xl font-bold">2</div>
                <p class="text-xs text-zinc-500 mt-1">
                    Sedang diproses admin
                </p>
            </div>
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex flex-row items-center justify-between space-y-0 pb-2">
                    <h3 class="tracking-tight text-sm font-medium text-zinc-500">Disetujui</h3>
                    <i class="fas fa-check-circle text-zinc-400"></i>
                </div>
                <div class="text-2xl font-bold">10</div>
                <p class="text-xs text-zinc-500 mt-1">
                    Peminjaman aktif & selesai
                </p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h2 class="text-lg font-semibold tracking-tight text-zinc-900 mb-4">Akses Cepat</h2>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('users.pengajuan.index') }}"
                    class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 hover:bg-zinc-50 hover:border-zinc-300 transition-all">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900 group-hover:bg-white group-hover:shadow-sm">
                            <i class="fas fa-search text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-zinc-900">Cari Ruangan</h3>
                            <p class="text-sm text-zinc-500">Lihat daftar fasilitas</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('users.pengajuan.index') }}"
                    class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 hover:bg-zinc-50 hover:border-zinc-300 transition-all">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900 group-hover:bg-white group-hover:shadow-sm">
                            <i class="fas fa-plus text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-zinc-900">Buat Pengajuan</h3>
                            <p class="text-sm text-zinc-500">Ajukan peminjaman baru</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('users.pengajuan.status') }}"
                    class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 hover:bg-zinc-50 hover:border-zinc-300 transition-all">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900 group-hover:bg-white group-hover:shadow-sm">
                            <i class="fas fa-history text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-zinc-900">Cek Status</h3>
                            <p class="text-sm text-zinc-500">Pantau progres</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('pengumuman.index') }}"
                    class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 hover:bg-zinc-50 hover:border-zinc-300 transition-all">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900 group-hover:bg-white group-hover:shadow-sm">
                            <i class="fas fa-bullhorn text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-zinc-900">Pengumuman</h3>
                            <p class="text-sm text-zinc-500">Informasi terbaru</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Ruangan Populer / Tersedia -->
        <div class="mt-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold tracking-tight text-zinc-900">Rekomendasi Ruangan</h2>
                <a href="{{ route('users.pengajuan.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1">
                    Lihat Semua <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($rekomendasi_ruangan as $kelas)
                    <div
                        class="group relative bg-white rounded-xl border border-zinc-200 overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="aspect-video w-full bg-zinc-100 relative overflow-hidden">
                            <img src="{{ $kelas->gambar ? asset('uploads/kelas/' . $kelas->gambar) : 'https://placehold.co/600x400?text=Ruangan' }}"
                                onerror="this.src='https://placehold.co/600x400?text=Ruangan'"
                                alt="{{ $kelas->nama_kelas }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute top-3 right-3 bg-emerald-500/90 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wide backdrop-blur-sm">
                                Tersedia
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h3 class="font-bold text-zinc-900 line-clamp-1">{{ $kelas->nama_kelas }}</h3>
                                    <p class="text-xs text-zinc-500">{{ $kelas->gedung->nama_gedung ?? 'Gedung' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 text-xs text-zinc-600 mb-4 mt-3">
                                <div class="flex items-center gap-1.5">
                                    <i class="fas fa-users text-zinc-400"></i>
                                    <span>{{ $kelas->kapasitas_mahasiswa }} Kursi</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <i class="fas fa-wind text-zinc-400"></i>
                                    <span>AC</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <i class="fas fa-wifi text-zinc-400"></i>
                                    <span>WiFi</span>
                                </div>
                            </div>

                            <a href="{{ route('users.pengajuan.create', $kelas->id) }}"
                                class="flex w-full items-center justify-center gap-2 rounded-lg bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2">
                                Ajukan Peminjaman
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
