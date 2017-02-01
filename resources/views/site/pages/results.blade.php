@extends('site.layouts.base.master')

@section('title')
نتائج البحث 
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">
                    <h2 class="headline3"> نتائج البحث </h2>
                    @if ($products->isEmpty())
                        <div class="alert alert-info">
                            لا يوجد منتجات تطابق هذا البحث, قم بالبحث مجددا
                        </div>
                    @else
                        <div>
                            <small>  المنتجات المطابقة لاختيارك. </small>
                        </div>
                        @include('site.pages.templates.products', ['products' => $products])
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="small-imgs">
       @include('site.layouts.partials.tradmark')
    </div>

@endsection
