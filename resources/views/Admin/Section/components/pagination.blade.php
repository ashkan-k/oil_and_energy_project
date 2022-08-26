@if($paginator->hasPages())
    <ul class="pagination d-flex justify-content-center">
        @if ($paginator->onFirstPage())
            <li class="footable-page-arrow disabled"><a>«</a>
            </li>
        @else
            <li class="footable-page-arrow"><a data-page="first" href="{{ $paginator->previousPageUrl() }}">«</a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page ==  $paginator->currentPage())
                        <li class="footable-page active"><a>{{ $page }}</a></li>
                    @else
                        <li class="footable-page"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach


        @if ($paginator->hasMorePages())
            <li class="footable-page-arrow"><a data-page="last" href="{{ $paginator->nextPageUrl() }}">»</a></li>
        @else
            <li class="footable-page-arrow disabled"><a>»</a></li>
        @endif

    </ul>
@endif
