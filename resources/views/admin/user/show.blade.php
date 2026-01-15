@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Informasi Pengguna</h1>
            <p class="mt-1 text-sm text-zinc-500">Detail lengkap data akun pengguna.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.user.index') }}" class="hover:text-zinc-900 transition-colors">Pengguna</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <!-- Profile Card -->
    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <!-- Banner -->
        <div class="h-32 bg-zinc-900/5 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-zinc-200 to-zinc-100"></div>
            <!-- Back Button -->
            <a href="{{ route('admin.user.index') }}"
                class="absolute top-4 left-4 inline-flex items-center gap-2 px-3 py-1.5 bg-white/60 hover:bg-white/90 text-zinc-700 rounded-md backdrop-blur-md transition-colors text-xs font-medium border border-zinc-200/50 shadow-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="px-8 pb-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Avatar Section -->
                <div class="-mt-12 flex flex-col items-center md:items-start z-10">
                    <div class="h-24 w-24 rounded-2xl border-4 border-white bg-white shadow-md overflow-hidden">
                        <img src="{{ $user->profile_picture ? asset('uploads/profile/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=EBF4FF&color=3B82F6' }}"
                            class="w-full h-full object-cover" alt="{{ $user->name }}">
                    </div>
                </div>

                <!-- Info Section -->
                <div class="flex-1 pt-2 md:pt-4">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-zinc-900">{{ $user->name }}</h2>
                            <p class="text-sm text-zinc-500">{{ $user->email ?? 'Belum ada email' }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span
                                class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-xs font-medium text-zinc-900">
                                {{ $user->role->role_name ?? 'User' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-zinc-100 pt-6">
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Username</dt>
                            <dd class="text-sm font-medium text-zinc-900 flex items-center gap-2">
                                <i class="fas fa-user-circle text-zinc-400"></i>
                                {{ $user->username }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Nomor Telepon</dt>
                            <dd class="text-sm font-medium text-zinc-900 flex items-center gap-2">
                                <i class="fas fa-phone text-zinc-400"></i>
                                {{ $user->no_telepon ?? '-' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">ID Pengguna</dt>
                            <dd class="text-sm font-medium text-zinc-900 flex items-center gap-2">
                                <i class="fas fa-hashtag text-zinc-400"></i>
                                {{ $user->id }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Bergabung Sejak</dt>
                            <dd class="text-sm font-medium text-zinc-900 flex items-center gap-2">
                                <i class="fas fa-calendar text-zinc-400"></i>
                                {{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}
                            </dd>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                            class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                            <i class="fas fa-pencil-alt mr-2"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
