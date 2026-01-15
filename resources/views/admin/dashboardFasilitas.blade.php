@extends('layouts.admin')

@section('title', 'Dashboard Fasilitas')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Dashboard Fasilitas</h1>
            <p class="mt-1 text-sm text-zinc-500">Ringkasan operasional fasilitas dan sarana prasarana.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Dashboard Fasilitas</span>
        </nav>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Gedung -->
        <a href="{{ route('admin.gedung.index') }}"
            class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Total Gedung</p>
                    <h4 class="text-2xl font-bold text-zinc-900 mt-2">{{ $totalGedung ?? 0 }}</h4>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fas fa-building text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Total Ruang Kelas -->
        <a href="{{ route('admin.kelas.index') }}"
            class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Total Ruang Kelas</p>
                    <h4 class="text-2xl font-bold text-zinc-900 mt-2">{{ $totalKelas ?? 0 }}</h4>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <i class="fas fa-door-open text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Peminjaman Ruangan -->
        <a href="{{ route('admin.peminjaman-ruangan.index') }}"
            class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Peminjaman</p>
                    <h4 class="text-lg font-bold text-zinc-900 mt-2">Jadwal & List</h4>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                    <i class="fas fa-calendar-check text-lg"></i>
                </div>
            </div>
        </a>

        <!-- Permohonan User -->
        <a href="{{ route('admin.pengajuan-ruangan.index') }}"
            class="group relative overflow-hidden rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:border-zinc-300 hover:shadow-md transition-all">
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Permohonan</p>
                    <h4 class="text-lg font-bold text-zinc-900 mt-2">Menunggu Approval</h4>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <i class="fas fa-envelope-open-text text-lg"></i>
                </div>
            </div>
        </a>
    </div>
@endsection
