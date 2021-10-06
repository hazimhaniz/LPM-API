@if ($paginator->hasPages() && $paginator->total() > 0)
    <nav>
    <ul class="pagination pagination-primary">

        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link" tabindex="-1" data-original-title="" title="">Previous</a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link" >{{ $element }}</a></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" >{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link"  href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="page-item disabled"><a class="page-link" >Next</a></li>
        @endif
    </ul>
    </nav>
@endif
