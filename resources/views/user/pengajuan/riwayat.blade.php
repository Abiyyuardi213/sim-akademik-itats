<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Daftar Permohonan Peminjaman</title>
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

        body {
            font-family: 'Source Sans Pro', sans-serif !important;
            background-color: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Hero section */
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
        }

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
            margin-bottom: 2rem;
        }

        /* Card */
        .status-card {
            background-color: var(--bg-white);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 1rem;
            transition: .2s;
        }
        .status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .status-card .card-body { padding: 1.5rem; }

        .room-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .75rem;
            margin-bottom: 1rem;
        }

        .room-icon {
            width: 40px; height: 40px;
            background: var(--primary-blue);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            font-size: .9rem;
            color: var(--text-secondary);
            margin-bottom: .5rem;
        }

        .info-icon {
            width: 32px; height: 32px;
            background: var(--light-blue);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary-blue);
        }

        .status-badge {
            padding: .5rem 1rem;
            border-radius: 20px;
            font-size: .85rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: .25rem;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-diterima { background: #d1fae5; color: #065f46; }
        .status-ditolak { background: #fee2e2; color: #991b1b; }

        .card-footer {
            background: var(--bg-light) !important;
            border-top: 1px solid var(--border-light);
            font-size: .85rem;
            color: var(--text-secondary) !important;
            padding: 1rem 1.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: var(--bg-white);
            border: 1px solid var(--border-light);
            border-radius: 12px;
        }
        .empty-icon {
            width: 80px; height: 80px;
            background: var(--light-blue);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary-blue);
            font-size: 2rem;
        }
    </style>
</head>
<body>
    @include('include.navbarUser')

    <!-- Hero -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="hero-title">Daftar Permohonan Peminjaman</h1>
            <p class="hero-subtitle">Lihat riwayat dan status peminjaman ruangan Anda</p>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Riwayat Pengajuan</h2>
                <p class="section-subtitle">Semua permohonan peminjaman ruangan yang telah diajukan</p>
            </div>

            @if($riwayats->count())
                <div class="row">
                    @foreach($riwayats as $index => $item)
                        <div class="col-12">
                            <div class="card status-card">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                                        <div class="flex-grow-1">
                                            <div class="room-title">
                                                <div class="room-icon"><i class="fas fa-door-open"></i></div>
                                                <span>{{ $item->kelas->nama_kelas ?? 'Ruangan Tidak Tersedia' }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon"><i class="fas fa-building"></i></div>
                                                <span>{{ $item->prodi->nama_prodi ?? '-' }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                                                <span>{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon"><i class="fas fa-clock"></i></div>
                                                <span>{{ $item->waktu_peminjaman }} - {{ $item->waktu_berakhir_peminjaman }}</span>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon"><i class="fas fa-clipboard-list"></i></div>
                                                <span>{{ $item->keperluan_peminjaman }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center">
                                            @if($item->status == 'pending')
                                                <span class="status-badge status-pending"><i class="fas fa-clock"></i> Menunggu</span>
                                            @elseif($item->status == 'disetujui')
                                                <span class="status-badge status-diterima"><i class="fas fa-check-circle"></i> Diterima</span>
                                            @else
                                                <span class="status-badge status-ditolak"><i class="fas fa-times-circle"></i> Ditolak</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-hashtag me-2"></i>Permohonan {{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}
                                    </div>

                                    @if($item->status == 'disetujui')
                                        {{-- <a href="{{ route('users.pengajuan.cetakPdf', $item->id) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-pdf"></i> Cetak PDF
                                        </a> --}}
                                        <a href="{{ route('users.pengajuan.cetakPdf', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-pdf"></i> Cetak PDF
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                    <h4>Belum Ada Permohonan</h4>
                    <p>Anda belum pernah mengajukan peminjaman ruangan. Silakan ajukan melalui menu <strong>Ajukan Peminjaman</strong>.</p>
                </div>
            @endif
        </div>
    </section>

    @include('include.footerUser')
    @include('services.LogoutModalUser')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
