@extends('layouts.admin')

@section('title', 'Ubah Data Legalisir')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Ubah Data Legalisir</h1>
            <p class="mt-1 text-sm text-zinc-500">Perbarui data legalisir yang sudah ada.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.legalisir.index') }}" class="hover:text-zinc-900 transition-colors">Legalisir</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Ubah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Update Data</h3>
            <p class="text-sm text-zinc-500">Sesuaikan informasi di bawah ini.</p>
        </div>

        <form action="{{ route('admin.legalisir.update', $legalisir->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Kolom Kiri: Identitas -->
                <div class="space-y-5">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Informasi Dokumen &
                        Mahasiswa</h4>

                    <div class="space-y-2">
                        <label for="tanggal" class="text-sm font-medium leading-none text-zinc-900">Tanggal
                            Legalisir</label>
                        <input type="date" id="tanggal" name="tanggal"
                            value="{{ old('tanggal', $legalisir->tanggal) }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="no_legalisir" class="text-sm font-medium leading-none text-zinc-900">Nomor Surat /
                            Legalisir</label>
                        <input type="text" id="no_legalisir" name="no_legalisir"
                            value="{{ old('no_legalisir', $legalisir->no_legalisir) }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="nama" class="text-sm font-medium leading-none text-zinc-900">Nama Mahasiswa</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $legalisir->nama) }}"
                            required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="npm" class="text-sm font-medium leading-none text-zinc-900">NPM</label>
                        <input type="text" id="npm" name="npm" value="{{ old('npm', $legalisir->npm) }}"
                            required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>
                </div>

                <!-- Kolom Kanan: Jumlah Dokumen -->
                <div class="space-y-5">
                    <h4 class="text-sm font-medium text-zinc-900 border-b border-zinc-100 pb-2">Rincian Dokumen</h4>

                    <div class="space-y-2">
                        <label for="jumlah_ijazah" class="text-sm font-medium leading-none text-zinc-900">Jumlah
                            Ijazah</label>
                        <input type="number" id="jumlah_ijazah" name="jumlah_ijazah"
                            value="{{ old('jumlah_ijazah', $legalisir->jumlah_ijazah) }}" min="0"
                            oninput="hitungTotal()"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="jumlah_transkip" class="text-sm font-medium leading-none text-zinc-900">Jumlah
                            Transkrip</label>
                        <input type="number" id="jumlah_transkip" name="jumlah_transkip"
                            value="{{ old('jumlah_transkip', $legalisir->jumlah_transkip) }}" min="0"
                            oninput="hitungTotal()"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="jumlah_lain" class="text-sm font-medium leading-none text-zinc-900">Dokumen
                            Lainnya</label>
                        <input type="number" id="jumlah_lain" name="jumlah_lain"
                            value="{{ old('jumlah_lain', $legalisir->jumlah_lain) }}" min="0" oninput="hitungTotal()"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2 p-4 bg-zinc-50 rounded-lg border border-zinc-100">
                        <label for="jumlah_total" class="text-sm font-semibold leading-none text-zinc-900">Total
                            Keseluruhan</label>
                        <input type="number" id="jumlah_total" name="jumlah_total"
                            value="{{ old('jumlah_total', $legalisir->jumlah_total) }}" readonly
                            class="flex h-10 w-full rounded-md border-0 bg-transparent px-0 py-2 text-xl font-bold text-zinc-900 focus:ring-0">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.legalisir.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function hitungTotal() {
            const ijazah = parseInt(document.getElementById('jumlah_ijazah').value) || 0;
            const transkip = parseInt(document.getElementById('jumlah_transkip').value) || 0;
            const lain = parseInt(document.getElementById('jumlah_lain').value) || 0;

            const total = ijazah + transkip + lain;
            document.getElementById('jumlah_total').value = total;
        }
    </script>
@endsection
