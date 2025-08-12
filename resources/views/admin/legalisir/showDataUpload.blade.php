<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Upload Data Legalisir</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Konfirmasi Upload Data Legalisir</h1>
                <p>Periksa kembali data di bawah ini sebelum menyimpan ke sistem.</p>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('admin.legalisir.import.confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="data" value="{{ base64_encode(serialize($data)) }}">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Legalisir</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataUploadTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No Legalisir</th>
                                            <th>Nama</th>
                                            <th>NPM</th>
                                            <th>Ijazah</th>
                                            <th>Transkip</th>
                                            <th>Lain-lain</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row['tanggal'] }}</td>
                                                <td>{{ $row['no_legalisir'] }}</td>
                                                <td>{{ $row['nama'] }}</td>
                                                <td>{{ $row['npm'] }}</td>
                                                <td>{{ $row['jumlah_ijazah'] }}</td>
                                                <td>{{ $row['jumlah_transkip'] }}</td>
                                                <td>{{ $row['jumlah_lain'] }}</td>
                                                <td>{{ $row['jumlah_total'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('admin.legalisir.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan ke Database</button>
                        </div>
                    </div>
                </form>
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
        $('#dataUploadTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
</body>
</html>
