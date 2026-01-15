@extends('layouts.admin')

@section('title', 'Detail Periode')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Periode</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap tentang periode cuti akademik.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.periode.index') }}" class="hover:text-zinc-900 transition-colors">Periode Cuti</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <div class="max-w-3xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                <i class="fas fa-calendar-alt text-zinc-500"></i> Informasi Periode
            </h3>
            @if ($periode->periode_status)
                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    STATUS AKTIF
                </span>
            @else
                <span
                    class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                    NONAKTIF
                </span>
            @endif
        </div>

        <div class="p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-zinc-500">ID Periode</dt>
                    <dd
                        class="mt-1 text-sm text-zinc-900 font-mono bg-zinc-50 p-2 rounded border border-zinc-100 inline-block">
                        {{ $periode->id }}
                    </dd>
                </div>

                <div class="sm:col-span-2 border-b border-zinc-100 pb-4">
                    <dt class="text-sm font-medium text-zinc-500">Nama Periode</dt>
                    <dd class="mt-1 text-lg font-semibold text-zinc-900">{{ $periode->nama_periode }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-zinc-500">Awal Cuti</dt>
                    <dd class="mt-1 text-sm font-medium text-zinc-900">
                        {{ \Carbon\Carbon::parse($periode->awal_cuti)->translatedFormat('F Y') }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-zinc-500">Akhir Cuti</dt>
                    <dd class="mt-1 text-sm font-medium text-zinc-900">
                        {{ \Carbon\Carbon::parse($periode->akhir_cuti)->translatedFormat('F Y') }}
                    </dd>
                </div>

                <div class="sm:col-span-2 pt-2">
                    <dt class="text-sm font-medium text-zinc-500">Bulan Pelaksanaan HER</dt>
                    <dd class="mt-1 text-sm font-medium text-zinc-900 flex items-center gap-2">
                        <i class="fas fa-info-circle text-blue-500"></i>
                        {{ \Carbon\Carbon::parse($periode->bulan_her)->translatedFormat('F Y') }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-zinc-50 px-6 py-4 flex justify-end gap-3 border-t border-zinc-100">
            <a href="{{ route('admin.periode.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('admin.periode.edit', $periode->id) }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-pencil-alt mr-2"></i> Edit Data
            </a>
        </div>
    </div>
@endsection
