@if($paginator->total() >= 1)
    <tfoot>
        <tr>
            <th colspan="100">
                <div class="ui right floated pagination menu">
                    <div class="item">
                        Página {{$paginator->currentPage()}}
                        de {{$paginator->lastPage()}}
                        - {{$paginator->total()}}
                        @if($paginator->total() == 1)
                            Elemento
                        @else
                            Elementos
                        @endif
                    </div>
                    {{-- Previous Page Link --}}
                    @if($paginator->onFirstPage())
                        <a class="icon item disabled">
                            <i class="left chevron icon"></i>
                        </a>
                    @else
                        <a class="icon item" href="{{$paginator->previousPageUrl()}}">
                            <i class="left chevron icon"></i>
                        </a>
                    @endif
                    {{-- Pagination Elements --}}
                    @foreach($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if(is_string($element))
                            <a class="item disabled">{{$element}}</a>
                        @endif

                        {{-- Array Of Links --}}
                        @if(is_array($element))
                            @foreach($element as $page => $url)
                                @if($page == $paginator->currentPage())
                                    <a class="item active">{{$page}}</a>
                                @else
                                    <a class="item" href="{{$url}}">{{$page}}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a class="icon item" href="{{$paginator->nextPageUrl()}}">
                            <i class="right chevron icon"></i>
                        </a>
                    @else
                        <a class="icon item disabled">
                            <i class="right chevron icon"></i>
                        </a>
                    @endif
                </div>
            </th>
        </tr>
    </tfoot>
@endif
