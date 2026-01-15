<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Home</title>
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
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased">
    <!-- Navbar -->
    @include('include.navbarHome')

    <!-- Hero Section -->
    <section id="beranda" class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-40">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="flex flex-col space-y-8 text-center lg:text-left order-2 lg:order-1">
                    <div class="space-y-4">
                        <div
                            class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-sm font-medium text-zinc-800 backdrop-blur-sm self-center lg:self-start">
                            <span class="mr-2 h-2 w-2 rounded-full bg-green-500"></span>
                            Sistem Akademik ITATS
                        </div>
                        <h1 class="text-4xl font-extrabold tracking-tight lg:text-6xl text-zinc-900 leading-[1.1]">
                            Kelola Peminjaman <br class="hidden lg:block" />
                            <span class="text-zinc-500">Ruangan Kampus</span>
                        </h1>
                        <p class="mx-auto lg:mx-0 max-w-[700px] text-zinc-500 md:text-xl leading-relaxed">
                            Platform terintegrasi untuk pengajuan, jadwal, dan pengelolaan fasilitas ruangan dengan
                            proses yang transparan dan efisien.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('login.guest') }}"
                            class="inline-flex h-12 items-center justify-center rounded-md bg-zinc-900 px-8 text-sm font-medium text-zinc-50 shadow transition-colors hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50">
                            Login Sekarang
                        </a>
                        <a href="#fitur"
                            class="inline-flex h-12 items-center justify-center rounded-md border border-zinc-200 bg-white px-8 text-sm font-medium shadow-sm transition-colors hover:bg-zinc-100 hover:text-zinc-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50 text-zinc-900">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
                <!-- Hero Image -->
                <div class="relative order-1 lg:order-2">
                    <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-zinc-100 shadow-xl">
                        <img src="{{ asset('image/d1.jpg') }}" alt="Room Booking Dashboard"
                            class="w-full h-auto object-cover aspect-[4/3]">
                    </div>
                    <!-- Decorative elements could go here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 bg-zinc-50/50 border-y border-zinc-100">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center justify-center text-center space-y-4 mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-zinc-900 sm:text-4xl">Fitur Unggulan</h2>
                <p class="max-w-[700px] text-zinc-500 md:text-lg">
                    Kami menghadirkan pengalaman terbaik dalam manajemen ruangan kampus dengan fitur modern dan mudah
                    digunakan.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md">
                    <div
                        class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900">
                        <i class="fas fa-door-open text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3">Daftar Ruangan</h3>
                    <p class="text-zinc-500 leading-relaxed">
                        Akses informasi detail seluruh ruangan yang tersedia, mencakup fasilitas, kapasitas, dan foto
                        kondisi terkini.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md">
                    <div
                        class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900">
                        <i class="fas fa-calendar-check text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3">Peminjaman Mudah</h3>
                    <p class="text-zinc-500 leading-relaxed">
                        Proses pengajuan yang disederhanakan dengan formulir intuitif, dapat diakses dari perangkat dan
                        di mana saja.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="rounded-xl border border-zinc-200 bg-white p-8 shadow-sm transition-shadow hover:shadow-md">
                    <div
                        class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-3">Tracking Real-time</h3>
                    <p class="text-zinc-500 leading-relaxed">
                        Pantau status permohonan Anda secara langsung. Dapatkan transparansi penuh dalam setiap proses
                        persetujuan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x-0 md:divide-x divide-zinc-100">
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-zinc-900">50+</div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Ruangan</p>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-zinc-900">1.2k+</div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Transaksi</p>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-zinc-900">98%</div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Kepuasan</p>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-extrabold text-zinc-900">24/7</div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wide">Layanan</p>
                </div>
            </div>
        </div>
    </section>

    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
