@extends('site.layouts.base.master')

@section('title')
اتصل بنا
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="max-w-600">
                        <h2 class="headline2"> اتصل بنا </h2>
                        <div class="forms">
                            <form action="{{ route('site.contact.send') }}" data-notification="fancy" onsubmit="return false" method="post">
                                <div class="row-form">
                                    <input type="text"  name="fullname" class="full-form" placeholder="الإسم" />
                                </div>
                                <div class="row-form">
                                    <input type="email" name="email"  class="full-form" placeholder="البريد الإلكتروني" />
                                </div>
                                <div class="row-form">
                                    <input type="text" name="subject"  class="full-form" placeholder="موضوع الرسالة" />
                                </div>
                                <div class="row-form">
                                    <textarea class="full-form" name="message"  placeholder="نص الرسالة"></textarea>
                                </div>
                                <div class="row-form but-holder">
                                    <button type="submit" data-loading="انتظر..." class="sub-b ajax-submit">إرسال</button>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                        </div>
                    </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
    <div class="small-imgs">
        @include('site.layouts.partials.tradmark')
    </div>
@endsection
