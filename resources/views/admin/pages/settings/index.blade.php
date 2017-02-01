
@extends('admin.master')

@section('title')
Dashboard
@endsection
@section('content-title')
الاعدادات العامة
@endsection

@section('content')
<!-- Main content -->
<form  role="form" class="ajax-form" action="{{url('admin/settings/edit')}}" method="post" enctype="multipart/form-data"
       onsubmit="return false;">
    <section class="content">

        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile file-box">
                        <img  name="logo"  style="cursor:pointer;"class="profile-user-img file-btn img-responsive img-circle" src="{{url('storage/uploads/images/logo/'.$settings->site_logo)}}"  alt="User profile picture">

                        <input type="file"  style="visibility: hidden;" name="site_logo">

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('settings.info_header') }}</h3>
                        <div class="box-tools pull-left">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="site_name">{{ trans('settings.site_name') }}</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                   value="{{$settings->site_name}}">
                        </div>
                        <div  class="form-group">
                            <label>{{ trans('settings.default_locale') }}</label>
                            <select name="default_locale" class="form-control">
                                @foreach(App\Locale::all() as $locale)
                                    <option value="{{ $locale->id }}" {{ $locale->id === $settings->default_locale ? 'selected' : '' }}>{{ $locale->name ." | ". $locale->alias }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="site_email">{{ trans('settings.site_email') }}</label>
                            <input type="email" class="form-control" id="site_email" name="site_email"
                            value="{{ $settings->site_email }}">
                        </div>

                        <div class="form-group">
                            <label for="site_phone1">{{ trans('settings.site_phone1') }}</label>
                            <input type="text" class="form-control" id="site_phone1" name="site_phone1"
                            value="{{ $settings->site_phone1 }}">
                        </div>
                        <div class="form-group">
                            <label for="phone2">{{ trans('settings.site_phone2') }}</label>
                            <input type="text" class="form-control" id="site_phone2" name="site_phone2"
                            value="{{ $settings->site_phone2 }}">
                        </div>
                        <div class="form-group">
                            <label for="address">{{ trans('settings.site_address') }}</label>
                            <input type="text" class="form-control" id="site_address" name="site_address"
                            value="{{ $settings->site_address }}">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4">{{ trans('admin_global.map_lat')}}</label>
                            <input class="form-control" type="text" name="map_lat" value="{{ $settings->map_lat }}">
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4">{{ trans('admin_global.map_lng') }}</label>
                            <input class="form-control" type="text" name="map_lng" value="{{ $settings->map_lng }}">
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('settings.meta_header') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="meta_author">{{ trans('settings.meta_author') }}</label>
                            <input type="text" class="form-control" id="meta_author" name="meta_author"
                                   value="{{ $settings->meta_author }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">{{ trans('settings.meta_keywords') }}</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                   value="{{$settings->meta_keywords }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_description">{{ trans('settings.meta_description') }}</label>
                            <textarea type="text" class="form-control" id="meta_description" name="meta_description">{{ $settings->meta_description }}</textarea>
                        </div>

                    </div>

                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('settings.social_header') }}</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="facebook">{{ trans('settings.social_facebook') }}</label>
                            <input type="text" class="form-control" id="facebook" name="facebook"
                                   value="{{$settings->facebook}}">
                        </div>
                        <div class="form-group">
                            <label for="google">{{ trans('settings.social_google') }}</label>
                            <input type="text" class="form-control" id="google" name="google"
                                   value="{{$settings->google}}">
                        </div>
                        <div class="form-group">
                            <label for="twitter">{{ trans('settings.social_twitter') }}</label>
                            <input type="text" class="form-control" id="twitter" name="twitter"
                                   value="{{$settings->twitter}}">
                        </div>
                        <div class="form-group">
                            <label for="instagram">{{ trans('settings.social_instagram') }}</label>
                            <input type="text" class="form-control" id="instagram" name="instagram"
                                   value="{{$settings->instagram}}">
                        </div>
                        <div class="form-group">
                            <label for="youtube">{{ trans('settings.social_youtube') }}</label>
                            <input type="text" class="form-control" id="youtube" name="youtube"
                                   value="{{$settings->youtube}}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ trans('admin_global.operations_header') }}</h3>
                    </div>
                    <div class="box-body text-center box-profile">
                        <button type="submit" class="btn btn-app ajax-submit">
                            <i class="fa fa-save"></i> {{ trans('admin_global.btn_save') }}
                        </button>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
    {{ csrf_field() }}
</form>
<!-- page script -->

@endsection
<!-- /.content -->
