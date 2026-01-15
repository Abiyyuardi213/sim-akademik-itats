<!-- Modal Konfirmasi Logout -->
<div id="logoutModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="closeLogoutModal()"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal Panel -->
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                <!-- Header -->
                <div class="bg-gradient-to-r from-red-500 to-rose-600 px-6 py-4 flex items-center justify-between">
                    <h5 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Konfirmasi Logout
                    </h5>
                    <button type="button" onclick="closeLogoutModal()"
                        class="text-white/80 hover:text-white transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Body -->
                <div class="px-6 py-6">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <i class="fas fa-question text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold leading-6 text-gray-900">Anda yakin ingin keluar?</h3>
                            <p class="mt-2 text-sm text-gray-500">
                                Anda akan diarahkan kembali ke halaman login. Pastikan semua pekerjaan Anda sudah
                                tersimpan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse gap-3">
                    <form action="{{ route('logout') }}" method="POST" class="inline-block w-full sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="inline-flex w-full sm:w-auto justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 transition-all duration-200">
                            <i class="fas fa-sign-out-alt mr-2 mt-0.5"></i> Logout
                        </button>
                    </form>
                    <button type="button" onclick="closeLogoutModal()"
                        class="mt-3 sm:mt-0 inline-flex w-full sm:w-auto justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-all duration-200">
                        Batal
                    </button>
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
