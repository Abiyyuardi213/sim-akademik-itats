<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kaprodi Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-zinc-50 text-zinc-900 antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-zinc-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-4">
                    <img class="h-8 w-auto" src="{{ asset('image/itats-biru.png') }}" alt="ITATS">
                    <div class="h-6 w-px bg-zinc-200"></div>
                    <span class="font-semibold text-zinc-800 tracking-tight">KAPRODI PANEL</span>
                </div>

                <div class="flex items-center gap-6">
                    <div class="hidden md:flex flex-col items-end">
                        <span class="text-sm font-medium text-zinc-900">
                            {{ Auth::guard('admin')->user()->username ?? 'Kaprodi' }}
                        </span>
                        <span class="text-xs text-zinc-500">
                            {{ Auth::guard('admin')->user()->prodi->nama_prodi ?? 'Program Studi' }}
                        </span>
                    </div>

                    <button type="button" onclick="openLogoutModal()"
                        class="p-2 rounded-md text-zinc-500 hover:text-red-600 hover:bg-red-50 transition-colors"
                        title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div
                class="mb-6 flex items-center p-4 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 text-sm">
                <i class="fas fa-check-circle mr-3 text-lg"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 flex items-center p-4 rounded-lg bg-red-50 text-red-800 border border-red-200 text-sm">
                <i class="fas fa-exclamation-circle mr-3 text-lg"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-zinc-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-xs text-zinc-500">
                &copy; {{ date('Y') }} SIM Peminjaman Ruangan ITATS. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Logout Modal -->
    <div id="logoutModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-zinc-900/40 transition-opacity backdrop-blur-sm"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-zinc-200">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-sign-out-alt text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-zinc-900" id="modal-title">Konfirmasi
                                    Logout</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-zinc-500">Apakah Anda yakin ingin keluar dari sistem?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-zinc-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-zinc-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">Keluar</button>
                        </form>
                        <button type="button" onclick="closeLogoutModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
    @yield('scripts')
</body>

</html>
