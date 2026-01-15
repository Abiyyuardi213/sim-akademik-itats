@extends('layouts.admin')

@section('title', 'Tambah Program Studi')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Program Studi</h1>
            <p class="mt-1 text-sm text-zinc-500">Tambahkan data program studi baru ke dalam sistem.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.prodi.index') }}" class="hover:text-zinc-900 transition-colors">Prodi</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-2xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Tambah Prodi</h3>
            <p class="text-sm text-zinc-500">Lengkapi data di bawah ini.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.prodi.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Prodi -->
                <div class="space-y-2 md:col-span-2">
                    <label for="nama_prodi" class="text-sm font-medium leading-none text-zinc-900">Nama Program Studi <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nama_prodi" name="nama_prodi" value="{{ old('nama_prodi') }}" required
                        placeholder="Contoh: Teknik Informatika"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                </div>

                <!-- Kode Prodi -->
                <div class="space-y-2">
                    <label for="kode_prodi" class="text-sm font-medium leading-none text-zinc-900">Kode Prodi</label>
                    <input type="text" id="kode_prodi" name="kode_prodi" value="{{ old('kode_prodi') }}"
                        placeholder="Contoh: IF"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                </div>

                <!-- Alias Prodi -->
                <div class="space-y-2">
                    <label for="alias_prodi" class="text-sm font-medium leading-none text-zinc-900">Alias Prodi</label>
                    <input type="text" id="alias_prodi" name="alias_prodi" value="{{ old('alias_prodi') }}"
                        placeholder="Contoh: Informatika"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Kaprodi -->
                <div class="space-y-2">
                    <label for="nama_kaprodi" class="text-sm font-medium leading-none text-zinc-900">Nama Kaprodi <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="nama_kaprodi" name="nama_kaprodi" value="{{ old('nama_kaprodi') }}" required
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                </div>

                <!-- NIP Kaprodi -->
                <div class="space-y-2">
                    <label for="nip_kaprodi" class="text-sm font-medium leading-none text-zinc-900">NIP Kaprodi</label>
                    <input type="text" id="nip_kaprodi" name="nip_kaprodi" value="{{ old('nip_kaprodi') }}"
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="space-y-2">
                <label for="prodi_description" class="text-sm font-medium leading-none text-zinc-900">Deskripsi</label>
                <textarea id="prodi_description" name="prodi_description" rows="4"
                    placeholder="Deskripsi singkat tentang program studi..."
                    class="flex min-h-[80px] w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">{{ old('prodi_description') }}</textarea>
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label for="prodi_status" class="text-sm font-medium leading-none text-zinc-900">Status</label>
                <div class="relative">
                    <select id="prodi_status" name="prodi_status" required
                        class="flex h-10 w-full items-center justify-between rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 appearance-none">
                        <option value="1" {{ old('prodi_status') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('prodi_status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <i class="fas fa-chevron-down text-zinc-400 text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.prodi.index') }}"
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
