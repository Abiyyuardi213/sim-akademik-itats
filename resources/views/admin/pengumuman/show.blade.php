@extends('layouts.admin')

@section('title', 'Detail Pengumuman')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-zinc-900">Detail Pengumuman</h1>
            <a href="{{ route('admin.pengumuman.index') }}"
                class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition-colors">
                &larr; Kembali
            </a>
        </div>

        <!-- Content Card -->
        <div class="rounded-xl border border-zinc-200 bg-white shadow-sm overflow-hidden">
            <!-- Metadata Header -->
            <div
                class="bg-zinc-50 border-b border-zinc-200 px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-zinc-200 flex items-center justify-center text-zinc-500">
                        <i class="fas fa-bullhorn text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-zinc-900">Oleh: {{ $pengumuman->author->name ?? 'Admin' }}
                        </h2>
                        <p class="text-xs text-zinc-500">
                            {{ \Carbon\Carbon::parse($pengumuman->tanggal_dibuat)->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                </div>
                <div>
                    @if ($pengumuman->status === 'published')
                        <span
                            class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                            Published
                        </span>
                    @elseif($pengumuman->status === 'draft')
                        <span
                            class="inline-flex items-center rounded-full bg-zinc-50 px-2.5 py-0.5 text-xs font-medium text-zinc-600 ring-1 ring-inset ring-zinc-500/10">
                            Draft
                        </span>
                    @else
                        <span
                            class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                            Archived
                        </span>
                    @endif
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">
                <h1 class="text-3xl font-bold text-zinc-900 mb-6">{{ $pengumuman->judul }}</h1>

                <div class="prose prose-zinc max-w-none text-zinc-700 leading-relaxed trix-content">
                    {!! $pengumuman->isi !!}
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="bg-zinc-50 border-t border-zinc-200 px-6 py-4 flex justify-end gap-3">
                <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}"
                    class="inline-flex items-center justify-center rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm font-medium text-zinc-700 shadow-sm hover:bg-zinc-50 hover:text-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-950 focus:ring-offset-2 transition-colors">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ini menghapus pengumuman ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-trash mr-2"></i> Hapus
                    </button>
                </form>
            </div>
        </div>

        <style>
            .trix-content h1 {
                font-size: 1.5em;
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .trix-content h2 {
                font-size: 1.25em;
                font-weight: bold;
                margin-bottom: 0.5em;
            }

            .trix-content ul {
                list-style-type: disc;
                padding-left: 1.5em;
                margin-bottom: 1em;
            }

            .trix-content ol {
                list-style-type: decimal;
                padding-left: 1.5em;
                margin-bottom: 1em;
            }

            .trix-content pre {
                background-color: #f3f4f6;
                padding: 1em;
                border-radius: 0.5rem;
                overflow-x: auto;
                font-family: monospace;
            }

            .trix-content blockquote {
                border-left: 4px solid #e5e7eb;
                padding-left: 1em;
                color: #6b7280;
                font-style: italic;
                margin-bottom: 1em;
            }

            .trix-content a {
                color: #2563eb;
                text-decoration: underline;
            }

            .trix-content div {
                margin-bottom: 0.5em;
            }
        </style>
    </div>
@endsection
