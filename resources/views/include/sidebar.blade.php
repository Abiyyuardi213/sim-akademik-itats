<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="#" class="brand-link d-flex justify-content-center align-items-center">
        <img src="{{ asset('image/itats-biru.png') }}"
             alt="Logo ITATS"
             class="brand-image d-none d-md-inline"
             style="width: 170px; height: 90px; object-fit: contain;">
        <img src="{{ asset('image/itats-biru.png') }}"
             alt="Logo Mini ITATS"
             class="brand-image d-inline d-md-none"
             style="width: 40px; height: 40px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('uploads/profile_pictures/' . session('profile_picture', 'default.png')) }}"
                     class="img-circle elevation-2"
                     alt="User Image"
                     style="width: 45px; height: 45px; object-fit: cover; border: 2px solid white;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold">
                    {{ session('nama_user') }}
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    {{ session('role_name', 'Unknown') }}
                </span>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Peran Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengguna') }}" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('prodi') }}" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Program Studi</p>
                    </a>
                </li>

                @php
                    $isCuti = request()->is('cuti*');
                @endphp
                <li class="nav-item has-treeview {{ $isCuti ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isCuti ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Cuti
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isCuti ? 'display: block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('cuti/dashboard') }}" class="nav-link">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <p>Dashboard Rekap Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('periode.index') }}" class="nav-link">
                                <i class="fas fa-calendar-alt nav-icon text-success"></i>
                                <p>Periode Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cuti/manajemen-cuti') }}" class="nav-link">
                                <i class="fas fa-cogs nav-icon text-danger"></i>
                                <p>Manajemen Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('cuti/mahasiswa-cuti') }}" class="nav-link">
                                <i class="fas fa-user-graduate nav-icon text-info"></i>
                                <p>List Mahasiswa Cuti</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('pengumuman') }}" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
