<div class="shop_pagination_area wow fadeInUp" data-wow-delay="1.1s">
    <nav aria-label="Page navigation">
        @if ($paginator->hasPages())
            <ul class="pagination pagination-sm" wire:click="$emit('updateFilter')">
                @if (!$paginator->onFirstPage())
                    <li class="page-item"><a class="page-link" wire:click="previousPage">
                        &larr;</a>
                    </li>
                @endif
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" wire:click="nextPage">&rarr;</a></li>
                @endif
            </ul>
        @endif
    </nav>
</div>
