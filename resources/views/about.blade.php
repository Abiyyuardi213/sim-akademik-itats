<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Tentang</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: #f8f9fa;
        }
        .about-hero {
            background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
            color: white;
            padding: 80px 0;
        }
        .about-section {
            padding: 60px 0;
        }
        .about-icon {
            font-size: 3rem;
            color: #17a2b8;
            margin-bottom: 1rem;
        }
        .card-custom {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        .card-custom:hover {
            transform: translateY(-5px);
        }
        .about-hero {
            background: url("{{ asset('image/d1-crop.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 50vh;
        }

        .about-hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* atur kegelapan di sini */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('include.navbarHome')

    <!-- Hero Section -->
    <section class="about-hero text-center d-flex align-items-center position-relative">
        <div class="overlay"></div>
        <div class="container text-white position-relative">
            <h1 class="display-4 fw-bold">Tentang Sistem</h1>
            <p class="lead mt-3">Sistem Peminjaman Ruangan Akademik WR 1</p>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <!-- Slider Gambar -->
                    <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded shadow">
                            <div class="carousel-item active">
                                <img src="{{ asset('image/d12.jpg') }}" class="d-block w-100" alt="Tentang Sistem 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/d1interior.jpg') }}" class="d-block w-100" alt="Tentang Sistem 2">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('image/joglo.jpg') }}" class="d-block w-100" alt="Tentang Sistem 3">
                            </div>
                        </div>
                        <!-- Kontrol Navigasi -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Apa itu Sistem Peminjaman Ruangan?</h2>
                    <p class="text-muted">
                        Sistem ini dirancang untuk mempermudah proses peminjaman ruangan di lingkungan kampus ITATS.
                        Pengguna dapat mengajukan permohonan peminjaman, memantau status pengajuan,
                        serta menerima notifikasi terkait persetujuan atau penolakan peminjaman.
                    </p>
                    <p class="text-muted">
                        Dengan sistem ini, transparansi dan efisiensi pengelolaan ruangan dapat ditingkatkan,
                        serta meminimalisir konflik jadwal penggunaan ruangan.
                    </p>
                </div>
            </div>

            <!-- Visi & Misi -->
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold mb-4">Visi & Misi</h2>
                </div>
                <div class="col-md-6">
                    <div class="card card-custom p-4">
                        <div class="about-icon"><i class="fas fa-eye"></i></div>
                        <h5 class="fw-bold mb-3">Visi</h5>
                        <p class="text-muted">Menjadi sistem informasi yang efektif, efisien, dan transparan dalam mendukung pengelolaan ruangan kampus.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-custom p-4">
                        <div class="about-icon"><i class="fas fa-bullseye"></i></div>
                        <h5 class="fw-bold mb-3">Misi</h5>
                        <p class="text-muted">Menyediakan layanan digital yang memudahkan mahasiswa, dosen, dan staf dalam proses peminjaman ruangan.</p>
                    </div>
                </div>
            </div>

            <!-- Tim Developer -->
            <div class="row text-center">
                <div class="col-12 mb-4">
                    <h2 class="fw-bold">Tim Pengembang</h2>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom text-center p-4 shadow-sm border-0 rounded-3 h-100">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('image/default.png') }}"
                                class="rounded-circle shadow-sm"
                                width="100" height="100" alt="Dev 1">
                        </div>
                        <h6 class="fw-bold mb-1">R. Abiyyu Ardi Lian Permadi</h6>
                        <p class="text-muted mb-0">
                            Backend & Frontend Developer <br>
                            <small>Teknik Informatika 2023</small>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom text-center p-4 shadow-sm border-0 rounded-3 h-100">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('image/default.png') }}"
                                class="rounded-circle shadow-sm"
                                width="100" height="100" alt="Dev 1">
                        </div>
                        <h6 class="fw-bold mb-1">Developer 2</h6>
                        <p class="text-muted mb-0">
                            Frontend Developer <br>
                            <small>Angkatan</small>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom text-center p-4 shadow-sm border-0 rounded-3 h-100">
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('image/default.png') }}"
                                class="rounded-circle shadow-sm"
                                width="100" height="100" alt="Dev 1">
                        </div>
                        <h6 class="fw-bold mb-1">Developer 3</h6>
                        <p class="text-muted mb-0">
                            UI/UX Designer <br>
                            <small>Angkatan</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('include.footerUser')
    @include('services.LogoutModalUser')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
