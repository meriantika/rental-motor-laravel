@if ($paginator->hasPages())
<div class="dashboard-pagination">

    {{-- PREVIOUS --}}
    @if ($paginator->onFirstPage())
        <span class="page-btn disabled">
            ‹
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" 
           class="page-btn hover-scale"
           aria-label="Previous">
            ‹
        </a>
    @endif


    {{-- PAGE NUMBERS --}}
    @foreach ($elements as $element)

        {{-- DOTS --}}
        @if (is_string($element))
            <span class="page-dots">...</span>
        @endif

        {{-- NUMBER LINKS --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)

                @if ($page == $paginator->currentPage())
                    <span class="page-btn active">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" 
                       class="page-btn hover-scale">
                        {{ $page }}
                    </a>
                @endif

            @endforeach
        @endif

    @endforeach


    {{-- NEXT --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" 
           class="page-btn hover-scale"
           aria-label="Next">
            ›
        </a>
    @else
        <span class="page-btn disabled">
            ›
        </span>
    @endif

</div>
@endif