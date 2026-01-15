@extends('layouts.admin')

@section('title', 'Tambah Peminjaman Ruangan')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Peminjaman Ruangan</h1>
            <p class="mt-1 text-sm text-zinc-500">Ajukan atau catat peminjaman ruangan baru.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.peminjaman-ruangan.index') }}"
                class="hover:text-zinc-900 transition-colors">Peminjaman</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Peminjaman</h3>
            <p class="text-sm text-zinc-500">Pastikan jadwal tidak bentrok dengan peminjaman lain.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.peminjaman-ruangan.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri: Waktu -->
                <div class="space-y-5">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Waktu Peminjaman</h4>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="tanggal_peminjaman" class="text-sm font-medium leading-none text-zinc-900">Tanggal
                                Mulai</label>
                            <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman"
                                value="{{ old('tanggal_peminjaman') }}" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                            @error('tanggal_peminjaman')
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="tanggal_berakhir_peminjaman"
                                class="text-sm font-medium leading-none text-zinc-900">Tanggal Selesai</label>
                            <input type="date" id="tanggal_berakhir_peminjaman" name="tanggal_berakhir_peminjaman"
                                value="{{ old('tanggal_berakhir_peminjaman') }}" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                            @error('tanggal_berakhir_peminjaman')
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="waktu_peminjaman" class="text-sm font-medium leading-none text-zinc-900">Jam
                                Mulai</label>
                            <input type="time" id="waktu_peminjaman" name="waktu_peminjaman"
                                value="{{ old('waktu_peminjaman') }}" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                            @error('waktu_peminjaman')
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="waktu_berakhir_peminjaman"
                                class="text-sm font-medium leading-none text-zinc-900">Jam Selesai</label>
                            <input type="time" id="waktu_berakhir_peminjaman" name="waktu_berakhir_peminjaman"
                                value="{{ old('waktu_berakhir_peminjaman') }}" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                            @error('waktu_berakhir_peminjaman')
                                <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Detail -->
                <div class="space-y-5">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Detail Ruangan & Peminjam
                    </h4>

                    <div class="space-y-2">
                        <label for="kelas_id" class="text-sm font-medium leading-none text-zinc-900">Ruangan</label>
                        <div class="relative">
                            <select id="kelas_id" name="kelas_id" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach ($kelass as $kelas)
                                    <option value="{{ $kelas->id }}"
                                        {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                        @error('kelas_id')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="prodi_id" class="text-sm font-medium leading-none text-zinc-900">Program Studi
                            Peminjam</label>
                        <div class="relative">
                            <select id="prodi_id" name="prodi_id" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="">-- Pilih Program Studi --</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->id }}"
                                        {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                        {{ $prodi->kode_prodi ?? '--' }} | {{ strtoupper($prodi->nama_prodi) }}
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
            </div>

            <!-- Full Width -->
            <div class="space-y-2">
                <label for="keperluan_peminjaman" class="text-sm font-medium leading-none text-zinc-900">Keperluan</label>
                <textarea id="keperluan_peminjaman" name="keperluan_peminjaman" rows="3" required
                    class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950"
                    placeholder="Jelaskan keperluan peminjaman secara singkat...">{{ old('keperluan_peminjaman') }}</textarea>
                @error('keperluan_peminjaman')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.peminjaman-ruangan.index') }}"
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
