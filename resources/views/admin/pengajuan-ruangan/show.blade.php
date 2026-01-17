@extends('layouts.admin')

@section('title', 'Detail Permohonan')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Permohonan Peminjaman</h1>
            <p class="mt-1 text-sm text-zinc-500">Tinjau detail lengkap pengajuan sebelum mengambil tindakan.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.pengajuan-ruangan.index') }}"
                class="hover:text-zinc-900 transition-colors">Permohonan</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Detail</span>
        </nav>
    </div>

    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900 flex items-center gap-2">
                <i class="fas fa-file-alt text-zinc-400"></i> Informasi Pengajuan
            </h3>

            @if ($pengajuan->status == 'pending')
                <span
                    class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                    Menunggu Konfirmasi
                </span>
            @elseif($pengajuan->status == 'pending_admin')
                <span
                    class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
                    Menunggu Approval Admin
                </span>
            @elseif($pengajuan->status == 'disetujui')
                <span
                    class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    Disetujui
                </span>
            @elseif($pengajuan->status == 'ditolak')
                <span
                    class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                    Ditolak
                </span>
            @endif
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <!-- Info Peminjam & Tempat -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Data Pemohon & Lokasi</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Nama Pemohon</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900 flex items-center gap-2">
                            <div
                                class="h-6 w-6 rounded-full bg-zinc-100 flex items-center justify-center text-xs text-zinc-500">
                                <i class="fas fa-user"></i>
                            </div>
                            {{ $pengajuan->user->name ?? 'User' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Program Studi</dt>
                        <dd class="mt-1 text-sm text-zinc-700">
                            {{ $pengajuan->prodi->nama_prodi ?? '-' }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Ruangan Yang Diajukan</dt>
                        <dd class="mt-1 text-base font-bold text-zinc-900">
                            {{ $pengajuan->room_name ?? ($pengajuan->kelas->nama_kelas ?? '-') }}
                        </dd>
                    </div>
                </div>

                <!-- Waktu -->
                <div class="space-y-6">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Waktu Pelaksanaan</h4>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Tanggal</dt>
                        <dd class="mt-1 text-base font-medium text-zinc-900">
                            {{ \Carbon\Carbon::parse($pengajuan->tanggal_peminjaman)->translatedFormat('d F Y') }}
                            @if ($pengajuan->tanggal_peminjaman != $pengajuan->tanggal_berakhir_peminjaman)
                                <span class="text-zinc-400 mx-2">-</span>
                                {{ \Carbon\Carbon::parse($pengajuan->tanggal_berakhir_peminjaman)->translatedFormat('d F Y') }}
                            @endif
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Jam</dt>
                        <dd
                            class="mt-1 text-base font-mono text-zinc-700 bg-zinc-50 inline-block px-2 py-1 rounded border border-zinc-200">
                            {{ $pengajuan->waktu_peminjaman }} - {{ $pengajuan->waktu_berakhir_peminjaman }} WIB
                        </dd>
                    </div>
                </div>

                <!-- Keperluan Full Width -->
                <div class="md:col-span-2">
                    <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-2">Keperluan Peminjaman</dt>
                    <dd class="text-sm text-zinc-700 bg-zinc-50 p-4 rounded-md border border-zinc-100 italic">
                        "{{ $pengajuan->keperluan_peminjaman }}"
                    </dd>
                </div>

                <!-- Catatan Admin jika ada -->
                @if ($pengajuan->catatan_admin)
                    <div class="md:col-span-2">
                        <dt class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-2">Catatan Admin</dt>
                        <dd class="text-sm text-zinc-700 bg-yellow-50/50 p-4 rounded-md border border-yellow-100">
                            {{ $pengajuan->catatan_admin }}
                        </dd>
                    </div>
                @endif

            </div>
        </div>

        <div
            class="bg-zinc-50 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-zinc-100">
            <a href="{{ route('admin.pengajuan-ruangan.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors w-full sm:w-auto">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>

            @if ($pengajuan->status == 'pending_admin')
                <div class="flex gap-3 w-full sm:w-auto">
                    <form action="{{ route('admin.pengajuan-ruangan.reject', $pengajuan->id) }}" method="POST"
                        class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center rounded-md border border-red-200 bg-white text-red-600 px-4 py-2 text-sm font-medium shadow-sm hover:bg-red-50 focus:outline-none focus:ring-1 focus:ring-red-600 transition-colors">
                            <i class="fas fa-times mr-2"></i> Tolak
                        </button>
                    </form>
                    <form action="{{ route('admin.pengajuan-ruangan.approve', $pengajuan->id) }}" method="POST"
                        class="w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                            <i class="fas fa-check mr-2"></i> Setujui
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
