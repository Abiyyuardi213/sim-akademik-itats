@extends('layouts.user')

@section('title', 'Detail Peminjaman | Akademik WR 1')

@section('content')
    <div class="container mx-auto px-4 md:px-6 py-8">
        {{-- Breadcrumb / Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('users.pengajuan.status') }}"
                class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Status
            </a>
        </div>

        <div class="max-w-4xl mx-auto">
            {{-- Header Section --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Detail Peminjaman</h1>
                    <p class="text-zinc-500">Informasi lengkap mengenai pengajuan peminjaman ruangan Anda.</p>
                </div>

                {{-- Status Badge --}}
                <div class="flex items-center">
                    @if (in_array($pengajuan->status, ['pending', 'pending_kaprodi', 'pending_admin']))
                        <span
                            class="inline-flex items-center rounded-full bg-yellow-50 px-4 py-2 text-sm font-semibold text-yellow-600 border border-yellow-100 ring-2 ring-yellow-500/10">
                            <span class="mr-2 h-2.5 w-2.5 rounded-full bg-yellow-400 animate-pulse"></span>
                            Menunggu Persetujuan
                            @if ($pengajuan->status == 'pending_kaprodi')
                                (Kaprodi)
                            @endif
                            @if ($pengajuan->status == 'pending_admin')
                                (Admin)
                            @endif
                        </span>
                    @elseif($pengajuan->status == 'disetujui')
                        <span
                            class="inline-flex items-center rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-600 border border-emerald-100 ring-2 ring-emerald-500/10">
                            <span class="mr-2 h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                            Disetujui
                        </span>
                    @elseif($pengajuan->status == 'ditolak')
                        <span
                            class="inline-flex items-center rounded-full bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 border border-red-100 ring-2 ring-red-500/10">
                            <span class="mr-2 h-2.5 w-2.5 rounded-full bg-red-500"></span>
                            Ditolak
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-gray-50 px-4 py-2 text-sm font-semibold text-gray-600 border border-gray-100">
                            {{ ucfirst($pengajuan->status) }}
                        </span>
                    @endif
                </div>
            </div>

            {{-- Main Content Card --}}
            <div class="rounded-2xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
                {{-- Upper Section: Key Info --}}
                <div class="p-6 md:p-8 border-b border-zinc-100 bg-zinc-50/50">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <h2 class="text-sm font-semibold text-zinc-400 uppercase tracking-wider mb-1">Keperluan</h2>
                            <p class="text-xl font-medium text-zinc-900">{{ $pengajuan->keperluan_peminjaman }}</p>
                        </div>
                        <div>
                            <h2 class="text-sm font-semibold text-zinc-400 uppercase tracking-wider mb-1">ID Pengajuan</h2>
                            <p class="text-sm font-mono text-zinc-600 break-all select-all">{{ $pengajuan->id }}</p>
                        </div>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="p-6 md:p-8 grid gap-8 md:grid-cols-2">
                    {{-- Room Details --}}
                    <div class="space-y-6">
                        <h3
                            class="text-lg font-semibold text-zinc-900 border-b border-zinc-100 pb-2 flex items-center gap-2">
                            <i class="fas fa-door-open text-zinc-400"></i> Detail Ruangan
                        </h3>

                        <div class="grid gap-4">
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Nama Ruangan</p>
                                <p class="font-medium text-zinc-900">{{ $pengajuan->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Gedung</p>
                                <?php
                                $gedungName = '-';
                                if ($pengajuan->kelas && $pengajuan->kelas->gedung) {
                                    $gedungName = $pengajuan->kelas->gedung->nama_gedung;
                                }
                                ?>
                                <p class="font-medium text-zinc-900">{{ $gedungName }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Program Studi</p>
                                <p class="font-medium text-zinc-900">{{ $pengajuan->prodi->nama_prodi ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Kapasitas</p>
                                <p class="font-medium text-zinc-900">{{ $pengajuan->kelas->kapasitas_mahasiswa ?? '-' }}
                                    Orang</p>
                            </div>
                        </div>
                    </div>

                    {{-- Schedule Details --}}
                    <div class="space-y-6">
                        <h3
                            class="text-lg font-semibold text-zinc-900 border-b border-zinc-100 pb-2 flex items-center gap-2">
                            <i class="far fa-calendar-alt text-zinc-400"></i> Jadwal Peminjaman
                        </h3>

                        <div class="grid gap-4">
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Tanggal Mulai</p>
                                <p class="font-medium text-zinc-900">
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_peminjaman)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Tanggal Selesai</p>
                                <p class="font-medium text-zinc-900">
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_berakhir_peminjaman)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>
                            <div class="flex gap-8">
                                <div>
                                    <p class="text-sm text-zinc-500 mb-1">Waktu Mulai</p>
                                    <p class="font-medium text-zinc-900">
                                        {{ \Carbon\Carbon::parse($pengajuan->waktu_peminjaman)->format('H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-500 mb-1">Waktu Selesai</p>
                                    <p class="font-medium text-zinc-900">
                                        {{ \Carbon\Carbon::parse($pengajuan->waktu_berakhir_peminjaman)->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-500 mb-1">Diajukan Pada</p>
                                <p class="text-sm text-zinc-700">
                                    {{ $pengajuan->created_at->translatedFormat('d M Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes Section --}}
                @if ($pengajuan->catatan_admin || $pengajuan->catatan_kaprodi)
                    <div class="px-6 md:px-8 pb-8 space-y-4">
                        @if ($pengajuan->catatan_kaprodi)
                            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4 md:p-5">
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <i class="fas fa-user-tie text-orange-500 text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-orange-900 mb-1">Catatan Kaprodi</h4>
                                        <p class="text-sm text-orange-800 leading-relaxed">
                                            {{ $pengajuan->catatan_kaprodi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($pengajuan->catatan_admin)
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 md:p-5">
                                <div class="flex gap-3">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <i class="fas fa-info-circle text-blue-500 text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-blue-900 mb-1">Catatan Admin</h4>
                                        <p class="text-sm text-blue-800 leading-relaxed">{{ $pengajuan->catatan_admin }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- Footer / Actions --}}
                <div
                    class="bg-zinc-50 border-t border-zinc-100 px-6 md:px-8 py-5 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <p class="text-xs text-zinc-400">
                        Terakhir diperbarui: {{ $pengajuan->updated_at->diffForHumans() }}
                    </p>

                    @if ($pengajuan->status == 'disetujui')
                        <a href="{{ route('users.pengajuan.cetakPdf', $pengajuan->id) }}" target="_blank"
                            class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-zinc-800 hover:shadow-md transition-all">
                            <i class="fas fa-print mr-2"></i> Cetak Bukti Peminjaman
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
