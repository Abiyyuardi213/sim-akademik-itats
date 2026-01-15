@extends('layouts.admin')

@section('title', 'Detail Kelas')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Kelas</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap mengenai ruang kelas.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.kelas.index') }}" class="hover:text-zinc-900 transition-colors">Kelas</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
                    <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                        <i class="fas fa-door-open text-zinc-500"></i> Informasi Ruangan
                    </h3>
                    @if ($kelas->kelas_status)
                        <span
                            class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                            SIAP DIGUNAKAN
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                            MAINTENANCE
                        </span>
                    @endif
                </div>

                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nama Kelas</dt>
                            <dd class="mt-1 text-lg font-semibold text-zinc-900">{{ $kelas->nama_kelas }}</dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Gedung</dt>
                            <dd class="mt-1 text-base text-zinc-700 flex items-center gap-2">
                                <i class="far fa-building text-zinc-400"></i>
                                {{ $kelas->gedung->nama_gedung ?? '-' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Kapasitas</dt>
                            <dd class="mt-1 text-base text-zinc-700 flex items-center gap-2">
                                <i class="fas fa-users text-zinc-400 text-sm"></i>
                                {{ $kelas->kapasitas_mahasiswa }} Orang
                            </dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-2">Keterangan</dt>
                            <dd class="text-sm text-zinc-700 bg-zinc-50 p-4 rounded-md border border-zinc-100">
                                {{ $kelas->keterangan ?: 'Tidak ada keterangan tambahan.' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Sidebar / Image -->
        <div class="lg:col-span-1 space-y-6">
            <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50">
                    <h3 class="text-base font-semibold text-zinc-900">Foto Ruangan</h3>
                </div>
                <div class="p-6">
                    @if ($kelas->gambar)
                        <div
                            class="relative aspect-video w-full overflow-hidden rounded-lg border border-zinc-200 bg-zinc-100">
                            <img src="{{ asset('uploads/kelas/' . $kelas->gambar) }}" alt="{{ $kelas->nama_kelas }}"
                                class="h-full w-full object-cover">
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center p-8 bg-zinc-50 rounded-lg border border-dashed border-zinc-300 text-zinc-400">
                            <i class="fas fa-image text-3xl mb-2"></i>
                            <span class="text-sm">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>
                <div class="bg-zinc-50 px-6 py-4 border-t border-zinc-100 text-center">
                    <p class="text-xs text-zinc-400">Terakhir diupdate: {{ $kelas->updated_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col gap-3">
                <a href="{{ route('admin.kelas.edit', $kelas->id) }}"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    <i class="fas fa-pencil-alt mr-2"></i> Edit Data Kelas
                </a>
                <a href="{{ route('admin.kelas.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
@endsection
