<div class="row">

    @if(count($products)>0)
        @foreach($products as $product)

            <div class="col-xs-12 col-md-6 col-lg-3 mb20" style="max-height: 330px">
                @include('site.pages.templates.product', ['product' => $product])
            </div>
        @endforeach

    @endif


</div>
@include('site.pages.templates.pagination', ['paginator' => $products])
