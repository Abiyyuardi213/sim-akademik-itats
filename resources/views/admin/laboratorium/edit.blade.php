@extends('layouts.admin')

@section('title', 'Ubah Data Laboratorium')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Ubah Data Laboratorium</h1>
            <p class="mt-1 text-sm text-zinc-500">Perbarui informasi laboratorium dan fasilitas.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.laboratorium.index') }}" class="hover:text-zinc-900 transition-colors">Laboratorium</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Ubah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="max-w-4xl bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-6 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Ubah Data Laboratorium</h3>
            <p class="text-sm text-zinc-500">Edit detail informasi laboratorium di bawah ini.</p>
        </div>

        <form action="{{ route('admin.laboratorium.update', $laboratorium->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label for="gedung_id" class="text-sm font-medium leading-none text-zinc-900">Gedung</label>
                        <div class="relative">
                            <select id="gedung_id" name="gedung_id" required
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="">-- Pilih Gedung --</option>
                                @foreach ($gedungs as $gedung)
                                    <option value="{{ $gedung->id }}"
                                        {{ old('gedung_id', $laboratorium->gedung_id) == $gedung->id ? 'selected' : '' }}>
                                        {{ $gedung->nama_gedung }}
                                    </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="nama_laboratorium" class="text-sm font-medium leading-none text-zinc-900">Nama
                            Laboratorium</label>
                        <input type="text" id="nama_laboratorium" name="nama_laboratorium"
                            value="{{ old('nama_laboratorium', $laboratorium->nama_laboratorium) }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-5">
                    <div class="space-y-2">
                        <label for="kapasitas" class="text-sm font-medium leading-none text-zinc-900">Kapasitas
                            (Orang)</label>
                        <input type="number" id="kapasitas" name="kapasitas"
                            value="{{ old('kapasitas', $laboratorium->kapasitas) }}" required
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-sm font-medium leading-none text-zinc-900">Status
                            Laboratorium</label>
                        <div class="relative">
                            <select id="status" name="status"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 appearance-none">
                                <option value="1" {{ old('status', $laboratorium->status) == 1 ? 'selected' : '' }}>
                                    Siap
                                    Digunakan
                                </option>
                                <option value="0" {{ old('status', $laboratorium->status) == 0 ? 'selected' : '' }}>
                                    Maintenance
                                </option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="gambar" class="text-sm font-medium leading-none text-zinc-900">Foto Ruangan
                            (Opsional)</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                            class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-500 file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @if ($laboratorium->gambar)
                            <div class="mt-2 text-sm text-zinc-500">
                                Gambar saat ini: <a href="{{ asset('uploads/laboratorium/' . $laboratorium->gambar) }}"
                                    target="_blank" class="text-blue-600 hover:underline">Lihat Gambar</a>
                            </div>
                        @endif
                        @error('gambar')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        <div class="mt-2">
                            <img id="preview-img" src="#" alt="Preview"
                                class="hidden max-h-48 rounded-lg border border-zinc-200 shadow-sm object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label for="keterangan" class="text-sm font-medium leading-none text-zinc-900">Keterangan Tambahan</label>
                <textarea id="keterangan" name="keterangan" rows="3"
                    class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">{{ old('keterangan', $laboratorium->keterangan) }}</textarea>
            </div>

            <div class="pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.laboratorium.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    Batal
                </a>
                <button type="button" id="submitBtn"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const gambarInput = document.getElementById('gambar');
        const previewImg = document.getElementById('preview-img');
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');

        gambarInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const file = files[0];
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewImg.classList.remove('hidden');

                    if (cropper) cropper.destroy();

                    cropper = new Cropper(previewImg, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                        movable: true,
                        zoomable: true,
                        rotatable: true,
                        scalable: true,
                        autoCropArea: 0.8,
                    });
                }
                reader.readAsDataURL(file);
            }
        });

        submitBtn.addEventListener('click', function(e) {
            if (cropper) {
                e.preventDefault();
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
                submitBtn.disabled = true;

                cropper.getCroppedCanvas().toBlob((blob) => {
                    const fileInput = new File([blob], gambarInput.files[0].name, {
                        type: 'image/jpeg'
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(fileInput);
                    gambarInput.files = dataTransfer.files;

                    form.submit();
                }, 'image/jpeg', 0.8);
            } else {
                form.submit();
            }
        });
    </script>
@endsection
