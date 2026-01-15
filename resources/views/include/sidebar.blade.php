<aside
    class="w-64 bg-white border-r border-zinc-200 hidden md:flex flex-col h-full shrink-0 transition-all duration-300 relative z-20">
    <!-- Logo -->
    <div class="h-16 flex items-center gap-2 px-6 border-b border-zinc-200">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
            <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS"
                class="h-8 w-auto object-contain grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all">
            <span class="font-bold text-lg text-zinc-900 tracking-tight">Admin<span
                    class="text-zinc-400">Panel</span></span>
        </a>
    </div>

    <!-- User Info -->
    <div class="p-4 border-b border-zinc-100 bg-zinc-50/50">
        <div class="flex items-center gap-3">
            @php
                $currentUser = Auth::guard('admin')->check()
                    ? Auth::guard('admin')->user()
                    : Auth::guard('users')->user();
            @endphp
            <div class="relative">
                <img src="{{ asset('uploads/profile/' . ($currentUser->profile_picture ?? 'default.png')) }}"
                    class="w-9 h-9 rounded-full object-cover border border-zinc-200 shadow-sm" alt="User Image">
            </div>
            <div class="overflow-hidden">
                <h6 class="text-sm font-semibold text-zinc-900 truncate">{{ $currentUser->username }}</h6>
                <p class="text-xs text-zinc-500 font-medium truncate">
                    {{ $currentUser->role->role_name ?? 'Administrator' }}</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-100 text-zinc-900 shadow-sm' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
            <i class="fas fa-home w-4 text-center"></i>
            <span>Dashboard</span>
        </a>

        @if ($currentUser->role->role_name !== 'CSR')
            <div class="pt-6 pb-2 px-3">
                <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Master Data</p>
            </div>

            <a href="{{ route('admin.role.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.role.*') ? 'bg-zinc-100 text-zinc-900 shadow-sm' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                <i class="fas fa-user-shield w-4 text-center"></i>
                <span>Peran Pengguna</span>
            </a>

            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.user.*') ? 'bg-zinc-100 text-zinc-900 shadow-sm' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                <i class="fas fa-users-cog w-4 text-center"></i>
                <span>Pengguna</span>
            </a>

            <a href="{{ route('admin.prodi.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.prodi.*') ? 'bg-zinc-100 text-zinc-900 shadow-sm' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                <i class="fas fa-university w-4 text-center"></i>
                <span>Program Studi</span>
            </a>
        @endif

        <!-- Menu Cuti -->
        <div class="pt-6 pb-2 px-3">
            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Manajemen Cuti</p>
        </div>

        @php
            $isCuti = request()->routeIs('admin.periode.*') || request()->routeIs('admin.mahasiswa-cuti.*');
        @endphp
        <div class="space-y-1" id="cuti-menu">
            <button onclick="toggleMenu('cuti-submenu', 'cuti-arrow')"
                class="w-full flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $isCuti ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                <div class="flex items-center gap-3">
                    <i class="fas fa-briefcase w-4 text-center"></i>
                    <span>Cuti Mahasiswa</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-zinc-400 {{ $isCuti ? 'rotate-180' : '' }}"
                    id="cuti-arrow"></i>
            </button>
            <div id="cuti-submenu" class="pl-4 space-y-1 mt-1 {{ $isCuti ? 'block' : 'hidden' }}">
                <a href="{{ route('admin.mahasiswa-cuti.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.mahasiswa-cuti.dashboard') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Dashboard Cuti</span>
                </a>
                <a href="{{ route('admin.periode.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.periode.*') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Periode Cuti</span>
                </a>
                <a href="{{ route('admin.mahasiswa-cuti.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.mahasiswa-cuti.index') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>List Mahasiswa</span>
                </a>
            </div>
        </div>

        <!-- Menu Fasilitas -->
        <div class="pt-6 pb-2 px-3">
            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Fasilitas</p>
        </div>

        @php
            $isFasilitas =
                request()->routeIs('admin.fasilitas.dashboard') ||
                request()->routeIs('admin.gedung.*') ||
                request()->routeIs('admin.kelas.*') ||
                request()->routeIs('admin.peminjaman-ruangan.*') ||
                request()->routeIs('admin.pengajuan-ruangan.*') ||
                request()->routeIs('admin.fasilitas-support.*');
        @endphp
        <div class="space-y-1" id="fasilitas-menu">
            <button onclick="toggleMenu('fasilitas-submenu', 'fasilitas-arrow')"
                class="w-full flex items-center justify-between px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $isFasilitas ? 'text-zinc-900 bg-zinc-50' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
                <div class="flex items-center gap-3">
                    <i class="fas fa-building w-4 text-center"></i>
                    <span>Sarana & Prasarana</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-zinc-400 {{ $isFasilitas ? 'rotate-180' : '' }}"
                    id="fasilitas-arrow"></i>
            </button>
            <div id="fasilitas-submenu" class="pl-4 space-y-1 mt-1 {{ $isFasilitas ? 'block' : 'hidden' }}">
                <a href="{{ route('admin.fasilitas.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.fasilitas.dashboard') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Dashboard Fasilitas</span>
                </a>
                <a href="{{ route('admin.gedung.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.gedung.*') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Gedung</span>
                </a>
                <a href="{{ route('admin.kelas.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.kelas.*') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Ruang Kelas</span>
                </a>
                <a href="{{ route('admin.peminjaman-ruangan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.peminjaman-ruangan.*') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Jadwal Peminjaman</span>
                </a>
                <a href="{{ route('admin.pengajuan-ruangan.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 border-l border-zinc-200 ml-2 {{ request()->routeIs('admin.pengajuan-ruangan.*') ? 'text-zinc-900 font-semibold border-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:border-zinc-400' }}">
                    <span>Permohonan User</span>
                </a>
            </div>
        </div>

        <!-- Lainnya -->
        <div class="pt-6 pb-2 px-3">
            <p class="text-xs font-semibold text-zinc-400 uppercase tracking-wider">Layanan</p>
        </div>

        <a href="{{ route('admin.legalisir.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.legalisir.*') ? 'bg-zinc-100 text-zinc-900 shadow-sm' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900' }}">
            <i class="fas fa-file-signature w-4 text-center"></i>
            <span>Legalisir</span>
        </a>

        <div class="h-10"></div> <!-- Spacer -->
    </nav>
</aside>

<script>
    function toggleMenu(submenuId, arrowId) {
        const submenu = document.getElementById(submenuId);
        const arrow = document.getElementById(arrowId);

        if (submenu.classList.contains('hidden')) {
            submenu.classList.remove('hidden');
            arrow.classList.add('rotate-180');
        } else {
            submenu.classList.add('hidden');
            arrow.classList.remove('rotate-180');
        }
    }
</script>
