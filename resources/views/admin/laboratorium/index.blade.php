@extends('layouts.admin')

@section('title', 'Manajemen Laboratorium')

@section('styles')
    <style>
        /* Custom DataTables Pagination Styling */
        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            justify-content: flex-end;
            gap: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            color: #52525b;
            background-color: #ffffff;
            border: 1px solid #e4e4e7;
            border-radius: 0.375rem;
            cursor: pointer;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #18181b;
            background-color: #f4f4f5;
            border-color: #d4d4d8;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #ffffff !important;
            background-color: #18181b !important;
            border-color: #18181b !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            color: #a1a1aa;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            box-shadow: none;
        }

        .dataTables_wrapper .dataTables_info {
            color: #71717a;
            font-size: 0.875rem;
        }

        td.dataTables_empty {
            text-align: center;
            padding: 3rem !important;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Laboratorium</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola data laboratorium dan fasilitas praktikum.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <nav class="flex text-sm font-medium text-zinc-500 items-center">
                <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
                <span class="mx-2 text-zinc-300">/</span>
                <span class="text-zinc-900">Laboratorium</span>
            </nav>
            <a href="{{ route('admin.laboratorium.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                <i class="fas fa-plus mr-2"></i> Tambah Lab
            </a>
        </div>
    </div>

    <!-- Filters & Table -->
    <div class="space-y-4">
        <!-- Filter Card -->
        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-4">
            <form method="GET" action="{{ route('admin.laboratorium.index') }}"
                class="flex flex-col sm:flex-row items-center gap-3">
                <label for="filter_gedung" class="text-sm font-medium text-zinc-700 whitespace-nowrap">Filter
                    Gedung:</label>
                <div class="relative w-full sm:w-64">
                    <select name="gedung_id" id="filter_gedung"
                        class="flex h-9 w-full rounded-md border border-zinc-200 bg-white px-3 py-1 text-sm shadow-sm transition-colors cursor-pointer focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 appearance-none">
                        <option value="">-- Semua Gedung --</option>
                        @foreach ($gedungs as $gedung)
                            <option value="{{ $gedung->id }}" {{ request('gedung_id') == $gedung->id ? 'selected' : '' }}>
                                {{ $gedung->nama_gedung }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-zinc-100 px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-200/80 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors w-full sm:w-auto">
                    Terapkan
                </button>
            </form>
        </div>

        <!-- Table Card -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table id="labTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center">No</th>
                            <th class="px-6 py-3">Nama Lab</th>
                            <th class="px-6 py-3">Gedung</th>
                            <th class="px-6 py-3">Kapasitas</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach ($laboratoriums as $index => $lab)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-zinc-900">{{ $lab->nama_laboratorium }}</td>
                                <td class="px-6 py-4 text-zinc-600">{{ $lab->gedung->nama_gedung ?? '-' }}</td>
                                <td class="px-6 py-4 text-zinc-600">{{ $lab->kapasitas }} Orang</td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer toggle-status"
                                            data-id="{{ $lab->id }}" {{ $lab->status ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                        </div>
                                        <span
                                            class="ml-3 text-xs font-medium text-zinc-600 peer-checked:text-green-600 w-20 text-left">{{ $lab->status ? 'Siap' : 'Maint.' }}</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.laboratorium.show', $lab->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-blue-600 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.laboratorium.edit', $lab->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <button
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 shadow-sm transition-colors delete-lab-btn"
                                        data-id="{{ $lab->id }}" title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="fixed inset-0 z-50 hidden" id="deleteModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-zinc-200">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-zinc-900" id="modal-title">Konfirmasi
                                    Hapus</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus laboratorium ini?
                                        Tindakan ini tidak dapat dibatalkan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="deleteForm" method="POST" class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                        <button type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto"
                            onclick="closeDeleteModal()">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#labTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari laboratorium...",
                    "emptyTable": "<div class='flex flex-col items-center justify-center text-zinc-500'><i class='fas fa-flask text-4xl mb-3 text-zinc-300'></i><p class='font-medium'>Belum ada data laboratorium.</p></div>"
                },
                "dom": '<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"ip>'
            });

            @if (session('new_entry_created'))
                table.page('last').draw(false);
            @endif

            $('.dataTables_filter input').addClass(
                'w-full md:w-64 rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 focus:border-zinc-900 text-sm'
                );
            $('.dataTables_length select').addClass(
                'rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 text-sm'
                );

            $('.delete-lab-btn').click(function() {
                let id = $(this).data('id');
                let deleteUrl = "{{ url('admin/laboratorium') }}/" + id;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteModal').removeClass('hidden');
            });

            $(document).on("change", ".toggle-status", function() {
                let id = $(this).data("id");
                let status = $(this).prop("checked") ? 1 : 0;
                const $label = $(this).siblings('span');
                const $checkbox = $(this);

                $.post("{{ url('admin/laboratorium') }}/" + id + "/toggle-status", {
                    _token: '{{ csrf_token() }}',
                    status: status
                }, function(res) {
                    if (res.success) {
                        $label.text(status ? 'Siap' : 'Maint.');
                        $label.toggleClass('text-green-600', status).toggleClass('text-zinc-600', !
                            status);
                    } else {
                        $checkbox.prop('checked', !status);
                        alert('Gagal: ' + res.message);
                    }
                }).fail(function(xhr) {
                    console.error(xhr);
                    $checkbox.prop('checked', !status);
                    alert('Terjadi kesalahan sistem.');
                });
            });
        });

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
@endsection
