<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan Peminjaman</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Permohonan</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.pengajuan-ruangan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Permohonan</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Program Studi</dt>
                            <dd class="col-sm-9">{{ $pengajuan->prodi->nama_prodi ?? '-' }}</dd>

                            <dt class="col-sm-3">Ruangan</dt>
                            <dd class="col-sm-9">{{ $pengajuan->kelas->nama_kelas ?? '-' }}</dd>

                            <dt class="col-sm-3">Tanggal Mulai</dt>
                            <dd class="col-sm-9">{{ $pengajuan->tanggal_peminjaman }}</dd>

                            <dt class="col-sm-3">Tanggal Akhir</dt>
                            <dd class="col-sm-9">{{ $pengajuan->tanggal_berakhir_peminjaman }}</dd>

                            <dt class="col-sm-3">Waktu</dt>
                            <dd class="col-sm-9">{{ $pengajuan->waktu_peminjaman }} - {{ $pengajuan->waktu_berakhir_peminjaman }}</dd>

                            <dt class="col-sm-3">Keperluan</dt>
                            <dd class="col-sm-9">{{ $pengajuan->keperluan_peminjaman }}</dd>

                            <dt class="col-sm-3">Status</dt>
                            <dd class="col-sm-9">
                                @if($pengajuan->status == 'pending')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($pengajuan->status == 'approved')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($pengajuan->status == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </dd>

                            <dt class="col-sm-3">Catatan Admin</dt>
                            <dd class="col-sm-9">{{ $pengajuan->catatan_admin ?? '-' }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer text-right">
                        @if($pengajuan->status == 'pending')
                            <form action="{{ route('admin.pengajuan-ruangan.approve', $pengajuan->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                            <form action="{{ route('admin.pengajuan-ruangan.reject', $pengajuan->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('include.footerSistem')
</div>

@include('services.ToastModal')
@include('services.LogoutModal')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="{{ asset('js/ToastScript.js') }}"></script>
<script>
    $(document).ready(function() {
        @if (session('success') || session('error'))
            $('#toastNotification').toast({
                delay: 3000,
                autohide: true
            }).toast('show');
        @endif
    });
</script>
</body>
</html>
