<div class="bar">
    <div class="container">
        <div class="row">
            @if(!Auth::guard('members')->check())
                <div class="col-xs-12 col-md-6 rmb15 text-right">
                    <span class="welcome-text">
                        مرحباً بكم في متجرنا يمكنكم <a href="{{url('auth')}}">التسجيل</a> مجاناً
                    </span>
                </div>
            @else
                <div class="col-xs-12 col-md-6 rmb15 text-right">
                    <span class="welcome-text">
                        مرحبا بك  <a href="{{url('profile/')}}">{{Auth::guard('members')->user()->f_name }}</a>
                        | <a href="{{url('auth/logout')}}">تسجيل خروج </a>
                    </span>
                </div>
            @endif
            <div class="col-xs-12 col-md-6 rmb15 text-left">
                <div class="top-contacts">
                    <span> <i class="fa fa-envelope"></i> {{ $settings->site_email }} </span>
                    <span> <i class="fa fa-phone"></i> {{ $settings->site_phone1 }} </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="act-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4 rmb15 text-right">
                <a class="logo" href="{{ route('site.index') }}">
                    <img src="{{ $settings->getLogo() }}" alt="logo" />
                </a>
            </div>
            <div class="col-xs-12 col-md-8 rmb15 text-left">
                <form action="{{ route('site.search.index') }}" method="get">
                    <div class="top-search">
                    <select name="category" class="s-select">
                        @foreach (App\Category::get() as $c)
                            <option value="{{ $c->slug }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="q" class="s-text" placeholder="أدخل كلمة البحث هنا .." />
                    <button type="submit" class="s-button"> <i class="fa fa-search"></i> </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
