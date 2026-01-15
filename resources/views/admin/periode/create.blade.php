@extends('layouts.admin')

@section('title', 'Tambah Periode')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Periode Baru</h1>
            <p class="mt-1 text-sm text-zinc-500">Buat periode cuti akademik baru untuk mahasiswa.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.periode.index') }}" class="hover:text-zinc-900 transition-colors">Periode Cuti</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-2xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Periode Cuti</h3>
            <p class="text-sm text-zinc-500">Lengkapi detail untuk menyimpan periode baru.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.periode.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label for="nama_periode"
                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-zinc-900">Nama
                    Periode</label>
                <input type="text" id="nama_periode" name="nama_periode" value="{{ old('nama_periode') }}" required
                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                    placeholder="Contoh: Genap 2024/2025">
                @error('nama_periode')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label for="awal_cuti" class="text-sm font-medium leading-none text-zinc-900">Awal Cuti</label>
                    <input type="month" id="awal_cuti" name="awal_cuti" value="{{ old('awal_cuti') }}" required
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    @error('awal_cuti')
                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="akhir_cuti" class="text-sm font-medium leading-none text-zinc-900">Akhir Cuti</label>
                    <input type="month" id="akhir_cuti" name="akhir_cuti" value="{{ old('akhir_cuti') }}" required
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    @error('akhir_cuti')
                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label for="bulan_her" class="text-sm font-medium leading-none text-zinc-900">Bulan Wajib HER</label>
                <input type="month" id="bulan_her" name="bulan_her" value="{{ old('bulan_her') }}" required
                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white cursor-pointer focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                <p class="text-xs text-zinc-500">Bulan dimana mahasiswa diwajibkan melakukan daftar ulang.</p>
                @error('bulan_her')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="periode_status" class="text-sm font-medium leading-none text-zinc-900">Status Periode</label>
                <div class="relative">
                    <select id="periode_status" name="periode_status"
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
                <a href="{{ route('admin.periode.index') }}"
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
