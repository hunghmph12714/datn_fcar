@if ($paginator->hasPages())

<ul class="shop-pagination box-shadow text-center ptblr-10-30">
    @if ($paginator->onFirstPage())
    <li><a href="#"><i class="zmdi zmdi-chevron-left disable"></i></a></li>
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="zmdi zmdi-chevron-left"></i></a></li>

    @endif
    @foreach ($elements as $element)

    @if (is_string($element))
    <li class="disabled"><a href="#">{{ $element }}</a></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active"><a href="#">{{ $page }}</a></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="zmdi zmdi-chevron-right"></i></a></li>
    @else
    <li class="disable"><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
    @endif
</ul>
@endif