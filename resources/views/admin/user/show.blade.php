@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.user.index') }}" class="hover:text-blue-600">Manajemen Pengguna</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium">Detail Pengguna</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Informasi Pengguna</h1>
        <p class="mt-1 text-sm text-gray-600">Detail lengkap data akun pengguna.</p>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <!-- Cover/Header Background -->
        <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600 relative">
            <!-- Back Button -->
            <a href="{{ route('admin.user.index') }}"
                class="absolute top-4 left-4 inline-flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg backdrop-blur-sm transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="px-8 pb-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Avatar Section (overlapping header) -->
                <div class="-mt-16 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full border-4 border-white bg-white shadow-md overflow-hidden relative">
                        <img src="{{ $user->profile_picture ? asset('uploads/profile/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=EBF4FF&color=3B82F6' }}"
                            class="w-full h-full object-cover" alt="{{ $user->name }}">
                    </div>
                    <h2 class="mt-4 text-xl font-bold text-gray-900 text-center">{{ $user->name }}</h2>
                    <span
                        class="mt-1 px-3 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-full uppercase tracking-wide">
                        {{ $user->role->role_name ?? 'User' }}
                    </span>
                </div>

                <!-- Details Section -->
                <div class="flex-1 pt-4 md:pt-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Info Item -->
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                            <span
                                class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-1">Username</span>
                            <div class="flex items-center gap-2 text-gray-900 font-medium">
                                <i class="fas fa-user-circle text-gray-400"></i>
                                {{ $user->username }}
                            </div>
                        </div>

                        <!-- Info Item -->
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-1">Email</span>
                            <div class="flex items-center gap-2 text-gray-900 font-medium">
                                <i class="fas fa-envelope text-gray-400"></i>
                                {{ $user->email }}
                            </div>
                        </div>

                        <!-- Info Item -->
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-1">No.
                                Telepon</span>
                            <div class="flex items-center gap-2 text-gray-900 font-medium">
                                <i class="fas fa-phone text-gray-400"></i>
                                {{ $user->no_telepon ?? '-' }}
                            </div>
                        </div>

                        <!-- Info Item -->
                        <div class="p-4 rounded-lg bg-gray-50 border border-gray-100">
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block mb-1">ID
                                Pengguna</span>
                            <div class="flex items-center gap-2 text-gray-900 font-medium">
                                <i class="fas fa-fingerprint text-gray-400"></i>
                                #{{ $user->id }}
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8 flex gap-3">
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/30">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
