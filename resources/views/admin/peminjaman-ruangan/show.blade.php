@extends('layouts.admin')

@section('title', 'Detail Peminjaman')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Peminjaman Ruangan</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap tentang jadwal peminjaman.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.peminjaman-ruangan.index') }}"
                class="hover:text-zinc-900 transition-colors">Peminjaman</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                <i class="fas fa-calendar-week text-zinc-500"></i> Informasi Peminjaman
            </h3>
            @php
                $today = \Carbon\Carbon::today();
                $start = \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman);
                $end = \Carbon\Carbon::parse($peminjaman->tanggal_berakhir_peminjaman);
            @endphp

            @if ($today->lt($start))
                <span
                    class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                    AKAN DATANG
                </span>
            @elseif ($today->gt($end))
                <span
                    class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                    SELESAI
                </span>
            @else
                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    SEDANG BERLANGSUNG
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Waktu -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Jadwal Penggunaan</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Tanggal</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900">
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->translatedFormat('d F Y') }}
                            <span class="text-zinc-400 mx-2">-</span>
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_berakhir_peminjaman)->translatedFormat('d F Y') }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Jam</dt>
                        <dd class="mt-1 text-base font-mono text-zinc-700">
                            {{ $peminjaman->waktu_peminjaman }} WIB - {{ $peminjaman->waktu_berakhir_peminjaman }} WIB
                        </dd>
                    </div>
                </div>

                <!-- Detail -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Peminjam & Ruangan</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Penanggung Jawab / Prodi</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900">
                            {{ $peminjaman->prodi ? $peminjaman->prodi->nama_prodi : '-' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Ruangan</dt>
                        <dd class="mt-1 text-base font-bold text-zinc-900 flex items-center gap-2">
                            <i class="fas fa-door-open text-zinc-400 text-sm"></i>
                            {{ $peminjaman->kelas ? $peminjaman->kelas->nama_kelas : '-' }}
                        </dd>
                    </div>
                </div>

                <!-- Keperluan Full Width -->
                <div class="md:col-span-2 border-t border-zinc-100 pt-4">
                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Keperluan</dt>
                    <dd
                        class="mt-2 text-sm text-zinc-700 bg-zinc-50 p-4 rounded-md border border-zinc-100 border-l-4 border-l-zinc-300 italic">
                        "{{ $peminjaman->keperluan_peminjaman }}"
                    </dd>
                </div>
            </div>
        </div>

        <div class="bg-zinc-50 px-6 py-4 flex justify-end gap-3 border-t border-zinc-100">
            <a href="{{ route('admin.peminjaman-ruangan.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('admin.peminjaman-ruangan.edit', $peminjaman->id) }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-pencil-alt mr-2"></i> Edit Data
            </a>
        </div>
    </div>
@endsection
