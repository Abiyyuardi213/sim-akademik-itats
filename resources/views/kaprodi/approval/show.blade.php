@extends('layouts.kaprodi')

@section('title', 'Detail Pengajuan')

@section('content')
    <div class="mb-8">
        <a href="{{ route('kaprodi.approval.index') }}"
            class="inline-flex items-center text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors mb-4 group">
            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i> Kembali
        </a>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Pengajuan</h1>
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
                $statusClass = $statusColors[$pengajuan->status] ?? 'bg-zinc-50 text-zinc-700 ring-zinc-600/10';
                $statusLabel = $statusLabels[$pengajuan->status] ?? ucfirst($pengajuan->status);
            @endphp
            <span
                class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium ring-1 ring-inset {{ $statusClass }}">
                {{ $statusLabel }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
                    <h2 class="text-base font-semibold text-zinc-900">Informasi Peminjaman</h2>
                    <span class="text-xs font-mono text-zinc-400">#{{ $pengajuan->nomor_surat ?? 'DRAFT' }}</span>
                </div>
                <div class="p-6 space-y-8">
                    <!-- User Info -->
                    <div>
                        <h3 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2 mb-4">Data Peminjam</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Nama Lengkap</p>
                                <p class="text-zinc-900 font-medium">{{ $pengajuan->user->username }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Unit / Prodi</p>
                                <p class="text-zinc-900">{{ $pengajuan->prodi->nama_prodi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Room Info -->
                    <div>
                        <h3 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2 mb-4">Detail Ruangan &
                            Waktu</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Ruangan</p>
                                <div class="flex items-center gap-3">
                                    @if ($pengajuan->kelas->gambar)
                                        <img src="{{ asset($pengajuan->kelas->gambar) }}"
                                            class="h-10 w-10 rounded-md object-cover bg-zinc-100" alt="Room">
                                    @endif
                                    <div>
                                        <p class="text-zinc-900 font-medium">{{ $pengajuan->kelas->nama_kelas }}</p>
                                        <p class="text-xs text-zinc-500">{{ $pengajuan->kelas->gedung->nama_gedung ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Jadwal</p>
                                <p class="text-zinc-900 font-medium">
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_peminjaman)->translatedFormat('l, d F Y') }}
                                </p>
                                <p class="text-sm text-zinc-600">
                                    {{ \Carbon\Carbon::parse($pengajuan->waktu_peminjaman)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($pengajuan->waktu_berakhir_peminjaman)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Purpose -->
                    <div>
                        <h3 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2 mb-4">Keperluan</h3>
                        <div class="rounded-lg bg-zinc-50 p-4 border border-zinc-100 text-zinc-700 leading-relaxed text-sm">
                            {{ $pengajuan->keperluan_peminjaman }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Card -->
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-zinc-200 bg-white shadow-sm sticky top-24">
                <div class="p-6 border-b border-zinc-100">
                    <h2 class="text-base font-semibold text-zinc-900">Tindakan</h2>
                </div>
                <div class="p-6 space-y-4">

                    @if ($pengajuan->status == 'pending_kaprodi')
                        <div
                            class="flex items-start gap-3 p-3 rounded-lg bg-yellow-50 border border-yellow-100 text-yellow-800 text-sm mb-6">
                            <i class="fas fa-info-circle mt-0.5 text-yellow-600"></i>
                            <p>Permohonan ini menunggu persetujuan Anda untuk diteruskan ke Admin.</p>
                        </div>

                        <form action="{{ route('kaprodi.approval.approve', $pengajuan->id) }}" method="POST"
                            id="approveForm">
                            @csrf
                            <div class="mb-4">
                                <label for="catatan_approve"
                                    class="block text-xs font-medium text-zinc-700 mb-1 uppercase tracking-wider">Catatan
                                    Persetujuan (Opsional)</label>
                                <textarea name="catatan_kaprodi" id="catatan_approve" rows="2"
                                    class="block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-zinc-600 sm:text-sm sm:leading-6 bg-zinc-50"
                                    placeholder="Tambahkan catatan jika perlu..."></textarea>
                            </div>
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center rounded-md bg-zinc-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-600 transition-all">
                                <i class="fas fa-check mr-2"></i> Setujui & Teruskan
                            </button>
                        </form>

                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-zinc-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-2 text-xs text-zinc-400 uppercase">Atau</span>
                            </div>
                        </div>

                        <form action="{{ route('kaprodi.approval.reject', $pengajuan->id) }}" method="POST"
                            id="rejectForm">
                            @csrf
                            <div class="mb-4">
                                <label for="catatan_reject"
                                    class="block text-xs font-medium text-zinc-700 mb-1 uppercase tracking-wider">Alasan
                                    Penolakan <span class="text-red-500">*</span></label>
                                <textarea name="catatan_kaprodi" id="catatan_reject" rows="2" required
                                    class="block w-full rounded-md border-0 py-1.5 text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 placeholder:text-zinc-400 focus:ring-2 focus:ring-inset focus:ring-red-600 sm:text-sm sm:leading-6 bg-red-50/10"
                                    placeholder="Wajib mengisi alasan penolakan..."></textarea>
                            </div>
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center rounded-md bg-white border border-red-200 px-4 py-2.5 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-50 hover:border-red-300 transition-all">
                                <i class="fas fa-times mr-2"></i> Tolak Pengajuan
                            </button>
                        </form>
                    @else
                        <div
                            class="flex flex-col items-center justify-center p-6 bg-zinc-50 rounded-lg border border-zinc-200 text-center">
                            @if ($pengajuan->status == 'disetujui')
                                <div
                                    class="h-10 w-10 bg-emerald-100 rounded-full flex items-center justify-center mb-3 text-emerald-600">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-zinc-900">Permohonan Disetujui</h3>
                            @elseif($pengajuan->status == 'ditolak')
                                <div
                                    class="h-10 w-10 bg-red-100 rounded-full flex items-center justify-center mb-3 text-red-600">
                                    <i class="fas fa-times"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-zinc-900">Permohonan Ditolak</h3>
                            @else
                                <div
                                    class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mb-3 text-blue-600">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-zinc-900">Menunggu Proses Admin</h3>
                            @endif
                            <p class="text-xs text-zinc-500 mt-1">Status saat ini:
                                <strong>{{ ucfirst($pengajuan->status) }}</strong></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
