@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Dashboard</h1>
            <p class="mt-1 text-sm text-zinc-500">Ringkasan aktivitas dan metrik utama sistem akademik.</p>
        </div>
        <!-- Breadcrumb or Actions could go here -->
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $currentUser = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('users')->user();
        @endphp

        @if ($currentUser->role->role_name !== 'CSR')
            <!-- Total Peran -->
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Peran</p>
                        <h4 class="text-2xl font-bold text-zinc-900 mt-1">{{ $totalPeran ?? 0 }}</h4>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600">
                        <i class="fas fa-user-tag"></i>
                    </div>
                </div>
            </div>

            <!-- Total Pengguna -->
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Total Pengguna</p>
                        <h4 class="text-2xl font-bold text-zinc-900 mt-1">{{ $totalPengguna ?? 0 }}</h4>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Program Studi -->
            <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-zinc-500">Program Studi</p>
                        <h4 class="text-2xl font-bold text-zinc-900 mt-1">{{ $totalDivisi ?? 0 }}</h4>
                    </div>
                    <div class="h-10 w-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Access Card 1 (Instead of Gradient) -->
        <a href="{{ route('admin.mahasiswa-cuti.dashboard') }}"
            class="group rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="h-10 w-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-calendar-check text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-zinc-900">Manajemen Cuti</h3>
                    <p class="text-xs text-zinc-500">Periode & Data</p>
                </div>
            </div>
            <div class="text-sm text-zinc-500 line-clamp-2">
                Kelola pengajuan cuti mahasiswa dan periode akademik.
            </div>
        </a>

        <!-- Quick Access Card 2 -->
        <a href="{{ route('admin.fasilitas.dashboard') }}"
            class="group rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="h-10 w-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fas fa-building text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-zinc-900">Fasilitas</h3>
                    <p class="text-xs text-zinc-500">Sarana & Prasarana</p>
                </div>
            </div>
            <div class="text-sm text-zinc-500 line-clamp-2">
                Kelola gedung, kelas, dan peminjaman ruangan.
            </div>
        </a>

        <!-- Quick Access Card 3 -->
        <a href="{{ route('admin.legalisir.index') }}"
            class="group rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <i class="fas fa-file-signature text-lg"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-zinc-900">Legalisir</h3>
                    <p class="text-xs text-zinc-500">Layanan Online</p>
                </div>
            </div>
            <div class="text-sm text-zinc-500 line-clamp-2">
                Verifikasi dan pemrosesan legalisir dokumen.
            </div>
        </a>

    </div>
@endsection
