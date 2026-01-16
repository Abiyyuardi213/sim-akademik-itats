@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                <span
                    class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-300 bg-white border border-zinc-200 rounded-lg cursor-default"
                    aria-hidden="true">
                    <i class="fas fa-chevron-left text-xs"></i>
                </span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-500 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 transition-colors"
                aria-label="{{ __('pagination.previous') }}">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-700 bg-white border border-zinc-200 rounded-lg cursor-default">{{ $element }}</span>
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">
                            <span
                                class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-white bg-zinc-900 border border-zinc-900 rounded-lg cursor-default shadow-sm">{{ $page }}</span>
                        </span>
                    @else
                        <a href="{{ $url }}"
                            class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-500 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 transition-colors"
                            aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-500 bg-white border border-zinc-200 rounded-lg hover:bg-zinc-50 focus:z-20 focus:outline-offset-0 transition-colors"
                aria-label="{{ __('pagination.next') }}">
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                <span
                    class="relative inline-flex items-center justify-center h-10 w-10 text-sm font-medium text-zinc-300 bg-white border border-zinc-200 rounded-lg cursor-default"
                    aria-hidden="true">
                    <i class="fas fa-chevron-right text-xs"></i>
                </span>
            </span>
        @endif
    </nav>
@endif
