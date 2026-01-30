<!-- Toast Notification -->
<div id="toastNotification"
    class="fixed top-24 left-1/2 z-[1100] w-[90vw] md:w-96 transform transition-all duration-300 -translate-x-1/2 -translate-y-5 opacity-0 pointer-events-none"
    role="alert">

    <div class="bg-white rounded-xl shadow-lg border-l-4 overflow-hidden pointer-events-auto flex">
        <!-- Icon Section -->
        <div id="toastIcon" class="flex-shrink-0 w-12 flex items-center justify-center bg-gray-100">
            <!-- Icon injected by JS -->
        </div>

        <!-- Content Section -->
        <div class="flex-1 p-4 border-l border-gray-100">
            <div class="flex items-start justify-between">
                <div>
                    <h3 id="toastTitle" class="text-sm font-bold text-gray-900">Notification</h3>
                    <p id="toastMessage" class="mt-1 text-sm text-gray-600 leading-relaxed"></p>
                </div>
                <button onclick="hideToast()" class="ml-4 text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times"></i>
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
            iconHtml = '<i class="fas fa-check-circle text-xl"></i>';
        } else if (type === 'error') {
            title.innerText = 'Gagal';
            borderClass = 'border-red-500';
            iconBgClass = 'bg-red-50';
            iconTextClass = 'text-red-500';
            iconHtml = '<i class="fas fa-times-circle text-xl"></i>';
        } else {
            title.innerText = 'Info';
            borderClass = 'border-blue-500';
            iconBgClass = 'bg-blue-50';
            iconTextClass = 'text-blue-500';
            iconHtml = '<i class="fas fa-info-circle text-xl"></i>';
        }

        borderContainer.classList.add(borderClass);
        iconContainer.className = `flex-shrink-0 w-12 flex items-center justify-center ${iconBgClass} ${iconTextClass}`;
        iconContainer.innerHTML = iconHtml;
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
