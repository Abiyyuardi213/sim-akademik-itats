@extends('layouts.admin')

@section('title', 'Tambah Gedung')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Gedung</h1>
            <p class="mt-1 text-sm text-zinc-500">Tambahkan data gedung baru ke dalam sistem.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.gedung.index') }}" class="hover:text-zinc-900 transition-colors">Gedung</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-2xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Data Gedung</h3>
            <p class="text-sm text-zinc-500">Lengkapi informasi di bawah ini.</p>
        </div>

        <form action="{{ route('admin.gedung.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="nama_gedung" class="text-sm font-medium leading-none text-zinc-900">Nama Gedung</label>
                <input type="text" id="nama_gedung" name="nama_gedung" value="{{ old('nama_gedung') }}" required
                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                    placeholder="Contoh: Gedung A">
                @error('nama_gedung')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="gedung_description" class="text-sm font-medium leading-none text-zinc-900">Deskripsi
                    Gedung</label>
                <textarea id="gedung_description" name="gedung_description" rows="4" required
                    class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                    placeholder="Deskripsi singkat mengenai gedung ini...">{{ old('gedung_description') }}</textarea>
                @error('gedung_description')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="gedung_status" class="text-sm font-medium leading-none text-zinc-900">Status Gedung</label>
                <div class="relative">
                    <select id="gedung_status" name="gedung_status"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.gedung.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
