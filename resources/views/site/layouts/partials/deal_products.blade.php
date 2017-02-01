
    @forelse(App\Product::latest()->get()->filter(function($p){ return $p->hasOffer(); }) as $product)
        <div class="pro-item">
             @include('site.pages.templates.product', ['product' => $product])
        </div>
    @empty
    	<div class="alert alert-info"> لا توجد عروض حتي الان</div>
    @endforelse

