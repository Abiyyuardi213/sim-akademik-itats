<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mahasiswa Cuti</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
    </style>
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
                            <h1 class="m-0">Detail Informasi Mahasiswa Cuti</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Cuti Mahasiswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nama Mahasiswa</th>
                                            <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                                        </tr>
                                        <tr>
                                            <th>NPM</th>
                                            <td>{{ $mahasiswa->npm }}</td>
                                        </tr>
                                        <tr>
                                            <th>Program Studi</th>
                                            <td>{{ $mahasiswa->prodi ? $mahasiswa->prodi->nama_prodi : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Periode Cuti</th>
                                            <td>{{ $mahasiswa->periode ? $mahasiswa->periode->nama_periode : '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Surat Cuti</th>
                                            <td>{{ $mahasiswa->nomor_cuti }}</td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>{{ $mahasiswa->keterangan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Cuti Mahasiswa</th>
                                            <td>{{ $mahasiswa->surat_status ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Data dibuat pada</th>
                                            <td>{{ $mahasiswa->created_at }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa-cuti.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.logoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-widget="treeview"]').Treeview('init');
        });
    </script>
</body>
</html>
