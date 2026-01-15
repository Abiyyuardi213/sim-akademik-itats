<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan | Akademik WR 1</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased flex flex-col min-h-screen">
    @include('include.navbarUser')

    <main class="flex-grow container mx-auto px-4 md:px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Status Pengajuan</h1>
            <p class="text-zinc-500">Pantau status terkini dari permohonan peminjaman ruangan Anda.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($pengajuans ?? [] as $p)
                <div
                    class="group rounded-xl border border-zinc-200 bg-white p-6 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6">
                        @if ($p->status == 'pending')
                            <div class="h-3 w-3 rounded-full bg-yellow-500 ring-4 ring-yellow-500/20"></div>
                        @elseif($p->status == 'approved')
                            <div class="h-3 w-3 rounded-full bg-green-500 ring-4 ring-green-500/20"></div>
                        @elseif($p->status == 'rejected')
                            <div class="h-3 w-3 rounded-full bg-red-500 ring-4 ring-red-500/20"></div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div
                            class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 text-zinc-900 mb-3">
                            <i class="fas fa-file-contract text-lg"></i>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900 line-clamp-1">{{ $p->kegiatan }}</h3>
                        <p class="text-sm text-zinc-500">{{ $p->kelas->nama_kelas ?? 'Ruangan' }} •
                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</p>
                    </div>

                    <div class="space-y-3 border-t border-zinc-100 pt-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Waktu</span>
                            <span class="font-medium text-zinc-900">{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-zinc-500">Status</span>
                            <span
                                class="font-medium {{ $p->status == 'approved' ? 'text-green-600' : ($p->status == 'rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </div>
                        @if ($p->keterangan)
                            <div class="bg-zinc-50 p-3 rounded-md text-xs text-zinc-600 mt-2">
                                <span class="font-semibold block mb-1">Catatan:</span>
                                {{ $p->keterangan }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('users.pengajuan.show', $p->id) }}"
                            class="inline-flex w-full items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-900 hover:bg-zinc-50 hover:text-zinc-900 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 border-2 border-dashed border-zinc-200 rounded-xl">
                    <div
                        class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 text-zinc-400 mb-4">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-zinc-900">Tidak ada pengajuan aktif</h3>
                    <p class="text-zinc-500 text-sm mt-1">Anda belum mengajukan peminjaman ruangan.</p>
                    <a href="{{ route('users.pengajuan.index') }}"
                        class="inline-flex items-center justify-center mt-4 rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 transition-colors">
                        Mulai Ajukan
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
