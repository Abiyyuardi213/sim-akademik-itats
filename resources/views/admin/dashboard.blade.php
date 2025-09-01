<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .fc-daygrid-day-number {
            color: white !important;
        }
        .fc-daygrid-day {
            border: none !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('include.navbarSistem')
    @include('include.sidebar')

    {{-- @php
        if (Auth::guard('admin')->check()) {
            dd(Auth::guard('admin')->user());
        }

        if (Auth::guard('users')->check()) {
            dd(Auth::guard('users')->user());
        }
    @endphp --}}

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- @can('akses-admin-dosen') --}}
                    @php
                        $currentUser = Auth::guard('admin')->check()
                            ? Auth::guard('admin')->user()
                            : Auth::guard('users')->user();
                    @endphp

                    @if($currentUser->role->role_name !== 'CSR')
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalPeran ?? 0 }}</h3>
                                <p>Total Peran</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <a href="{{ route('admin.role.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalPengguna ?? 0 }}</h3>
                                <p>Total Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning text-white">
                            <div class="inner">
                                <h3>{{ $totalDivisi ?? 0 }}</h3>
                                <p>Program Studi</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <a href="{{ route('admin.prodi.index') }}" class="small-box-footer text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    {{-- @endcan --}}

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>Cuti</h3>
                                <p>Periode & Manajemen Cuti</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <a href="{{ route('admin.mahasiswa-cuti.dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>Fasilitas</h3>
                                <p>Fasilitas & Peminjaman</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <a href="{{ route('admin.fasilitas.dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalLegalisir ?? 0 }}</h3>
                                <p>Manajemen Legalisir</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-signature"></i>
                            </div>
                            <a href="{{ route('admin.legalisir.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script src="{{ asset('resources/js/ToastScript.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id'
            });
            calendar.render();
        }
    });

    $(document).ready(function () {
        $('[data-widget="treeview"]').each(function () {
            AdminLTE.Treeview._jQueryInterface.call($(this));
        });
    });
</script>
</body>
</html>
