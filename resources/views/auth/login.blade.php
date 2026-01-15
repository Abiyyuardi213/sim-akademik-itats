<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin | Akademik WR 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">

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
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>

<body class="h-screen w-full bg-cover bg-center overflow-hidden flex items-center justify-center relative"
    style="background-image: url('{{ asset('image/gedungA.jpg') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-zinc-950/70 backdrop-blur-sm z-0"></div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-[400px] px-4">
        <div class="bg-white rounded-xl shadow-2xl p-8 border border-zinc-200/80">
            <!-- Header -->
            <div class="flex flex-col items-center space-y-4 mb-8">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="h-10 w-auto opacity-90">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Login Admin</h2>
                    <p class="text-sm text-zinc-500">Masuk untuk mengelola sistem WR 1</p>
                </div>
            </div>

            <!-- Flash Error -->
            @if (session('error'))
                <div
                    class="mb-6 p-3 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-4 h-4 shrink-0">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-6 p-3 rounded-md bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-4 h-4 shrink-0">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label for="username"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" required
                        autofocus
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        placeholder="Masukkan Username">
                    @error('username')
                        <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password"
                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Password</label>
                    <input id="password" name="password" type="password" required
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                        placeholder="Masukkan Password">
                    @error('password')
                        <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 rounded border-zinc-300 text-zinc-900 focus:ring-zinc-900">
                        <label for="remember"
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                            Ingat saya
                        </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-zinc-900 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                <button type="submit"
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 h-10 w-full mt-2">
                    Masuk
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-zinc-400">
                    &copy; 2025 ITATS. All rights reserved.
                </p>
            </div>
        </div>
    </div>

</body>

</html>
