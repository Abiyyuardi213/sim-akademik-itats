@extends('layouts.admin')

@section('title', 'Detail Data Legalisir')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Legalisir</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap riwayat legalisir dokumen mahasiswa.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.legalisir.index') }}" class="hover:text-zinc-900 transition-colors">Legalisir</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                <i class="fas fa-file-contract text-zinc-400"></i> Data Dokumen
            </h3>
            <span
                class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                Total Dokumen: {{ $legalisir->jumlah_total }}
            </span>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <!-- Info Mahasiswa -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Identitas Mahasiswa</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nama</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900 flex items-center gap-2">
                            <div
                                class="h-6 w-6 rounded-full bg-zinc-100 flex items-center justify-center text-xs text-zinc-500">
                                <i class="fas fa-user"></i>
                            </div>
                            {{ $legalisir->nama }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">NPM</dt>
                        <dd class="mt-1 text-base font-mono text-zinc-700">
                            {{ $legalisir->npm }}
                        </dd>
                    </div>
                </div>

                <!-- Info Legalisir -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Detail Surat</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nomor Legalisir</dt>
                        <dd class="mt-1 text-base font-bold text-zinc-900">
                            {{ $legalisir->no_legalisir }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Tanggal</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900">
                            {{ \Carbon\Carbon::parse($legalisir->tanggal)->translatedFormat('d F Y') }}
                        </dd>
                    </div>
                </div>

                <!-- Rincian Jumlah -->
                <div class="md:col-span-2 border-t border-zinc-100 pt-4 mt-2">
                    <h4 class="text-sm font-medium text-zinc-900 mb-4">Rincian Dokumen</h4>

                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-zinc-50 p-3 rounded-lg border border-zinc-100 text-center">
                            <span class="block text-xs text-zinc-500">Ijazah</span>
                            <span class="block text-lg font-bold text-zinc-900">{{ $legalisir->jumlah_ijazah }}</span>
                        </div>
                        <div class="bg-zinc-50 p-3 rounded-lg border border-zinc-100 text-center">
                            <span class="block text-xs text-zinc-500">Transkrip</span>
                            <span class="block text-lg font-bold text-zinc-900">{{ $legalisir->jumlah_transkip }}</span>
                        </div>
                        <div class="bg-zinc-50 p-3 rounded-lg border border-zinc-100 text-center">
                            <span class="block text-xs text-zinc-500">Lain-lain</span>
                            <span class="block text-lg font-bold text-zinc-900">{{ $legalisir->jumlah_lain }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-zinc-50 px-6 py-4 flex justify-end gap-3 border-t border-zinc-100">
            <a href="{{ route('admin.legalisir.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('admin.legalisir.edit', $legalisir->id) }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-pencil-alt mr-2"></i> Edit Data
            </a>
        </div>
    </div>
@endsection
