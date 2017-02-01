@extends('site.layouts.base.master')

@section('title')

@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">

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

                    @if(session()->has('success'))
                        @foreach(session()->pull('success') as $msg)
                            <div class="alert alert-success">

                                {!!$msg!!}
                            </div>
                        @endforeach

                    @endif

                </div>

                <div class="col-xs-12 col-md-9 col-lg-9">
                    <h2 class="headline2"> التسجيل </h2>
                    <div class="forms"  >
                        <form  action="{{url('auth/register')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="row-form req">
                                        <span>الاسم الاول (الشخصي)</span>
                                        <input  name="f_name" type="text" value="{{ count($errors) ? Request::old('f_name') : '' }}" class="full-form" placeholder="الإسم الأول" />
                                    </div>
                                    <div class="row-form">
                                        <span>الوظيفه</span>
                                        <input name="job" type="text" value="{{ count($errors) ? Request::old('job') : '' }}" class="full-form" placeholder="الوظيفة" />
                                    </div>
                                    <div class="row-form req">
                                        <span>الرقم السري</span>
                                        <input type="password" name="password" class="full-form" placeholder="كلمة المرور" />
                                    </div>

                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="row-form req">
                                        <span>الاسم الاخير (العائلي)</span>
                                        <input type="text" name="l_name" value="{{ count($errors) ? Request::old('l_name') : '' }}" class="" placeholder="الإسم الأخير" />
                                    </div>
                                    <div class="row-form req">
                                        <span>البريد الالكتروني</span>
                                        <input type="email" name="email" value="{{ count($errors) ? Request::old('email') : '' }}" class="full-form" placeholder="البريد الإلكتروني" />
                                    </div>
                                    <div class="row-form req">
                                        <span>تاكيد الرقم السري</span>
                                        <input type="password" name="cpassword" class="full-form"
                                        placeholder=" تأكيد كلمة المرور" />
                                    </div>
                                </div>
                            </div>
                            <div class="row-form req">
                                <span>البلد</span>
                                <select data-region-id="one" @if (count($errors)) data-default-option="{{ Request::old('country') }}" data-default-value="{{ Request::old('country') }}" @else data-default-option="-- اختر البلد --"  @endif name="country" class="crs-country full-form">
                                </select>
                            </div>
                            <div class="row-form req">
                                <span>المدينة</span>
                                <select id="one" name="city" @if (count($errors)) data-default-option="{{ Request::old('city') }}" data-default-value="{{ Request::old('city') }}" @else data-default-option="-- اختر المدينة --" @endif class="full-form">
                                </select>
                            </div>
                            <div class="row-form req">
                                <span>رقم الجوال</span>
                                <input type="text" name="phone" value="{{ count($errors) ? Request::old('phone') : '' }}" class="full-form" placeholder="الجوال" />
                            </div>
                            <div class="row-form req">
                                <span>العنوان (بالتفاصيل)</span>
                                <input type="text" name="address" value="{{ count($errors) ? Request::old('address') : '' }}" class="full-form" placeholder="العنوان" />
                            </div>
                            <div class="row-form">
                                <label>
                                    <input type="checkbox" checked name="agree" />
                                    <span>أوافق على الشروط والأحكام</span>
                                </label>
                            </div>


                            <div class="row-form but-holder">
                                <button type="submit" class="sub-b">تسجيل</button>
                            </div>
                        </form>
                    </div>
                </div><!--right-->
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <h2 class="headline2"> الدخول </h2>
                    <div class="forms">
                        <form  action="{{url('auth/login')}}" method="post">
                            {{ csrf_field() }}
                            <div class="row-form">
                                <span>البريد الالكتروني</span>
                                <input type="email"  name="email" class="full-form" placeholder=" ادخل البريد الالكترونى " />
                            </div>
                            <div class="row-form">
                                <span>الرقم السري</span>
                                <input type="password"  name="password" class="full-form" placeholder="كلمة المرور" />
                            </div>
                            <div class="row-form">
                                <label>
                                    <input type="checkbox" name="remmeber" />
                                    <span>تذكرني</span>
                                </label>
                            </div>
                            <div class="row-form but-holder">
                                <button type="submit" class="sub-b">دخول</button>
                            </div>
                        </form>
                    </div>
                </div><!--left-->
            </div>
        </div>
    </div>

    <hr />

    <!--<div class="orders">
    <div class="container">
    <div class="row">
    <div class="col-xs-12">
    <h2 class="headline2 border-b"> مشترياتك </h2>

    <div class="details">
    <div class="de-right">المشتريات</div>
    <div class="de-left">3</div>
</div>
<div class="details">
<div class="de-right">قيمة الشحن</div>
<div class="de-left">00.00 ريال</div>
</div>
<div class="details">
<div class="de-right">مصاريف إضافية</div>
<div class="de-left">00.00 ريال</div>
</div>
<div class="details">
<div class="de-right"><b>إجمالي المشتريات</b></div>
<div class="de-left"><span>897.00</span> ريال</div>
</div>
<br />
<br />
<h2 class="headline2 border-b"> طريقة الدفع </h2>
<div class="row-form">
<label>
<input type="radio" name="" />
<span>دفع فيزا كارت</span>
</label>
</div>
<div class="row-form">
<label>
<input type="radio" name="" />
<span>الدفع عند التسليم</span>
</label>
</div>
<div class="row-form">
<label>
<input type="radio" name="" />
<span>باي بال
<a href="#">
ما هو باي بال؟ </a></span>
</label>
</div>
<div class="row-form but-holder text-right">
<button type="submit" class="sub-b2">تنفيذ</button>
</div>            </div>
</div>
</div>
</div>
-->


<div class="small-imgs">
    @include('site.layouts.partials.tradmark')
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(function(){
            window.crs.init();
        });
    </script>
@endsection
