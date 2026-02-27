<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity" onclick="closeLogoutModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <!-- Modal Panel -->
            <div
                class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-[400px] border border-zinc-200">
                <!-- Header Component -->
                <div class="px-6 pt-6 pb-4 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-zinc-900" id="modal-title">Konfirmasi Logout</h3>
                    <button type="button" onclick="closeLogoutModal()"
                        class="text-zinc-400 hover:text-zinc-500 focus:outline-none transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <!-- Body Component -->
                <div class="px-6 pb-8">
                    <p class="text-[15px] text-zinc-600">Apakah anda yakin ingin mengakhiri sesi ini?</p>
                </div>

                <!-- Footer Component -->
                <div class="px-6 py-4 flex justify-end gap-3 rounded-b-xl">
                    <button type="button" onclick="closeLogoutModal()"
                        class="inline-flex justify-center items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 transition-colors">
                        Cancel
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block m-0">
                        @csrf
                        <button type="submit"
                            class="inline-flex justify-center items-center rounded-lg bg-[#e50000] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#cc0000] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#e50000] transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) modal.classList.remove('hidden');
    }

    function closeLogoutModal() {
        const modal = document.getElementById('logoutModal');
        if (modal) modal.classList.add('hidden');
    }

    // Auto-bind to bootstrap-style triggers for compatibility
    document.addEventListener('DOMContentLoaded', () => {
        const triggers = document.querySelectorAll(
            '[data-bs-target="#logoutModal"], [data-target="#logoutModal"]');
        triggers.forEach(trigger => {
            trigger.onclick = (e) => {
                e.preventDefault();
                openLogoutModal();
            };
        });
    });
</script>
