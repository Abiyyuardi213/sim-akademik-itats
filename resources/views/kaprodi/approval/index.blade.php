@extends('layouts.kaprodi')

@section('title', 'Persetujuan Kaprodi')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Persetujuan Kaprodi</h1>
            <p class="mt-1 text-sm text-zinc-500">Tinjau permohonan peminjaman ruangan yang memerlukan persetujuan.</p>
        </div>
        <div class="flex gap-3">
            <span
                class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium text-zinc-700 shadow-sm ring-1 ring-inset ring-zinc-300">
                <i class="fas fa-calendar mr-2 text-zinc-400"></i> {{ now()->translatedFormat('d M Y') }}
            </span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-50/50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-4 w-12 text-center">No</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Ruangan</th>
                        <th class="px-6 py-4">Keperluan</th>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 bg-white">
                    @forelse ($pengajuans as $index => $pengajuan)
                        <tr class="hover:bg-zinc-50/50 transition-colors group">
                            <td class="px-6 py-4 text-center font-medium text-zinc-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-zinc-900">{{ $pengajuan->user->username }}</p>
                                <div class="flex items-center mt-1 text-xs text-zinc-500">
                                    <span class="truncate max-w-[150px]">{{ $pengajuan->prodi->nama_prodi }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-zinc-900">{{ $pengajuan->kelas->nama_kelas }}</p>
                                <p class="text-xs text-zinc-500">{{ $pengajuan->kelas->gedung->nama_gedung ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 text-zinc-600">
                                <p class="line-clamp-2 max-w-xs" title="{{ $pengajuan->keperluan_peminjaman }}">
                                    {{ $pengajuan->keperluan_peminjaman }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-zinc-600 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span
                                        class="font-medium">{{ \Carbon\Carbon::parse($pengajuan->tanggal_peminjaman)->translatedFormat('d M Y') }}</span>
                                    <span class="text-xs text-zinc-500 mt-0.5">
                                        {{ \Carbon\Carbon::parse($pengajuan->waktu_peminjaman)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($pengajuan->waktu_berakhir_peminjaman)->format('H:i') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusColors = [
                                        'pending_kaprodi' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
                                        'pending_admin' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                        'disetujui' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                        'ditolak' => 'bg-red-50 text-red-700 ring-red-600/10',
                                    ];
                                    $statusLabels = [
                                        'pending_kaprodi' => 'Menunggu Kaprodi',
                                        'pending_admin' => 'Menunggu Admin',
                                        'disetujui' => 'Disetujui',
                                        'ditolak' => 'Ditolak',
                                    ];
                                    $statusClass =
                                        $statusColors[$pengajuan->status] ??
                                        'bg-zinc-50 text-zinc-700 ring-zinc-600/10';
                                    $statusLabel = $statusLabels[$pengajuan->status] ?? ucfirst($pengajuan->status);
                                @endphp
                                <span
                                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('kaprodi.approval.show', $pengajuan->id) }}"
                                    class="inline-flex items-center justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 transition-colors">
                                    Tinjau
                                    <i
                                        class="fas fa-arrow-right ml-2 text-zinc-400 group-hover:text-zinc-600 transition-colors"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="h-12 w-12 rounded-full bg-zinc-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-check text-zinc-400 text-lg"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-zinc-900">Semua Beres!</h3>
                                    <p class="mt-1 text-sm text-zinc-500">Tidak ada permohonan yang perlu disetujui saat
                                        ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
