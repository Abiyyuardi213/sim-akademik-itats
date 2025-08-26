<!-- Enhanced Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#beranda">
            <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="navbar-logo me-3">
            <div class="brand-text d-none d-md-block">
                <div class="brand-title">ITATS</div>
                <div class="brand-subtitle">Peminjaman Ruangan</div>
            </div>
        </a>

        <!-- Mobile toggle button -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <!-- Beranda -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('home') }}">
                        <i class="fas fa-home me-2"></i>Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('about') }}">
                        <i class="fas fa-info-circle me-2"></i>Tentang
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="{{ url('fasilitas') }}">
                        <i class="fas fa-building me-2"></i>Fasilitas
                    </a>
                </li>

                <!-- Pengumuman -->
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#pengumuman">
                        <i class="fas fa-bullhorn me-2"></i>Pengumuman
                    </a>
                </li>
            </ul>

            <!-- Login Button -->
            <div class="d-flex">
                <a href="{{ url('login-guest') }}" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    :root {
        --primary-blue: #2563eb;
        --secondary-blue: #1e40af;
        --light-blue: #dbeafe;
        --accent-blue: #3b82f6;
        --dark-blue: #1e3a8a;
        --pure-white: #ffffff;
        --light-gray: #f8fafc;
        --border-gray: #e2e8f0;
        --text-gray: #64748b;
        --text-dark: #1e293b;
    }

    .navbar {
        padding: 1rem 0;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95) !important;
        border-bottom: 1px solid var(--border-gray);
    }

    .navbar-logo {
        height: 30px;
        width: auto;
    }

    .brand-text {
        line-height: 1.2;
    }

    .brand-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-blue);
    }

    .brand-subtitle {
        font-size: 0.75rem;
        color: var(--text-gray);
        font-weight: 500;
    }

    .nav-link-custom {
        font-weight: 500;
        padding: 0.75rem 1.25rem !important;
        border-radius: 10px;
        margin: 0 0.25rem;
        transition: all 0.3s ease;
        color: var(--text-dark) !important;
        position: relative;
    }

    .nav-link-custom:hover {
        background: var(--light-blue);
        color: var(--primary-blue) !important;
        transform: translateY(-1px);
    }

    .nav-link-custom.active {
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        color: var(--pure-white) !important;
    }

    .dropdown-menu-custom {
        border: none;
        box-shadow: 0 10px 40px rgba(37, 99, 235, 0.15);
        border-radius: 15px;
        padding: 0.75rem 0;
        margin-top: 0.5rem;
        min-width: 220px;
    }

    .dropdown-item-custom {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 0;
    }

    .dropdown-item-custom:hover {
        background: var(--light-blue);
        color: var(--primary-blue);
        transform: translateX(5px);
    }

    .dropdown-item-custom.text-danger:hover {
        background: #fee2e2;
        color: #dc2626 !important;
    }

    .profile-dropdown {
        display: flex;
        align-items: center;
    }

    .profile-avatar {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, var(--primary-blue), var(--accent-blue));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.875rem;
    }

    .navbar-toggler {
        padding: 0.5rem;
        border-radius: 8px;
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }

    /* Mobile Responsive */
    @media (max-width: 991px) {
        .navbar-nav {
            padding-top: 1rem;
        }

        .nav-link-custom {
            margin: 0.25rem 0;
        }

        .dropdown-menu-custom {
            box-shadow: none;
            border: 1px solid var(--border-gray);
            margin-top: 0;
        }
    }

    @media (max-width: 576px) {
        .navbar {
            padding: 0.75rem 0;
        }

        .navbar-logo {
            height: 35px;
        }

        .brand-title {
            font-size: 1.1rem;
        }

        .brand-subtitle {
            font-size: 0.7rem;
        }
    }
</style>
