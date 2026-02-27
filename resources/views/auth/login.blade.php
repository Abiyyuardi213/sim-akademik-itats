<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin | Akademik WR 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="apple-touch-startup-image" href="{{ asset('image/itats-1080.jpg') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

<body class="h-screen w-full bg-white flex overflow-hidden">

    <!-- Left Panel (Form) -->
    <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-12 relative overflow-y-auto bg-white">

        <div class="m-auto w-full max-w-[380px]">
            <!-- Header -->
            <div class="flex flex-col items-center space-y-3 mb-8">
                <img src="{{ asset('image/itats-biru.png') }}" alt="Logo ITATS" class="h-10 w-auto opacity-90">
                <div class="text-center space-y-1">
                    <h2 class="text-xl font-bold tracking-tight text-zinc-900">Login Admin</h2>
                    <p class="text-sm text-zinc-500">Masuk untuk mengelola sistem WR 1</p>
                </div>
            </div>

            <!-- Flash Error -->
            @if (session('error'))
                <div
                    class="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-5 p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-600 flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white rounded-[14px] border border-zinc-200 p-6 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)]">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Username -->
                    <div class="space-y-1.5">
                        <label for="username" class="text-[13px] font-semibold text-zinc-800">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="far fa-user text-zinc-400 text-sm"></i>
                            </div>
                            <input id="username" name="username" type="text" value="{{ old('username') }}" required
                                autofocus
                                class="flex h-10 w-full rounded-lg border border-zinc-200 bg-white pl-10 pr-3 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all"
                                placeholder="Masukkan username anda">
                        </div>
                        @error('username')
                            <p class="text-[0.8rem] font-medium text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="text-[13px] font-semibold text-zinc-800">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-zinc-400 text-sm"></i>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="flex h-10 w-full rounded-lg border border-zinc-200 bg-white pl-10 pr-10 py-2 text-sm text-zinc-900 placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent transition-all"
                                placeholder="Masukkan password anda">
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-zinc-400 hover:text-zinc-600 focus:outline-none">
                                <i id="eye-icon" class="far fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-[0.8rem] font-medium text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Options: Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between pt-1 pb-2">
                        <div class="flex items-center">
                            <input id="remember" name="remember" value="1" type="checkbox"
                                class="h-4 w-4 text-zinc-900 focus:ring-zinc-900 border-zinc-300 rounded cursor-pointer accent-zinc-900">
                            <label for="remember"
                                class="ml-2.5 block text-[13px] text-zinc-600 cursor-pointer select-none">Ingat
                                saya</label>
                        </div>
                        <a href="{{ route('password.request') }}"
                            class="text-[13px] font-medium text-zinc-900 hover:text-blue-600 transition-colors">
                            Lupa Password?
                        </a>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full h-10 flex items-center justify-center gap-2 rounded-lg bg-[#18181b] text-white text-sm font-semibold hover:bg-black transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-zinc-900">
                        Masuk <i class="fas fa-sign-in-alt ml-1"></i>
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-[11px] text-zinc-400">
                    &copy; 2025 ITATS. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- Right Panel (Background Image) -->
    <div class="hidden lg:block lg:w-1/2 relative bg-zinc-900">
        <img src="{{ asset('image/gedungA.jpg') }}" alt="Background"
            class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-black/10"></div>

        <!-- Top Left Logo -->
        <div class="absolute top-8 left-10">
            <img src="{{ asset('image/itats-biru.png') }}" alt="Logo Background"
                class="h-10 opacity-90 brightness-0 invert drop-shadow">
        </div>

        <!-- Bottom Text Quote -->
        <div class="absolute bottom-12 left-10 pr-12">
            <p class="text-white text-[17px] font-medium leading-relaxed mb-2 max-w-xl shadow-sm">
                "Sistem Informasi Sarana dan Prasarana Terintegrasi untuk efisiensi dan keunggulan operasional kampus."
            </p>
            <p class="text-white/80 text-[13px]">Institut Teknologi Adhi Tama Surabaya</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
