<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik WR 1 - @yield('title', 'Dashboard')</title>
    <link rel="icon" type="image/png" href="{{ asset('image/itats-1080.jpg') }}">

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
        }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-50 antialiased" style="-webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('include.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <!-- Navbar -->
            @include('include.navbarSistem')

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('include.footerSistem')
        </div>
    </div>

    @include('services.ToastModal')
    <!-- Logout Modal should be compatible with Tailwind or rebuilt -->
    @include('services.LogoutModal')

    <!-- Toast Logic (if using existing JS, ensure it works without jQuery if possible, or include jQuery if strictly needed) -->
    <!-- For now, assuming ToastScript.js might need jQuery. Let's include jQuery just in case for legacy scripts survival -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('resources/js/ToastScript.js') }}"></script>

    @yield('scripts')
</body>

</html>
