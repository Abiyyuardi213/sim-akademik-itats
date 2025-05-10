<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Legalisir</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
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
                            <h1 class="m-0">Detail Informasi Legalisir</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="card shadow-lg">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title mb-0">Informasi Detail Legalisir</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th width="40%">Tanggal Legalisir</th>
                                            <td>{{ $legalisir->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. Legalisir</th>
                                            <td>{{ $legalisir->no_legalisir }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $legalisir->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NPM</th>
                                            <td>{{ $legalisir->npm }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Ijazah</th>
                                            <td>{{ $legalisir->jumlah_ijazah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Transkip</th>
                                            <td>{{ $legalisir->jumlah_transkip }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Lain-lain</th>
                                            <td>{{ $legalisir->jumlah_lain }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Total</th>
                                            <td>{{ $legalisir->jumlah_total }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ route('legalisir.index') }}" class="btn btn-secondary">
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
