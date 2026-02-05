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
                <div class="container mx-auto px-6 py-8" id="main-content">
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

    <div id="page-scripts">
        @yield('scripts')
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('aside nav a');
            const contentContainer = document.getElementById('main-content');
            const scriptsContainer = document.getElementById('page-scripts');

            // Helper to update sidebar active state
            function updateSidebarActiveState(targetUrl) {
                sidebarLinks.forEach(link => {
                    // Reset to inactive styles
                    link.className =
                        'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900';

                    // Specific check for Cuti and Fasilitas submenus (optional, can be improved)
                    // For now, simple URL matching
                    if (link.href === targetUrl || targetUrl.startsWith(link.href)) {
                        // Apply active styles
                        link.className =
                            'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 bg-zinc-100 text-zinc-900 shadow-sm';

                        // Expand parent submenu if exists
                        const parentSubmenu = link.closest('[id$="-submenu"]');
                        if (parentSubmenu) {
                            parentSubmenu.classList.remove('hidden');
                            const arrowId = parentSubmenu.id.replace('submenu', 'arrow');
                            const arrow = document.getElementById(arrowId);
                            if (arrow) arrow.classList.add('rotate-180');
                        }
                    }
                });
            }

            // Highlighting based on current URL on initial load (fallback)
            updateSidebarActiveState(window.location.href);

            sidebarLinks.forEach(link => {
                link.addEventListener('click', async (e) => {
                    const url = link.href;

                    // Allow opening in new tab
                    if (e.ctrlKey || e.metaKey || e.shiftKey || e.button === 1) return;

                    // Ignore valid hash links on same page
                    if (url.includes('#') && url.split('#')[0] === window.location.href.split(
                            '#')[0]) return;

                    e.preventDefault();

                    try {
                        // NProgress or simple loading state could go here
                        contentContainer.style.opacity = '0.5';

                        const response = await fetch(url);
                        if (!response.ok) throw new Error('Network response was not ok');
                        const htmlText = await response.text();

                        // Parse HTML
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(htmlText, 'text/html');

                        // Update Title
                        document.title = doc.title;

                        // Swap Content
                        const newContent = doc.getElementById('main-content');
                        if (newContent) {
                            contentContainer.innerHTML = newContent.innerHTML;
                        }

                        // Swap and Execute Scripts
                        const newScripts = doc.getElementById('page-scripts');
                        if (newScripts) {
                            // Clear old scripts? Or just append? 
                            // Usually safer to clear specific page scripts if wrapped correctly.
                            scriptsContainer.innerHTML = '';

                            // We need to recreate script tags for them to execute
                            Array.from(newScripts.querySelectorAll('script')).forEach(
                                oldScript => {
                                    const newScript = document.createElement('script');
                                    Array.from(oldScript.attributes).forEach(attr =>
                                        newScript.setAttribute(attr.name, attr.value));
                                    newScript.appendChild(document.createTextNode(oldScript
                                        .innerHTML));
                                    scriptsContainer.appendChild(newScript);
                                });
                        }

                        // Update URL
                        window.history.pushState({}, '', url);

                        // Update Sidebar UI
                        updateSidebarActiveState(url);

                    } catch (error) {
                        console.error('Navigation error:', error);
                        window.location.href = url; // Fallback to full reload
                    } finally {
                        contentContainer.style.opacity = '1';
                    }
                });
            });

            // Handle browser Back/Forward buttons
            window.addEventListener('popstate', () => {
                // For simplicity in this iteration, just reload to ensure state consistency
                window.location.reload();
            });
        });
    </script>
</body>

</html>
