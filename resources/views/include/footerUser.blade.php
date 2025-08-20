<footer class="footer-modern">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <div class="footer-logo-section">
                        <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="footer-logo">
                        <div class="footer-brand-text">
                            <h5 class="footer-title">Sistem Peminjaman Ruangan</h5>
                            {{-- <p class="footer-subtitle">Institut Teknologi Adhi Tama Surabaya</p> --}}
                        </div>
                    </div>
                    <p class="footer-description">Solusi digital terpadu untuk mengelola peminjaman ruangan di lingkungan kampus dengan mudah, efisien, dan transparan.</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Menu Utama</h6>
                <ul class="footer-links">
                    <li><a href="#beranda"><i class="fas fa-home me-2"></i>Beranda</a></li>
                    <li><a href="#daftar-ruangan"><i class="fas fa-door-open me-2"></i>Daftar Ruangan</a></li>
                    <li><a href="#permohonan-peminjaman"><i class="fas fa-file-alt me-2"></i>Peminjaman</a></li>
                    <li><a href="#pengumuman"><i class="fas fa-bullhorn me-2"></i>Pengumuman</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Informasi Kontak</h6>
                <ul class="footer-contact">
                    <li>
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <span>itats@itats.ac.id</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Telepon</strong>
                            <span>(031) 5991101</span>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Alamat</strong>
                            <span>Jln Arief Rachman Hakim 100, Surabaya 60117</span>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Ikuti Kami</h6>
                <p class="footer-social-text">Tetap terhubung dengan update terbaru dari ITATS</p>
                <div class="social-links">
                    <a href="#" class="social-link facebook" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link twitter" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link instagram" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link linkedin" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-link youtube" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="footer-copyright">
                    &copy; 2025 <strong>Institut Teknologi Adhi Tama Surabaya</strong>. All rights reserved.
                </p>
            </div>
            <div class="col-md-6">
                <div class="footer-links-bottom">
                    <a href="#privacy">Kebijakan Privasi</a>
                    <a href="#terms">Syarat & Ketentuan</a>
                    <a href="#help">Bantuan</a>
                </div>
            </div>
        </div>
    </div>
</footer>

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

    .footer-modern {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
        color: var(--pure-white);
        padding: 4rem 0 2rem;
        position: relative;
        overflow: hidden;
    }

    .footer-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="footerPattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23footerPattern)"/></svg>');
        opacity: 0.3;
    }

    .footer-modern > .container {
        position: relative;
        z-index: 2;
    }

    .footer-logo-section {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .footer-logo {
        height: 50px;
        width: auto;
        margin-right: 1rem;
        filter: brightness(0) invert(1);
    }

    .footer-brand-text {
        flex: 1;
    }

    .footer-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--pure-white);
    }

    .footer-subtitle {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    .footer-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0;
    }

    .footer-heading {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--pure-white);
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background: var(--accent-blue);
        border-radius: 1px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .footer-links a:hover {
        color: var(--pure-white);
        transform: translateX(5px);
    }

    .footer-links a i {
        width: 20px;
        color: var(--accent-blue);
    }

    .footer-contact {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-contact li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.25rem;
    }

    .footer-contact i {
        width: 20px;
        color: var(--accent-blue);
        margin-right: 1rem;
        margin-top: 0.25rem;
        flex-shrink: 0;
    }

    .footer-contact div {
        flex: 1;
    }

    .footer-contact strong {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--pure-white);
    }

    .footer-contact span {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.4;
    }

    .footer-social-text {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1.5rem;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-link {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--pure-white);
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .social-link:hover {
        transform: translateY(-3px);
        color: var(--pure-white);
    }

    .social-link.facebook:hover { background: #1877f2; }
    .social-link.twitter:hover { background: #1da1f2; }
    .social-link.instagram:hover { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
    .social-link.linkedin:hover { background: #0077b5; }
    .social-link.youtube:hover { background: #ff0000; }

    .footer-divider {
        border: none;
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 3rem 0 2rem;
    }

    .footer-copyright {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        margin: 0;
    }

    .footer-links-bottom {
        display: flex;
        gap: 2rem;
        justify-content: flex-end;
        flex-wrap: wrap;
    }

    .footer-links-bottom a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-links-bottom a:hover {
        color: var(--pure-white);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .footer-modern {
            padding: 3rem 0 1.5rem;
        }

        .footer-logo-section {
            flex-direction: column;
            text-align: center;
            margin-bottom: 2rem;
        }

        .footer-logo {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .footer-links-bottom {
            justify-content: center;
            margin-top: 1rem;
        }

        .social-links {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .footer-links-bottom {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .social-links {
            gap: 0.75rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
        }
    }
</style>
