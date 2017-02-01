 @if(count($trademark)>0)
                   
<div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="headline2"> الماركات التجارية </h2>
                <div class="owl-carousel carousel1">
                 @foreach($trademark as $t)
                    <div class="s-cmera">
                    @php
                    $t->img = $t->image ? $t->image->name : 'default.jpg'
                    @endphp

                        <img src="{{url('storage/uploads/images/trademark')}}/{{$t->img}}" alt="c" />
                    </div>
                    @endforeach
                    

                  
                  
                </div>
            </div>
        </div>
    </div>
    @endif