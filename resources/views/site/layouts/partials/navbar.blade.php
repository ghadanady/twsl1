<div class="uper-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 text-right rmb20">
                <div class="menu-toggle">
                    <i class="fa fa-bars"></i>
                    <span>أقسام الموقع</span>
                    <i class="fa fa-angle-down"></i>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 text-left rmb20">
                <div class="shopping-cart" data-url="{{ route('site.cart.index') }}" id="shopping-cart-box">
                    @include('site.layouts.partials.shopping-cart')
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mainer-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <ul class="up-menu">
                    @php
                        $skiped_ids = []
                    @endphp
                    @foreach(App\Category::take(7)->get() as $c)
                        <li class="up-menu-item">
                            <a href="{{ $c->getUrl() }}" >
                                {{$c->name}}
                                @if($c->subCategories->isEmpty())
                                </a>
                            @else
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="up-menu-child">
                                @foreach($c->subCategories as $sub)
                                    <li>
                                        @php
                                            $skiped_ids [] = $sub->id;
                                        @endphp
                                        <a href="{{ $sub->getUrl() }}">
                                            {{ $sub->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li class="up-menu-item">
                    <a >
                        اخري
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="up-menu-child">
                        @foreach(App\Category::skip(7)->take(App\Category::count() - 7)->get() as $c)
                            @if (in_array($c->id,$skiped_ids))
                                @continue
                            @endif
                            <li>
                                <a href="{{ $c->getUrl() }}">
                                    {{ $c->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
