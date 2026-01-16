@extends('layouts.admin')

@section('title', 'Periode Cuti')

@section('content')
    <!-- Page Header -->
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
            /* zinc-600 */
            background-color: #ffffff;
            border: 1px solid #e4e4e7;
            /* zinc-200 */
            border-radius: 0.375rem;
            cursor: pointer;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #18181b;
            /* zinc-900 */
            background-color: #f4f4f5;
            /* zinc-50 */
            border-color: #d4d4d8;
            /* zinc-300 */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #ffffff !important;
            background-color: #18181b !important;
            /* zinc-900 */
            border-color: #18181b !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            color: #a1a1aa;
            /* zinc-400 */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:active {
            box-shadow: none;
        }

        /* Remove default DataTables styling if any */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f4f4f5;
            /* zinc-50 */
            color: #18181b;
            /* zinc-900 */
            border: 1px solid #d4d4d8;
            /* zinc-300 */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: #18181b;
            /* zinc-900 */
            color: #ffffff;
            border: 1px solid #18181b;
        }

        .dataTables_wrapper .dataTables_info {
            color: #71717a;
            /* zinc-500 */
            font-size: 0.875rem;
        }

        /* Styling for empty table message */
        td.dataTables_empty {
            text-align: center;
            padding: 3rem !important;
        }
    </style>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Periode Cuti</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola daftar periode cuti akademik.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <nav class="flex text-sm font-medium text-zinc-500 items-center">
                <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
                <span class="mx-2 text-zinc-300">/</span>
                <span class="text-zinc-900">Periode Cuti</span>
            </nav>
            <a href="{{ route('admin.periode.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                <i class="fas fa-plus mr-2"></i> Tambah Periode
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div
            class="px-6 py-4 border-b border-zinc-200 bg-zinc-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h3 class="text-base font-semibold text-zinc-900">Daftar Periode</h3>
            <!-- Search Placeholder (Datatables will handle search, but good to have structure) -->
            <div class="relative max-w-xs w-full">
                <!-- Search input handled by DataTables usually, but for custom Shadcn feel we might wrap DataTables controls or leave as is.
                             Since we rely on DataTables, we will initialize it to target a clean table.
                        -->
            </div>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table id="periodeTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">ID Periode</th>
                            <th class="px-6 py-3">Nama Periode</th>
                            <th class="px-6 py-3">Awal Cuti</th>
                            <th class="px-6 py-3">Akhir Cuti</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach ($periodes as $index => $periode)
                            <tr class="hover:bg-zinc-50/50 transition-colors group">
                                <td class="px-6 py-4 font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="font-mono text-xs bg-zinc-100 px-2 py-1 rounded text-zinc-600">{{ Str::limit($periode->id, 8, '...') }}</span>
                                        <button class="text-zinc-400 hover:text-zinc-600 copy-id-btn transition-colors"
                                            data-id="{{ $periode->id }}" title="Salin ID">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium text-zinc-800">{{ $periode->nama_periode }}</td>
                                <td class="px-6 py-4 text-zinc-600">{{ $periode->awal_cuti }}</td>
                                <td class="px-6 py-4 text-zinc-600">{{ $periode->akhir_cuti }}</td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer toggle-status"
                                            data-periode-id="{{ $periode->id }}"
                                            {{ $periode->periode_status ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                        </div>
                                        <span
                                            class="ml-3 text-xs font-medium text-zinc-600 peer-checked:text-green-600">{{ $periode->periode_status ? 'Aktif' : 'Nonaktif' }}</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.periode.show', $periode->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.periode.edit', $periode->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <button
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 shadow-sm transition-colors delete-periode-btn"
                                        data-toggle="modal" data-target="#deletePeriodeModal"
                                        data-periode-id="{{ $periode->id }}" title="Hapus">
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
    <div class="fixed inset-0 z-50 hidden" id="deletePeriodeModal" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
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
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus periode ini? Tindakan
                                        ini tidak dapat dibatalkan.</p>
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
                            data-dismiss="modal" onclick="closeModal('deletePeriodeModal')">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- jQuery is already loaded in layouts.admin, needed for DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tailwind-styled DataTables
            $('#periodeTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari data...",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "zeroRecords": "<div class='flex flex-col items-center justify-center text-zinc-500'><i class='fas fa-search-minus text-4xl mb-2 text-zinc-300'></i><p>Tidak ada data yang cocok.</p></div>",
                    "emptyTable": "<div class='flex flex-col items-center justify-center text-zinc-500'><i class='fas fa-calendar-times text-4xl mb-3 text-zinc-300'></i><p class='font-medium'>Belum ada data periode.</p></div>",
                    "paginate": {
                        "first": '<i class="fas fa-angle-double-left"></i>',
                        "last": '<i class="fas fa-angle-double-right"></i>',
                        "next": '<i class="fas fa-angle-right"></i>',
                        "previous": '<i class="fas fa-angle-left"></i>'
                    }
                },
                "dom": '<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"ip>'
            });

            // Custom styling for DataTables inputs
            $('.dataTables_filter input').addClass(
                'w-full md:w-64 rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 focus:border-zinc-900 text-sm'
            );
            $('.dataTables_length select').addClass(
                'rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 text-sm'
            );

            // Handle Delete Modal
            $('.delete-periode-btn').click(function() {
                let periodeId = $(this).data('periode-id');
                let deleteUrl = "{{ url('admin/periode') }}/" + periodeId;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deletePeriodeModal').removeClass('hidden'); // Show tailwind modal
            });

            // Handle close modal (custom since we are not using bootstrap js for this modal structure fully)
            $('[data-dismiss="modal"]').click(function() {
                $('#deletePeriodeModal').addClass('hidden');
            });
        });

        // Copy ID
        $('.copy-id-btn').click(function() {
            const id = $(this).data('id');
            navigator.clipboard.writeText(id)
                .then(() => {
                    // Toast handled by backend session or custom JS, reusing existing if available
                    // Ideally we replace this with a simple alert or reuse the Toast component
                    alert("ID disalin: " + id);
                })
                .catch(() => {
                    console.error("Gagal menyalin ID");
                });
        });

        // Toggle Status
        $(".toggle-status").change(function() {
            let periodeId = $(this).data("periode-id");
            let status = $(this).prop("checked") ? 1 : 0;
            const $label = $(this).siblings('span');

            $.post("{{ url('admin/periode') }}/" + periodeId + "/toggle-status", {
                _token: '{{ csrf_token() }}',
                periode_status: status
            }, function(res) {
                if (res.success) {
                    $label.text(status ? 'Aktif' : 'Nonaktif');
                    // Optional: Show success toast
                } else {
                    alert("Gagal memperbarui status.");
                }
            }).fail(function() {
                alert("Terjadi kesalahan.");
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
