@extends('site.layouts.base.master')
@php
$loginUser=Auth::guard('members')->user();
@endphp
@section('title')

@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>عملية دفع ناجحه</strong> شكراً من اجل اهتمامك البالغ بمنتجاتنا و نرجوا ان نقدم لك اعلي جودة من الخدمة
                    </div>
                    <h3> الطلب رقم {{ $order->id }}#</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>سيتم الشحن الي:</h4>
                            <table class="table">
                                <tr>
                                    <td>اسم المشتري</td><td>{{ $order->address->name }}</td>
                                </tr>
                                <tr>
                                    <td>العنوان الاول</td><td> {{ $order->address->address1 }}</td>
                                </tr>
                                <tr>
                                    <td>العنوان الثاني</td><td>
                                        @if (empty($order->address->address2))
                                            –-
                                        @else
                                            {{ $order->address->address2 }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>الدولة</td><td> {{ $order->address->country }} </td>
                                </tr>
                                <tr>
                                    <td>المدينة</td><td> {{ $order->address->city }} </td>
                                </tr>
                                <tr>
                                    <td>البريد الالكتروني</td><td> {{ $order->address->postal_code }} </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>المنتجات</h4>
                            @foreach ($order->products as $product)
                                <a href="{{ route('product.show',['slug'=> $product->slug]) }}"> {{ $product->name }} </a>(x {{ $product->pivot->quantity }})<br/>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>تكلفة الطلب</h3>
                            <table class="table">
                                <tr>
                                    <td>تكلفة الشحن</td><td>5.00 ريال</td>
                                </tr>
                                <tr>
                                    <td><strong>الاجمالي</strong></td><td>{{ number_format($order->total) }} ريال</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
