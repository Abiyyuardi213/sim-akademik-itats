@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Tambah Pengguna Baru</h1>
            <p class="mt-1 text-sm text-zinc-500">Buat akun pengguna baru dan atur hak aksesnya.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <a href="{{ route('admin.user.index') }}" class="hover:text-zinc-900 transition-colors">Pengguna</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Tambah</span>
        </nav>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-6 sm:p-8">
        <div class="mb-8 border-b border-zinc-100 pb-4">
            <h3 class="text-lg font-semibold text-zinc-900">Form Tambah Pengguna</h3>
            <p class="text-sm text-zinc-500">Lengkapi informasi pengguna di bawah ini.</p>
        </div>

        @if (session('error'))
            <div class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-500"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <!-- Left Column: Form Fields -->
            <div class="lg:col-span-2 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="name" class="text-sm font-medium leading-none text-zinc-900">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            placeholder="Contoh: Budi Santoso"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @error('name')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="username" class="text-sm font-medium leading-none text-zinc-900">Username <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                            placeholder="budi_s"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @error('username')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="email" class="text-sm font-medium leading-none text-zinc-900">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="email@example.com"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @error('email')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="no_telepon" class="text-sm font-medium leading-none text-zinc-900">No. Telepon</label>
                        <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                            placeholder="08123456789"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @error('no_telepon')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-sm font-medium leading-none text-zinc-900">Password <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                        @error('password')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="role_id" class="text-sm font-medium leading-none text-zinc-900">Role <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select id="role_id" name="role_id" required
                                class="flex h-10 w-full items-center justify-between rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 appearance-none"
                                onchange="toggleKaprodiFields()">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" data-rolename="{{ strtolower($role->role_name) }}"
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <i class="fas fa-chevron-down text-zinc-400 text-xs"></i>
                            </div>
                        </div>
                        @error('role_id')
                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kaprodi Fields (Hidden by default) -->
                    <div id="kaprodiFields" class="col-span-1 md:col-span-2 hidden space-y-6 pt-4 border-t border-zinc-100">
                        <div class="flex items-center gap-2">
                            <h4 class="text-sm font-semibold text-zinc-900">Informasi Akademik (Kaprodi)</h4>
                            <span class="text-xs text-zinc-500 bg-zinc-100 px-2 py-0.5 rounded-full">Khusus Kaprodi</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="prodi_id" class="text-sm font-medium leading-none text-zinc-900">Program Studi
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select id="prodi_id" name="prodi_id"
                                        class="flex h-10 w-full items-center justify-between rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 appearance-none">
                                        <option value="">-- Pilih Program Studi --</option>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}"
                                                {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                                {{ $prodi->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                        <i class="fas fa-chevron-down text-zinc-400 text-xs"></i>
                                    </div>
                                </div>
                                @error('prodi_id')
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="nip" class="text-sm font-medium leading-none text-zinc-900">NIP <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="nip" name="nip" value="{{ old('nip') }}"
                                    placeholder="Nomor Induk Pegawai"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                @error('nip')
                                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Profile Picture -->
            <div class="flex flex-col items-center space-y-4 pt-2">
                <label class="block text-sm font-medium text-zinc-900 self-start">Foto Profil</label>
                <div class="w-full aspect-square bg-zinc-50 rounded-xl border-2 border-dashed border-zinc-300 hover:border-zinc-900 transition-colors flex items-center justify-center overflow-hidden relative group cursor-pointer"
                    onclick="document.getElementById('profile_picture').click()">
                    <!-- Initial Placeholder -->
                    <div id="uploadPlaceholder" class="text-center p-6 text-zinc-400">
                        <i class="fas fa-cloud-upload-alt text-4xl mb-2"></i>
                        <p class="text-sm font-medium">Klik untuk upload</p>
                        <p class="text-xs">JPG, PNG (Max 2MB)</p>
                    </div>

                    <!-- Preview -->
                    <img id="preview" src="#" class="hidden w-full h-full object-cover" alt="Preview">
                </div>
                <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*"
                    onchange="previewImage(event)">
                @error('profile_picture')
                    <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="lg:col-span-3 pt-6 border-t border-zinc-100 flex items-center gap-3 justify-end">
                <a href="{{ route('admin.user.index') }}"
                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
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
            reader.readAsDataURL(event.target.files[0]);
        }

        function toggleKaprodiFields() {
            const roleSelect = document.getElementById('role_id');
            const kaprodiFields = document.getElementById('kaprodiFields');
            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            const roleName = selectedOption.getAttribute('data-rolename');

            if (roleName && (roleName.includes('kaprodi') || roleName.includes('kepala program studi'))) {
                kaprodiFields.classList.remove('hidden');
                document.getElementById('prodi_id').setAttribute('required', 'required');
                document.getElementById('nip').setAttribute('required', 'required');
            } else {
                kaprodiFields.classList.add('hidden');
                document.getElementById('prodi_id').removeAttribute('required');
                document.getElementById('nip').removeAttribute('required');
                // Clear values when hidden
                document.getElementById('prodi_id').value = "";
                document.getElementById('nip').value = "";
            }
        }

        // Run on load in case of validation error redirect
        document.addEventListener('DOMContentLoaded', function() {
            toggleKaprodiFields();
        });
    </script>
@endsection
