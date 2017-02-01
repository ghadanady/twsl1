@extends('site.layouts.base.master')

@section('title')
    {{$category->name}}
@endsection
@section('content')
    <div class="inner-container">
        <div class="container">
            <form action="{{ $category->getUrl() }}">
                <div class="row">
                    <div class="col-xs-12 col-md-9 col-lg-9">

                        <div class="sec-img">
                            <img src="{{ url('storage/uploads/images/category') }}/{{ $category->image ? $category->image->name : 'p_default.png' }}" alt="sec" />
                        </div>
                        <div class="sec-des">
                            <h2>{{ $category->name }}</h2>
                            @if(!$category->subCategories->isEmpty())
                                <span>القسم يحتوى على أقسام فرعية </span>
                                <span>يمكنكم تصفح كل قسم على حدا</span>
                            @endif
                        </div>

                        <div class="hr-row">
                            <div class="hr-right">
                                <select name="order" class="in-select filter">
                                    <option value="default">الترتيب بواسطة : الافتراضي</option>
                                    <option value="name">الترتيب بواسطة : الاسم</option>
                                    <option value="latest">الترتيب بواسطة : الاحدث</option>
                                    <option value="oldest">الترتيب بواسطة : الاقدام</option>
                                    <option value="sheepest">الترتيب بواسطة : الاقل سعراً</option>
                                    <option value="expensive">الترتيب بواسطة : الاعلي سعراً</option>
                                </select>
                                <select name="per_page" class="in-select filter">
                                    <option value="3">إعرض : 3</option>
                                    <option value="9">إعرض : 9</option>
                                    <option value="15">إعرض : 15</option>
                                    <option value="21">إعرض : 21</option>
                                </select>
                            </div>
                            <div class="hr-left">
                                <div class="inline-icons">
                                    <button type="button">
                                        <i class="fa fa-th-large"></i>
                                    </button>
                                    <button type="button">
                                        <i class="fa fa-th-list"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- row -->

                        <div id="products-area">
                            @include('site.pages.templates.category-products', ['products' => $products])
                        </div>
                        <!-- row -->
                    </div>
                    <!--right-->
                    <div class="col-xs-12 col-md-6 col-lg-3">

                        <div class="left-borderd">


                            @if($category->isMain())
                                <h2>الاقسام الفرعيه </h2>
                            @else
                                <h2>اقسام مشابهه </h2>
                            @endif

                            <ul class="cats">
                                @php
                                $categories  =$category->isMain() ? $category->subCategories : App\Category::orderByRaw('RAND()')->take(7)->get();
                                @endphp
                                @foreach($categories  as $c)
                                    <li>
                                        <a href="{{ $c->getUrl() }}">
                                            <i class="fa fa-angle-double-left"></i>
                                            {{ $c->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div style="direction: rtl">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="accordion" class="panel panel-primary behclick-panel">

                                                <div class="panel-body" >
                                                    <div class="panel-heading " >
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#collapse0">
                                                                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> السعر
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse0" class="panel-collapse collapse in" >
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <div class="checkbox">
                                                                    <label>من </label>
                                                                    <input  name="min_price"  class="form-control" type="text" value="{{ $min_price }}">
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <div class="checkbox" >
                                                                    <label> ألى</label>
                                                                    <input  name="max_price" type="text"   class="form-control" value="{{ $max_price }}">
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="panel-heading " >
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#collapse1">
                                                                <i class="indicator fa fa-caret-down" aria-hidden="true"></i> التقييم
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse1" class="panel-collapse collapse in" >
                                                        <ul class="list-group">
                                                            <li class="list-group-item">
                                                                <label>
                                                                    <input  name="rates[]" checked type="checkbox" value="1">
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                </label>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <label>
                                                                    <input  name="rates[]" checked type="checkbox" value="2">
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                </label>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <label>
                                                                    <input  name="rates[]" checked type="checkbox" value="3">
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                </label>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <label>
                                                                    <input  name="rates[]" checked type="checkbox" value="4">
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gray"></span>
                                                                </label>
                                                            </li>
                                                            <li class="list-group-item">
                                                                <label>
                                                                    <input  name="rates[]" checked type="checkbox" value="5">
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                    <span class="fa fa-star gold"></span>
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-form but-holder pull-right">
                                                <button type="button" href="{{ $category->getUrl() }}" class="sub-b filter">تنقيح</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>




                            <div class="left-ads">
                                <a href="#">
                                    <img src="{{ asset('assets/site/imgs/ads-left.png') }}" alt="s" />
                                </a>
                            </div>

                        </div>


                    </div>
                    <!--left-->
                </div>    </div>
            </form>
        </div>

        <div class="small-imgs">
            @include('site.layouts.partials.tradmark')
        </div>
    @endsection
    <script type="text/javascript">


    </script>
