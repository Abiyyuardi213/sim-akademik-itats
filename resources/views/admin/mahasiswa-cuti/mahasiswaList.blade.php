@extends('layouts.admin')

@section('title', 'Daftar Mahasiswa Cuti')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Manajemen Mahasiswa Cuti</h1>
            <p class="mt-1 text-sm text-zinc-500">Daftar mahasiswa yang mengajukan cuti akademik.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Mahasiswa Cuti</span>
        </nav>
    </div>

    <!-- Table Card -->
    <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
        <div
            class="px-6 py-4 border-b border-zinc-200 bg-zinc-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-base font-semibold text-zinc-900">Daftar Mahasiswa</h3>

            <div class="flex flex-wrap gap-2">
                <!-- Form Import CSV -->
                <form action="{{ route('admin.mahasiswa-cuti.import') }}" method="POST" enctype="multipart/form-data"
                    id="importCsvForm" class="hidden">
                    @csrf
                    <input type="file" name="csv_file" id="csv_file" accept=".csv"
                        onchange="document.getElementById('importCsvForm').submit();">
                </form>
                <button type="button"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors"
                    onclick="document.getElementById('csv_file').click();">
                    <i class="fas fa-upload mr-2 text-zinc-500"></i> Import CSV
                </button>

                <!-- Export CSV -->
                <a href="{{ route('admin.mahasiswa-cuti.export') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-900 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    <i class="fas fa-download mr-2 text-zinc-500"></i> Export CSV
                </a>

                <!-- Tambah Data -->
                <a href="{{ route('admin.mahasiswa-cuti.create') }}"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </a>
            </div>
        </div>

        <div class="p-0">
            <div class="overflow-x-auto">
                <table id="mahasiswaTable" class="w-full text-left text-sm">
                    <thead class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Mahasiswa</th>
                            <th class="px-6 py-3">NPM</th>
                            <th class="px-6 py-3">Nomor Cuti</th>
                            <th class="px-6 py-3">Periode</th>
                            <th class="px-6 py-3">Keterangan</th>
                            <th class="px-6 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100 bg-white">
                        @foreach ($mahasiswas as $index => $mahasiswa)
                            <tr class="hover:bg-zinc-50/50 transition-colors">
                                <td class="px-6 py-4 font-medium text-zinc-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-zinc-900">{{ $mahasiswa->nama_mahasiswa }}</div>
                                    <div class="text-xs text-zinc-500">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-zinc-600">{{ $mahasiswa->npm }}</td>
                                <td class="px-6 py-4 text-zinc-600">{{ $mahasiswa->nomor_cuti }}</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 border border-blue-100">
                                        {{ $mahasiswa->periode ? $mahasiswa->periode->nama_periode : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-zinc-500 italic truncate max-w-xs"
                                    title="{{ $mahasiswa->keterangan }}">
                                    {{ Str::limit($mahasiswa->keterangan, 30) ?: '-' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-1">
                                    <a href="{{ route('admin.mahasiswa-cuti.show', $mahasiswa->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.mahasiswa-cuti.edit', $mahasiswa->id) }}"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-950 shadow-sm transition-colors"
                                        title="Edit">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </a>
                                    <button
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-zinc-200 bg-white text-red-600 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-1 focus:ring-red-500 shadow-sm transition-colors delete-mahasiswa-btn"
                                        data-toggle="modal" data-target="#deleteMahasiswaModal"
                                        data-mahasiswa-id="{{ $mahasiswa->id }}" title="Hapus">
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
    <div class="fixed inset-0 z-50 hidden" id="deleteMahasiswaModal" aria-labelledby="modal-title" role="dialog"
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
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin menghapus data mahasiswa ini?
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
                            data-dismiss="modal" onclick="closeModal('deleteMahasiswaModal')">Batal</button>
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
            $('#mahasiswaTable').DataTable({
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

            // Handle Delete Modal
            $('.delete-mahasiswa-btn').click(function() {
                let mahasiswaId = $(this).data('mahasiswa-id');
                let deleteUrl = "{{ url('admin/mahasiswa-cuti') }}/" + mahasiswaId;
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteMahasiswaModal').removeClass('hidden');
            });

            $('[data-dismiss="modal"]').click(function() {
                $('#deleteMahasiswaModal').addClass('hidden');
            });
        });

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
