@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Edit Pengumuman</h1>
            <a href="{{ route('admin.pengumuman.index') }}"
                class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                &larr; Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm p-6 md:p-8">
            <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="space-y-2">
                    <label for="judul" class="text-sm font-medium text-zinc-900">Judul Pengumuman</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $pengumuman->judul) }}"
                        required
                        class="block w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 placeholder-zinc-400 focus:border-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-900 transition-colors shadow-sm"
                        placeholder="Contoh: Jadwal Libur Semester Genap">
                    @error('judul')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="text-sm font-medium text-zinc-900">Status Publikasi</label>
                    <select id="status" name="status"
                        class="block w-full rounded-lg border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-900 focus:border-zinc-900 focus:outline-none focus:ring-1 focus:ring-zinc-900 shadow-sm">
                        <option value="draft" {{ old('status', $pengumuman->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $pengumuman->status) == 'published' ? 'selected' : '' }}>
                            Published</option>
                        <option value="archived" {{ old('status', $pengumuman->status) == 'archived' ? 'selected' : '' }}>
                            Archived</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Isi (Trix Editor) -->
                <div class="space-y-2">
                    <label for="isi" class="text-sm font-medium text-zinc-900">Konten Pengumuman</label>
                    <input id="isi" type="hidden" name="isi" value="{{ old('isi', $pengumuman->isi) }}">
                    <trix-editor input="isi"
                        class="trix-content min-h-[300px] border-zinc-200 rounded-lg focus:border-zinc-900 focus:ring-zinc-900"></trix-editor>
                    @error('isi')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.pengumuman.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Trix Editor CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar .trix-button-group {
            margin-bottom: 0.5rem;
            border-color: #e4e4e7;
        }

        trix-toolbar .trix-button {
            border-bottom: 2px solid transparent;
        }

        trix-toolbar .trix-button--active {
            background: #f4f4f5;
            color: #18181b;
        }

        trix-editor {
            border: 1px solid #e4e4e7;
            border-radius: 0.5rem;
            padding: 1rem;
            background-color: white;
            min-height: 300px;
        }

        trix-editor:focus {
            outline: none;
            border-color: #18181b;
            box-shadow: 0 0 0 1px #18181b;
        }
    </style>
@endsection
