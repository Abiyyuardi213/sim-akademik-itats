<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program Studi</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .card {
            border-radius: 10px;
        }
        .table th {
            background-color: #f8f9fa;
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
                            <h1 class="m-0">Detail Informasi Program Studi</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="card shadow-lg">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title mb-0">Informasi Program Studi</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th width="40%">Nama Prodi</th>
                                                <td>{{ $prodi->nama_prodi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kode Prodi</th>
                                                <td>{{ $prodi->kode_prodi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Alias Prodi</th>
                                                <td>{{ $prodi->alias_prodi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nama Kaprodi</th>
                                                <td>{{ $prodi->nama_kaprodi }}</td>
                                            </tr>
                                            <tr>
                                                <th>NIP Kaprodi</th>
                                                <td>{{ $prodi->nip_kaprodi ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <td>{{ $prodi->prodi_description ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    @if($prodi->prodi_status)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Non-Aktif</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Dibuat pada</th>
                                                <td>{{ $prodi->created_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Diperbarui pada</th>
                                                <td>{{ $prodi->updated_at->format('d-m-Y H:i') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ route('admin.prodi.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.nav-sidebar').Treeview('init');
        });
    </script>
</body>
</html>
