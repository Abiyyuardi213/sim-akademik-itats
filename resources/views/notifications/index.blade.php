@extends($layout)

@section('title', 'Semua Notifikasi')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Notifikasi</h1>
                <p class="text-sm text-zinc-500 mt-1">Lihat semua riwayat notifikasi Anda.</p>
            </div>

            @if ($notifications->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-zinc-300 rounded-md shadow-sm text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-check-double mr-2"></i> Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden">
            @if ($notifications->count() > 0)
                <ul class="divide-y divide-zinc-100">
                    @foreach ($notifications as $notification)
                        @php
                            $isRead = !is_null($notification->read_at);
                        @endphp
                        <li
                            class="relative hover:bg-zinc-50 transition duration-150 ease-in-out {{ $isRead ? '' : 'bg-blue-50/30' }}">
                            <a href="{{ route('notifications.go', $notification->id) }}" class="block p-6">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="h-10 w-10 rounded-full {{ $isRead ? 'bg-zinc-100 text-zinc-500' : 'bg-blue-100 text-blue-600' }} flex items-center justify-center">
                                            <i class="fas {{ $isRead ? 'fa-bell' : 'fa-bell' }} text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-zinc-900 truncate">
                                                {{ $notification->data['title'] ?? 'Pemberitahuan' }}
                                            </p>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <p
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-zinc-100 text-zinc-800">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            <p class="text-sm text-zinc-600 line-clamp-2">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                    @if (!$isRead)
                                        <div class="flex-shrink-0 self-center">
                                            <span
                                                class="h-2.5 w-2.5 bg-blue-600 rounded-full block ring-2 ring-white"></span>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="px-6 py-4 border-t border-zinc-200 bg-zinc-50">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-zinc-100 mb-4">
                        <i class="far fa-bell-slash text-2xl text-zinc-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-zinc-900">Belum ada notifikasi</h3>
                    <p class="mt-1 text-sm text-zinc-500">Anda akan melihat notifikasi di sini ketika ada aktivitas baru.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
