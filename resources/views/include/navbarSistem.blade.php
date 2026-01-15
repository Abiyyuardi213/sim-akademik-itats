<header
    class="h-16 bg-white border-b border-zinc-200 flex items-center justify-between px-6 z-10 sticky top-0 backdrop-blur supports-[backdrop-filter]:bg-white/80">
    <!-- Mobile Sidebar Toggle -->
    <button class="md:hidden text-zinc-500 hover:text-zinc-900 focus:outline-none transition-colors">
        <i class="fas fa-bars text-xl"></i>
    </button>

    <!-- Left Side -->
    <div class="hidden md:flex items-center gap-2 text-sm text-zinc-500">
        <span class="font-medium text-zinc-900">{{ date('d F Y') }}</span>
    </div>

    <!-- Right Side -->
    <div class="flex items-center gap-4">
        <!-- Notification -->
        <button class="relative p-2 text-zinc-400 hover:text-zinc-900 transition-colors">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </button>

        <div class="h-6 w-px bg-zinc-200 mx-1"></div>

        <!-- User Dropdown -->
        <div class="relative group">
            <button
                class="flex items-center gap-3 focus:outline-none transition-colors group-hover:bg-zinc-50 p-1.5 rounded-lg -mr-2">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-zinc-900">
                        {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->username : Auth::guard('users')->user()->username }}
                    </p>
                    <p class="text-xs text-zinc-500">Administrator</p>
                </div>
                <div
                    class="h-8 w-8 rounded-full bg-zinc-100 border border-zinc-200 flex items-center justify-center text-zinc-600">
                    <i class="fas fa-user-shield text-sm"></i>
                </div>
                <i
                    class="fas fa-chevron-down text-xs text-zinc-400 group-hover:text-zinc-600 transition-transform duration-200 group-hover:rotate-180 mr-1"></i>
            </button>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 top-full pt-2 w-56 hidden group-hover:block z-50">
                <div class="bg-white rounded-lg shadow-lg border border-zinc-200 py-1 overflow-hidden">
                    <div class="px-3 py-2 border-b border-zinc-100 bg-zinc-50/50">
                        <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wider">Akun Saya</p>
                    </div>
                    <div class="p-1">
                        <a href="{{ url('dashboard-admin') }}"
                            class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 rounded-md hover:bg-zinc-100 hover:text-zinc-900 transition-colors">
                            <i class="fas fa-tachometer-alt w-4 text-center text-zinc-400"></i> Dashboard
                        </a>
                        <a href="{{ Auth::guard('admin')->check() ? route('admin.profile.edit') : route('users.profile.edit') }}"
                            class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 rounded-md hover:bg-zinc-100 hover:text-zinc-900 transition-colors">
                            <i class="fas fa-user-circle w-4 text-center text-zinc-400"></i> Edit Profile
                        </a>
                    </div>
                    <div class="border-t border-zinc-100 my-1"></div>
                    <div class="p-1">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#logoutModal"
                            class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 rounded-md hover:bg-red-50 transition-colors text-left">
                            <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
