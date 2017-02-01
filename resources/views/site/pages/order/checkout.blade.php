@extends('site.layouts.base.master')
@php
$loginUser=Auth::guard('members')->user();
@endphp
@section('title')

@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <form action="{{ route('site.order.create') }}" method="post">
                <div class="row">
                    <div class="col-md-8">
                        @include('site.layouts.partials.alerts')
                        <div class="col-md-6">
                            <h3>عنوان الشحن</h3>
                            <hr>
                            <div class="form-group">
                                <label for="address1">العنوان الاول</label>
                                <input type="text" name="address1" id="address1" value="{{ $loginUser->address }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address2">العنوان الثاني (اختياري)</label>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Optional">
                            </div>
                            <div class="form-group">
                                <label for="country">الدولة</label>
                                <select data-region-id="one" id="country" data-default-option="{{ $loginUser->country }}"  data-default-value="{{ $loginUser->country }}"   dir="ltr" name="country" class="crs-country form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="one">المدينه</label>
                                <select id="one" name="city" data-default-option="{{ $loginUser->city }}"  data-default-value="{{ $loginUser->city }}" dir="ltr" class="form-control">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postalcode">الرقم البريدي</label>
                                <input type="text" name="postal_code" id="postalcode" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>بيانات الشخصية</h3>
                            <hr>
                            <div class="form-group">
                                <label for="name">الاسم الشخصي</label>
                                <input type="text" name="name" id="name" value="{{ $loginUser->f_name." " .$loginUser->l_name }}" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="phone">رقم الهاتف</label>
                                <input type="tel" name="phone" id="phone" value="{{ $loginUser->phone }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <h4>بيانات الطلب</h4>
                            <hr>
                            @include('site.layouts.partials.cart-summary')
                            <button class="btn btn-default" type="submit">تاكيد الدفع </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <!-- Appending Drop-In payment form -->
                            <h3>الدفع الالكتروني<h3>
                                <hr>
                                <div id="payment-form">
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="https://js.braintreegateway.com/js/braintree-2.27.0.min.js"></script>
    <script>
    $.ajax({
        url: '{{ route('site.braintree.token') }}',
        type: 'get',
        datatype: 'json'
    })
    .success(function(CLIENT_TOKEN){
        braintree.setup(CLIENT_TOKEN.token, 'dropin', {
            container: 'payment-form'
        });
    });
    </script>
@endsection
