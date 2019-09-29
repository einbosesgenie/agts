 <div class="pagination">
     @if ($paginator->hasPages())
        <div>
            <div class="pagination__row">
                @if ($paginator->onFirstPage())
                    <a class="pagination__back disable" rel="prev"><span>Назад</span></a>
                @else
                    <a class="pagination__back" href="{{ $paginator->previousPageUrl() }}" rel="prev"><span>Назад</span></a>
                @endif
                @foreach ($elements as $element)
                    @if (is_array($element))
                        <div class="pagination__pages">
                            @foreach ($element as $page => $url)
                                @if ($page === $paginator->currentPage())
                                    <a class="active" href="#">{{ $page }}</a>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <a class="pagination__next" href="{{ $paginator->nextPageUrl() }}"
                       rel="prev"><span>Вперед</span></a>
                @else
                    <a class="pagination__next disabled" rel="next"><span>Вперед</span></a>
                @endif
            </div>
            <div class="pagination__more">
                <div class="pagination__more--mobile">
                    <button class="btn btn-fill js-pagination-more">Показать еще</button>
                </div>
                <div class="pagination__more--desktop">
                    <button class="btn btn-empty js-pagination-more">Показать еще</button>
                </div>
            </div>
        </div>
        @endif
    </div>