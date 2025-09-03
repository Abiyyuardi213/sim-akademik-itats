<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Fasilitas Support</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        .toggle-status {
            width: 50px;
            height: 24px;
            appearance: none;
            background: #ddd;
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-status:checked {
            background: linear-gradient(90deg, #28a745, #2ecc71);
        }

        .toggle-status::before {
            content: "❌";
            position: absolute;
            top: 3px;
            left: 4px;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
            text-align: center;
            font-size: 12px;
            line-height: 18px;
        }

        .toggle-status:checked::before {
            content: "✔️";
            transform: translateX(26px);
            color: #28a745;
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
                            <h1 class="m-0">Manajemen Ruang Support</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Daftar Ruang Support</h3>
                            <a href="{{ route('admin.fasilitas-support.create') }}" class="btn btn-primary btn-sm ml-auto">
                                <i class="fas fa-plus"></i> Tambah Data Ruang Support
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="GET" action="{{ route('admin.fasilitas-support.index') }}" class="form-inline mb-3">
                                    <label for="filter_gedung" class="mr-2">Filter Gedung:</label>
                                    <select name="gedung_id" id="filter_gedung" class="form-control mr-2">
                                        <option value="">-- Semua Gedung --</option>
                                        @foreach ($gedungs as $gedung)
                                            <option value="{{ $gedung->id }}" {{ request('gedung_id') == $gedung->id ? 'selected' : '' }}>
                                                {{ $gedung->nama_gedung }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-secondary">Terapkan</button>
                                </form>
                                <table id="fasilitasTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Fasilitas</th>
                                            <th>Gedung</th>
                                            <th>Kapasitas</th>
                                            <th>Keterangan</th>
                                            <th>Status Fasilitas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fasilitass as $index => $fasilitas)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $fasilitas->nama_fasilitas }}</td>
                                                <td>{{ $fasilitas->gedung->nama_gedung ?? '-' }}</td>
                                                <td>{{ $fasilitas->kapasitas }}</td>
                                                <td>{{ $fasilitas->keterangan }}</td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="toggle-status"
                                                        data-fasilitas-id="{{ $fasilitas->id }}"
                                                        {{ $fasilitas->fasilitas_status ? 'checked' : '' }}>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.fasilitas-support.show', $fasilitas->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('admin.fasilitas-support.edit', $fasilitas->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete-fasilitas-btn"
                                                        data-toggle="modal"
                                                        data-target="#deleteFasilitasModal"
                                                        data-fasilitas-id="{{ $fasilitas->id }}">
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
    <div class="modal fade" id="deleteFasilitasModal" tabindex="-1" aria-labelledby="deleteFasilitasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteFasilitasModalLabel"><i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus fasilitas ini? Tindakan ini tidak dapat dibatalkan.
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
            $("#fasilitasTable").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "stateSave": true
            });
        });

        $(document).ready(function () {
            $('.delete-fasilitas-btn').click(function () {
                let fasilitasId = $(this).data('fasilitas-id');
                let deleteUrl = "{{ url('fasilitas-support') }}/" + fasilitasId;
                $('#deleteForm').attr('action', deleteUrl);
            });
        });

        $(document).ready(function () {
            $(".toggle-status").change(function () {
                let fasilitasId = $(this).data("fasilitas-id");
                let status = $(this).prop("checked") ? 1 : 0;

                $.post("{{ url('admin/fasilitas-support') }}/" + fasilitasId + "/toggle-status", {
                    _token: '{{ csrf_token() }}',
                    fasilitas_status: status
                }, function(res) {
                    if(res.success){
                        $(".toast-body").text(res.message);
                        $("#toastNotification").toast({ autohide: true, delay: 3000 }).toast("show");
                    } else {
                        alert("Gagal memperbarui status.");
                    }
                }).fail(function () {
                    alert("Terjadi kesalahan dalam mengubah status.");
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
