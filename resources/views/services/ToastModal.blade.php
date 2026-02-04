<!-- Toast Notification -->
<div id="toastNotification"
    class="fixed top-24 left-1/2 -translate-x-1/2 z-[1100] w-[85vw] md:w-80 transform transition-all duration-300 -translate-y-5 opacity-0 pointer-events-none"
    role="alert">

    <div class="bg-white rounded-lg shadow-lg border-l-4 overflow-hidden pointer-events-auto flex ring-1 ring-black/5">
        <!-- Icon Section -->
        <div id="toastIcon" class="flex-shrink-0 w-10 flex items-center justify-center bg-gray-50">
            <!-- Icon injected by JS -->
        </div>

        <!-- Content Section -->
        <div class="flex-1 p-3 border-l border-gray-100 min-w-0">
            <div class="flex items-start justify-between gap-2">
                <div class="min-w-0 flex-1">
                    <h3 id="toastTitle" class="text-sm font-bold text-gray-900 truncate">Notification</h3>
                    <p id="toastMessage" class="mt-0.5 text-xs text-gray-600 leading-snug break-words"></p>
                </div>
                <button onclick="hideToast()"
                    class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors p-0.5 -mr-1 -mt-1 rounded-md hover:bg-gray-100">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toastNotification');
        const title = document.getElementById('toastTitle');
        const body = document.getElementById('toastMessage');
        const iconContainer = document.getElementById('toastIcon');
        const borderContainer = toast.querySelector('.bg-white');

        // Reset classes
        borderContainer.className = 'bg-white rounded-xl shadow-lg border-l-4 overflow-hidden pointer-events-auto flex';

        let iconHtml = '';
        let borderClass = '';
        let iconBgClass = '';
        let iconTextClass = '';

        if (type === 'success') {
            title.innerText = 'Berhasil';
            borderClass = 'border-green-500';
            iconBgClass = 'bg-green-50';
            iconTextClass = 'text-green-500';
            // iconHtml = '<i class="fas fa-check-circle text-xl"></i>'; // Removed as requested
        } else if (type === 'error') {
            title.innerText = 'Gagal';
            borderClass = 'border-red-500';
            iconBgClass = 'bg-red-50';
            iconTextClass = 'text-red-500';
            // iconHtml = '<i class="fas fa-times-circle text-xl"></i>';
        } else {
            title.innerText = 'Info';
            borderClass = 'border-blue-500';
            iconBgClass = 'bg-blue-50';
            iconTextClass = 'text-blue-500';
            // iconHtml = '<i class="fas fa-info-circle text-xl"></i>';
        }

        borderContainer.classList.add(borderClass);
        if (iconHtml) {
            iconContainer.className =
                `flex-shrink-0 w-10 flex items-center justify-center ${iconBgClass} ${iconTextClass}`;
            iconContainer.innerHTML = iconHtml;
            iconContainer.classList.remove('hidden');
        } else {
            iconContainer.classList.add('hidden');
        }
        body.innerText = message;

        // Show
        // Remove hidden classes (-translate-y-5, opacity-0)
        // Keep centering classes (left-1/2, -translate-x-1/2) attached to base
        toast.classList.remove('-translate-y-5', 'opacity-0', 'pointer-events-none');

        // Auto hide
        setTimeout(() => {
            hideToast();
        }, 4000);
    }

    function hideToast() {
        const toast = document.getElementById('toastNotification');
        toast.classList.add('-translate-y-5', 'opacity-0', 'pointer-events-none');
    }

    // Auto-show from session
    document.addEventListener('DOMContentLoaded', () => {
        @if (session('success'))
            showToast("{{ session('success') }}", 'success');
        @elseif (session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    });
</script>
