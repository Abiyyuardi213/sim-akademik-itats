<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna | Akademik WR 1</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased flex flex-col min-h-screen">
    @include('include.navbarUser')

    <main class="flex-grow container mx-auto px-4 md:px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Profil Saya</h1>
            <p class="text-zinc-500">Kelola informasi akun dan preferensi Anda.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar / Profile Card -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
                    <div class="p-6 text-center border-b border-zinc-100">
                        <div class="relative w-32 h-32 mx-auto mb-4">
                            <img src="{{ $user->profile_picture ? asset('uploads/profile/' . $user->profile_picture) : asset('image/default.png') }}"
                                alt="Foto Profil"
                                class="w-full h-full object-cover rounded-full border-2 border-zinc-100">
                        </div>
                        <h2 class="text-xl font-bold text-zinc-900">{{ $user->name }}</h2>
                        <span
                            class="inline-block mt-2 px-3 py-1 bg-zinc-100 text-zinc-600 text-xs font-medium rounded-full border border-zinc-200">
                            {{ $user->role->nama_role ?? 'User' }}
                        </span>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-zinc-50 text-zinc-500 border border-zinc-100">
                                <i class="fas fa-envelope text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Email</p>
                                <p class="text-sm font-medium text-zinc-900 mt-0.5">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-zinc-50 text-zinc-500 border border-zinc-100">
                                <i class="fas fa-phone text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Telepon</p>
                                <p class="text-sm font-medium text-zinc-900 mt-0.5">{{ $user->no_telepon ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-zinc-900">Edit Informasi</h3>
                        <p class="text-sm text-zinc-500">Perbarui detail profil akun Anda di sini.</p>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 rounded-md bg-green-50 border border-green-200 text-sm text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('users.profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid gap-6 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Nama
                                    Lengkap</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                @error('name')
                                    <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="username"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Username</label>
                                <input type="text" name="username" id="username"
                                    value="{{ old('username', $user->username) }}"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                @error('username')
                                    <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="email"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Email</label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                @error('email')
                                    <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="no_telepon"
                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">No.
                                    Telepon</label>
                                <input type="text" name="no_telepon" id="no_telepon"
                                    value="{{ old('no_telepon', $user->no_telepon) }}"
                                    class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                @error('no_telepon')
                                    <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-2 pt-2">
                            <label for="password"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password
                                Baru</label>
                            <input type="password" name="password" id="password"
                                class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                            <p class="text-[0.8rem] text-zinc-500">Kosongkan jika tidak ingin mengubah password.</p>
                            @error('password')
                                <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="profile_picture"
                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Foto
                                Profil</label>
                            <input type="file" name="profile_picture" id="profile_picture"
                                class="flex w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm text-zinc-600 file:mr-4 file:py-0 file:px-0 file:border-0 file:bg-transparent file:text-sm file:font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                            <p class="text-[0.8rem] text-zinc-500">JPG atau PNG. Maksimal 2MB.</p>
                            @error('profile_picture')
                                <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4 flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 h-10 px-4 py-2">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
