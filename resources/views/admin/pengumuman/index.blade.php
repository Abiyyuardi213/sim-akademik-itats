@extends('layouts.admin')

@section('title', 'Manajemen Pengumuman')

@section('content')
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Pengumuman</h1>
                <p class="mt-2 text-sm text-zinc-500">Kelola pengumuman dan informasi penting untuk pengguna.</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{ route('admin.pengumuman.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 sm:w-auto transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Pengumuman
                </a>
            </div>
        </div>

        <!-- Table Card -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 border-b border-zinc-200">
                        <tr>
                            <th class="h-12 px-4 font-medium text-zinc-500 w-16 text-center">No</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Judul</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Konten Preview</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Status</th>
                            <th class="h-12 px-4 font-medium text-zinc-500">Tanggal Dibuat</th>
                            <th class="h-12 px-4 font-medium text-zinc-500 w-32 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @forelse($pengumumans as $index => $item)
                            <tr class="hover:bg-zinc-50/50 transition-colors group">
                                <td class="p-4 text-center font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="p-4">
                                    <span class="font-semibold text-zinc-900 block">{{ $item->judul }}</span>
                                    <span class="text-xs text-zinc-500">Oleh: {{ $item->author->name ?? 'Admin' }}</span>
                                </td>
                                <td class="p-4 text-zinc-600 max-w-xs truncate">
                                    {{ Str::limit(strip_tags($item->isi), 50) }}
                                </td>
                                <td class="p-4">
                                    @if ($item->status === 'published')
                                        <span
                                            class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                            Published
                                        </span>
                                    @elseif($item->status === 'draft')
                                        <span
                                            class="inline-flex items-center rounded-full bg-zinc-50 px-2 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                                            Draft
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                                            Archived
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-zinc-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal_dibuat)->translatedFormat('d M Y H:i') }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.pengumuman.show', $item->id) }}"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-400 hover:border-zinc-300 hover:text-zinc-900 shadow-sm transition-all"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        <a href="{{ route('admin.pengumuman.edit', $item->id) }}"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-400 hover:border-blue-300 hover:text-blue-600 shadow-sm transition-all"
                                            title="Edit">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                        <button type="button" onclick="confirmDelete('{{ $item->id }}')"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-400 hover:border-red-300 hover:text-red-600 shadow-sm transition-all"
                                            title="Hapus">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-zinc-500">
                                        <div
                                            class="h-12 w-12 rounded-full bg-zinc-100 flex items-center justify-center mb-3">
                                            <i class="fas fa-bullhorn text-xl text-zinc-400"></i>
                                        </div>
                                        <h3 class="font-medium text-zinc-900">Belum ada pengumuman</h3>
                                        <p class="text-sm mt-1">Silakan tambahkan pengumuman baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
