    <div class="c-ads">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/x-ads1.png') }}" alt="ads" />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <a class="full-w">
                        <img src="{{ asset('assets/site/imgs/x-ads2.png') }}" alt="ads" />
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mailer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="mail-form">
                        <form action="{{ route('site.contact.subscribe') }}" data-notification="fancy" onsubmit="return false">
                            <input type="email" name="email" class="mail-txt" placeholder="البريد الالكتروني" />
                            <button data-loading="انتظر..." type="submit" class="mail-sub ajax-submit"> <i class="fa fa-send"></i> </button>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- mailer -->

    <div class="f-links">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6 text-right rmb20">
                    <ul class="fo-linak">
                        <li> <a href="{{ route('site.index') }}"> <i class="fa fa-angle-left"></i> الرئيسية</a> </li>
                        <li> <a href="{{ route('site.search.offers') }}"> <i class="fa fa-angle-left"></i>احدث العروض</a> </li>
                        <li> <a href="{{ route('site.faq.index') }}"> <i class="fa fa-angle-left"></i> الاسئلة الشائعة</a> </li>
                        @foreach (App\Info::get() as $info)
                            @if (!$info->isActive())
                                @continue
                            @endif
                            <li> <a href="{{ $info->getUrl() }}"> <i class="fa fa-angle-left"></i> {{ $info->name }}</a> </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6 text-left rmb20">
                    <div class="footer-socials">
                        @php
                            $content = App\Link::first();
                            $data['icons'] = $content? unserialize($content->icons) : [];
                            $data['contents'] = $content? unserialize($content->contents) : [];
                        @endphp
                        @foreach ($data['icons'] as $icon)
                            <span> <i class="fa {{ $icon }}"></i> {{ $data['contents'][$loop->index] }} </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- f-links -->

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 rmb20 text-right">
                    <div class="f-copy">
                        جميع الحقوق محفوظة لـ توصل كوم © 2016
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 rmb20 text-left">
                    <a href="http://www.al-yasser.com.sa" target="_blank">
                        <img src="{{ asset('assets/site/imgs/yas.png') }}" alt="alyasser.com" />
                    </a>
                </div>
            </div>
        </div>
    </div>
