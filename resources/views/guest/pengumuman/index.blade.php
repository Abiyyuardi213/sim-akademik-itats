@extends('layouts.user')

@section('title', 'Daftar Pengumuman')

@section('content')
    <div class="min-h-screen bg-zinc-50 pt-24 pb-12">
        <div class="container mx-auto px-4 md:px-8">
            <!-- Header -->
            <div class="mb-10 text-center max-w-2xl mx-auto">
                <h1 class="text-3xl font-extrabold text-zinc-900 tracking-tight sm:text-4xl">
                    Pengumuman & Informasi
                </h1>
                <p class="mt-4 text-zinc-500">
                    Informasi terbaru seputar peminjaman ruangan dan fasilitas kampus ITATS.
                </p>
            </div>

            @if ($pengumumans->isEmpty())
                <div class="text-center py-16">
                    <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-zinc-100 mb-6">
                        <i class="fas fa-bullhorn text-3xl text-zinc-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-zinc-900">Belum ada pengumuman</h3>
                    <p class="text-zinc-500 mt-2">Silakan cek kembali nanti untuk update terbaru.</p>
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pengumumans as $item)
                        <article
                            class="bg-white rounded-2xl shadow-sm border border-zinc-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col h-full group">
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-xs text-zinc-500 mb-3">
                                    <span
                                        class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full font-medium">Info</span>
                                    <span>&bull;</span>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal_dibuat)->locale('id')->diffForHumans() }}</span>
                                </div>

                                <h2
                                    class="text-xl font-bold text-zinc-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    <a href="{{ route('pengumuman.show', $item->id) }}">
                                        {{ $item->judul }}
                                    </a>
                                </h2>

                                <div class="text-zinc-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($item->isi), 150) }}
                                </div>

                                <div class="mt-auto pt-4 border-t border-zinc-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="h-6 w-6 rounded-full bg-zinc-100 flex items-center justify-center text-xs font-bold text-zinc-500">
                                            {{ substr($item->author->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span
                                            class="text-xs font-medium text-zinc-700">{{ $item->author->name ?? 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('pengumuman.show', $item->id) }}"
                                        class="text-sm font-semibold text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                                        Baca selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
