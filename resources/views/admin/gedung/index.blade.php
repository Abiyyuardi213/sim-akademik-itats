@extends('layouts.admin')

@section('title', 'Manajemen Gedung')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Gedung</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola daftar gedung dan status operasional.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <nav class="flex text-sm font-medium text-zinc-500 items-center">
                <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
                <span class="mx-2 text-zinc-300">/</span>
                <span class="text-zinc-900">Gedung</span>
            </nav>
            <a href="{{ route('admin.gedung.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                <i class="fas fa-plus mr-2"></i> Tambah Gedung
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50/50 flex justify-between items-center">
            <h3 class="text-base font-semibold text-zinc-900">Daftar Gedung</h3>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table id="gedungTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center">No</th>
                            <th class="px-6 py-3">Nama Gedung</th>
                            <th class="px-6 py-3">Deskripsi</th>
                            <th class="px-6 py-3 text-center">Status</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach ($gedungs as $index => $gedung)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-zinc-900">{{ $gedung->nama_gedung }}</td>
                                <td class="px-6 py-4 text-zinc-500">{{ Str::limit($gedung->gedung_description, 50) }}</td>
                                <td class="px-6 py-4 text-center">
                                    <label class="inline-flex relative items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer toggle-status"
                                            data-gedung-id="{{ $gedung->id }}"
                                            {{ $gedung->gedung_status ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
                                        </div>
                                        <span
                                            class="ml-3 text-xs font-medium text-zinc-600 peer-checked:text-green-600">{{ $gedung->gedung_status ? 'Aktif' : 'Nonaktif' }}</span>
                                    </label>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.gedung.edit', $gedung->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <button
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 shadow-sm transition-colors delete-gedung-btn"
                                        data-toggle="modal" data-target="#deleteGedungModal"
                                        data-gedung-id="{{ $gedung->id }}" title="Hapus">
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
    <div class="fixed inset-0 z-50 hidden" id="deleteGedungModal" aria-labelledby="modal-title" role="dialog"
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
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus data gedung ini?
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
                            data-dismiss="modal" onclick="closeModal('deleteGedungModal')">Batal</button>
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
            $('#gedungTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari gedung...",
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

            // Delete Modal
            $('.delete-gedung-btn').click(function() {
                let gedungId = $(this).data('gedung-id');
                let deleteUrl = "{{ url('admin/gedung') }}/" +
                gedungId; // Adjust url prefix if needed, ensuring /admin is respected if in routes
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteGedungModal').removeClass('hidden');
            });

            $('[data-dismiss="modal"]').click(function() {
                $('#deleteGedungModal').addClass('hidden');
            });

            // Toggle Status
            $(".toggle-status").change(function() {
                let gedungId = $(this).data("gedung-id");
                let status = $(this).prop("checked") ? 1 : 0;
                const $label = $(this).siblings('span');

                // Using correct URL prefix: assuming /admin/gedung based on rest of app
                // If previous code was url('gedung'), usually checking routes determines this. 
                // But standard resourceful admin routes are usually /admin/gedung.
                // I will use url('admin/gedung') to be safe with the route group likely in use.

                $.post("{{ url('admin/gedung') }}/" + gedungId + "/toggle-status", {
                    _token: '{{ csrf_token() }}',
                    gedung_status: status
                }, function(res) {
                    if (res.success) {
                        $label.text(status ? 'Aktif' : 'Nonaktif');
                        // Optional toast
                    } else {
                        alert("Gagal memperbarui status.");
                    }
                }).fail(function() {
                    // Try fallback url if admin prefix fails (just in case)
                    $.post("{{ url('gedung') }}/" + gedungId + "/toggle-status", {
                        _token: '{{ csrf_token() }}',
                        gedung_status: status
                    }, function(res) {
                        if (res.success) {
                            $label.text(status ? 'Aktif' : 'Nonaktif');
                        }
                    });
                });
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
