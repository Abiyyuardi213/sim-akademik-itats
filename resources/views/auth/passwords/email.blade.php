<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Lupa Password | Akademik WR 1</title>
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
                    <h2 class="text-xl font-semibold tracking-tight text-zinc-900">Reset Password</h2>
                    <p class="text-sm text-zinc-500">Masukkan email Anda untuk menerima link reset password.</p>
                </div>
            </div>

            <!-- Status Message -->
            @if (session('status'))
                <div
                    class="mb-6 p-3 rounded-md bg-green-50 border border-green-200 text-sm text-green-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-4 h-4 shrink-0">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium leading-none text-zinc-900">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="flex h-10 w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="text-[0.8rem] font-medium text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-white transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-zinc-50 hover:bg-zinc-900/90 h-10 w-full">
                        Kirim Link Reset Password
                    </button>

                    <a href="{{ route('login') }}"
                        class="mt-4 block text-center text-sm font-medium text-zinc-600 hover:text-zinc-900 transition-colors">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
