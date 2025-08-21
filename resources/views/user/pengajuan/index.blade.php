{{-- resources/views/users/pengajuan/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Pengajuan Peminjaman</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #1e40af;
            --light-blue: #dbeafe;
            --accent-blue: #3b82f6;
            --dark-blue: #1e3a8a;
            --pure-white: #ffffff;
            --light-gray: #f8fafc;
            --border-gray: #e2e8f0;
            --text-gray: #64748b;
            --text-dark: #1e293b;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }
        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: var(--pure-white);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="1" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="1" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .hero-subtitle {
            font-size: 1.25rem;
            font-weight: 400;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            position: relative;
        }
        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 3rem;
        }
        .room-card {
            background: var(--pure-white);
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
        }
        .room-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-blue));
        }
        .room-image {
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .room-card:hover .room-image {
            transform: scale(1.05);
        }
        .card-body {
            padding: 2rem;
        }
        .room-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }
        .room-info {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            color: var(--text-gray);
            font-size: 0.95rem;
        }
        .room-info i {
            width: 20px;
            color: var(--primary-blue);
            margin-right: 0.75rem;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
        .status-available {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        .status-unavailable {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            color: var(--pure-white);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
            color: var(--pure-white);
        }
        .btn-submit:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }
        .btn-submit::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-submit:hover::before {
            left: 100%;
        }
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--pure-white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.1);
        }
        .empty-state i {
            font-size: 4rem;
            color: var(--primary-blue);
            margin-bottom: 1.5rem;
        }
        .empty-state h4 {
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }
        .empty-state p {
            color: var(--text-gray);
            font-size: 1.1rem;
        }
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.1rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .card-body {
                padding: 1.5rem;
            }
            .room-title {
                font-size: 1.25rem;
            }
        }
        @media (max-width: 576px) {
            .hero-section {
                padding: 60px 0;
            }
            .hero-title {
                font-size: 2rem;
            }
            .section-title {
                font-size: 1.75rem;
            }
        }
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
    </style>
</head>
<body>
    @include('include.navbarUser')

    <section id="beranda" class="hero-section">
        <div class="container">
            <div class="hero-content text-center fade-in">
                <h1 class="hero-title">Ajukan Peminjaman Ruangan</h1>
                <p class="hero-subtitle">Temukan dan pesan ruangan yang sesuai dengan kebutuhan Anda dengan mudah dan cepat melalui sistem terintegrasi kami.</p>
            </div>
        </div>
    </section>

    <section id="daftar-ruangan" class="py-5">
        <div class="container">
            <div class="text-center mb-5 fade-in">
                <h2 class="section-title">Daftar Ruangan Tersedia</h2>
                <p class="section-subtitle">Pilih ruangan yang sesuai dengan kebutuhan dan kapasitas yang Anda inginkan</p>
            </div>

            <div class="row g-4">
                @forelse($kelas as $index => $item)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card room-card h-100 fade-in stagger-{{ ($index % 3) + 1 }}">
                            @if($item->gambar)
                                <img src="{{ asset('uploads/kelas/'.$item->gambar) }}" class="room-image w-100" alt="{{ $item->nama_kelas }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="room-image w-100" alt="Ruangan">
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h3 class="room-title">{{ $item->nama_kelas }}</h3>

                                <div class="room-info">
                                    <i class="fas fa-users"></i>
                                    <span>Kapasitas: {{ $item->kapasitas_mahasiswa }} orang</span>
                                </div>

                                <div class="room-info">
                                    <i class="fas fa-building"></i>
                                    <span>Gedung: {{ $item->gedung->nama_gedung ?? 'Tidak tersedia' }}</span>
                                </div>

                                @if($item->kelas_status)
                                    <div class="status-badge status-available">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Tersedia
                                    </div>
                                @else
                                    <div class="status-badge status-unavailable">
                                        <i class="fas fa-times-circle me-2"></i>
                                        Tidak Tersedia
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <a href="{{ route('users.pengajuan.create', $item->id) }}"
                                        class="btn btn-submit w-100 {{ !$item->kelas_status ? 'disabled' : '' }}"
                                        {{ !$item->kelas_status ? 'aria-disabled=true' : '' }}>
                                        <i class="fas fa-paper-plane me-2"></i>
                                        {{ $item->kelas_status ? 'Ajukan Peminjaman' : 'Tidak Tersedia' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state fade-in">
                            <i class="fas fa-door-closed"></i>
                            <h4>Tidak Ada Ruangan Tersedia</h4>
                            <p>Maaf, saat ini tidak ada ruangan yang tersedia untuk dipinjam. Silakan coba lagi nanti atau hubungi administrator.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('include.footerUser')
    @include('services.LogoutModalUser')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            document.querySelectorAll('.btn-submit:not(.disabled)').forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    }
                });
            });
        });

        @if(session('success'))
            Swal.fire({
                title: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK",
                draggable: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK",
                draggable: true
            });
        @endif
    </script>
</body>
</html>
