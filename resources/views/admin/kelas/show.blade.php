<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas - {{ $kelas->nama_kelas }}</title>
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
                            <h1 class="m-0">Detail Kelas</h1>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('admin.kelas.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Kelas</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Nama Kelas:</strong>
                                    <p>{{ $kelas->nama_kelas }}</p>

                                    <strong>Gedung:</strong>
                                    <p>{{ $kelas->gedung->nama_gedung ?? '-' }}</p>

                                    <strong>Kapasitas Mahasiswa:</strong>
                                    <p>{{ $kelas->kapasitas_mahasiswa }}</p>

                                    <strong>Status Kelas:</strong>
                                    <p>
                                        @if($kelas->kelas_status)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Nonaktif</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Keterangan:</strong>
                                    <p>{{ $kelas->keterangan ?? '-' }}</p>

                                    <strong>Gambar Kelas:</strong><br>
                                    @if($kelas->gambar)
                                        <img src="{{ asset('uploads/kelas/' . $kelas->gambar) }}" alt="Gambar Kelas" class="img-fluid rounded" style="max-height: 300px;">
                                    @else
                                        <p>Tidak ada gambar</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i> Edit Kelas
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
