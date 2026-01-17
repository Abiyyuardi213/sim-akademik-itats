@extends('layouts.admin')

@section('title', 'Permohonan Peminjaman')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Permohonan Peminjaman Ruangan</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola dan tinjau permintaan peminjaman ruangan dari pengguna.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Permohonan</span>
        </nav>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900">Daftar Permohonan</h3>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table id="pengajuanTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center">No</th>
                            <th class="px-6 py-3">Peminjam</th>
                            <th class="px-6 py-3">Ruangan</th>
                            <th class="px-6 py-3">Jadwal</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach ($pengajuans as $index => $pengajuan)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-medium text-zinc-900">{{ $pengajuan->user->name ?? 'User' }}</span>
                                        <span
                                            class="text-xs text-zinc-500">{{ $pengajuan->prodi->nama_prodi ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-zinc-700">
                                    {{ $pengajuan->room_name ?? ($pengajuan->kelas->nama_kelas ?? '-') }}
                                </td>
                                <td class="px-6 py-4 text-zinc-600">
                                    <div class="flex flex-col">
                                        <span class="text-sm">
                                            {{ \Carbon\Carbon::parse($pengajuan->tanggal_peminjaman)->translatedFormat('d M Y') }}
                                        </span>
                                        <span class="text-xs text-zinc-400">
                                            {{ $pengajuan->waktu_peminjaman }} - {{ $pengajuan->waktu_berakhir_peminjaman }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($pengajuan->status == 'pending')
                                        <span
                                            class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-0.5 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">
                                            Menunggu
                                        </span>
                                    @elseif($pengajuan->status == 'pending_admin')
                                        <span
                                            class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-600/20">
                                            Menunggu Admin
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
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.pengajuan-ruangan.show', $pengajuan->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-blue-600 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>

                                    @if ($pengajuan->status == 'pending_admin')
                                        <form action="{{ route('admin.pengajuan-ruangan.approve', $pengajuan->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-green-600 hover:bg-green-50 hover:text-green-700 focus:outline-none focus:ring-1 focus:ring-green-600 shadow-sm transition-colors"
                                                title="Setujui">
                                                <i class="fas fa-check text-xs"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pengajuan-ruangan.reject', $pengajuan->id) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-600 shadow-sm transition-colors"
                                                title="Tolak">
                                                <i class="fas fa-times text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tailwind-styled DataTables
            $('#pengajuanTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari pengajuan...",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": {
                        "first": '<i class="fas fa-angle-double-left"></i>',
                        "last": '<i class="fas fa-angle-double-right"></i>',
                        "next": '<i class="fas fa-angle-right"></i>',
                        "previous": '<i class="fas fa-angle-left"></i>'
                    }
                },
                "dom": '<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"ip>'
            });

            // Custom styling for inputs
            $('.dataTables_filter input').addClass(
                'w-full md:w-64 rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 focus:border-zinc-900 text-sm'
            );
            $('.dataTables_length select').addClass(
                'rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 text-sm'
            );
        });
    </script>
@endsection
