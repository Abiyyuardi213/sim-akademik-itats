@extends('layouts.admin')

@section('title', 'Manajemen Kaprodi')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Daftar Kaprodi</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola data Kepala Program Studi di sini.</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.kaprodi.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 disabled:pointer-events-none disabled:opacity-50">
                <i class="fas fa-plus mr-2"></i> Tambah Kaprodi
            </a>
        </div>
    </div>

    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table id="kaprodiTable" class="w-full text-sm text-left">
                <thead class="text-xs text-zinc-500 uppercase bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nama Kaprodi</th>
                        <th class="px-6 py-3 font-medium">NIP</th>
                        <th class="px-6 py-3 font-medium">Prodi</th>
                        <th class="px-6 py-3 font-medium">Kontak</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @foreach ($users as $user)
                        <tr class="hover:bg-zinc-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-9 w-9 rounded-full bg-zinc-100 flex items-center justify-center overflow-hidden border border-zinc-200">
                                        @if ($user->profile_picture)
                                            <img src="{{ asset('uploads/profile/' . $user->profile_picture) }}"
                                                alt="{{ $user->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span
                                                class="font-semibold text-zinc-500 text-xs">{{ substr($user->name, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-medium text-zinc-900">{{ $user->name }}</span>
                                        <span class="text-xs text-zinc-500">{{ $user->username }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-zinc-600">{{ $user->nip ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if ($user->prodi)
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                        {{ $user->prodi->nama_prodi }}
                                    </span>
                                @else
                                    <span class="text-zinc-400 italic">Tidak ada prodi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-zinc-600">
                                <div class="flex flex-col gap-1">
                                    <span class="flex items-center gap-2 text-xs">
                                        <i class="fas fa-envelope text-zinc-400 w-4"></i> {{ $user->email }}
                                    </span>
                                    @if ($user->no_telepon)
                                        <span class="flex items-center gap-2 text-xs">
                                            <i class="fas fa-phone text-zinc-400 w-4"></i> {{ $user->no_telepon }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.kaprodi.show', $user->id) }}"
                                        class="p-2 text-zinc-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kaprodi.edit', $user->id) }}"
                                        class="p-2 text-zinc-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('admin.kaprodi.destroy', $user->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-zinc-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#kaprodiTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                dom: '<"flex flex-col md:flex-row items-center justify-between pb-4 gap-4"lf>rtip',
            });
        });
    </script>
@endsection
