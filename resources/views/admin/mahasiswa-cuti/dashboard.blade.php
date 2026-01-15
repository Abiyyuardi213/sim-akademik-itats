@extends('layouts.admin')

@section('title', 'Dashboard Cuti')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Dashboard Cuti</h1>
            <p class="mt-1 text-sm text-zinc-500">Ringkasan data periode dan mahasiswa cuti akademik.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Dashboard Cuti</span>
        </nav>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Total Periode Cuti -->
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Total Periode Cuti</p>
                    <h4 class="text-3xl font-bold text-zinc-900 mt-2">{{ $totalPeriode ?? 0 }}</h4>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-zinc-50">
                <a href="{{ route('admin.periode.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
                    Lebih Detail <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>

        <!-- Total Mahasiswa Cuti -->
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-zinc-500">Total Mahasiswa Cuti</p>
                    <h4 class="text-3xl font-bold text-zinc-900 mt-2">{{ $totalMahasiswaCuti ?? 0 }}</h4>
                </div>
                <div class="h-12 w-12 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                    <i class="fas fa-user-clock text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-zinc-50">
                <a href="{{ route('admin.mahasiswa-cuti.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 group">
                    Lebih Detail <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
