@extends('layouts.admin')

@section('title', 'Tambah Kaprodi')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <nav class="flex text-sm font-medium text-zinc-500 items-center mb-4">
                <a href="{{ route('admin.kaprodi.index') }}" class="hover:text-zinc-900 transition-colors">Daftar Kaprodi</a>
                <span class="mx-2 text-zinc-300">/</span>
                <span class="text-zinc-900">Tambah Baru</span>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Kaprodi Baru</h1>
            <p class="mt-1 text-sm text-zinc-500">Isi formulir berikut untuk menambahkan akun Kepala Program Studi.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200">
                <div class="flex items-center gap-2 text-red-700 font-medium mb-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Terdapat kesalahan pada inputan</span>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.kaprodi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left Column: Primary Info -->
                    <div class="md:col-span-2 space-y-6">
                        <h3 class="text-base font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Informasi Akun</h3>

                        <div class="grid grid-cols-1 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-zinc-700">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border"
                                    placeholder="Cth: Dr. Budi Santoso, M.Kom">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="username" class="block text-sm font-medium text-zinc-700">Username <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                                        required
                                        class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border">
                                </div>

                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-medium text-zinc-700">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border"
                                        placeholder="nama@institusi.ac.id">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-zinc-700">Password <span
                                        class="text-red-500">*</span></label>
                                <input type="password" name="password" id="password" required
                                    class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border">
                                <p class="text-xs text-zinc-500">Minimal 6 karakter.</p>
                            </div>
                        </div>

                        <h3 class="text-base font-semibold text-zinc-900 border-b border-zinc-100 pb-2 pt-4">Informasi
                            Akademik</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="nip" class="block text-sm font-medium text-zinc-700">NIP <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nip" id="nip" value="{{ old('nip') }}" required
                                    class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border">
                            </div>

                            <div class="space-y-2">
                                <label for="prodi_id" class="block text-sm font-medium text-zinc-700">Program Studi <span
                                        class="text-red-500">*</span></label>
                                <select name="prodi_id" id="prodi_id" required
                                    class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border bg-white">
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}"
                                            {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="no_telepon" class="block text-sm font-medium text-zinc-700">Nomor Telepon /
                                WA</label>
                            <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}"
                                class="w-full rounded-md border-zinc-300 shadow-sm focus:border-zinc-900 focus:ring-zinc-900 sm:text-sm py-2 px-3 border">
                        </div>
                    </div>

                    <!-- Right Column: Profile Picture -->
                    <div class="space-y-6">
                        <h3 class="text-base font-semibold text-zinc-900 border-b border-zinc-100 pb-2">Foto Profil</h3>

                        <div class="flex flex-col items-center">
                            <div class="w-full aspect-square bg-zinc-50 rounded-xl border-2 border-dashed border-zinc-300 hover:border-zinc-900 transition-colors flex items-center justify-center overflow-hidden relative group cursor-pointer"
                                onclick="document.getElementById('profile_picture').click()">
                                <!-- Initial Placeholder -->
                                <div id="uploadPlaceholder" class="text-center p-6 text-zinc-400">
                                    <i class="fas fa-camera text-4xl mb-2"></i>
                                    <p class="text-sm font-medium">Upload Foto</p>
                                    <p class="text-xs">Max 2MB</p>
                                </div>

                                <!-- Preview -->
                                <img id="preview" src="#" class="hidden w-full h-full object-cover"
                                    alt="Preview">
                            </div>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                                accept="image/*" onchange="previewImage(event)">
                            <p class="text-xs text-center text-zinc-500 mt-2">Format: JPG, PNG, WebP</p>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-zinc-50 border-t border-zinc-100 flex justify-end gap-3">
                    <a href="{{ route('admin.kaprodi.index') }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-md hover:bg-zinc-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900">
                        Simpan Kaprodi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                const placeholder = document.getElementById('uploadPlaceholder');
                output.src = reader.result;
                output.classList.remove('hidden');
                placeholder.classList.add('hidden');
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
