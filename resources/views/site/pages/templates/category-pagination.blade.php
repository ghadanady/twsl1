<?php
// config
$link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>
<div class="hr-row">
    @if ($paginator->lastPage() > 1)
        <div class="hr-right">
            <div class="pagnation">
                <a href="{{ ($paginator->currentPage() == 1) ? '#' : $paginator->url(1) }}"><i class="fa fa-angle-right"></i></a>
                @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                    <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                    ?>
                    @if ($from < $i && $i < $to)
                        <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
                    @endif
                @endfor
                <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? '#' : $paginator->url($paginator->lastPage()) }}"><i class="fa fa-angle-left"></i></a>
            </div>
        </div>
    @endif
    <div class="hr-left">
        <div class="left-text">
            الصفحات من {{ $paginator->currentPage() }} : {{ $paginator->total() }}
        </div>
    </div>
</div>
<!-- row -->
