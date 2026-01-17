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
        <div class="relative group">
            @php
                $notifUser = Auth::guard('admin')->user() ?? Auth::guard('users')->user();
                $unreadCount = $notifUser ? $notifUser->unreadNotifications->count() : 0;
            @endphp
            <button class="relative p-2 text-zinc-400 hover:text-zinc-900 transition-colors focus:outline-none">
                <i class="fas fa-bell text-lg"></i>
                @if ($unreadCount > 0)
                    <span class="absolute top-1.5 right-2 flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span
                            class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border border-white"></span>
                    </span>
                @endif
            </button>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 top-full pt-2 w-80 hidden group-hover:block z-50">
                <div class="bg-white rounded-lg shadow-lg border border-zinc-200 overflow-hidden">
                    <div class="px-4 py-3 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
                        <p class="text-xs font-semibold text-zinc-500 uppercase tracking-wider">Notifikasi
                            ({{ $unreadCount }})</p>
                        @if ($unreadCount > 0)
                            <form action="{{ route('notifications.readAll') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-xs text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                    Tandai dibaca
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="max-h-[350px] overflow-y-auto">
                        @if ($notifUser)
                            @forelse($notifUser->unreadNotifications as $notification)
                                <a href="{{ route('notifications.go', $notification->id) }}"
                                    class="block px-4 py-3 hover:bg-zinc-50 transition-colors border-b border-zinc-50 last:border-0 relative">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 mt-1">
                                            <div
                                                class="h-8 w-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                                <i class="fas fa-info text-xs"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-zinc-900 mb-0.5">
                                                {{ $notification->data['title'] ?? 'Pemberitahuan' }}
                                            </p>
                                            <p class="text-xs text-zinc-600 leading-relaxed line-clamp-2">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                            <p class="text-[10px] text-zinc-400 mt-1.5">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 h-2 w-2 rounded-full bg-blue-500"></div>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center">
                                    <div
                                        class="h-10 w-10 bg-zinc-50 rounded-full flex items-center justify-center mx-auto mb-3 text-zinc-400">
                                        <i class="far fa-bell-slash"></i>
                                    </div>
                                    <p class="text-sm text-zinc-500 font-medium">Tidak ada notifikasi baru</p>
                                </div>
                            @endforelse
                        @endif
                    </div>

                    <div class="bg-zinc-50 p-2 text-center border-t border-zinc-100">
                        <a href="{{ route('notifications.index') }}"
                            class="text-xs text-zinc-500 hover:text-zinc-900 font-medium block w-full py-1">Lihat
                            Semua Notifikasi</a>
                    </div>
                </div>
            </div>
        </div>

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
