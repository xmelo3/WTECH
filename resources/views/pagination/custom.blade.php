@if ($paginator->hasPages())
<nav class="custom-pagination" role="navigation" aria-label="Pagination">

    {{-- ‹ Previous --}}
    @if ($paginator->onFirstPage())
        <span class="page-btn page-arrow disabled" aria-disabled="true">&#8249;</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn page-arrow" rel="prev" aria-label="Previous">&#8249;</a>
    @endif

    {{-- Numbered pages --}}
    @foreach ($elements as $element)

        {{-- Dots spacer --}}
        @if (is_string($element))
            <span class="page-btn page-dots">{{ $element }}</span>
        @endif

        {{-- Page links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-btn page-current" aria-current="page">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif

    @endforeach

    {{-- › Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn page-arrow" rel="next" aria-label="Next">&#8250;</a>
    @else
        <span class="page-btn page-arrow disabled" aria-disabled="true">&#8250;</span>
    @endif

</nav>
@endif