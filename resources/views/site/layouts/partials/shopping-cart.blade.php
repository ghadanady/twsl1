<div onclick="location='{{ route('site.cart.index') }}'" class="cart-open">
    ( <span> {{ $basket->itemCount() }} </span> )
    <i class="fa fa-shopping-cart"></i>
</div>
<div class="cart-cont" id="cart-content">
    @if ($basket->itemCount())
        <div class="cart-items">
            @foreach ($basket->all() as $item)
                <a href="{{ $item->getUrl() }}" class="close-box">
                    @php
                    $imgs = $item->getImages();
                    @endphp

                    @if($imgs->isEmpty())
                        <img src="{{ url('storage/uploads/images/category/p_default.png') }}" style="max-width: 120px; max-height: 120px;" alt="{{ $item->name }}" />
                    @else
                        <img src="{{ $imgs->first()->url }}" style="max-width: 120px; max-height: 120px;"  alt="{{ $item->name }}" />
                    @endif
                    <p class="product-name">
                        {{ $item->name }}
                    </p>
                    <div class="product-price">
                        {{ $item->quantity }} x
                        <span class="price">{{ number_format($item->getDiscount()) }} ريال</span>
                    </div>
                    <div class="close-btn product-remove cart-btn" data-quantity="0" data-url="{{ route('site.cart.update' , ['slug' => $item->slug]) }}">
                        <i class="fa fa-close"></i>
                    </div><!-- .product-remove -->
                </a>
            @endforeach

        </div><!--End cart-items-->
        <div class="shipping">
            <p>Sub Total</p>
            @php
                $subTotal = $basket->subTotal();
            @endphp
            <p>{{ $subTotal > 0 ? number_format(($subTotal + 5 )) : number_format($subTotal) }} ريال</p>
        </div>
        <a href="{{ route('site.order.checkout') }}" class="cart-button">Checkout</a>
    @else
        لا يوجد منتجات بالعربة
    @endif

</div><!--End cart-cont-->
