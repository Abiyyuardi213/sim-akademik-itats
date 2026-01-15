<nav
    class="sticky top-0 z-50 w-full border-b border-zinc-200 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60">
    <div class="container mx-auto px-4 md:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <!-- Logo -->
            <!-- Logo -->
            <a class="flex items-center gap-3 mr-6"
                href="{{ Auth::guard('users')->check() ? url('dashboard-user') : url('home') }}">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="h-10 w-auto">
                <span class="hidden md:block h-6 w-px bg-zinc-200"></span>
                <span class="hidden md:block text-sm font-bold tracking-wide text-zinc-600 uppercase">
                    Peminjaman Ruangan
                </span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-6">
                <!-- Beranda -->
                <a class="text-sm font-medium transition-colors hover:text-zinc-900 {{ Request::is('dashboard-user') || Request::is('home') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ Auth::guard('users')->check() ? url('dashboard-user') : url('home') }}">
                    Beranda
                </a>

                <!-- Menu Dropdown -->
                <div class="relative group">
                    <button
                        class="flex items-center gap-1 text-sm font-medium text-zinc-600 hover:text-zinc-900 focus:outline-none"
                        id="menu-dropdown-btn">
                        Menu
                        <svg class="h-4 w-4 transition-transform group-hover:rotate-180 text-zinc-400 group-hover:text-zinc-900"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute right-0 top-full pt-2 w-56 hidden group-hover:block z-50">
                        <div class="rounded-lg bg-white shadow-lg border border-zinc-200 p-1">
                            <a href="{{ route('users.pengajuan.index') }}"
                                class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 rounded-md transition-colors">
                                <i class="fas fa-door-open w-4 text-center"></i> Daftar Ruangan
                            </a>
                            <a href="{{ route('users.pengajuan.riwayat') }}"
                                class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 rounded-md transition-colors">
                                <i class="fas fa-file-alt w-4 text-center"></i> Riwayat Pengajuan
                            </a>
                            <a href="{{ route('users.pengajuan.status') }}"
                                class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 rounded-md transition-colors">
                                <i class="fas fa-clock w-4 text-center"></i> Status Pengajuan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Pengumuman -->
                <a class="text-sm font-medium transition-colors hover:text-zinc-900 {{ Request::is('pengumuman*') ? 'text-zinc-900 font-semibold' : 'text-zinc-600' }}"
                    href="{{ route('pengumuman.index') }}">
                    Pengumuman
                </a>

                <!-- Separator -->
                <div class="h-6 w-px bg-zinc-200"></div>

                <!-- Notifications -->
                <div class="relative group">
                    <button class="relative p-1 text-zinc-500 hover:text-zinc-900 focus:outline-none">
                        <i class="fas fa-bell text-lg"></i>
                        @if (Auth::guard('users')->check() &&
                                Auth::guard('users')->user()->unreadNotifications &&
                                Auth::guard('users')->user()->unreadNotifications->count())
                            <span
                                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                        @endif
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-80 origin-top-right rounded-lg bg-white shadow-lg border border-zinc-200 hidden group-hover:block transition-all duration-200 z-50">
                        <div
                            class="py-2 px-4 text-xs font-semibold text-zinc-500 uppercase tracking-wider bg-zinc-50/50 border-b border-zinc-100 rounded-t-lg">
                            Notifikasi
                        </div>
                        <div class="py-1 max-h-64 overflow-y-auto">
                            @php
                                $user = Auth::guard('users')->user();
                                $notifications = $user ? $user->unreadNotifications : [];
                            @endphp
                            @forelse($notifications as $notification)
                                <a href="{{ route('notifications.go', $notification->id) }}"
                                    class="block px-4 py-3 text-sm text-zinc-700 hover:bg-zinc-50 border-b border-zinc-100 last:border-0">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 text-blue-500 mt-0.5"><i
                                                class="fas fa-info-circle"></i></div>
                                        <div>
                                            <p class="font-medium text-zinc-900">
                                                {{ $notification->data['message'] ?? 'Notifikasi Baru' }}</p>
                                            <p class="text-xs text-zinc-500 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-3 text-sm text-zinc-500 text-center">Tidak ada notifikasi</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Profile Dropdown -->
                @if (Auth::guard('users')->check())
                    <div class="relative group">
                        <button class="flex items-center gap-2 focus:outline-none">
                            <div
                                class="h-8 w-8 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-600">
                                <span
                                    class="font-semibold text-xs">{{ substr(Auth::guard('users')->user()->username, 0, 2) }}</span>
                            </div>
                            <span class="text-sm font-medium text-zinc-700 group-hover:text-zinc-900 transition-colors">
                                {{ Auth::guard('users')->user()->username }}
                            </span>
                            <svg class="h-4 w-4 text-zinc-400 transition-transform group-hover:rotate-180"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute right-0 top-full pt-2 w-48 hidden group-hover:block z-50">
                            <div class="rounded-lg bg-white shadow-lg border border-zinc-200 p-1">
                                <a href="{{ route('users.profile.edit') }}"
                                    class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 rounded-md transition-colors">
                                    <i class="fas fa-user-circle w-4 text-center"></i> Profil Pengguna
                                </a>
                                <div class="h-px bg-zinc-100 my-1"></div>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#logoutModal"
                                    class="w-full text-left flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                    <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login.guest') }}"
                        class="text-sm font-medium text-zinc-900 hover:text-zinc-700">Login</a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn"
                class="inline-flex items-center justify-center rounded-md p-2 text-zinc-700 hover:bg-zinc-100 focus:outline-none md:hidden">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                    <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="hidden border-t border-zinc-200 bg-white md:hidden">
        <div class="space-y-1 p-4">
            @if (Auth::guard('users')->check())
                <div class="px-3 py-3 border-b border-zinc-100 mb-2">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-9 w-9 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-600">
                            <span
                                class="font-semibold text-sm">{{ substr(Auth::guard('users')->user()->username, 0, 2) }}</span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-zinc-900">{{ Auth::guard('users')->user()->username }}
                            </p>
                            <a href="{{ route('users.profile.edit') }}"
                                class="text-xs text-zinc-500 hover:text-zinc-900 hover:underline">Edit Profil</a>
                        </div>
                    </div>
                </div>
            @endif

            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 {{ Request::is('dashboard-user') || Request::is('home') ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600' }}"
                href="{{ Auth::guard('users')->check() ? url('dashboard-user') : url('home') }}">
                Beranda
            </a>

            @if (Auth::guard('users')->check())
                <div class="space-y-1 pl-3 border-l-2 border-zinc-100 ml-3 py-1">
                    <a href="{{ route('users.pengajuan.index') }}"
                        class="block rounded-md px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50">
                        Daftar Ruangan
                    </a>
                    <a href="{{ route('users.pengajuan.riwayat') }}"
                        class="block rounded-md px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50">
                        Riwayat Pengajuan
                    </a>
                    <a href="{{ route('users.pengajuan.status') }}"
                        class="block rounded-md px-3 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50">
                        Status Pengajuan
                    </a>
                </div>
            @endif

            <a class="block rounded-md px-3 py-2 text-sm font-medium hover:bg-zinc-100 {{ Request::is('pengumuman*') ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600' }}"
                href="{{ route('pengumuman.index') }}">
                Pengumuman
            </a>

            <div class="mt-4 pt-4 border-t border-zinc-100">
                @if (Auth::guard('users')->check())
                    <a href="#logout" data-bs-toggle="modal" data-bs-target="#logoutModal"
                        class="block rounded-md px-3 py-2 text-center text-sm font-medium text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 transition-colors">
                        Logout
                    </a>
                @else
                    <a href="{{ route('login.guest') }}"
                        class="block rounded-md px-3 py-2 text-center text-sm font-medium text-zinc-900 hover:bg-zinc-100 border border-zinc-200 transition-colors">
                        Login
                    </a>
                @endif
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
