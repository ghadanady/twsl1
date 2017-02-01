@if ($paginator->lastPage() > 1)
<div class="row">
    <div class="col-xs-12 text-center">

        <a href="{{ ($paginator->currentPage() == 1) ? '#' : $paginator->url($paginator->currentPage() - 1) }}" class="navgat-a nmr">
            <i class="fa fa-angle-right"></i>
            <span>السابق</span>
        </a>
        <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? '#' : $paginator->url($paginator->currentPage() + 1) }}" class="navgat-a nml">
            <span>التالي</span>
            <i class="fa fa-angle-left"></i>
        </a>
    </div>
</div>
@endif
