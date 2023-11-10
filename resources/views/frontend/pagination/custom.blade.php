@if ($paginator->hasPages())
<ul class="pagination__wrapper d-flex align-items-center justify-content-center">
    @if ($paginator->onFirstPage())
    <li class="pagination__list disabled">
        <span class="pagination__item pagination__item--current">
            <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/></svg>
        </span>
    </li>
    @else
    <li class="pagination__list" >
        <a class="pagination__item--arrow  link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
            <svg xmlns="http://www.w3.org/2000/svg"  width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/></svg>
        </a>
    </li>
    @endif
    @foreach ($elements as $element)
        @if (is_string($element))
    <li class="pagination__list disabled"><span>{{ $element }}</span></li>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
    <li class="pagination__list active my-active"><span class="pagination__item pagination__item--current">{{ $page }}</span></li>
                @else
    <li class="pagination__list"><a class="pagination__item link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if ($paginator->hasMorePages())
    <li class="pagination__list">
        <a href="{{ $paginator->nextPageUrl() }}" rel="next">
            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg>
        </a>
    </li>
    @else
    <li class="pagination__list disabled">
        <span class="pagination__item pagination__item--current">
            <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg>
        </span>
    </li>
    @endif
</ul>
@endif 