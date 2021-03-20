{{-- {{ $data->appends(compact('q'))->onEachSide(1)->links('layouts.paginate') }} --}}
@if ($paginator->hasPages())
    <div class="pagination">

        @if ($paginator->onFirstPage())
            {{-- <a class="disabled"><span>Previous</span></a> --}}
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active my-active"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
        @else
            {{-- <a class="disabled"><span>Next</span></a> --}}
        @endif
    </div>
@endif
