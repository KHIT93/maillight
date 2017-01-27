@if ($paginator->hasPages())
    <nav class="pagination is-right">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination-previous is-disabled">Previous</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-previous">Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-next">Next</a>
        @else
            <a class="pagination-next is-disabled">Next</a>
        @endif
        <ul class="pagination-list"></ul>
    </nav>
@endif