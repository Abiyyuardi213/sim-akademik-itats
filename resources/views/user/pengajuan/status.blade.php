<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Status Permohonan</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #2563eb;
            --light-blue: #dbeafe;
            --dark-blue: #1d4ed8;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --bg-white: #ffffff;
            --bg-light: #f8fafc;
            --border-light: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Simplified hero section with clean white background and blue accent */
        .hero-section {
            background-color: var(--bg-white);
            padding: 60px 0 40px;
            border-bottom: 1px solid var(--border-light);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Clean main content section */
        .main-content {
            padding: 40px 0;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        /* Simplified status cards with clean white background */
        .status-card {
            background-color: var(--bg-white);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
            margin-bottom: 1rem;
        }

        .status-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .status-card .card-body {
            padding: 1.5rem;
        }

        .room-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Simple blue icon background */
        .room-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Light blue info icons */
        .info-icon {
            width: 32px;
            height: 32px;
            background-color: var(--light-blue);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            font-size: 0.8rem;
        }

        /* Clean status badges with simple colors */
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-diterima {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-ditolak {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Simple empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background-color: var(--bg-white);
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background-color: var(--light-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary-blue);
            font-size: 2rem;
        }

        .empty-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .empty-description {
            color: var(--text-secondary);
            font-size: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Clean card footer */
        .card-footer {
            background-color: var(--bg-light) !important;
            border-top: 1px solid var(--border-light);
            padding: 1rem 1.5rem;
            font-size: 0.85rem;
            color: var(--text-secondary) !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0 30px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .status-card .card-body {
                padding: 1.25rem;
            }

            .room-title {
                font-size: 1.1rem;
            }
        }

        /* Removed all heavy animations and scroll effects */
    </style>
</head>
<body>
    @include('include.navbarUser')

    <!-- Simplified hero section -->
    <section class="hero-section">
        <div class="container">
            <div class="text-center">
                <h1 class="hero-title">Status Permohonan</h1>
                <p class="hero-subtitle">Pantau status pengajuan ruangan Anda dengan mudah</p>
            </div>
        </div>
    </section>

    <!-- Clean main content without animations -->
    <section class="main-content">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Daftar Status Permohonan</h2>
                <p class="section-subtitle">Status terkini dari permohonan peminjaman ruangan Anda</p>
            </div>

            @if($statuses->count())
                <div class="row">
                    @foreach($statuses as $index => $item)
                        <div class="col-12">
                            <div class="card status-card">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                                        <div class="flex-grow-1">
                                            <div class="room-title">
                                                <div class="room-icon">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                                <span>{{ $item->kelas->nama_kelas ?? 'Ruangan Tidak Tersedia' }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </div>
                                                <span>{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-clock"></i>
                                                </div>
                                                <span>{{ $item->waktu_peminjaman }} - {{ $item->waktu_berakhir_peminjaman }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            @if($item->status == 'pending')
                                                <span class="status-badge status-pending">
                                                    <i class="fas fa-clock"></i>
                                                    Menunggu
                                                </span>
                                            @elseif($item->status == 'disetujui')
                                                <span class="status-badge status-diterima">
                                                    <i class="fas fa-check-circle"></i>
                                                    Disetujui
                                                </span>
                                            @else
                                                <span class="status-badge status-ditolak">
                                                    <i class="fas fa-times-circle"></i>
                                                    Ditolak
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <i class="fas fa-hashtag me-2"></i>Permohonan {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4 class="empty-title">Belum Ada Permohonan</h4>
                    <p class="empty-description">
                        Anda belum memiliki permohonan peminjaman ruangan.
                        Silakan ajukan permohonan baru untuk melihat statusnya di sini.
                    </p>
                </div>
            @endif
        </div>
    </section>

    @include('include.footerUser')
    @include('services.LogoutModalUser')

    <!-- Removed AOS library and heavy JavaScript animations -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
