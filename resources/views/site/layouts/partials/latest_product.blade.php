    @foreach(App\Product::latest()->get() as $product)

        <div class="pro-item">
           @include('site.pages.templates.product', ['product' => $product])
        </div>
    @endforeach

