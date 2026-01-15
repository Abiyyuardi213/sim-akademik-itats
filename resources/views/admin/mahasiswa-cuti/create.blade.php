@extends('layouts.admin')

@section('title', 'Tambah Data Cuti')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Data Cuti</h1>
            <p class="mt-1 text-sm text-zinc-500">Ajukan atau catat data cuti akademik mahasiswa baru.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.mahasiswa-cuti.index') }}" class="hover:text-zinc-900 transition-colors">Mahasiswa
                Cuti</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Data Cuti</h3>
            <p class="text-sm text-zinc-500">Isi formulir berikut dengan data mahasiswa yang valid.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.mahasiswa-cuti.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label for="nama_mahasiswa" class="text-sm font-medium leading-none text-zinc-900">Nama
                            Mahasiswa</label>
                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}"
                            required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                            placeholder="Masukkan nama lengkap">
                        @error('nama_mahasiswa')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="npm" class="text-sm font-medium leading-none text-zinc-900">NPM</label>
                        <input type="text" id="npm" name="npm" value="{{ old('npm') }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                            placeholder="Nomor Pokok Mahasiswa">
                        @error('npm')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="prodi_id" class="text-sm font-medium leading-none text-zinc-900">Program Studi</label>
                        <div class="relative">
                            <select id="prodi_id" name="prodi_id" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="" disabled selected>-- Pilih Program Studi --</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('prodi_id')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label for="periode_id" class="text-sm font-medium leading-none text-zinc-900">Periode Cuti</label>
                        <div class="relative">
                            <select id="periode_id" name="periode_id" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="" disabled selected>-- Pilih Periode --</option>
                                @foreach ($periodes as $periode)
                                    <option value="{{ $periode->id }}"
                                        {{ old('periode_id') == $periode->id ? 'selected' : '' }}>
                                        {{ $periode->nama_periode }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('periode_id')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="nomor_cuti" class="text-sm font-medium leading-none text-zinc-900">Nomor Surat
                            Cuti</label>
                        <input type="text" id="nomor_cuti" name="nomor_cuti" value="{{ old('nomor_cuti') }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                            placeholder="Contoh: 01/CK/WRI/ITATS/IV/2023">
                        @error('nomor_cuti')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="surat_status" class="text-sm font-medium leading-none text-zinc-900">Status
                            Surat</label>
                        <div class="relative">
                            <select id="surat_status" name="surat_status"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full Width -->
            <div class="space-y-2">
                <label for="keterangan" class="text-sm font-medium leading-none text-zinc-900">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4"
                    class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                    placeholder="Tambahkan keterangan tambahan jika diperlukan...">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.mahasiswa-cuti.index') }}"
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
