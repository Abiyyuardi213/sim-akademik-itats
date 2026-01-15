@extends('layouts.admin')

@section('title', 'Detail Kaprodi')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <nav class="flex text-sm font-medium text-zinc-500 items-center mb-4">
                <a href="{{ route('admin.kaprodi.index') }}" class="hover:text-zinc-900 transition-colors">Daftar Kaprodi</a>
                <span class="mx-2 text-zinc-300">/</span>
                <span class="text-zinc-900">Detail</span>
            </nav>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Kaprodi</h1>
            <p class="mt-1 text-sm text-zinc-500">Informasi lengkap tentang {{ $user->name }}.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Summary Card -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden p-6 text-center">
                    <div
                        class="w-32 h-32 mx-auto bg-zinc-100 rounded-full flex items-center justify-center overflow-hidden border border-zinc-200 mb-4">
                        @if ($user->profile_picture)
                            <img src="{{ asset('uploads/profile/' . $user->profile_picture) }}" alt="{{ $user->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl font-bold text-zinc-400">{{ substr($user->name, 0, 2) }}</span>
                        @endif
                    </div>
                    <h2 class="text-lg font-bold text-zinc-900">{{ $user->name }}</h2>
                    <p class="text-sm text-zinc-500 mb-4">{{ $user->username }}</p>

                    <div
                        class="inline-flex rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                        {{ $user->role->role_name }}
                    </div>

                    <div class="mt-6 flex justify-center gap-3">
                        <a href="{{ route('admin.kaprodi.edit', $user->id) }}"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 focus:outline-none transition-colors">
                            <i class="fas fa-pencil-alt mr-2"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Detailed Info Card -->
            <div class="col-span-1 md:col-span-2">
                <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-100">
                        <h3 class="font-semibold text-zinc-900">Informasi Pribadi & Akademik</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Email</p>
                                <p class="text-zinc-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">No. Telepon</p>
                                <p class="text-zinc-900">{{ $user->no_telepon ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">NIP</p>
                                <p class="text-zinc-900 font-mono">{{ $user->nip ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Program Studi</p>
                                <p class="font-medium text-zinc-900">
                                    {{ $user->prodi ? $user->prodi->nama_prodi : 'Belum ditentukan' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider mb-1">Tanggal Bergabung
                                </p>
                                <p class="text-zinc-900">{{ $user->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity / Status Placeholders could go here -->
            </div>
        </div>
    </div>
@endsection
