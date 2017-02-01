@extends('site.layouts.base.master')

@section('title')
الاسئله الشائعة
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <h2 class="headline3"> الاسئله الشائعة </h2>
                    @foreach (App\Faq::latest()->get() as $faq)
                        @if (!$faq->isActive())
                            @continue
                        @endif
                        <div class="qus">
                            <h2>
                                {{ $faq->question }}
                            </h2>
                            <div>
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <div class="small-imgs">
        @include('site.layouts.partials.tradmark')
    </div>
@endsection
