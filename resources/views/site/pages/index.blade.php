@extends('site.layouts.base.master')

@section('title')
الرئيسية
@endsection
@section('content')

    <!-- slider section -->
    @include('site.layouts.partials.slider')

    <div class="top-ads">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <a href="#" class="ads-inline">
                        <img src="{{ asset('assets/site/imgs/ux3-1.png') }}" alt="s" />
                        <span class="shadows"></span>
                        <span class="ard-po">عرض خاص</span>
                        <span class="ard-po-txt">
                            عنوان العرض الخاص سوف نظهرة هنا وإسم المنتج
                            <hr />
                            خصم يصل لـ 50%
                        </span>
                    </a>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <a href="#" class="ads-inline">
                        <img src="{{ asset('assets/site/imgs/ux3-2.png') }}" alt="s" />
                        <span class="shadows"></span>
                        <span class="ard-po">عرض خاص</span>
                        <span class="ard-po-txt">
                            عنوان العرض الخاص سوف نظهرة هنا وإسم المنتج
                            <hr />
                            خصم يصل لـ 50%
                        </span>
                    </a>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <a href="#" class="ads-inline">
                        <img src="{{ asset('assets/site/imgs/ux3-3.png') }}" alt="s" />
                        <span class="shadows"></span>
                        <span class="ard-po">عرض خاص</span>
                        <span class="ard-po-txt">
                            عنوان العرض الخاص سوف نظهرة هنا وإسم المنتج
                            <hr />
                            خصم يصل لـ 50%
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="latest">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="newst-top">
                        <div class="newst-inline">
                            <h2></h2>
                        </div>
                        <div class="newst-inline">
                            <ul class="nav" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tx1" aria-controls="tx1" role="tab" data-toggle="tab"> عروض</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tx2" aria-controls="tx2" role="tab" data-toggle="tab">المضاف حديثا </a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tx1">
                            <div class="owl-carousel topleft carousel1" id="">
                                @include('site.layouts.partials.latest_product');
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane " id="tx2">
                            <div class="owl-carousel topleft carousel1" id="">
                                @include('site.layouts.partials.deal_products');
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tx3">
                            <div class="owl-carousel topleft carousel1" id="">
                                <div class="pro-item">
                                    <div class="pro-s">
                                        <div class="p-img-holder">
                                            <img src="{{ asset('assets/site/imgs/prod-img.png') }}" alt="pro" />
                                            <span class="pro-shadow"></span>
                                            <span class="prod-info">
                                                <b>299.00</b>
                                                ريال
                                            </span>
                                            <a href="#">
                                                <hr />
                                                <i class="fa fa-shopping-bag"></i>
                                                <span>أضف إلى السلة</span>
                                            </a>
                                        </div>
                                        <a class="prod-go" href="#">إسم المنتج يظهر هنا</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



    <div class="c-ads">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/c-ads1.png') }}" alt="ads" />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/c-ads2.png') }}" alt="ads" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="heads">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="heads-cx">
                        المنتجات
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="products-mx">
        <div class="container">
            @include('site.pages.templates.products', ['products' => App\Product::orderByRaw('RAND()')->paginate(8)])
        </div>
    </div>


    <div class="c-ads">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/x-ads1.png') }}" alt="ads" />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/x-ads2.png') }}" alt="ads" />
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
