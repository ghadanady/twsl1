<div class="products-cc">
    <div class="row">
        @forelse ($products as $product)
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="prod-item">
                    <span class="price">
                        {{ number_format($product->getDiscount()) }} <br /> ريال
                    </span>
                    @php
                    $imgs = $product->getImages();
                    @endphp

                    @if($imgs->isEmpty())
                        <img src="{{ url('storage/uploads/images/category/p_default.png') }}" alt="c" />
                    @else
                        <img src="{{ $imgs->first()->url }}" alt="mob" />
                    @endif
                    <a href="{{ $product->getUrl() }}" class="prod-title"> {{ $product->name }}</a>
                    <div class="rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $product->getRating())
                                <span class="gold"> <i class="fa fa-star"></i> </span>
                            @else
                                <span class="gray"> <i class="fa fa-star"></i> </span>
                            @endif
                        @endfor
                    </div>
                    <div class="prod-buts">
                        <button type="button" class="add-cart cart-btn" data-quantity="1" data-url="{{ $product->getCartUrl('add') }}"> <i class="fa fa-shopping-cart"></i> أضف إلى السلة </button>
                        <button type="button" onclick="location='{{ $product->getUrl() }}'" class="add-cart"> <i class="fa fa-television"></i></button>
                    </div>
                </div>
            </div>
        @empty
            <div class='alert alert-info'> لايوجد منتجات بهذا التصنيف</div>
        @endforelse
        <!-- // -->
    </div>
</div>

@include('site.pages.templates.category-pagination', ['paginator' => $products])
