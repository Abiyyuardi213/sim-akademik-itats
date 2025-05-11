<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Periode</title>
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
                            <h1 class="m-0">Ubah Periode</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i> Form Ubah Data Periode</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('periode.update', $periode->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama_periode">Nama Periode</label>
                                    <input type="text" class="form-control" name="nama_periode" value="{{ old('nama_periode', $periode->nama_periode) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="awal_cuti">Awal Cuti</label>
                                    <input type="month" class="form-control" name="awal_cuti" value="{{ old('awal_cuti', $periode->awal_cuti) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="akhir_cuti">Akhir Cuti</label>
                                    <input type="month" class="form-control" name="akhir_cuti" value="{{ old('akhir_cuti', $periode->akhir_cuti) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="bulan_her">Bulan Wajib HER</label>
                                    <input type="month" class="form-control" name="bulan_her" value="{{ old('bulan_her', $periode->bulan_her) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="periode_status">Status Periode</label>
                                    <select class="form-control" name="periode_status">
                                        <option value="1" {{ $periode->periode_status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $periode->periode_status == 0 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                <a href="{{ route('periode.index') }}" class="btn btn-secondary">Batal</a>
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
