@extends('layouts.admin')

@section('title', 'Profil Saya')

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
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Profil Saya</h1>
            <p class="mt-1 text-sm text-zinc-500">Kelola informasi profil dan keamanan akun Anda.</p>
        </div>
        <nav class="flex text-sm font-medium text-zinc-500 items-center">
            <a href="{{ url('admin/dashboard') }}" class="hover:text-zinc-900 transition-colors">Home</a>
            <span class="mx-2 text-zinc-300">/</span>
            <span class="text-zinc-900">Profil</span>
        </nav>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Form Binding -->
        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
            <!-- Banner -->
            <div class="h-32 bg-zinc-900/5 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-zinc-100 to-white opacity-50"></div>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
                id="profileForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="cropped_image" id="cropped_image">

                <div class="px-8 pb-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Left: Profile Picture -->
                        <div class="-mt-12 flex flex-col items-center z-10">
                            <div class="relative group cursor-pointer">
                                <div class="h-32 w-32 rounded-2xl border-4 border-white bg-white shadow-md overflow-hidden">
                                    <img id="preview"
                                        src="{{ $user->profile_picture ? asset('uploads/profile/' . $user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=EBF4FF&color=3B82F6' }}"
                                        class="w-full h-full object-cover" alt="Preview">
                                </div>

                                <!-- Hover Overlay for Edit -->
                                <div class="absolute inset-0 rounded-2xl flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity border-4 border-white"
                                    onclick="document.getElementById('profile_picture').click()">
                                    <i class="fas fa-camera text-white text-2xl"></i>
                                </div>
                            </div>

                            <input type="file" name="profile_picture" id="profile_picture" class="hidden"
                                accept="image/*">
                            @error('profile_picture')
                                <p class="mt-2 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror

                            <div class="mt-4 text-center">
                                <span
                                    class="inline-flex items-center rounded-full border border-zinc-200 bg-zinc-50 px-3 py-1 text-xs font-semibold text-zinc-900">
                                    {{ $user->role->role_name ?? 'User' }}
                                </span>
                            </div>
                        </div>

                        <!-- Right: Form Fields -->
                        <div class="flex-1 pt-2 md:pt-4">
                            @if (session('success'))
                                <div
                                    class="mb-6 p-4 rounded-md bg-emerald-50 border border-emerald-200 text-sm text-emerald-600 flex items-center gap-2">
                                    <i class="fas fa-check-circle text-emerald-500"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div
                                    class="mb-6 p-4 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div class="space-y-2">
                                    <label for="name" class="text-sm font-medium leading-none text-zinc-900">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required
                                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                    @error('name')
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Username -->
                                    <div class="space-y-2">
                                        <label for="username"
                                            class="text-sm font-medium leading-none text-zinc-900">Username</label>
                                        <input type="text" id="username" name="username"
                                            value="{{ old('username', $user->username) }}" required
                                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                        @error('username')
                                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="space-y-2">
                                        <label for="no_telepon" class="text-sm font-medium leading-none text-zinc-900">Nomor
                                            Telepon</label>
                                        <input type="text" id="no_telepon" name="no_telepon"
                                            value="{{ old('no_telepon', $user->no_telepon) }}"
                                            class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                        @error('no_telepon')
                                            <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label for="email"
                                        class="text-sm font-medium leading-none text-zinc-900">Email</label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                    @error('email')
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="space-y-2">
                                    <label for="password" class="text-sm font-medium leading-none text-zinc-900">Password
                                        Baru</label>
                                    <input type="password" id="password" name="password"
                                        placeholder="Kosongkan jika tidak ingin mengubah password"
                                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950">
                                    <p class="text-[10px] text-zinc-500">Minimal 6 karakter.</p>
                                    @error('password')
                                        <p class="text-xs text-red-600 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-zinc-100">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="inline-flex items-center justify-center rounded-md border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 focus:outline-none focus:ring-1 focus:ring-zinc-950 transition-colors">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-md bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const image = document.getElementById('preview');
        const input = document.getElementById('profile_picture');
        const form = document.getElementById('profileForm');
        const croppedImageInput = document.getElementById('cropped_image');

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = () => {
                image.src = reader.result;

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
                    croppedImageInput.value = canvas.toDataURL('image/jpeg');
                    form.submit();
                }, 'image/jpeg');
            }
        });
    </script>
@endsection
