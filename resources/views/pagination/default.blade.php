<?php $link_limit = 7; ?>
@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        @if($paginator->currentPage()>1)
            <li class="">
                <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
            </li>
        @endif
{{--        @if(true)
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $paginator->url($paginator->firstPage()) }}">{{ $paginator->firstPage() }}s</a>
            </li>
            <li class="disabled">
                <span>&hellip;</span>
            </li>
        @endif--}}
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                if ($paginator->currentPage() > 1) {
                    $to += $half_total_links - $paginator->currentPage() - 1;
                } else {
                    $to += $half_total_links - $paginator->currentPage();
                }
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    @if(($paginator->currentPage() == $i))
                        <span>{{ $i }}</span>
                    @else
                        <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                </li>
            @endif
        @endfor
        @if($link_limit<$paginator->lastPage() && $paginator->currentPage()<($link_limit+1))
            <li class="disabled">
                <span>&hellip;</span>
            </li>
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif
        @if(($paginator->currentPage()+1)!=$i)
            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a href="{{$paginator->nextPageUrl() }}">&raquo;</a>
            </li>
        @endif
    </ul>
@endif