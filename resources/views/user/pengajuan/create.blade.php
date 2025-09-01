<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ruangan - {{ $kelas->nama_kelas }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        secondary: '#3b82f6',
                        accent: '#60a5fa',
                        success: '#10b981',
                        danger: '#ef4444',
                        'blue-50': '#eff6ff',
                        'blue-100': '#dbeafe',
                        'blue-600': '#2563eb',
                        'blue-700': '#1d4ed8',
                        'blue-800': '#1e40af',
                        'blue-900': '#1e3a8a',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .card-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .card-shadow-lg {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        @media (max-width: 768px) {
            .mobile-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-white min-h-screen">
    <!-- Header -->
    <div class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center gap-4">
                <button onclick="history.back()" class="p-3 hover:bg-white/20 rounded-full transition-all duration-200 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <div class="text-white">
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $kelas->nama_kelas }}</h1>
                    <p class="text-blue-100 mt-1 text-sm md:text-base">
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 8h1m4 0h1"></path>
                            </svg>
                            {{ $kelas->gedung->nama_gedung ?? '-' }}
                        </span>
                        <span class="mx-2">•</span>
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ $kelas->kapasitas_mahasiswa }} orang
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl card-shadow-lg p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Pilih Tanggal</h2>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-1 xl:grid-cols-2 gap-3" id="dateNavigation">
                        <!-- Dates will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl card-shadow-lg p-6">
                    <div id="timeSlots" class="space-y-6">
                        <div class="text-center py-12 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-lg">Pilih tanggal untuk melihat waktu yang tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
>
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl w-full max-w-lg max-h-[90vh] overflow-y-auto card-shadow-lg">
            <div class="gradient-bg p-6 rounded-t-xl">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Detail Booking</h3>
                    </div>
                    <button onclick="closeModal()" class="p-2 hover:bg-white/20 rounded-full transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <form action="{{ route('users.pengajuan.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                <input type="hidden" name="tanggal_peminjaman" id="selectedDate" required>
                <input type="hidden" name="tanggal_berakhir_peminjaman" id="selectedEndDate" required>
                <input type="hidden" name="waktu_peminjaman" id="selectedStartTime" required>
                <input type="hidden" name="waktu_berakhir_peminjaman" id="selectedEndTime" required>

                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-600 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-blue-700">Waktu yang dipilih:</div>
                            <div class="font-bold text-blue-900 text-lg" id="selectedTimeDisplay"></div>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="prodi_id" class="block text-sm font-bold text-gray-700 mb-3">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                        <option value="">Pilih Program Studi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="keperluan_peminjaman" class="block text-sm font-bold text-gray-700 mb-3">Keperluan</label>
                    <textarea name="keperluan_peminjaman" id="keperluan_peminjaman" rows="4" class="w-full p-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none" placeholder="Jelaskan keperluan peminjaman ruangan..." required></textarea>
                </div>

                <button type="submit" class="w-full gradient-bg text-white py-4 rounded-xl font-bold text-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Pengajuan
                    </span>
                </button>
            </form>
        </div>
    </div>

    <script>
        const bookedDates = @json($bookings->map(fn($b) => $b->tanggal_peminjaman));
        const bookedTimes = @json($bookings->groupBy('tanggal_peminjaman')->map(fn($bookings) => $bookings->map(fn($b) => ['start' => $b->waktu_peminjaman, 'end' => $b->waktu_berakhir_peminjaman])));

        let selectedDate = null;
        let selectedTimeSlot = null;

        function generateDates() {
            const dates = [];
            const today = new Date();

            for (let i = 0; i < 14; i++) {
                const date = new Date(today);
                date.setDate(today.getDate() + i);
                dates.push(date);
            }

            return dates;
        }

        function formatDate(date, format = 'short') {
            const days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

            if (format === 'short') {
                return {
                    day: days[date.getDay()],
                    date: date.getDate(),
                    month: months[date.getMonth()]
                };
            }

            return date.toISOString().split('T')[0];
        }

        function isDateAvailable(dateStr) {
            return !bookedDates.includes(dateStr);
        }

        // function generateTimeSlots() {
        //     const slots = [];
        //     for (let hour = 7; hour <= 17; hour++) {
        //         const startTime = `${hour.toString().padStart(2, '0')}:00`;
        //         const endTime = `${(hour + 1).toString().padStart(2, '0')}:00`;
        //         slots.push({ start: startTime, end: endTime });
        //     }
        //     return slots;
        // }

        function generateTimeSlots(minDuration = 5, maxDuration = 8) {
            const slots = [];
            const startHour = 7;
            const endHour = 17;

            for (let hour = startHour; hour <= endHour; hour++) {
                for (let duration = minDuration; duration <= maxDuration; duration++) {
                    const endTimeHour = hour + duration;
                    if (endTimeHour <= endHour) {
                        const startTime = `${hour.toString().padStart(2, '0')}:00`;
                        const endTime = `${endTimeHour.toString().padStart(2, '0')}:00`;
                        slots.push({ start: startTime, end: endTime, duration });
                    }
                }
            }
            return slots;
        }

        function isTimeSlotAvailable(dateStr, startTime, endTime) {
            if (!bookedTimes[dateStr]) return true;

            return !bookedTimes[dateStr].some(booking => {
                return (startTime < booking.end && endTime > booking.start);
            });
        }

        function renderDateNavigation() {
            const dates = generateDates();
            const container = document.getElementById('dateNavigation');

            container.innerHTML = dates.map((date, index) => {
                const dateStr = formatDate(date, 'full');
                const dateDisplay = formatDate(date);
                const isAvailable = isDateAvailable(dateStr);
                const isToday = index === 0;

                const isStart = startDate === dateStr;
                const isEnd = endDate === dateStr;
                const inRange = startDate && endDate && new Date(dateStr) > new Date(startDate) && new Date(dateStr) < new Date(endDate);

                return `
                    <button
                        onclick="selectDate('${dateStr}')"
                        class="p-4 rounded-xl text-center transition-all duration-200 transform hover:scale-105
                            ${isStart || isEnd ? 'bg-blue-600 text-white shadow-lg'
                                : inRange ? 'bg-blue-100 text-blue-800'
                                : isAvailable ? 'bg-gray-50 hover:bg-blue-50 text-gray-900 border-2 border-gray-200 hover:border-blue-300'
                                : 'bg-red-50 text-red-400 cursor-not-allowed border-2 border-red-200'}"
                        ${!isAvailable ? 'disabled' : ''}
                    >
                        <div class="text-xs font-semibold mb-1 ${isStart || isEnd ? 'text-blue-100' : 'text-gray-500'}">${dateDisplay.day}</div>
                        <div class="text-2xl font-bold mb-1">${dateDisplay.date}</div>
                        <div class="text-sm font-medium ${isStart || isEnd ? 'text-blue-100' : 'text-gray-600'}">${dateDisplay.month}</div>
                        ${isStart ? '<div class="text-xs mt-2 font-semibold">Mulai</div>' : ''}
                        ${isEnd ? '<div class="text-xs mt-2 font-semibold">Selesai</div>' : ''}
                        ${isToday ? '<div class="text-xs mt-1 font-semibold ' + (isStart || isEnd ? 'text-blue-100' : 'text-blue-600') + '">Hari ini</div>' : ''}
                    </button>
                `;
            }).join('');
        }

        // function selectDate(dateStr) {
        //     selectedDate = dateStr;
        //     renderDateNavigation();
        //     renderTimeSlots();
        // }

        let startDate = null;
        let endDate = null;

        function selectDate(dateStr) {
            if (!startDate) {
                startDate = dateStr;
                endDate = null;
            } else if (!endDate) {
                endDate = dateStr;
                // kalau user pilih mundur, swap
                if (new Date(endDate) < new Date(startDate)) {
                    [startDate, endDate] = [endDate, startDate];
                }
                selectedDate = startDate;
                document.getElementById('selectedDate').value = startDate;
                document.getElementById('selectedEndDate').value = endDate || startDate;
            } else {
                // reset kalau klik lagi
                startDate = dateStr;
                endDate = null;
                document.getElementById('selectedEndDate').value = "";
            }

            renderDateNavigation();
            renderTimeSlots();
        }

        function renderTimeSlots() {
            if (!selectedDate) return;

            const slots = generateTimeSlots();
            const container = document.getElementById('timeSlots');

            container.innerHTML = `
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Pilih Waktu</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    ${slots.map(slot => {
                        const isAvailable = isTimeSlotAvailable(selectedDate, slot.start, slot.end);

                        return `
                            <button
                                onclick="selectTimeSlot('${slot.start}', '${slot.end}')"
                                class="p-4 rounded-xl border-2 text-center transition-all duration-200 transform hover:scale-105 ${
                                    isAvailable
                                        ? 'border-gray-200 hover:border-blue-500 hover:bg-blue-50 bg-white'
                                        : 'border-red-200 bg-red-50 text-red-400 cursor-not-allowed'
                                }"
                                ${!isAvailable ? 'disabled' : ''}
                            >
                                <div class="font-bold text-lg mb-2">${slot.start} - ${slot.end}</div>
                                <div class="text-sm font-semibold px-3 py-1 rounded-full ${
                                    isAvailable
                                        ? 'text-green-700 bg-green-100'
                                        : 'text-red-700 bg-red-100'
                                }">
                                    ${isAvailable ? 'Tersedia' : 'Terbooked'}
                                </div>
                            </button>
                        `;
                    }).join('')}
                </div>
            `;
        }

        function selectTimeSlot(startTime, endTime) {
            selectedTimeSlot = { start: startTime, end: endTime };

            document.getElementById('selectedDate').value = startDate;
            document.getElementById('selectedEndDate').value = endDate || startDate;
            document.getElementById('selectedStartTime').value = startTime;
            document.getElementById('selectedEndTime').value = endTime;

            const startObj = new Date(startDate);
            const endObj = endDate ? new Date(endDate) : startObj;

            const startDisplay = startObj.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            const endDisplay = endObj.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

            document.getElementById('selectedTimeDisplay').textContent =
                (startDate === endDate || !endDate)
                    ? `${startDisplay}, ${startTime} - ${endTime}`
                    : `${startDisplay} s/d ${endDisplay}, ${startTime} - ${endTime}`;

            document.getElementById('bookingModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderDateNavigation();
        });

        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
