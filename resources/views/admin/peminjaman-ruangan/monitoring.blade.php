@extends('layouts.admin')

@section('title', 'Monitoring Peminjaman Ruangan')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 space-y-4 sm:space-y-0">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Monitoring Peminjaman Ruangan</h1>
            <p class="mt-1 text-sm text-zinc-500">Kalender monitoring penggunaan ruangan di ITATS.</p>
        </div>
        <div>
            <a href="{{ route('admin.peminjaman-ruangan.index') }}"
                class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-zinc-600 hover:bg-zinc-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500">
                <i class="fas fa-list mr-2"></i> List Peminjaman
            </a>
        </div>
    </div>

    <!-- Calendar Container -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 p-6">
        <div id="calendar"></div>
    </div>

    <!-- Detail Modal -->
    <div id="eventModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop"
            aria-hidden="true" onclick="closeModal()"></div>

        <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
            <!-- Modal Panel -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 scale-95"
                id="modalPanel">

                <!-- Close Button -->
                <div class="absolute right-4 top-4">
                    <button type="button" onclick="closeModal()"
                        class="rounded-md bg-white text-zinc-400 hover:text-zinc-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <div class="px-6 py-6">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold leading-6 text-zinc-900" id="modalTitle">Detail Peminjaman</h3>
                        <p class="mt-1 text-sm text-zinc-500">Informasi lengkap mengenai jadwal peminjaman ruangan.</p>
                    </div>

                    <div class="space-y-5">
                        <div class="grid grid-cols-3 gap-4 border-b border-zinc-100 pb-4">
                            <div class="text-sm font-medium text-zinc-500">Ruangan</div>
                            <div class="col-span-2 text-sm font-semibold text-zinc-900" id="detailRuangan">-</div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 border-b border-zinc-100 pb-4">
                            <div class="text-sm font-medium text-zinc-500">Peminjam</div>
                            <div class="col-span-2 text-sm font-semibold text-zinc-900" id="detailPeminjam">-</div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 border-b border-zinc-100 pb-4">
                            <div class="text-sm font-medium text-zinc-500">Tanggal</div>
                            <div class="col-span-2 text-sm font-semibold text-zinc-900" id="detailTanggal">-</div>
                        </div>

                        <div class="grid grid-cols-3 gap-4 border-b border-zinc-100 pb-4">
                            <div class="text-sm font-medium text-zinc-500">Waktu</div>
                            <div class="col-span-2 text-sm font-semibold text-zinc-900" id="detailWaktu">-</div>
                        </div>

                        <div>
                            <div class="text-sm font-medium text-zinc-500 mb-2">Kegiatan</div>
                            <div class="rounded-md bg-zinc-50 p-3 text-sm text-zinc-700 border border-zinc-100"
                                id="detailKegiatan">
                                -
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-50 px-6 py-4 flex flex-row-reverse">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-zinc-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-700 sm:w-auto transition-colors"
                        onclick="closeModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                // Fetch events from the current URL (which handles AJAX requests)
                events: "{{ route('admin.peminjaman-ruangan.monitoring') }}",
                eventClick: function(info) {
                    openModal(info.event);
                },
                eventTimeFormat: { // like '14:30'
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                loading: function(isLoading) {
                    if (isLoading) {
                        // Optional: show a loading spinner
                    } else {
                        // hide spinner
                    }
                }
            });

            calendar.render();
        });

        function openModal(event) {
            // Set content
            document.getElementById('detailRuangan').innerText = event.extendedProps.ruangan || '-';
            document.getElementById('detailPeminjam').innerText = event.extendedProps.peminjam || '-';
            document.getElementById('detailTanggal').innerText = event.extendedProps.tanggal || '-';
            document.getElementById('detailWaktu').innerText = event.extendedProps.waktu || '-';
            document.getElementById('detailKegiatan').innerText = event.extendedProps.kegiatan || '-';

            // Show modal
            const modal = document.getElementById('eventModal');
            const panel = document.getElementById('modalPanel');
            const backdrop = document.getElementById('modalBackdrop');

            modal.classList.remove('hidden');

            // Animation
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');

                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('eventModal');
            const panel = document.getElementById('modalPanel');
            const backdrop = document.getElementById('modalBackdrop');

            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');

            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>

    <style>
        .fc-event {
            cursor: pointer;
            transition: all 0.2s;
        }

        .fc-event:hover {
            opacity: 0.9;
            transform: scale(1.02);
        }

        .fc-daygrid-event {
            font-size: 0.85em;
            padding: 2px 4px;
        }
    </style>
@endsection
