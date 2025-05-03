<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Legalisir</title>
    <link rel="icon" href="{{ asset('assets/itats-icon.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .card-header .d-flex.justify-content-end {
            margin-left: auto;
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
                            <h1 class="m-0">Manajemen Legalisir</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Legalisir</h3>
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Form Import CSV -->
                                <form action="{{ route('legalisir.import') }}" method="POST" enctype="multipart/form-data" id="importCsvForm" class="mr-2">
                                    @csrf
                                    <input type="file" name="csv_file" id="csv_file" accept=".csv" class="d-none" required onchange="document.getElementById('importCsvForm').submit();">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="document.getElementById('csv_file').click();">
                                        <i class="fas fa-upload"></i> Import CSV
                                    </button>
                                </form>

                                <!-- Export CSV -->
                                <a href="{{ url('legalisir/export') }}" class="btn btn-success btn-sm mr-2">
                                    <i class="fas fa-download"></i> Export CSV
                                </a>

                                <!-- Tambah Data -->
                                <a href="{{ route('legalisir.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Data Legalisir
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="legalisirTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No. Legalisir</th>
                                            <th>Nama</th>
                                            <th>NPM</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($legalisirs as $index => $legalisir)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $legalisir->tanggal }}</td>
                                                <td>{{ $legalisir->no_legalisir }}</td>
                                                <td>{{ $legalisir->nama }}</td>
                                                <td>{{ $legalisir->npm }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('legalisir.show', $legalisir->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('legalisir.edit', $legalisir->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete-legalisir-btn"
                                                        data-toggle="modal"
                                                        data-target="#deleteLegalisirModal"
                                                        data-legalisir-id="{{ $legalisir->id }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="tablePagination"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('include.footerSistem')
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteLegalisirModal" tabindex="-1" aria-labelledby="deleteLegalisirModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteLegalisirModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data legalisir ini? Tindakan ini tidak dapat dibatalkan.
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('services.ToastModal')
    @include('services.LogoutModal')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/ToastScript.js') }}"></script>
    <script>
        $(document).ready(function () {
            $("#legalisirTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });

        $(document).ready(function () {
            $('.delete-legalisir-btn').click(function () {
                let legalisirId = $(this).data('legalisir-id');
                let deleteUrl = "{{ url('legalisir') }}/" + legalisirId;
                $('#deleteForm').attr('action', deleteUrl);
            });
        });

        $(document).ready(function () {
            $('.copy-id-btn').click(function () {
                const id = $(this).data('id');
                navigator.clipboard.writeText(id)
                    .then(() => {
                        $(".toast-body").text('ID berhasil disalin ke clipboard');
                        $("#toastNotification").toast({ autohide: true, delay: 3000 }).toast("show");
                    })
                    .catch(() => {
                        $(".toast-body").text('Gagal menyalin ID');
                        $("#toastNotification").toast({ autohide: true, delay: 3000 }).toast("show");
                    });
            });
        });

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
