@extends('site.layouts.base.master')

@section('title')
    {{$product->name}}
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 rmb20">
                            <div class="pro-imgs-slider">
                                <div class="owl-carousel big-images">
                                    @foreach ($product->getImages() as $img)
                                        <div class="larg-img">
                                            <img src="{{ $img->url }}" alt="l" />
                                        </div>
                                    @endforeach
                                </div>
                                <div class="owl-carousel thumbs">
                                    @foreach ($product->getImages() as $img)
                                        <div class="sma-img">
                                            <img src="{{ $img->url }}" alt="l" />
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="pro-title-in">
                                {{ $product->name }}
                                {{ $rate }}
                            </div>

                            <div style="direction: ltr;margin-left: 250px; position: relative; z-index: 0;" >

                                <div class="rateyo"
                                data-geturl="{{ url('product/rate') }}"
                                data-url="{{ url('product/addrate') }}"
                                data-productId="{{ $product->id }}" >
                            </div>
                        </div>

                        <div class="red-t">التفاصيل</div>
                        <p class="in-o-det">
                            {!!$product->desc!!}
                        </p>
                        @if($product->hasOffer() )
                            <div class="price new">
                                <strong>{{$product->getDiscount()}}</strong>
                                <span>ريال</span>
                            </div>
                            <div class="price old">
                                <strong>{{$product->price}}</strong>
                                <span>ريال</span>
                            </div>

                        @else

                            <div class="price new">
                                <strong>{{$product->price}}</strong>
                                <span>ريال</span>
                            </div>
                        @endif

                        <form onsubmit="return false;" class="cart-form" action="{{ $product->getCartUrl('update') }}">
                            <div class="quantity">
                                <div class="sp-quantity">
                                    <div class="sp-plus fff asdasxx"><a class="ddd" data-multi="-1">-</a></div>
                                    <div class="sp-input">
                                        <input type="text" data-max="{{ $product->stock }}" data-min="0" name="quantity" class="quntity-input" value="1" />
                                    </div>
                                    <div class="sp-minus fff asdasxx"><a class="ddd" data-multi="1">+</a></div>
                                </div>
                                <button type="button" class="add-cart cart-btn">
                                    أضف إلى السلة
                                </button>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>



                <h2 class="headline2"> التعليقات </h2>
                <div class="comments">
                    @if(count($comments)>0)
                        @foreach($comments as $c)
                            <div class="comment-it{{($loop->last)? '_last' : '' }}" data-last="{{ ($loop->last) }}">
                                <div class="comment-hed">
                                    <span class="scax">{{ $c->name }}</span>
                                    <span>{{ $c->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-text">
                                    {{ $c->comment }}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info"> لم يتم اضافة تعليقات كن انت أول من يعلق</div>
                    @endif


                </div>
                <h2 class="headline2"> إضافة تعليق </h2>
                <div class="errors">

                    @if(isset($errors) && count($errors) > 0)
                        <div class="alert alert-danger alert-dismissable">
                            <button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {!!$error!!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
                <div class="forms">
                    <form action="{{url('product/addComment')}}" method="post" >
                        {{ csrf_field() }}
                        <div class="row-form">
                            <input type="text"  name="name" class="full-form" placeholder="الإسم" />
                            <input type="hidden"  name="product_id" value="{{$product->id}}" />
                        </div>
                        <div class="row-form">
                            <input type="email"  name="email" class="full-form" placeholder="البريد الإلكتروني" />
                        </div>
                        <div class="row-form">
                            <textarea class="full-form"  name="comment"placeholder="التعليق"></textarea>
                        </div>
                        <div class="row-form but-holder">
                            <button type="submit" class="sub-b">إرسال</button>
                        </div>
                    </form>
                </div>

            </div><!--right-->
            <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="left-ads">
                    <a href="#">
                        <img src="{{ asset('assets/site/imgs/ad-laptop.png') }}" alt="s" />
                    </a>
                </div>
            </div><!--left-->

        </div>
    </div>
</div>
@if(count($related_products)>0)
    <div class="related">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="headline2"> منتجات ذات صلة </h2>
                    <div class="owl-carousel carousel2">
                        @foreach($related_products as $p)
                            <div class="related-p">
                                @include('site.pages.templates.product', ['product' => $p])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="small-imgs">
    @include('site.layouts.partials.tradmark')
</div>

@endsection
