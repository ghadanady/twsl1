@extends('site.layouts.base.master')

@section('title')
 الصفحة الشخصية 
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <form action="{{ url('profile/edit') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="headline3"> الصفحة الشخصية </h2>
                    </div>
                    @php
                    $loginUser=Auth::guard('members')->user();
                    @endphp
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
                        <div class="forms">

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="row-form req">
                                        <span>الاسم الاول (الشخصي)</span>
                                        <input  name="f_name" type="text" value="{{ $loginUser->f_name }}" class="full-form" placeholder="الإسم الأول" />
                                    </div>
                                    <div class="row-form">
                                        <span>الوظيفه</span>
                                        <input name="job" type="text" value="{{ $loginUser->job }}" class="full-form" placeholder="الوظيفة" />
                                    </div>
                                    <div class="row-form ">
                                        <span>رقم سري جديد</span>
                                        <input type="password" name="password" class="full-form" placeholder="رقم سري جديد" />
                                    </div>

                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="row-form req">
                                        <span>الاسم الاخير (العائلي)</span>
                                        <input type="text" name="l_name" value="{{ $loginUser->l_name }}" class="" placeholder="الإسم الأخير" />
                                    </div>
                                    <div class="row-form req">
                                        <span>البريد الالكتروني</span>
                                        <input type="email" name="email" value="{{ $loginUser->email }}" class="full-form" placeholder="البريد الإلكتروني" />
                                    </div>
                                    <div class="row-form ">
                                        <span>تاكيد الرقم السري</span>
                                        <input type="password" name="cpassword" class="full-form"
                                        placeholder="تاكيد الرقم السري" />
                                    </div>
                                </div>
                            </div>
                            <div class="row-form req">
                                <span>البلد</span>
                                <select data-region-id="one" data-default-option="{{ $loginUser->country }}"  data-default-value="{{ $loginUser->country }}"   name="country" class="crs-country full-form">
                                </select>
                            </div>
                            <div class="row-form req">
                                <span>المدينة</span>
                                <select id="one" name="city" data-default-option="{{ $loginUser->city }}"  data-default-value="{{ $loginUser->city }}" class="full-form">
                                </select>
                            </div>
                            <div class="row-form req">
                                <span>رقم الجوال</span>
                                <input type="text" name="phone" value="{{ $loginUser->phone }}" class="full-form" placeholder="الجوال" />
                            </div>
                            <div class="row-form req">
                                <span>العنوان (بالتفاصيل)</span>
                                <input type="text" name="address" value="{{ $loginUser->address }}" class="full-form" placeholder="العنوان" />
                            </div>
                            <div class="row-form but-holder">
                                <button type="submit" class="sub-b">تعديل البيانات</button>
                            </div>
                        </div>

                    </div><!--right-->
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center">

                        <div class="avatar file-box img-responsive img-circle">
                            <img src="{{ $loginUser->image ? url('storage/uploads/images/avatars/'.$loginUser->image) : asset('assets/site/imgs/user-info.png') }}" style="cursor: pointer; border-radius: 50%;" class="file-btn" alt="{{ $loginUser->f_name . " " . $loginUser->l_name}}" />
                            <input type="file" name="image" accept="image/*" style="visibility:hidden;">
                            <a href="#" onclick="return false"> <i class="fa fa-camera"></i> </a>
                        </div>

                    </div><!--left-->
                </form>
            </div>
        </div>
    </div>



    <div class="small-imgs">
        @include('site.layouts.partials.tradmark')
    </div>
</div>

@endsection
