@extends('layouts.admin')

@section('title', 'Detail Program Studi')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Program Studi</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap mengenai program studi.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.prodi.index') }}" class="hover:text-zinc-900 transition-colors">Prodi</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <!-- Detail Card -->
    <div class="max-w-3xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="border-b border-zinc-100 bg-zinc-50/50 px-6 py-4 flex items-center justify-between">
            <h3 class="font-semibold text-zinc-900">Informasi Prodi</h3>
            <span
                class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                {{ $prodi->prodi_status
                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                    : 'bg-zinc-100 text-zinc-700 border-zinc-200' }}">
                {{ $prodi->prodi_status ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <div class="p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-zinc-500">Nama Program Studi</dt>
                    <dd class="mt-1 text-base font-semibold text-zinc-900">{{ $prodi->nama_prodi }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-zinc-500">Kode Prodi</dt>
                    <dd class="mt-1 text-sm text-zinc-900 font-mono">{{ $prodi->kode_prodi ?? '-' }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-zinc-500">Alias</dt>
                    <dd class="mt-1 text-sm text-zinc-900">{{ $prodi->alias_prodi ?? '-' }}</dd>
                </div>

                <div class="border-t border-zinc-100 pt-4 sm:col-span-2">
                    <h4 class="text-sm font-medium text-zinc-900 mb-3">Informasi Kaprodi</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-xs text-zinc-500">Nama Kaprodi</dt>
                            <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $prodi->nama_kaprodi }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs text-zinc-500">NIP Kaprodi</dt>
                            <dd class="mt-1 text-sm font-medium text-zinc-900">{{ $prodi->nip_kaprodi ?? '-' }}</dd>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-2 border-t border-zinc-100 pt-4">
                    <dt class="text-sm font-medium text-zinc-500">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-zinc-700 leading-relaxed">{{ $prodi->prodi_description ?? '-' }}</dd>
                </div>

                <div class="sm:col-span-2 border-t border-zinc-100 pt-4 flex gap-4 text-xs text-zinc-400">
                    <div>
                        <span class="block font-medium">Dibuat</span>
                        {{ $prodi->created_at ? $prodi->created_at->format('d M Y, H:i') : '-' }}
                    </div>
                    <div>
                        <span class="block font-medium">Diperbarui</span>
                        {{ $prodi->updated_at ? $prodi->updated_at->format('d M Y, H:i') : '-' }}
                    </div>
                </div>
            </dl>

            <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-zinc-100">
                <a href="{{ route('admin.prodi.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    Kembali
                </a>
                <a href="{{ route('admin.prodi.edit', $prodi->id) }}"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                    <i class="fas fa-pencil-alt mr-2"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection
