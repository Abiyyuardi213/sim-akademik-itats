@extends('layouts.admin')

@section('title', 'Detail Mahasiswa Cuti')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Mahasiswa Cuti</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap data cuti mahasiswa.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.mahasiswa-cuti.index') }}" class="hover:text-zinc-900 transition-colors">Mahasiswa
                Cuti</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                <i class="fas fa-user-clock text-zinc-500"></i> Informasi Data Cuti
            </h3>
            @if ($mahasiswa->surat_status)
                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    STATUS AKTIF
                </span>
            @else
                <span
                    class="inline-flex items-center rounded-full bg-zinc-100 px-2.5 py-0.5 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                    TIDAK AKTIF
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Data Mahasiswa -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Informasi Mahasiswa</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nama Mahasiswa</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900">{{ $mahasiswa->nama_mahasiswa }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">NPM</dt>
                        <dd class="mt-1 text-base font-mono text-zinc-700">{{ $mahasiswa->npm }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Program Studi</dt>
                        <dd class="mt-1 text-sm text-zinc-700">{{ $mahasiswa->prodi ? $mahasiswa->prodi->nama_prodi : '-' }}
                        </dd>
                    </div>
                </div>

                <!-- Detail Cuti -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Detail Cuti</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nomor Surat Cuti</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $mahasiswa->nomor_cuti }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Periode Cuti</dt>
                        <dd
                            class="mt-1 text-sm inline-flex items-center rounded-md bg-blue-50 px-2 py-1 font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                            {{ $mahasiswa->periode ? $mahasiswa->periode->nama_periode : '-' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Data Dibuat Pada</dt>
                        <dd class="mt-1 text-sm text-zinc-500">{{ $mahasiswa->created_at->translatedFormat('d F Y, H:i') }}
                        </dd>
                    </div>
                </div>

                <!-- Keterangan Full Width -->
                <div class="md:col-span-2 border-t border-zinc-100 pt-4">
                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Keterangan</dt>
                    <dd class="mt-2 text-sm text-zinc-700 bg-zinc-50 p-4 rounded-md border border-zinc-100 italic">
                        "{{ $mahasiswa->keterangan ?: 'Tidak ada keterangan tambahan.' }}"
                    </dd>
                </div>
            </div>
        </div>

        <div class="bg-zinc-50 px-6 py-4 flex justify-end gap-3 border-t border-zinc-100">
            <a href="{{ route('admin.mahasiswa-cuti.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <a href="{{ route('admin.mahasiswa-cuti.edit', $mahasiswa->id) }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                <i class="fas fa-pencil-alt mr-2"></i> Edit Data
            </a>
        </div>
    </div>
@endsection
