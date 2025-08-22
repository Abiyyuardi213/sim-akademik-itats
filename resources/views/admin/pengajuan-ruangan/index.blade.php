<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Permohonan Peminjaman</title>
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
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permohonan Peminjaman Ruangan</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Permohonan</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pengajuanTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Prodi</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pengajuans as $index => $pengajuan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $pengajuan->prodi->nama_prodi ?? '-' }}</td>
                                        <td>{{ $pengajuan->kelas->nama_kelas ?? '-' }}</td>
                                        <td>{{ $pengajuan->tanggal_peminjaman }}</td>
                                        <td>{{ $pengajuan->tanggal_berakhir_peminjaman }}</td>
                                        <td>{{ $pengajuan->waktu_peminjaman }} - {{ $pengajuan->waktu_berakhir_peminjaman }}</td>
                                        <td>
                                            @if($pengajuan->status == 'pending')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($pengajuan->status == 'disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif($pengajuan->status == 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pengajuan-ruangan.show', $pengajuan->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($pengajuan->status == 'pending')
                                                <form action="{{ route('admin.pengajuan-ruangan.approve', $pengajuan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.pengajuan-ruangan.reject', $pengajuan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
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
        $("#pengajuanTable").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
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
