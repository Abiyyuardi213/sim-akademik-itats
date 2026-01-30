<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Fasilitas">
    <title>Akademik WR 1 - Fasilitas</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('image/itats-1080.jpg') }}">

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

<body class="bg-white text-zinc-950 antialiased">
    <!-- Navbar -->
    @include('include.navbarHome')

    <!-- Header Section -->
    <section class="py-20 md:py-28 bg-zinc-50 border-b border-zinc-100">
        <div class="container mx-auto px-4 text-center max-w-3xl">
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-zinc-900 mb-6">Fasilitas Kampus</h1>
            <p class="text-lg text-zinc-500 leading-relaxed">
                Menyediakan berbagai ruangan dan fasilitas modern untuk mendukung kegiatan akademik dan kreativitas
                mahasiswa.
            </p>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                <!-- Item 1: Ruang Kelas -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/kelas1.jpg') }}" alt="Ruang Kelas"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Akademik</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Ruang Kelas</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed mb-4">
                            Dilengkapi dengan proyektor, AC, kursi ergonomis, dan papan tulis whiteboard. Kapasitas
                            bervariasi untuk mendukung proses belajar.
                        </p>
                        <ul class="space-y-2 text-sm text-zinc-600">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2 text-xs"></i> Full
                                AC</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2 text-xs"></i> LCD
                                Projector</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2 text-xs"></i> WiFi
                                Access</li>
                        </ul>
                    </div>
                </div>

                <!-- Item 2: Ruang Rapat -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/d1interior2.jpg') }}" alt="Ruang Rapat"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-users"></i>
                            <span>Administrasi</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Ruang Rapat</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed mb-4">
                            Cocok untuk diskusi, seminar, atau pertemuan organisasi mahasiswa. Desain interior yang
                            nyaman mendorong kolaborasi.
                        </p>
                        <ul class="space-y-2 text-sm text-zinc-600">
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                Kapasitas 10-20 orang</li>
                            <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2 text-xs"></i> Sound
                                System</li>
                        </ul>
                    </div>
                </div>

                <!-- Item 3: Laboratorium -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/labkomputer.jpg') }}" alt="Laboratorium"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-desktop"></i>
                            <span>Praktikum</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Laboratorium Komputer</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">
                            Fasilitas komputer modern dengan spesifikasi tinggi, akses internet cepat, dan perangkat
                            lunak pendukung untuk praktikum.
                        </p>
                    </div>
                </div>

                <!-- Item 4: Perpustakaan -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/perpustakaan-1.jpg') }}" alt="Perpustakaan"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-book-reader"></i>
                            <span>Umum</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Perpustakaan</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">
                            Koleksi buku, jurnal, dan referensi digital yang lengkap. Area baca yang tenang dan nyaman
                            untuk studi mandiri.
                        </p>
                    </div>
                </div>

                <!-- Item 5: Aula -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/joglo.jpg') }}" alt="Aula"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-university"></i>
                            <span>Umum</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Aula Serbaguna</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">
                            Ruang luas yang dapat digunakan untuk seminar, workshop, pameran, dan kegiatan akademik
                            skala besar lainnya.
                        </p>
                    </div>
                </div>

                <!-- Item 6: Kantin -->
                <div
                    class="group rounded-xl border border-zinc-200 bg-card text-card-foreground shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-video relative overflow-hidden">
                        <img src="{{ asset('image/fasilitas/kantin.jpg') }}" alt="Kantin"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center gap-2 text-sm font-medium text-zinc-500">
                            <i class="fas fa-utensils"></i>
                            <span>Fasilitas</span>
                        </div>
                        <h3 class="text-xl font-bold text-zinc-900 mb-3">Kantin Kampus</h3>
                        <p class="text-zinc-500 text-sm leading-relaxed">
                            Tempat istirahat dan makan dengan berbagai pilihan menu sehat, higienis, dan harga
                            terjangkau bagi mahasiswa.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
