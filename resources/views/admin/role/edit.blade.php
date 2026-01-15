@extends('layouts.admin')

@section('title', 'Ubah Peran')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.role.index') }}" class="hover:text-blue-600">Manajemen Peran</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium">Ubah Peran</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Ubah Data Peran</h1>
        <p class="mt-1 text-sm text-gray-600">Edit informasi dan status peran pengguna.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-2xl">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center">
                    <i class="fas fa-edit text-sm"></i>
                </div>
                Form Ubah Peran
            </h3>
        </div>

        <div class="p-6">
            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-lg flex items-start gap-3">
                    <i class="fas fa-exclamation-circle mt-0.5"></i>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.role.update', $role->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Peran -->
                <div>
                    <label for="role_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Peran <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-tag"></i>
                        </div>
                        <input type="text" id="role_name" name="role_name"
                            value="{{ old('role_name', $role->role_name) }}" required autocomplete="off"
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('role_name') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                            placeholder="Contoh: Administrator">
                    </div>
                    @error('role_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="role_description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea id="role_description" name="role_description" required rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all resize-none @error('role_description') border-red-300 focus:ring-red-500/20 focus:border-red-500 @enderror"
                        placeholder="Jelaskan tujuan dan cakupan akses">{{ old('role_description', $role->role_description) }}</textarea>
                    @error('role_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="role_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <div class="relative">
                        <select id="role_status" name="role_status" required
                            class="w-full pl-4 pr-10 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all appearance-none cursor-pointer">
                            <option value="1" {{ old('role_status', $role->role_status) == 1 ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="0" {{ old('role_status', $role->role_status) == 0 ? 'selected' : '' }}>
                                Nonaktif</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="pt-4 flex items-center gap-3 border-t border-gray-100 mt-6">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm shadow-blue-500/30">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.role.index') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
