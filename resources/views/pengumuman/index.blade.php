<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Pengumuman</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
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
                            <h1 class="m-0">Manajemen Peminjaman Ruangan</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Peminjaman Ruangan</h3>
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Tambah Data -->
                                <a href="{{ route('peminjaman-ruangan.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Data Peminjaman
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="peminjamanTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Ruangan</th>
                                            <th>Peminjam</th>
                                            <th>Keperluan</th>
                                            <th>Waktu Peminjaman</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($peminjamans as $index => $peminjaman)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                                <td>{{ $peminjaman->kelas->nama_kelas ?? '-' }}</td>
                                                <td>{{ $peminjaman->prodi->nama_prodi ?? '-' }}</td>
                                                <td>{{ $peminjaman->keperluan_peminjaman }}</td>
                                                <td>{{ $peminjaman->waktu_peminjaman }} - {{ $peminjaman->waktu_berakhir_peminjaman }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('peminjaman-ruangan.show', $peminjaman->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('peminjaman-ruangan.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete-peminjaman-btn"
                                                        data-toggle="modal"
                                                        data-target="#deletePeminjamanModal"
                                                        data-peminjaman-id="{{ $peminjaman->id }}">
                                                        <i class="fas fa-trash"></i>
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
    <div class="modal fade" id="deletePeminjamanModal" tabindex="-1" aria-labelledby="deletePeminjamanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deletePeminjamanModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data peminjaman ini?
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
            $("#peminjamanTable").DataTable({
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
            $('.delete-peminjaman-btn').click(function () {
                let peminjamanId = $(this).data('peminjaman-id');
                let deleteUrl = "{{ url('peminjaman-ruangan') }}/" + peminjamanId;
                $('#deleteForm').attr('action', deleteUrl);
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
