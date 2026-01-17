@extends('layouts.user')

@section('title', 'Riwayat Pengajuan | Akademik WR 1')

@section('content')
    <div class="container mx-auto px-4 md:px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Riwayat Pengajuan</h1>
            <p class="text-zinc-500">Daftar semua permohonan peminjaman yang pernah Anda ajukan.</p>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th class="h-12 px-6 font-medium text-zinc-500">No</th>
                            <th class="h-12 px-6 font-medium text-zinc-500">Kegiatan</th>
                            <th class="h-12 px-6 font-medium text-zinc-500">Ruangan</th>
                            <th class="h-12 px-6 font-medium text-zinc-500">Tanggal</th>
                            <th class="h-12 px-6 font-medium text-zinc-500">Jam</th>
                            <th class="h-12 px-6 font-medium text-zinc-500">Status</th>
                            <th class="h-12 px-6 font-medium text-zinc-500 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($riwayats ?? [] as $index => $p)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="p-6 font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="p-6 text-zinc-700 font-medium">{{ $p->keperluan_peminjaman }}</td>
                                <td class="p-6 text-zinc-700">
                                    <div class="flex items-center gap-2">
                                        @if (($p->type ?? 'ruangan') == 'laboratorium')
                                            <i class="fas fa-flask text-zinc-400"></i>
                                        @elseif(($p->type ?? 'ruangan') == 'support')
                                            <i class="fas fa-chalkboard-teacher text-zinc-400"></i>
                                        @else
                                            <i class="fas fa-door-open text-zinc-400"></i>
                                        @endif
                                        {{ $p->room_name ?? ($p->kelas->nama_kelas ?? '-') }}
                                    </div>
                                </td>
                                <td class="p-6 text-zinc-500">
                                    {{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->translatedFormat('d M Y') }}
                                </td>
                                <td class="p-6 text-zinc-500 font-mono text-xs">
                                    {{ \Carbon\Carbon::parse($p->waktu_peminjaman)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($p->waktu_berakhir_peminjaman)->format('H:i') }}
                                </td>
                                <td class="p-6">
                                    @if ($p->status == 'pending' || $p->status == 'pending_kaprodi')
                                        <span
                                            class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700 gap-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>
                                            Menunggu Kaprodi
                                        </span>
                                    @elseif($p->status == 'pending_admin')
                                        <span
                                            class="inline-flex items-center rounded-full border border-blue-200 bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700 gap-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                            Menunggu Admin
                                        </span>
                                    @elseif($p->status == 'disetujui')
                                        <span
                                            class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 gap-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Disetujui
                                        </span>
                                    @elseif($p->status == 'ditolak')
                                        <span
                                            class="inline-flex items-center rounded-full border border-red-200 bg-red-50 px-2.5 py-0.5 text-xs font-semibold text-red-700 gap-1.5">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-0.5 text-xs font-semibold text-zinc-700">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-6 text-right">
                                    @if ($p->status == 'disetujui')
                                        <a href="{{ route('users.pengajuan.cetakPdf', $p->id) }}" target="_blank"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2"
                                            title="Cetak Surat Peminjaman">
                                            <i class="fas fa-print text-xs"></i>
                                        </a>
                                    @else
                                        <span class="text-zinc-400 italic text-xs">Belum disetujui</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-12 text-center text-zinc-500">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div
                                            class="h-12 w-12 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-400">
                                            <i class="fas fa-inbox text-xl"></i>
                                        </div>
                                        <p class="font-medium text-zinc-900">Belum ada riwayat pengajuan</p>
                                        <p class="text-sm">Pengajuan yang Anda buat akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($riwayats) && method_exists($riwayats, 'links'))
                <div class="p-4 border-t border-zinc-200 bg-zinc-50/50">
                    {{ $riwayats->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
