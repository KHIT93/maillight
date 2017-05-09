@if ($paginator->hasPages())
<ul class="pagination">
    <li>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination__navigation pagination__navigation--disabled">
                <i class="material-icons icon">chevron_left</i>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination__navigation">
                <i class="material-icons icon">chevron_left</i>
            </a>
        @endif
    </li>
    <li>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination__navigation">
                <i class="material-icons icon">chevron_right</i>
            </a>
        @else
            <a class="pagination__navigation pagination__navigation--disabled">
                <i class="material-icons icon">chevron_right</i>
            </a>
        @endif
    </li>
</ul>
@endif
