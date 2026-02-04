@extends('layouts.user')

@section('content')
    <div class="container mx-auto px-4 md:px-6 py-8">
        <a href="{{ url()->previous() }}"
            class="inline-flex items-center text-sm text-zinc-500 hover:text-zinc-900 mb-6 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Room Info Card -->
            <div class="lg:col-span-1 space-y-6">
                <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden sticky top-8">
                    <!-- Image Header -->
                    <div class="aspect-video w-full bg-zinc-100 relative overflow-hidden">
                        @if ($kelas->gambar)
                            <img src="{{ asset('uploads/kelas/' . $kelas->gambar) }}" alt="{{ $kelas->nama_kelas }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-zinc-300">
                                <i class="fas fa-image text-4xl"></i>
                            </div>
                        @endif
                        <div
                            class="absolute top-4 right-4 bg-zinc-900/90 backdrop-blur text-white text-xs px-3 py-1.5 rounded-full font-medium shadow-sm">
                            {{ $kelas->kapasitas_mahasiswa }} Kursi
                        </div>
                    </div>

                    <div class="p-6">
                        <h1 class="text-2xl font-bold text-zinc-900 mb-2">{{ $kelas->nama_kelas }}</h1>
                        <div class="flex items-center gap-2 text-zinc-500 text-sm mb-6">
                            <i class="fas fa-building text-zinc-400"></i>
                            <span>{{ $kelas->gedung->nama_gedung ?? 'Gedung tidak diketahui' }}</span>
                        </div>

                        <div class="space-y-4">
                            <div class="p-4 rounded-lg bg-zinc-50 border border-zinc-100">
                                <h3 class="text-sm font-semibold text-zinc-900 mb-2">Fasilitas</h3>
                                <p class="text-sm text-zinc-600 leading-relaxed">
                                    {{ $kelas->keterangan ?: 'Tidak ada keterangan fasilitas.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Form & Calendar -->
            <div class="lg:col-span-2">
                <div class="rounded-xl border border-zinc-200 bg-white shadow-sm p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-zinc-900">Jadwal Peminjaman</h2>
                        <p class="text-sm text-zinc-500">Pilih tanggal dan waktu untuk mengajukan peminjaman.</p>
                    </div>

                    <!-- Date Navigation -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-zinc-900" id="currentMonthDisplay">Januari 2024</h3>
                            <div class="flex gap-2">
                                <button id="prevDaysBtn"
                                    class="p-1.5 rounded-md hover:bg-zinc-100 text-zinc-500 transition-colors">
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </button>
                                <button id="nextDaysBtn"
                                    class="p-1.5 rounded-md hover:bg-zinc-100 text-zinc-500 transition-colors">
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide snap-x" id="dateNavigation">
                            <!-- Dates populated by JS -->
                        </div>
                    </div>

                    <!-- Time Slots -->
                    <div id="timeSlotsContainer" class="hidden animate-in fade-in slide-in-from-top-4 duration-300">
                        <div class="flex items-center justify-between mb-4 border-t border-zinc-100 pt-6">
                            <div>
                                <h3 class="text-sm font-medium text-zinc-900">Waktu Tersedia</h3>
                                <p class="text-xs text-zinc-500 mt-0.5" id="selectedDateDisplayForSlots">-</p>
                            </div>
                        </div>

                        <div id="timeSlotsGrid" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <!-- Time slots populated by JS -->
                        </div>
                    </div>

                    <div id="selectDatePrompt" class="border-2 border-dashed border-zinc-100 rounded-xl p-12 text-center">
                        <div
                            class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-zinc-50 text-zinc-300 mb-3">
                            <i class="far fa-calendar text-xl"></i>
                        </div>
                        <p class="text-sm text-zinc-500 font-medium">Pilih tanggal untuk melihat ketersediaan waktu</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation -->
    <div id="bookingModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-zinc-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-zinc-200">
                    <div class="flex items-center justify-between border-b border-zinc-100 px-4 py-3 sm:px-6">
                        <h3 class="text-base font-semibold leading-6 text-zinc-900" id="modal-title">Konfirmasi Peminjaman
                        </h3>
                        <button type="button" onclick="closeModal()"
                            class="text-zinc-400 hover:text-zinc-500 focus:outline-none">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form action="{{ route('users.pengajuan.store') }}" method="POST" class="p-4 sm:p-6">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                        <input type="hidden" name="tanggal_peminjaman" id="selectedDate" required>
                        <input type="hidden" name="tanggal_berakhir_peminjaman" id="selectedEndDate" required>
                        <input type="hidden" name="waktu_peminjaman" id="selectedStartTime" required>
                        <input type="hidden" name="waktu_berakhir_peminjaman" id="selectedEndTime" required>

                        <div class="mb-6 bg-zinc-50 rounded-lg p-4 border border-zinc-100 flex items-start gap-4">
                            <div
                                class="h-10 w-10 flex-shrink-0 bg-white rounded-lg border border-zinc-200 flex items-center justify-center text-zinc-700 shadow-sm">
                                <i class="far fa-clock"></i>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 uppercase tracking-wider font-semibold mb-1">Jadwal Dipilih
                                </p>
                                <p class="text-zinc-900 font-semibold text-lg leading-none mb-1" id="modalTimeDisplay">00:00
                                    - 00:00</p>
                                <p class="text-zinc-500 text-sm" id="modalDateDisplay">Senin, 1 Jan 2024</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <label for="prodi_id" class="text-sm font-medium leading-none text-zinc-900">Program Studi
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="prodi_id" id="prodi_id" required
                                        class="flex h-10 w-full appearance-none items-center justify-between rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-zinc-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="keperluan_peminjaman"
                                    class="text-sm font-medium leading-none text-zinc-900">Keperluan <span
                                        class="text-red-500">*</span></label>
                                <textarea name="keperluan_peminjaman" id="keperluan_peminjaman" required rows="3"
                                    placeholder="Contoh: Kuliah Tamu, Rapat Himpunan"
                                    class="flex min-h-[80px] w-full rounded-md border border-zinc-200 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-zinc-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-950 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                            <button type="button" onclick="closeModal()"
                                class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-900 shadow-sm ring-1 ring-inset ring-zinc-300 hover:bg-zinc-50 sm:mt-0 sm:w-auto">Batal</button>
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-md bg-zinc-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 sm:w-auto">Ajukan
                                Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Data from Server
            const bookedbookings = @json($bookings);
            // bookedbookings structure: [{tanggal_peminjaman, waktu_peminjaman, waktu_berakhir, ...}, ...]

            // State
            let today = new Date();
            let currentStartDate = new Date(today); // For pagination
            let selectedDateStr = null;

            const dateNav = document.getElementById('dateNavigation');
            const timeSlotsContainer = document.getElementById('timeSlotsContainer');
            const selectDatePrompt = document.getElementById('selectDatePrompt');
            const timeSlotsGrid = document.getElementById('timeSlotsGrid');
            const selectedDateDisplayForSlots = document.getElementById('selectedDateDisplayForSlots');
            const currentMonthDisplay = document.getElementById('currentMonthDisplay');

            // Render Dates
            function renderDates(startDate) {
                dateNav.innerHTML = '';

                // Show month of start date
                const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
                    'September', 'Oktober', 'November', 'Desember'
                ];
                currentMonthDisplay.textContent = `${monthNames[startDate.getMonth()]} ${startDate.getFullYear()}`;

                for (let i = 0; i < 14; i++) {
                    const date = new Date(startDate);
                    date.setDate(startDate.getDate() + i);

                    const dateStr = date.toISOString().split('T')[0];
                    const dayName = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'][date.getDay()];
                    const isToday = (date.toDateString() === today.toDateString());
                    const isSelected = (selectedDateStr === dateStr);

                    const btn = document.createElement('button');
                    btn.className =
                        `flex-shrink-0 w-[4.5rem] h-[5.5rem] flex flex-col items-center justify-center rounded-xl border transition-all duration-200 snap-start ${isSelected ? 'bg-zinc-900 text-white border-zinc-900 shadow-md transform scale-105' : 'bg-white text-zinc-600 border-zinc-200 hover:border-zinc-300 hover:bg-zinc-50'}`;
                    btn.onclick = () => selectDate(dateStr);

                    btn.innerHTML = `
                    <span class="text-xs font-medium ${isSelected ? 'text-zinc-300' : 'text-zinc-400'} mb-1">${dayName}</span>
                    <span class="text-xl font-bold mb-1">${date.getDate()}</span>
                    ${isToday ? `<span class="text-[10px] bg-emerald-500 text-white px-1.5 rounded-full mt-1">Hari ini</span>` : ''}
                `;

                    dateNav.appendChild(btn);
                }
            }

            function selectDate(dateStr) {
                selectedDateStr = dateStr;
                renderDates(currentStartDate); // Re-render to highlight

                selectDatePrompt.classList.add('hidden');
                timeSlotsContainer.classList.remove('hidden');

                // Format nice date display
                const d = new Date(dateStr);
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
                selectedDateDisplayForSlots.textContent =
                    `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;

                renderTimeSlots(dateStr);
            }

            // Slot Generation
            function generateTimeSlots() {
                // Pre-defined slots as requested
                const definedSlots = [{
                        start: "08:00",
                        end: "16:00"
                    },
                    {
                        start: "08:00",
                        end: "17:00"
                    },
                    {
                        start: "08:00",
                        end: "12:00"
                    },
                    {
                        start: "12:00",
                        end: "17:00"
                    },
                    {
                        start: "13:00",
                        end: "17:00"
                    }
                ];

                return definedSlots.map(slot => {
                    const startH = parseInt(slot.start.split(':')[0]);
                    const endH = parseInt(slot.end.split(':')[0]);
                    return {
                        start: slot.start,
                        end: slot.end,
                        duration: endH - startH
                    };
                });
            }

            function isSlotAvailable(dateStr, slotStart, slotEnd) {
                const slotStartVal = parseInt(slotStart.replace(':', ''));
                const slotEndVal = parseInt(slotEnd.replace(':', ''));

                // Filter bookings for this specific date
                const dayBookings = bookedbookings.filter(b => b.tanggal_peminjaman === dateStr);

                for (let b of dayBookings) {
                    // Assumes booking times are H:i:s or H:i form. parsing reliably:
                    // b.waktu_peminjaman might be "08:00:00"
                    const bStart = parseInt(b.waktu_peminjaman.substring(0, 5).replace(':', ''));
                    const bEnd = parseInt(b.waktu_berakhir_peminjaman.substring(0, 5).replace(':', ''));

                    // Overlap logic: (StartA < EndB) and (EndA > StartB)
                    if (slotStartVal < bEnd && slotEndVal > bStart) {
                        return false; // Overlaps
                    }
                }
                return true;
            }

            function renderTimeSlots(dateStr) {
                const slots = generateTimeSlots();
                timeSlotsGrid.innerHTML = '';

                // Group by start time to make it cleaner? Or plain grid?
                // User requested similar to previous but better UI.
                // Let's filter to show reasonable options.

                let hasSlots = false;

                slots.forEach(slot => {
                    const available = isSlotAvailable(dateStr, slot.start, slot.end);

                    // Only show available slots or all? Previous showed all with red.
                    // Shadcn style usually clean. Let's show all but dim unavailable.

                    const btn = document.createElement('button');

                    if (available) {
                        btn.className =
                            "group relative flex flex-col items-center justify-center p-3 rounded-lg border border-zinc-200 bg-white hover:border-zinc-900 hover:shadow-sm transition-all text-sm";
                        btn.onclick = () => openBookingModal(dateStr, slot.start, slot.end);
                        btn.innerHTML = `
                         <span class="font-semibold text-zinc-900 group-hover:text-zinc-900">${slot.start} - ${slot.end}</span>
                         <span class="text-[10px] text-zinc-500 mt-1 bg-zinc-100 px-2 py-0.5 rounded-full group-hover:bg-zinc-900 group-hover:text-white transition-colors">${slot.duration} Jam</span>
                    `;
                    } else {
                        btn.className =
                            "flex flex-col items-center justify-center p-3 rounded-lg border border-zinc-100 bg-zinc-50 opacity-50 cursor-not-allowed text-sm";
                        btn.innerHTML = `
                        <span class="font-semibold text-zinc-400 bg-transparent relative decoration-slice text-xs">${slot.start} - ${slot.end}</span>
                        <span class="text-[10px] text-zinc-400 mt-1">Terisi</span>
                     `;
                    }

                    timeSlotsGrid.appendChild(btn);
                    hasSlots = true;
                });

                if (!hasSlots) {
                    timeSlotsGrid.innerHTML =
                        '<p class="col-span-full text-center text-zinc-500 text-sm py-8">Tidak ada jadwal tersedia.</p>';
                }
            }

            // Navigation
            document.getElementById('prevDaysBtn').onclick = () => {
                currentStartDate.setDate(currentStartDate.getDate() - 7);
                // Don't go to past?
                if (currentStartDate < today) {
                    // Reset to today if went too far back, but allow navigation if viewed range includes today
                    if (Math.abs(currentStartDate - today) < (24 * 60 * 60 * 1000 * 7)) {
                        // okay
                    } else {
                        // actually simple:
                        // just allow going back
                    }
                }
                renderDates(currentStartDate);
            };
            document.getElementById('nextDaysBtn').onclick = () => {
                currentStartDate.setDate(currentStartDate.getDate() + 7);
                renderDates(currentStartDate);
            };

            // Init
            renderDates(currentStartDate);
        });

        function openBookingModal(dateStr, start, end) {
            // Set Inputs
            document.getElementById('selectedDate').value = dateStr;
            document.getElementById('selectedEndDate').value = dateStr;
            document.getElementById('selectedStartTime').value = start;
            document.getElementById('selectedEndTime').value = end;

            // Set Display
            const d = new Date(dateStr);
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('modalDateDisplay').textContent = d.toLocaleDateString('id-ID', options);
            document.getElementById('modalTimeDisplay').textContent = `${start} - ${end}`;

            // Open
            const modal = document.getElementById('bookingModal');
            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }
    </script>
@endsection
