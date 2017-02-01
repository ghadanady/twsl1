@extends('site.layouts.base.master')

@section('title')
{{ $info->name }}
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <h2 class="headline3">{{ $info->name }}</h2>

                    <div class="contents">
                        {!! $info->content !!}
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="small-imgs">
        @include('site.layouts.partials.tradmark')
    </div>
@endsection
