@extends('site.layouts.base.master')

@section('title')
سلة الشراء
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <h2 class="headline"> سلة الشراء </h2>
                    <br />
                    <br />
                    @if ($basket->itemCount())
                        <form class="ajax-form" data-notification="fancy" onsubmit="return false" method="post">
                            <div class="contents">
                            <table class="table txd table-hover">
                                <thead>
                                    <tr>
                                        <th> المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th> الإجمالية</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($basket->all() as $item)
                                        <tr  class="close-box">
                                            <td valign="middle"> <a href="{{ $item->getUrl() }}">
                                                @php
                                                $imgs = $item->getImages();
                                                @endphp

                                                @if($imgs->isEmpty())
                                                    <img src="{{ url('storage/uploads/images/category/p_default.png') }}" style="max-width: 120px; max-height: 120px;" alt="{{ $item->name }}" />
                                                @else
                                                    <img src="{{ $imgs->first()->url }}" style="max-width: 120px; max-height: 120px;"  alt="{{ $item->name }}" />
                                                @endif
                                            </a></td>
                                            <td valign="middle"><b>{{ number_format($item->getDiscount()) }}</b> ريال</td>
                                            <td valign="middle">
                                                <div class="quantity">
                                                    <div class="sp-quantity">
                                                        <div class="sp-minus fff asdasxx"><a class="ddd" data-multi="1">+</a></div>
                                                        <div class="sp-input">
                                                            <input type="text" class="quntity-input" data-max="{{ $item->stock }}" data-min="0" name="quantities[]" value="{{ $item->quantity }}" />
                                                        </div>
                                                        <div class="sp-plus fff asdasxx"><a class="ddd" data-multi="-1">-</a></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td valign="middle"><b>{{ number_format(($item->quantity * $item->getDiscount())) }}</b> ريال</td>
                                            <td valign="middle">
                                                <a href="#" class="c-cart cart-btn close-btn" data-quantity="0" data-url="{{ $item->getCartUrl('update') }}"> <i class="fa fa-close"></i> </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <br />
                            <br />

                            <div class="row-form but-holder text-right" style="color:#FFF;">
                                <button type="submit" data-url="{{ route('site.cart.update-cart') }}" data-loading="انتظر..." class=" ajax-submit sub-b2">تحديث السلة</button>
                            </div>

                            <div class="details">
                                <div class="de-right">المشتريات</div>
                                <div class="de-left">{{ $basket->itemCount() }}</div>
                            </div>
                            <div class="details">
                                <div class="de-right">قيمة الشحن</div>
                                <div class="de-left">5.00 ريال</div>
                            </div>
                            <div class="details">
                                <div class="de-right">مصاريف إضافية</div>
                                <div class="de-left">00.00 ريال</div>
                            </div>
                            <div class="details">
                                <div class="de-right"><b>إجمالي المشتريات</b></div>
                                <div class="de-left"><span>{{ number_format(($basket->subTotal() + 5 )) }}</span> ريال</div>
                            </div>
                            <br />

                            <div onclick="location='{{ route('site.order.checkout') }}'" class="row-form but-holder text-right" style="color:#FFF;">
                                <button type="button" class="sub-b2">الدفع</button>
                            </div>
                            <br />
                            <br />
                        </div>
                            {!! csrf_field() !!}
                        </form>
                    @else
                        <div class="alert alert-info">
                            لا يوجد منتجات حتي الان في العربة &larr; <a href="{{ route('site.index') }}"> تسوق الان</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>



    @if (Session::has('seen'))
    <div class="related">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="headline2"> انت مهتم بـ ... </h2>
                    <div class="owl-carousel carousel2">
                        @foreach (Session::get('seen') as $id)
                            @php
                                if(!($product = App\Product::find($id))){
                                    continue;
                                }
                            @endphp
                            <div class="related-p">
                                @include('site.pages.templates.product', ['product' => $product])
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
