<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar .right-side">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{ !empty($user->image) ? asset('storage/uploads/images/avatars/'. $user->image->name) : asset('storage/uploads/images/avatars/default.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-right info">
                <p>{{ $user->name }}</p>
                <a href="{{ url('admin/users/profile') }}"><i class="fa fa-circle text-success"></i> {{ !empty($user->name) ? $user->name : "بدون اسم" }}</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{url('/admin')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('admin_global.main_tab') }}</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{url('/admin/slider')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>الاسليدر</span>
                </a>
            </li>
            @if ($user->isAdmin())
                <li class="treeview">
                    <a href="{{url('admin/settings')}}">
                        <i class="fa fa-pie-chart"></i>
                        <span>{{ trans('admin_global.settings_tab') }}</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{url('admin/users')}}">
                        <i class="fa fa-dashboard"></i> <span>{{ trans('admin_global.users_tab') }}</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="{{url('admin/drivers')}}">
                        <i class="fa fa-dashboard"></i> <span>السائقين</span>
                    </a>
                </li>
            @endif
        </li>



        <li class="treeview">
            <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>{{ trans('categories.global_name') }}</span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('admin.categories.index' , ['type' => 'main']) }}"><i class="fa fa-circle-o"></i> {{ trans('categories.main_page_name') }}</a>
                </li>
                <li><a href="{{ route('admin.categories.index' , ['type' => 'sub']) }}"><i class="fa fa-circle-o"></i> {{ trans('categories.sub_page_name') }}</a>
                </li>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span>{{ trans('products.global_name') }}</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.products.add') }}"><i class="fa fa-circle-o"></i> {{ trans('products.add_page_name') }}</a>
            </li>
            <li><a href="{{ route('admin.products.index') }}"><i class="fa fa-circle-o"></i> {{ trans('products.page_name') }}</a>
            </li>
        </ul>
    </li>
     <!-- ghada strat -->
     <li class="treeview">
        <a href="{{url('admin/ads')}}">
            <i class="fa fa-dashboard"></i> <span>
            الاعلانات
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="{{url('admin/trademark')}}">
            <i class="fa fa-dashboard"></i> <span>
            الماركات التجارية
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="{{ route('admin.contacts.main') }}">
            <i class="fa fa-dashboard"></i> <span>
            لينكات التواصل الاجتماعي
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span>الاسئلة الشائعه</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.faqs.add') }}"><i class="fa fa-circle-o"></i>اضافة سؤال جديد</a>
            </li>
            <li><a href="{{ route('admin.faqs.index') }}"><i class="fa fa-circle-o"></i>عرض الاسئلة</a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span>الصفحات التعريفية</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.infos.add') }}"><i class="fa fa-circle-o"></i>اضافة صفحة جديدة</a>
            </li>
            <li><a href="{{ route('admin.infos.index') }}"><i class="fa fa-circle-o"></i>عرض الصفحات</a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pencil-square-o"></i>
            <span>الرسائل و الاشتركات</span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('admin.contacts.index') }}"><i class="fa fa-circle-o"></i>عرض الرسائل</a>
            </li>
            <li><a href="{{ route('admin.subscribtions.index') }}"><i class="fa fa-circle-o"></i>عرض الاشتركات</a>
            </li>
        </ul>
    </li>

</ul>
</section>
<!-- /.sidebar -->
</aside>
