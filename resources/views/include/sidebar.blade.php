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
             style="width: 160px; height: 80px; object-fit: contain;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Info -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                @php
                    $currentUser = Auth::guard('admin')->check()
                        ? Auth::guard('admin')->user()
                        : Auth::guard('users')->user();
                @endphp
                <img src="{{ asset('uploads/profile/' . ($currentUser->profile_picture ?? 'default.png')) }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid white;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold">
                    {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->username : Auth::guard('users')->user()->username }}
                </a>
                <span class="badge badge-success">Online</span>
                <span class="d-block" style="color: #f39c12; font-size: 14px; font-weight: 600;">
                    {{ $currentUser->role->role_name ?? 'Unknown' }}
                </span>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('dashboard-admin') }}" class="nav-link {{ request()->is('dashboard-admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Role & User (jika bukan CSR) -->
                @if($currentUser->role->role_name !== 'CSR')
                <li class="nav-item">
                    <a href="{{ route('admin.role.index') }}" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Peran Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('user') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Pengguna</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('prodi') }}" class="nav-link {{ request()->is('prodi*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Program Studi</p>
                    </a>
                </li>
                @endif

                <!-- Menu Cuti -->
                @php
                    $isCuti = request()->is('cuti*') ||
                              request()->is('mahasiswa-cuti*') ||
                              request()->is('periode*');
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
                            <a href="{{ url('mahasiswa-cuti/dashboard') }}" class="nav-link {{ request()->is('mahasiswa-cuti/dashboard') ? 'active' : '' }}">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <p>Dashboard Rekap Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.periode.index') }}" class="nav-link {{ request()->is('periode*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt nav-icon text-success"></i>
                                <p>Periode Cuti</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('mahasiswa-cuti') }}" class="nav-link {{ request()->is('mahasiswa-cuti') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate nav-icon text-info"></i>
                                <p>List Mahasiswa Cuti</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Menu Fasilitas -->
                @php
                    $isFasilitas = request()->is('fasilitas*') ||
                                   request()->is('gedung*') ||
                                   request()->is('kelas*') ||
                                   request()->is('peminjaman-ruangan*') ||
                                   request()->is('pengajuan-ruangan*');
                @endphp
                <li class="nav-item has-treeview {{ $isFasilitas ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isFasilitas ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Fasilitas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isFasilitas ? 'display: block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('fasilitas/dashboard') }}" class="nav-link {{ request()->is('fasilitas/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Dashboard Fasilitas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.gedung.index') }}" class="nav-link {{ request()->is('gedung*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-building text-success"></i>
                                <p>Gedung</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.kelas.index') }}" class="nav-link {{ request()->is('kelas*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chalkboard text-info"></i>
                                <p>Ruang Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.peminjaman-ruangan.index') }}" class="nav-link {{ request()->is('peminjaman-ruangan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-calendar-check text-warning"></i>
                                <p>Peminjaman Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pengajuan-ruangan.index') }}" class="nav-link {{ request()->is('pengajuan-ruangan*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paper-plane text-purple"></i>
                                <p>Permohonan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Legalisir -->
                <li class="nav-item">
                    <a href="{{ url('legalisir') }}" class="nav-link {{ request()->is('legalisir*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Legalisir</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
