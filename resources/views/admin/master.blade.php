<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="{{ $settings->meta_description }}">
    <meta name="keywords" content="{{ $settings->meta_keywords }}">
    <meta name="author" content="{{ $settings->meta_author }}">
    <meta name="contact" content="{{ $settings->site_email }}">
    <meta name="contactNetworkAddress"CONTENT="{{ $settings->site_email }}">
    <meta name="contactStreetAddress1"CONTENT="{{ $settings->site_address }}">
    <meta name="contactPhoneNumber" CONTENT="{{ $settings->site_phone2 }}">
    <meta name="contactPhoneNumber" CONTENT="{{ $settings->site_phone1 }}">
    <meta name="contactPhoneNumber1" CONTENT="{{ $settings->site_phone1 }}">
    <meta name="contactPhoneNumber2" CONTENT="{{ $settings->site_phone2 }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ $settings->getLogo() }}">
    <title>{{ $settings->site_name}} | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/AdminLTE.min.css') }}"> -->

    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/skins/skin-blue.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/morris/morris.css') }}">
    <!-- ٍSelect2  -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/admin/bootstrap/css/bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/Style-AR-2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/style.css') }}">
    @yield('styles')


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->

                <span class="logo-lg"><b>{{ $settings->site_name }}</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ !empty($user->image) ? asset('storage/uploads/images/avatars/'. $user->image->name) : asset('storage/uploads/images/avatars/default.jpg') }}" class="user-image" alt="User Image">
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ !empty($user->image) ? asset('storage/uploads/images/avatars/'. $user->image->name) : asset('storage/uploads/images/avatars/default.jpg') }}" class="img-circle" alt="User Image">

                                    <p>
                                        {{ trans('admin_global.users_name')}}: {{ $user->name }} - {{ $user->job }}
                                        <small>{{ trans('admin_global.users_register')}}: {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{url('admin/users/profile')}}" class="btn btn-default btn-flat">{{ trans('admin_global.users_profile')}}</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{url('admin/auth/logout')}}" class="btn btn-default btn-flat">{{ trans('admin_global.users_logout')}}</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div>
                    <h1>
                        <small>@yield('title')</small>
                    </h1>
                </div>
                <div>
                    @include('admin.layouts.alerts')
                </div>
            </section>
            @yield('content')
        </div>

        @include('admin.layouts.footer')
        @include('admin.layouts.settings')
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!--Modals-->
    @yield('modals')
    @yield('templates')
    <!-- csrf form  -->
    <form id="csrf">{!! csrf_field() !!}</form>
    <script src="{{ asset('assets/admin/plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('assets/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('assets/admin/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/knob/jquery.knob.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>

    <!-- <script src="{{ asset('assets/admin/dist/js/jquery.nicescroll.js') }}"></script> -->

    <div id="common-modal" class="modal fade" role="dialog">

    </div>
    @include('admin.templates.delete-modal')
    @include('admin.templates.loading')
    @include('admin.templates.alerts')
    <!-- End Modal-Template -->


    @yield('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('assets/admin/process.js') }}"></script>
    <script src="{{ asset('assets/admin/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        $("#googlemaps").gMap({
            latitude: {{ $settings->map_lat }},
            longitude: {{ $settings->map_lng }}
        });
    });
    </script>
</body>
</html>
