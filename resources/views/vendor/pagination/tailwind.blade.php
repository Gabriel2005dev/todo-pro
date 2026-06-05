@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="bg-white px-4 py-3 dark:border-gray-800 dark:bg-gray-900">

        {{-- MOBILE --}}
        <div class="flex items-center justify-between sm:hidden">

            @if ($paginator->onFirstPage())
                <span class="flex items-center rounded border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-400 dark:border-gray-700 dark:bg-gray-800">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="flex items-center rounded border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-red-50 hover:text-red-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-900 dark:hover:text-red-400">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="flex items-center rounded border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-red-50 hover:text-red-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-900 dark:hover:text-red-400">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="flex items-center rounded border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-400 dark:border-gray-700 dark:bg-gray-800">
                    {!! __('pagination.next') !!}
                </span>
            @endif

        </div>

        {{-- DESKTOP --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between">

            {{-- INFO --}}
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Mostrando
                @if ($paginator->firstItem())
                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $paginator->firstItem() }}
                    </span>
                    até
                    <span class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $paginator->lastItem() }}
                    </span>
                @else
                    {{ $paginator->count() }}
                @endif
                de
                <span class="font-semibold text-gray-900 dark:text-gray-100">
                    {{ $paginator->total() }}
                </span>
            </div>

            {{-- LINKS --}}
            <div class="flex items-center gap-1">

                {{-- PREVIOUS --}}
                @if ($paginator->onFirstPage())
                    <span class="flex h-9 w-9 items-center justify-center rounded border border-gray-200 bg-gray-50 text-gray-400 dark:border-gray-700 dark:bg-gray-800">
                        ‹
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="flex h-9 w-9 items-center justify-center rounded border border-gray-200 bg-white text-gray-600 transition hover:bg-red-50 hover:text-red-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-red-400">
                        ‹
                    </a>
                @endif

                {{-- NUMBERS --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 text-gray-400">...</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="flex h-9 w-9 items-center justify-center rounded bg-red-700 text-sm font-semibold text-white shadow">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="flex h-9 w-9 items-center justify-center rounded border border-gray-200 bg-white text-sm text-gray-600 transition hover:bg-red-50 hover:text-red-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-900">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- NEXT --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="flex h-9 w-9 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-600 transition hover:bg-red-50 hover:text-red-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-900 dark:hover:text-red-400">
                        ›
                    </a>
                @else
                    <span class="flex h-9 w-9 items-center justify-center rounded-md border border-gray-200 bg-gray-50 text-gray-400 dark:border-gray-700 dark:bg-gray-800">
                        ›
                    </span>
                @endif

            </div>
        </div>

    </nav>
@endif