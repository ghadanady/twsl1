<div class="pro-s">
    <div class="p-img-holder">
        @php
        $imgs = $product->getImages();
        @endphp

        @if($imgs->isEmpty())
            <img src="{{ url('storage/uploads/images/category/p_default.png') }}" alt="c" />
        @else
            <img src="{{ $imgs->first()->url }}" alt="mob" />
        @endif

        <span class="pro-shadow"></span>
        <span class="prod-info">
            @if($product->hasOffer() )
                <b>{{ number_format($product->getDiscount()) }}</b>
                بدلا من<br>
                <del class="warning">{{ $product->getPrice() }}</del>
            @else
                <b>{{ $product->getPrice() }}</b>
            @endif
            ريال
        </span>


        <a href="" class="cart-btn" data-quantity="1" data-url="{{ $product->getCartUrl('add') }}">
            <hr />
            <i class="fa fa-shopping-bag"></i>
            <span>أضف إلى السلة</span>
        </a>
    </div>
    <div class="reting">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $product->getRating())
                <span class="fa fa-star gold"></span>
            @else
                <span class="fa fa-star gray"></span>
            @endif
        @endfor
    </div>
    <a class="prod-go" href="{{ $product->getUrl() }}">{{ $product->name }}</a>
</div>
