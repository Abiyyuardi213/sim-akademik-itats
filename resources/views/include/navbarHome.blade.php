<nav
    class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="container mx-auto px-4 md:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo area -->
            <a class="flex items-center gap-2 mr-4" href="{{ url('home') }}">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="h-8 w-auto">
                <div class="hidden md:flex flex-col">
                    <span class="text-lg font-bold tracking-tight text-zinc-900 leading-none">SISTEM</span>
                    <span class="text-[10px] uppercase tracking-wider font-medium text-zinc-500">Peminjaman
                        Ruangan</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a class="transition-colors hover:text-zinc-900 {{ Request::is('home') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ url('home') }}">
                    Beranda
                </a>
                <a class="transition-colors hover:text-zinc-900 {{ Request::is('about') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ url('about') }}">
                    Tentang
                </a>
                <a class="transition-colors hover:text-zinc-900 {{ Request::is('fasilitas') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ url('fasilitas') }}">
                    Fasilitas
                </a>
                <a class="transition-colors hover:text-zinc-900 {{ Request::is('pengumuman*') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ url('pengumuman') }}">
                    Pengumuman
                </a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="{{ url('login-guest') }}"
                    class="hidden md:inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50">
                    Login
                </a>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn"
                    class="inline-flex items-center justify-center rounded-md p-2 text-zinc-700 hover:bg-zinc-100 focus:outline-none md:hidden">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden border-t border-zinc-200 bg-white md:hidden">
        <div class="space-y-1 p-4">
            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 {{ Request::is('home') ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600' }}"
                href="{{ url('home') }}">
                Beranda
            </a>
            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 {{ Request::is('about') ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600' }}"
                href="{{ url('about') }}">
                Tentang
            </a>
            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 {{ Request::is('fasilitas') ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600' }}"
                href="{{ url('fasilitas') }}">
                Fasilitas
            </a>
            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 text-zinc-600"
                href="{{ url('pengumuman') }}">
                Pengumuman
            </a>
            <div class="pt-4 mt-2 border-t border-zinc-100">
                <a href="{{ url('login-guest') }}"
                    class="block w-full rounded-md bg-zinc-900 px-3 py-2 text-center text-sm font-medium text-white hover:bg-zinc-900/90 shadow-sm">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');

        if (btn && menu) {
            btn.addEventListener('click', function() {
                menu.classList.toggle('hidden');
                menuIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        }
    });
</script>
