@extends('layouts.admin')

@section('title', 'Konfirmasi Upload Data')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Konfirmasi Upload Data</h1>
            <p class="mt-1 text-sm text-zinc-500">Tinjau data CSV sebelum disimpan ke database.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.legalisir.index') }}" class="hover:text-zinc-900 transition-colors">Legalisir</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Import Confirm</span>
        </nav>
    </div>

    <form action="{{ route('admin.legalisir.import.confirm') }}" method="POST">
        @csrf
        <input type="hidden" name="data" value="{{ base64_encode(serialize($data)) }}">

        <!-- Table Card -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-zinc-200 bg-zinc-50/50 flex justify-between items-center">
                <h3 class="text-base font-semibold text-zinc-900">Preview Data to Import</h3>
                <span
                    class="inline-flex items-center rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                    {{ count($data) }} Baris Data
                </span>
            </div>

            <div class="p-0">
                <div class="overflow-x-auto">
                    <table id="dataUploadTable" class="w-full text-left text-sm">
                        <thead
                            class="bg-zinc-50 text-zinc-500 uppercase tracking-wider font-medium border-b border-zinc-200">
                            <tr>
                                <th class="px-6 py-3 w-16 text-center">No</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Legal Number</th>
                                <th class="px-6 py-3">Identity</th>
                                <th class="px-6 py-3 text-center">Detail</th>
                                <th class="px-6 py-3 text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 bg-white">
                            @foreach ($data as $index => $row)
                                <tr class="hover:bg-zinc-50/50 transition-colors">
                                    <td class="px-6 py-4 text-center font-medium text-zinc-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-zinc-700 whitespace-nowrap">{{ $row['tanggal'] }}</td>
                                    <td class="px-6 py-4 font-mono text-xs text-zinc-600">{{ $row['no_legalisir'] }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-zinc-900">{{ $row['nama'] }}</span>
                                            <span class="text-xs text-zinc-500">{{ $row['npm'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center text-xs text-zinc-500">
                                        Ijazah: {{ $row['jumlah_ijazah'] }} | Trans: {{ $row['jumlah_transkip'] }} | Lain:
                                        {{ $row['jumlah_lain'] }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold text-zinc-900">
                                        {{ $row['jumlah_total'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.legalisir.index') }}"
                class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                <i class="fas fa-save mr-2"></i> Konfirmasi & Simpan
            </button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            // Tailwind-styled DataTables
            $('#dataUploadTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "search": "",
                    "searchPlaceholder": "Cari data...",
                    "paginate": {
                        "first": '<i class="fas fa-angle-double-left"></i>',
                        "last": '<i class="fas fa-angle-double-right"></i>',
                        "next": '<i class="fas fa-angle-right"></i>',
                        "previous": '<i class="fas fa-angle-left"></i>'
                    }
                },
                "dom": '<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"lf>rt<"flex flex-col md:flex-row justify-between items-center p-4 gap-4"ip>'
            });
            $('.dataTables_filter input').addClass(
                'w-full md:w-64 rounded-md border border-zinc-300 px-3 py-1.5 focus:outline-none focus:ring-1 focus:ring-zinc-900 focus:border-zinc-900 text-sm'
                );
        });
    </script>
@endsection
