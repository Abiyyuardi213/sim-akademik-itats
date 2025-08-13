<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#beranda">
            <img src="{{ asset('image/itats-biru.png') }}" alt="Logo" class="me-2">
            {{-- <span class="fw-bold text-primary">Peminjaman Ruangan</span> --}}
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <!-- Beranda -->
                <li class="nav-item">
                    <a class="nav-link active" href="#beranda">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>

                <!-- Menu Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-th-list me-1"></i>Menu
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#daftar-ruangan">
                                <i class="fas fa-door-open me-2"></i>Daftar Ruangan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#permohonan-peminjaman">
                                <i class="fas fa-file-alt me-2"></i>Permohonan Peminjaman Ruangan
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#status-permohonan">
                                <i class="fas fa-clock me-2"></i>Status Permohonan
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Pengumuman -->
                <li class="nav-item">
                    <a class="nav-link" href="#pengumuman">
                        <i class="fas fa-bullhorn me-1"></i>Pengumuman
                    </a>
                </li>
            </ul>

            <!-- Profile Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->username : Auth::guard('users')->user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#profil-pengguna">
                                <i class="fas fa-user me-2"></i>Profil Pengguna
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="#logout" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    .navbar-brand img {
        height: 30px;
    }
    .navbar {
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .dropdown-item:hover {
        background-color: #007bff;
        color: white;
    }
    .navbar-nav .nav-link {
        font-weight: 500;
        padding: 0.75rem 1rem;
    }
    .navbar-nav .nav-link:hover {
        color: #007bff !important;
    }
    .dropdown-toggle::after {
        margin-left: 0.5rem;
    }
</style>
