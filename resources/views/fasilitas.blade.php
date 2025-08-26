<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Fasilitas</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: #f8f9fa;
        }
        .hero-section {
            background: url('{{ asset('image/d1.jpg') }}') center/cover no-repeat;
            color: white;
            padding: 100px 0;
            position: relative;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
        }
        .hero-section .container {
            position: relative;
            z-index: 2;
        }
        .facility-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .facility-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
        }
        .facility-row {
            margin-bottom: 60px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('include.navbarHome')

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Fasilitas Kampus</h1>
            <p class="lead mt-3">Menyediakan berbagai ruangan dan fasilitas untuk mendukung kegiatan akademik</p>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Daftar Fasilitas</h2>
                <p class="text-muted">Fasilitas lengkap untuk kebutuhan akademik maupun kegiatan kampus lainnya</p>
            </div>

            <!-- Row 1 -->
            <div class="row facility-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('image/kelas1.jpg') }}" alt="Ruang Kelas" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Ruang Kelas</h3>
                    <p class="text-muted">Dilengkapi dengan proyektor, AC, dan kapasitas bervariasi sesuai kebutuhan.</p>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row facility-row align-items-center flex-lg-row-reverse">
                <div class="col-lg-6">
                    <img src="{{ asset('image/d1interior2.jpg') }}" alt="Ruang Rapat" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Ruang Rapat</h3>
                    <p class="text-muted">Cocok untuk diskusi, seminar, atau pertemuan organisasi mahasiswa.</p>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row facility-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('image/labkomputer.jpg') }}" alt="Laboratorium Komputer" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Laboratorium Komputer</h3>
                    <p class="text-muted">Fasilitas komputer modern dengan akses internet cepat dan perangkat lunak pendukung.</p>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="row facility-row align-items-center flex-lg-row-reverse">
                <div class="col-lg-6">
                    <img src="{{ asset('image/perpustakaan-1.jpg') }}" alt="Perpustakaan" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Perpustakaan</h3>
                    <p class="text-muted">Koleksi buku, jurnal, dan referensi digital untuk menunjang proses belajar.</p>
                </div>
            </div>

            <!-- Row 5 -->
            <div class="row facility-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('image/joglo.jpg') }}" alt="Aula Serbaguna" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Aula Serbaguna</h3>
                    <p class="text-muted">Digunakan untuk seminar, workshop, dan kegiatan akademik lainnya.</p>
                </div>
            </div>

            <!-- Row 6 -->
            <div class="row facility-row align-items-center flex-lg-row-reverse">
                <div class="col-lg-6">
                    <img src="{{ asset('image/fasilitas/kantin.jpg') }}" alt="Kantin Kampus" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Kantin Kampus</h3>
                    <p class="text-muted">Tempat makan dengan berbagai pilihan menu sehat dan terjangkau.</p>
                </div>
            </div>

            <!-- Row 7 -->
            <div class="row facility-row align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('image/fasilitas/parkir.jpg') }}" alt="Area Parkir" class="facility-img">
                </div>
                <div class="col-lg-6 facility-text">
                    <h3 class="fw-bold">Area Parkir</h3>
                    <p class="text-muted">Lahan parkir yang luas untuk kendaraan roda dua maupun roda empat.</p>
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
