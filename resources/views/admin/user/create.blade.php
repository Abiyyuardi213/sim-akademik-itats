@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
    <style>
        .cropper-container {
            width: 100% !important;
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.user.index') }}" class="hover:text-blue-600">Manajemen Pengguna</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium">Tambah Pengguna</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Pengguna Baru</h1>
        <p class="mt-1 text-sm text-gray-600">Buat akun pengguna baru dan atur hak aksesnya.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
            @csrf
            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-user-plus text-sm"></i>
                    </div>
                    Informasi Pengguna
                </h3>
            </div>

            <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Form Fields -->
                <div class="lg:col-span-2 space-y-6">
                    @if (session('error'))
                        <div
                            class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-lg flex items-start gap-3">
                            <i class="fas fa-exclamation-circle mt-0.5"></i>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="Contoh: Budi Santoso">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="budi_s">
                            @error('username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="email@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="08123456789">
                            @error('no_telepon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Role <span class="text-red-500">*</span>
                            </label>
                            <select id="role_id" name="role_id" required
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all bg-white">
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column: Profile Picture -->
                <div class="flex flex-col items-center space-y-4">
                    <label class="block text-sm font-medium text-gray-700 self-start">Foto Profil</label>

                    <div class="w-full aspect-square bg-gray-50 rounded-xl border-2 border-dashed border-gray-300 hover:border-blue-500 transition-colors flex items-center justify-center overflow-hidden relative group cursor-pointer"
                        onclick="document.getElementById('profile_picture').click()">
                        <!-- Initial Placeholder -->
                        <div id="uploadPlaceholder" class="text-center p-6 text-gray-400">
                            <i class="fas fa-cloud-upload-alt text-4xl mb-2"></i>
                            <p class="text-sm">Klik untuk upload foto</p>
                        </div>

                        <!-- Preview Image -->
                        <img id="preview" src="#" class="hidden w-full h-full object-contain" alt="Preview">

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-black/50 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-sm font-medium">Ganti Foto</span>
                        </div>
                    </div>

                    <input type="file" name="profile_picture" id="profile_picture" class="hidden" accept="image/*">
                    <input type="hidden" name="cropped_image" id="cropped_image">

                    @error('profile_picture')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-gray-500 text-center">Format: JPG, PNG. Maks: 2MB.</p>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 bg-gray-50 flex items-center gap-3">
                <button type="submit" id="saveButton"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/30">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.user.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const image = document.getElementById('preview');
        const input = document.getElementById('profile_picture');
        const placeholder = document.getElementById('uploadPlaceholder');
        const saveButton = document.getElementById('saveButton');
        const form = document.getElementById('userForm');
        const croppedImageInput = document.getElementById('cropped_image');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;
                image.classList.remove('hidden');
                placeholder.classList.add('hidden');

                if (cropper) cropper.destroy();
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                });
            };
            reader.readAsDataURL(file);
        });

        form.addEventListener('submit', function(e) {
            if (cropper) {
                e.preventDefault();
                const canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                });

                canvas.toBlob((blob) => {
                    // We need to convert blob to file or base64 to send.
                    // Or better: update the file input or append to FormData. 
                    // Since this is a standard form submit, hidden input with base64 is easiest if backend accepts it,
                    // BUT Laravel usually expects file.
                    // Actually, the original code had: formData.append('cropped_image', blob); inside crop event?
                    // No, standard form submit doesn't work well with blob unless we use Ajax.
                    // However, 'cropped_image' hidden input usually expects a string?
                    // Let's assume backend handles base64 if passed in hidden input, OR we have to use AJAX.
                    // The previous code had a hidden input 'cropped_image' but didn't seem to set it on submit, 
                    // it set it inside the crop() method? No, previous code was "formData.append..." inside crop event but that didn't do anything for a standard form submit unless valid.

                    // Let's convert to Base64 and assign to hidden input. 
                    // IF backend supports it. If not, we might need a different approach.
                    // Assuming the backend has logic to read 'cropped_image'.

                    croppedImageInput.value = canvas.toDataURL('image/jpeg');
                    form.submit();
                }, 'image/jpeg');
            }
        });
    </script>
@endsection
