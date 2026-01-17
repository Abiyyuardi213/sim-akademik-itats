@extends('layouts.user')

@section('title', 'Status Pengajuan | Akademik WR 1')

@section('content')
    <div class="container mx-auto px-4 md:px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Status Pengajuan</h1>
            <p class="text-zinc-500">Pantau status terkini dari permohonan peminjaman ruangan Anda.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($statuses ?? [] as $p)
                <div
                    class="group rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:shadow-lg hover:border-zinc-300 transition-all duration-300 relative overflow-hidden flex flex-col h-full">
                    <!-- Status indicator dot in top right -->
                    <div class="absolute top-6 right-6">
                        @if (in_array($p->status, ['pending', 'pending_kaprodi', 'pending_admin']))
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-semibold text-yellow-600 bg-yellow-50 px-2.5 py-0.5 rounded-full border border-yellow-100">
                                    {{ $p->status == 'pending_kaprodi' ? 'Menunggu Kaprodi' : ($p->status == 'pending_admin' ? 'Menunggu Admin' : 'Pending') }}
                                </span>
                                <div class="h-2.5 w-2.5 rounded-full bg-yellow-400 animate-pulse"></div>
                            </div>
                        @elseif($p->status == 'disetujui')
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100">Disetujui</span>
                                <div class="h-2.5 w-2.5 rounded-full bg-emerald-500"></div>
                            </div>
                        @elseif($p->status == 'ditolak')
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-semibold text-red-600 bg-red-50 px-2.5 py-0.5 rounded-full border border-red-100">Ditolak</span>
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500"></div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-5 pr-20"> <!-- Padding right to avoid overlap with status -->
                        <div
                            class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-100 text-zinc-900 mb-4 group-hover:bg-zinc-900 group-hover:text-white transition-colors duration-300">
                            <i class="fas fa-file-contract text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900 line-clamp-2 leading-tight mb-1">
                            {{ $p->keperluan_peminjaman }}</h3>
                        <p class="text-sm text-zinc-500">Dibuat pada {{ $p->created_at->translatedFormat('d M Y') }}</p>
                    </div>

                    <div class="space-y-4 border-t border-zinc-100 pt-5 mt-auto">
                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-8 flex justify-center text-zinc-400">
                                @if (($p->type ?? 'ruangan') == 'laboratorium')
                                    <i class="fas fa-flask"></i>
                                @elseif(($p->type ?? 'ruangan') == 'support')
                                    <i class="fas fa-chalkboard-teacher"></i>
                                @else
                                    <i class="fas fa-door-open"></i>
                                @endif
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">
                                    {{ ($p->type ?? 'ruangan') == 'laboratorium' ? 'Laboratorium' : (($p->type ?? 'ruangan') == 'support' ? 'Ruangan Support' : 'Ruangan') }}
                                </p>
                                <p class="font-medium text-zinc-900">
                                    {{ $p->room_name ?? ($p->kelas->nama_kelas ?? 'Ruangan') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 text-sm">
                            <div class="w-8 flex justify-center text-zinc-400"><i class="far fa-calendar"></i></div>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Jadwal</p>
                                <p class="font-medium text-zinc-900">
                                    {{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->translatedFormat('d M Y') }}
                                </p>
                                <p class="text-zinc-600 text-xs">
                                    {{ \Carbon\Carbon::parse($p->waktu_peminjaman)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($p->waktu_berakhir_peminjaman)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        @if ($p->catatan_admin)
                            <div class="bg-zinc-50 p-4 rounded-lg text-xs leading-relaxed border border-zinc-100">
                                <span class="font-bold text-zinc-900 block mb-1 flex items-center gap-1">
                                    <i class="fas fa-info-circle text-blue-500"></i> Catatan Admin:
                                </span>
                                <span class="text-zinc-600">{{ $p->catatan_admin }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-2">
                        <a href="{{ route('users.pengajuan.show', $p->id) }}"
                            class="inline-flex w-full items-center justify-center rounded-xl bg-white border border-zinc-200 px-4 py-2.5 text-sm font-semibold text-zinc-700 shadow-sm hover:bg-zinc-50 hover:border-zinc-300 hover:text-zinc-900 transition-all focus:outline-none focus:ring-2 focus:ring-zinc-950">
                            Lihat Detail Penuh
                        </a>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full flex flex-col items-center justify-center text-center py-24 border-2 border-dashed border-zinc-200 rounded-2xl bg-zinc-50/50">
                    <div
                        class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-white shadow-sm border border-zinc-200 runtext-zinc-400 mb-6">
                        <i class="fas fa-folder-open text-3xl text-zinc-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 mb-2">Tidak ada pengajuan aktif</h3>
                    <p class="text-zinc-500 max-w-sm mx-auto mb-8">Anda belum mengajukan peminjaman ruangan. Mulai ajukan
                        peminjaman untuk kegiatan Anda.</p>
                    <a href="{{ route('users.pengajuan.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-zinc-900 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-zinc-900/10 hover:bg-zinc-800 hover:scale-105 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Pengajuan Baru
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
