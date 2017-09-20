<?php
/**
 * Semantic UI
 * Includes previous and next buttons
 * @example $pages->links('pagination-advanced', ['paginator' => $pages])
 * @example @include('pagination-advanced', ['paginator' => $pages])
 *
 * @link https://semantic-ui.com/collections/menu.html#inverted Inverted styles
 * @see <div class="ui pagination inverted blue menu"> Inverted blue menu
 **/
?>
@if ($paginator->hasPages())
    <div class="ui pagination menu">
        @if ($paginator->onFirstPage())
            <a class="item disabled"><span>&laquo;</span></a>
        @else
            <a class="item" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif
    <!-- Array Of Links -->
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="item active"><span>{{ $page }}</span></a>
                    @else
                        <a class="item" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

    <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <a class="item" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <a class="item disabled"><span>&raquo;</span></a>
        @endif
    </div>
@endif