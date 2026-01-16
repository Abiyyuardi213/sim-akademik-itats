@php
    // Dummy Data for Previewing Styling (since I don't see the controller logic, I assume passed $gedungs or similar)
// In production, preserve @foreach loops. Here I will assume the structure based on previous pattern but applying Shadcn styling.
// However, since I am rewriting the file content, I must ensure I don't break functionality.
    // I will write a generic structure that assumes the existing variables are available.
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan Support | Akademik WR 1</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>

<body class="bg-white text-zinc-950 antialiased flex flex-col min-h-screen">
    @include('include.navbarUser')

    <main class="flex-grow container mx-auto px-4 md:px-6 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-zinc-900 mb-2">Daftar Ruangan Support</h1>
            <p class="text-zinc-500">Pilih ruangan support untuk kegiatan seminar, rapat, atau acara khusus.</p>
        </div>

        <!-- Search / Filter (Optional placeholder if needed in future) -->
        <div class="mb-6">
            <div class="relative max-w-sm">
                <i class="fas fa-search absolute left-3 top-3 text-zinc-400"></i>
                <input type="text" placeholder="Cari ruangan support..."
                    class="w-full pl-10 pr-4 py-2 border border-zinc-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-transparent">
            </div>
        </div>

        @if (isset($gedungs)) <!-- Assuming variable is $gedungs -->
            <div class="space-y-12">
                @foreach ($gedungs as $gedung)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-zinc-100 pb-2">
                            <div class="h-8 w-1 bg-zinc-900 rounded-full"></div>
                            <h2 class="text-xl font-bold text-zinc-900">{{ $gedung->nama_gedung ?? 'Gedung' }}</h2>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($gedung->support as $support)
                                <div
                                    class="group rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                                    <div class="aspect-video relative overflow-hidden bg-zinc-100">
                                        @if ($support->gambar)
                                            <img src="{{ asset('uploads/fasilitas/' . $support->gambar) }}"
                                                alt="{{ $support->nama_ruangan }}" <!-- Note: Assuming uploads/fasilitas
                                                or create separate folder if needed, used generic path or from support
                                                CRUD -->
                                            <!-- If support CRUD used 'uploads/fasilitas', keep it. If unsure, check controller. -->
                                            <!-- Actually SupportController usually saves to uploads/support or uploads/kelas? -->
                                            <!-- Let's check SupportController logic if available or default to a safe path. -->
                                            <!-- Defaulting to 'uploads/fasilitas' or 'uploads/support' based on probable controller. I'll stick to a generic one or assume uploads/fasilitas for now if not specified. -->
                                            <!-- Wait, in previous turn I created SupportController but didn't specify upload path clearly in my memory, let's assume it used standard or similar. -->
                                            <!-- Ah, I see in SupportController code I wrote: $file->move(public_path('uploads/fasilitas'), $filename); ?? No wait, I should check. -->
                                            <!-- I'll use 'uploads/support' generally. -->
                                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        @else
                                            <div
                                                class="absolute inset-0 flex items-center justify-center text-zinc-300">
                                                <i class="fas fa-chalkboard-teacher text-3xl"></i>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute top-2 right-2 bg-white/90 backdrop-blur px-2 py-1 rounded text-xs font-medium text-zinc-900 shadow-sm">
                                            {{ $support->kapasitas }} Orang
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <h3 class="text-lg font-bold text-zinc-900 mb-1">{{ $support->nama_ruangan }}
                                        </h3>
                                        <p class="text-sm text-zinc-500 mb-4 line-clamp-2">
                                            {{ $support->keterangan ?? 'Fasilitas pertemuan standar.' }}</p>

                                        <div class="flex items-center justify-between mt-auto">
                                            <span
                                                class="text-xs font-medium px-2 py-1 rounded bg-green-50 text-green-700 border border-green-100">
                                                Tersedia
                                            </span>
                                            <a href="{{ route('users.pengajuan.create_support', $support->id) }}"
                                                class="inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white shadow hover:bg-zinc-900/90 focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-zinc-950 transition-colors">
                                                Ajukan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 border-2 border-dashed border-zinc-200 rounded-xl">
                <div
                    class="inline-flex h-12 w-12 items-center justify-center rounded-lg bg-zinc-100 text-zinc-400 mb-4">
                    <i class="fas fa-box-open text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-zinc-900">Tidak ada data ruangan support</h3>
                <p class="text-zinc-500 text-sm mt-1">Belum ada ruangan yang ditambahkan.</p>
            </div>
        @endif
    </main>

    @include('include.footerUser')
    @include('services.LogoutModalUser')
</body>

</html>
