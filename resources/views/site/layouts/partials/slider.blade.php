<div class="slider">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            @if(count($slider)>0)
                <div class="owl-carousel" id="main-slider">
                @foreach($slider as $img)
                    <div class="slide">
                        <img src="{{url('storage/uploads/images/slider')}}/{{$img->image->name}}" alt="xsa" />
                        <p>
                            {{$img->title}}
                        </p>
                    </div>
                    @endforeach
                 

                </div>
                @endif
                <div class="blocks-inlines">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-lg-3">
                            <div class="imgs-inline">
                                <img src="{{ asset('assets/site/imgs/dx1.png') }}" alt="s" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-3">
                            <div class="imgs-inline">
                                <img src="{{ asset('assets/site/imgs/dx2.png') }}" alt="s" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-3">
                            <div class="imgs-inline">
                                <img src="{{ asset('assets/site/imgs/dx3.png') }}" alt="s" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-3">
                            <div class="imgs-inline">
                                <img src="{{ asset('assets/site/imgs/dx4.png') }}" alt="s" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
