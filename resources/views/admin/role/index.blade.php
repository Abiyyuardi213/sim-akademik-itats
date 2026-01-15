@extends('layouts.admin')

@section('title', 'Manajemen Peran')

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
    </style>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Peran</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola data peran (role) pengguna dan hak akses sistem.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Peran</span>
        </nav>
    </div>

    <!-- Actions Toolbar -->
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.role.create') }}"
            class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus:ring-zinc-950 transition-colors">
            <i class="fas fa-plus mr-2"></i> Tambah Peran
        </a>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div class="p-0">
            <div class="overflow-x-auto">
                <table id="roleTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center">No</th>
                            <th class="px-6 py-3 w-20">ID</th>
                            <th class="px-6 py-3">Nama Peran</th>
                            <th class="px-6 py-3">Deskripsi</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @forelse($roles as $index => $role)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-mono text-xs text-zinc-500">{{ $role->id }}</td>
                                <td class="px-6 py-4 font-medium text-zinc-900">
                                    <div class="flex items-center gap-2">
                                        {{ $role->role_name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-zinc-500">{{ Str::limit($role->role_description, 60) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="toggleStatus('{{ $role->id }}')"
                                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 {{ $role->role_status ? 'bg-zinc-900' : 'bg-zinc-200' }}"
                                        role="switch" aria-checked="{{ $role->role_status ? 'true' : 'false' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span aria-hidden="true"
                                            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $role->role_status ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.role.edit', $role->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <button
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 shadow-sm transition-colors"
                                        onclick="openDeleteModal('{{ $role->id }}')" title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-user-shield text-4xl text-zinc-300 mb-3"></i>
                                        <p>Belum ada data peran.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-zinc-100 bg-zinc-50/50 flex justify-between items-center">
            <span class="text-xs text-zinc-500">Total Peran: <span
                    class="font-medium text-zinc-900">{{ $roles->count() }}</span></span>
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
                                <h3 class="text-base font-semibold leading-6 text-zinc-900" id="modal-title">Hapus Peran
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus peran ini? Pastikan
                                        tidak ada pengguna yang sedang menggunakan peran ini. Tindakan ini tidak dapat
                                        dibatalkan.</p>
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
            // Tailwind-styled DataTables
            $('#roleTable').DataTable({
                "paging": true,
                "stateSave": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari peran...",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "zeroRecords": "Tidak ada data yang cocok",
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

        function openDeleteModal(id) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = "{{ url('admin/role') }}/" + id;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }

        function toggleStatus(id) {
            fetch(`{{ url('admin/role') }}/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        showToast('Gagal update status', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Terjadi kesalahan', 'error');
                });
        }
    </script>
@endsection
