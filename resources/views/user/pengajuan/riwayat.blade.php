<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengajuan | Akademik WR 1</title>

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
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Riwayat Pengajuan</h1>
            <p class="text-zinc-500">Daftar semua permohonan peminjaman yang pernah Anda ajukan.</p>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th class="h-12 px-4 font-medium text-zinc-500">No</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Kegiatan</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Ruangan</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Tanggal</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Jam</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Status</th>
                            <th class="h-12 px-4 font-medium text-zinc-500 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($pengajuans ?? [] as $index => $p)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="p-4 font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="p-4 text-zinc-700">{{ $p->kegiatan }}</td>
                                <td class="p-4 text-zinc-700">{{ $p->kelas->nama_kelas ?? '-' }}</td>
                                <td class="p-4 text-zinc-500">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                                <td class="p-4 text-zinc-500">{{ $p->jam_mulai }} - {{ $p->jam_selesai }}</td>
                                <td class="p-4">
                                    @if ($p->status == 'pending')
                                        <span
                                            class="inline-flex items-center rounded-full border border-yellow-200 bg-yellow-50 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                                            Pending
                                        </span>
                                    @elseif($p->status == 'approved')
                                        <span
                                            class="inline-flex items-center rounded-full border border-green-200 bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                            Disetujui
                                        </span>
                                    @elseif($p->status == 'rejected')
                                        <span
                                            class="inline-flex items-center rounded-full border border-red-200 bg-red-50 px-2.5 py-0.5 text-xs font-semibold text-red-700">
                                            Ditolak
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-2.5 py-0.5 text-xs font-semibold text-zinc-700">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('users.pengajuan.show', $p->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-900 hover:bg-zinc-100 focus:outline-none focus:ring-1 focus:ring-zinc-950">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-8 text-center text-zinc-500">
                                    <div class="flex flex-col items-center justify-center space-y-2">
                                        <div class="h-10 w-10 text-zinc-300"><i class="fas fa-inbox text-3xl"></i></div>
                                        <p>Belum ada riwayat pengajuan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination if needed -->
            @if (isset($pengajuans) && method_exists($pengajuans, 'links'))
                <div class="p-4 border-t border-zinc-200">
                    {{ $pengajuans->links() }}
                </div>
            @endif
        </div>
    </main>

    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
