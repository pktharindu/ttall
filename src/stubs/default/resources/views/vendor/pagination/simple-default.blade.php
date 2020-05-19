@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex justify-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true">
                    <span class="block px-4 py-3 text-gray-500 border border-r-0 border-gray-300 rounded-l" aria-hidden="true">
                        @lang('pagination.previous')
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       class="block px-4 py-3 text-indigo-800 border border-r-0 border-gray-300 rounded-l hover:text-white hover:bg-indigo-800 focus:outline-none focus:shadow-outline"
                    >
                        @lang('pagination.previous')
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       class="block px-4 py-3 text-indigo-800 border border-gray-300 rounded-r hover:text-white hover:bg-indigo-800 focus:outline-none focus:shadow-outline"
                    >
                        @lang('pagination.next')
                    </a>
                </li>
            @else
                <li aria-disabled="true">
                    <span class="block px-4 py-3 text-gray-500 border border-gray-300 rounded-r">
                        @lang('pagination.next')
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

