<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Legalisir</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
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
                            <h1 class="m-0">Ubah Data Legalisir</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('legalisir.update', $legalisir->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="{{ old('tanggal', $legalisir->tanggal) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_legalisir">No. Legalisir</label>
                                    <input type="text" class="form-control" name="no_legalisir" value="{{ old('no_legalisir', $legalisir->no_legalisir) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ old('nama', $legalisir->nama) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="npm">NPM</label>
                                    <input type="text" class="form-control" name="npm" value="{{ old('npm', $legalisir->npm) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_ijazah">Jumlah Ijazah</label>
                                    <input type="text" class="form-control" name="jumlah_ijazah" value="{{ old('jumlah_ijazah', $legalisir->jumlah_ijazah) }}">
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_transkip">Jumlah Transkip</label>
                                    <input type="text" class="form-control" name="jumlah_transkip" value="{{ old('jumlah_transkip', $legalisir->jumlah_transkip) }}">
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_lain">Jumlah Lain</label>
                                    <input type="text" class="form-control" name="jumlah_lain" value="{{ old('jumlah_lain', $legalisir->jumlah_lain) }}">
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_total">Jumlah Total</label>
                                    <input type="text" class="form-control" name="jumlah_total" value="{{ old('jumlah_total', $legalisir->jumlah_total) }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('legalisir.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
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
