<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Tentang">
    <title>Akademik WR 1 - Tentang</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

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
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-zinc-900 mb-6">Tentang Sistem</h1>
            <p class="text-lg text-zinc-500 leading-relaxed">
                Sistem Peminjaman Ruangan Akademik WR 1 - Institut Teknologi Adhi Tama Surabaya. <br
                    class="hidden md:block">
                Inovasi digital untuk efisiensi akademik.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-start">

                <!-- Image Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4 pt-12">
                        <img src="{{ asset('image/d12.jpg') }}"
                            class="rounded-xl border border-zinc-200 shadow-sm w-full h-48 object-cover"
                            alt="Tentang Sistem 1">
                    </div>
                    <div>
                        <img src="{{ asset('image/d1interior.jpg') }}"
                            class="rounded-xl border border-zinc-200 shadow-sm w-full h-64 object-cover"
                            alt="Tentang Sistem 2">
                        <div class="pt-4">
                            <img src="{{ asset('image/joglo.jpg') }}"
                                class="rounded-xl border border-zinc-200 shadow-sm w-full h-40 object-cover"
                                alt="Tentang Sistem 3">
                        </div>
                    </div>
                </div>

                <div class="lg:pt-8">
                    <div
                        class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-xs font-medium text-zinc-800 mb-6">
                        Overview
                    </div>
                    <h2 class="text-3xl font-bold tracking-tight text-zinc-900 mb-6">Sistem Terintegrasi untuk Kampus
                    </h2>
                    <div class="space-y-4 text-zinc-600 leading-relaxed">
                        <p>
                            Sistem ini dirancang untuk mempermudah proses peminjaman ruangan di lingkungan kampus ITATS.
                            Pengguna dapat mengajukan permohonan peminjaman, memantau status pengajuan, serta menerima
                            notifikasi terkait persetujuan dengan transparan.
                        </p>
                        <p>
                            Dengan sistem ini, kami berkomitmen untuk meningkatkan efisiensi pengelolaan fasilitas dan
                            meminimalisir konflik jadwal penggunaan ruangan di lingkungan akademik.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="mt-24">
                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Visi -->
                    <div class="p-8 rounded-xl border border-zinc-200 bg-zinc-50/50 hover:bg-zinc-50 transition-colors">
                        <div
                            class="h-10 w-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center text-zinc-900 mb-6 shadow-sm">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h4 class="text-xl font-bold text-zinc-900 mb-3">Visi</h4>
                        <p class="text-zinc-500 leading-relaxed">
                            Menjadi sistem informasi yang efektif, efisien, dan transparan dalam mendukung pengelolaan
                            ruangan kampus.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="p-8 rounded-xl border border-zinc-200 bg-zinc-50/50 hover:bg-zinc-50 transition-colors">
                        <div
                            class="h-10 w-10 bg-white border border-zinc-200 rounded-lg flex items-center justify-center text-zinc-900 mb-6 shadow-sm">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="text-xl font-bold text-zinc-900 mb-3">Misi</h4>
                        <p class="text-zinc-500 leading-relaxed">
                            Menyediakan layanan digital yang memudahkan mahasiswa, dosen, dan staf dalam proses
                            peminjaman ruangan dengan aksesibilitas tinggi.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Team -->
            <div class="mt-24">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold tracking-tight text-zinc-900">Tim Pengembang</h2>
                    <p class="text-zinc-500 mt-2">Dibalik layar sistem akademik</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <!-- Dev 1 -->
                    <div class="p-6 rounded-xl border border-zinc-200 bg-white text-center shadow-sm">
                        <img src="{{ asset('image/default.png') }}"
                            class="w-20 h-20 rounded-full mx-auto mb-4 bg-zinc-100 object-cover border border-zinc-200"
                            alt="Dev 1">
                        <h5 class="text-lg font-bold text-zinc-900">R. Abiyyu Ardi Lian P</h5>
                        <p class="text-sm font-medium text-zinc-500 mb-1">Backend & Frontend</p>
                        <p class="text-xs text-zinc-400">Teknik Informatika 2023</p>
                    </div>

                    <!-- Dev 2 -->
                    <div class="p-6 rounded-xl border border-zinc-200 bg-white text-center shadow-sm">
                        <img src="{{ asset('image/default.png') }}"
                            class="w-20 h-20 rounded-full mx-auto mb-4 bg-zinc-100 object-cover border border-zinc-200"
                            alt="Dev 2">
                        <h5 class="text-lg font-bold text-zinc-900">Developer 2</h5>
                        <p class="text-sm font-medium text-zinc-500 mb-1">Frontend Developer</p>
                        <p class="text-xs text-zinc-400">Angkatan</p>
                    </div>

                    <!-- Dev 3 -->
                    <div class="p-6 rounded-xl border border-zinc-200 bg-white text-center shadow-sm">
                        <img src="{{ asset('image/default.png') }}"
                            class="w-20 h-20 rounded-full mx-auto mb-4 bg-zinc-100 object-cover border border-zinc-200"
                            alt="Dev 3">
                        <h5 class="text-lg font-bold text-zinc-900">Developer 3</h5>
                        <p class="text-sm font-medium text-zinc-500 mb-1">UI/UX Designer</p>
                        <p class="text-xs text-zinc-400">Angkatan</p>
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
