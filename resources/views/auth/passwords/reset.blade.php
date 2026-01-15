<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password | Akademik WR 1</title>
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

    <!-- Card -->
    <div class="relative z-10 w-full max-w-[400px] px-4">
        <div class="bg-white rounded-xl shadow-2xl p-8 border border-zinc-200/80">
            <!-- Header -->
            <div class="flex flex-col items-center space-y-4 mb-8">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="h-10 w-auto opacity-90">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Buat Password Baru</h2>
                    <p class="text-sm text-zinc-500">Masukkan password baru Anda.</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium leading-none text-zinc-900">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required
                        readonly
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-zinc-50 px-3 py-2 text-sm ring-offset-white text-zinc-500 cursor-not-allowed">
                    @error('email')
                        <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium leading-none text-zinc-900">Password Baru</label>
                    <input id="password" name="password" type="password" required autofocus
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2">
                    @error('password')
                        <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password-confirm" class="text-sm font-medium leading-none text-zinc-900">Konfirmasi
                        Password</label>
                    <input id="password-confirm" name="password_confirmation" type="password" required
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2">
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 h-10 w-full">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
