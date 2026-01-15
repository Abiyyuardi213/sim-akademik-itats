@extends('layouts.user')

@section('title', $pengumuman->judul)

@section('content')
    <div class="min-h-screen bg-zinc-50 pt-24 pb-12">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            <!-- Breadcrumb -->
            <nav class="flex mb-6 text-sm text-zinc-500">
                <a href="{{ url('home') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('pengumuman.index') }}" class="hover:text-zinc-900 transition-colors">Pengumuman</a>
                <span class="mx-2">/</span>
                <span class="text-zinc-900 truncate max-w-xs">{{ $pengumuman->judul }}</span>
            </nav>

            <article class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden">
                <!-- Header -->
                <div class="bg-zinc-50/50 border-b border-zinc-100 p-6 md:p-10 text-center">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold uppercase tracking-wider mb-4">
                        Informasi
                    </div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-zinc-900 tracking-tight leading-tight mb-4">
                        {{ $pengumuman->judul }}
                    </h1>
                    <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-zinc-500">
                        <div class="flex items-center gap-2">
                            <div class="h-6 w-6 rounded-full bg-zinc-200 flex items-center justify-center">
                                <i class="fas fa-user text-[10px] text-zinc-500"></i>
                            </div>
                            <span>{{ $pengumuman->author->name ?? 'Admin' }}</span>
                        </div>
                        <span>&bull;</span>
                        <div class="flex items-center gap-2">
                            <i class="far fa-calendar text-zinc-400"></i>
                            <span>{{ \Carbon\Carbon::parse($pengumuman->tanggal_dibuat)->locale('id')->isoFormat('D MMMM Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 md:p-10">
                    <div class="prose prose-zinc max-w-none text-zinc-800 leading-relaxed trix-content">
                        {!! $pengumuman->isi !!}
                    </div>
                </div>

                <!-- Footer Share/Nav -->
                <div class="bg-zinc-50 border-t border-zinc-100 p-6 flex justify-between items-center">
                    <a href="{{ route('pengumuman.index') }}"
                        class="text-zinc-600 hover:text-zinc-900 font-medium text-sm flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </article>
        </div>
    </div>

    <style>
        /* Custom Trix Content Styling for Guest View */
        .trix-content h1 {
            font-size: 1.75em;
            font-weight: 800;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            color: #18181b;
        }

        .trix-content h2 {
            font-size: 1.5em;
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
            color: #18181b;
        }

        .trix-content h3 {
            font-size: 1.25em;
            font-weight: 600;
            margin-top: 1.25em;
            margin-bottom: 0.5em;
            color: #18181b;
        }

        .trix-content p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }

        .trix-content ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
        }

        .trix-content ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 1.25em;
        }

        .trix-content li {
            margin-bottom: 0.5em;
        }

        .trix-content blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1em;
            margin-left: 0;
            color: #4b5563;
            font-style: italic;
            background-color: #eff6ff;
            padding: 1em;
            border-radius: 0 0.5rem 0.5rem 0;
            margin-bottom: 1.5em;
        }

        .trix-content a {
            color: #2563eb;
            text-decoration: underline;
            font-weight: 500;
        }

        .trix-content strong {
            font-weight: 700;
            color: #18181b;
        }
    </style>
@endsection
