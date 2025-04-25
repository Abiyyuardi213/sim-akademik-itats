<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
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
        <!-- Sidebar user -->
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

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- @if (session('role_name') === 'Admin') --}}
                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Peran Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pengguna') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
                {{-- @endif --}}

                <li class="nav-item">
                    <a href="{{ url('divisi') }}" class="nav-link">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>Praktikum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('anggota') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Anggota</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('proker') }}" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Proker</p>
                    </a>
                </li>

                @php
                    $isKeuangan = request()->is('keuangan*');
                @endphp
                <li class="nav-item has-treeview {{ $isKeuangan ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isKeuangan ? 'active' : '' }}">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Keuangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ $isKeuangan ? 'display: block;' : '' }}">
                        <li class="nav-item">
                            <a href="{{ url('keuangan/dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard Keuangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('keuangan/pemasukkan') }}" class="nav-link">
                                <i class="fas fa-arrow-down nav-icon text-success"></i>
                                <p>Pemasukan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('keuangan/pengeluaran') }}" class="nav-link">
                                <i class="fas fa-arrow-up nav-icon text-danger"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('keuangan/list') }}" class="nav-link">
                                <i class="fas fa-money-bill-wave nav-icon text-success"></i>
                                <p>List Keuangan</p>
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
