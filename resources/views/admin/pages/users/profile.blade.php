
@extends('admin.master')

@section('title')
  {{ trans('admin_global.users_profile') }}
@endsection
@section('content-title')
 {{ trans('admin_global.users_profile') }}
@endsection

@section('content')
<!-- Main content -->
<form  role="form" onsubmit="return false;" class="ajax-form" action="{{url('admin/users/profile')}}" method="post" enctype="multipart/form-data">
  <section class="content">

    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile file-box">
                  <img id="btn-user-image" style="cursor:pointer;" src="{{ !empty($user->image) ? asset('storage/uploads/images/avatars/'. $user->image->name) : asset('storage/uploads/images/avatars/default.jpg') }}" class="profile-user-img file-btn img-responsive img-circle"   alt="User profile picture">

                  <input type="file"  style="visibility: hidden;" name="avatar">

                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('settings.info_header') }}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="form-group">
                      <label for="name">{{ trans('admin_global.users_name') }}</label>
                      <input type="text" class="form-control" id="name" name="name"
                      value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                      <label for="username">{{ trans('admin_global.users_username') }}</label>
                      <input type="text" class="form-control" id="username" name="username"
                      value="{{$user->username}}">
                    </div>
                        <div class="form-group">
                            <label>{{ trans('admin_global.users_role') }}</label>
                        @if ($user->isAdmin())
                            <select class="form-control" name="role_id">
                                <option value="{{$user->role->id}}">{{$user->role->alias}}</option>
                                @foreach (App\Role::get() as $role)
                                    <option value="{{$role->id}}">{{$role->alias}}</option>
                                @endforeach
                            </select>
                        @else
                            <span class="form-control">{{$user->role->alias}}</span>
                        @endif
                        </div>

                    <div class="form-group">
                      <label for="national_id">{{ trans('admin_global.users_national') }}</label>
                      <input type="text" class="form-control" id="national_id" name="national_id"
                      value="{{$user->national_id}}">
                    </div>
                    <div class="form-group">
                      <label for="phone">{{ trans('admin_global.users_phone') }}</label>
                      <input type="text" class="form-control" id="phone" name="phone"
                      value="{{$user->phone}}">
                    </div>
                    <div class="form-group">
                      <label for="age">{{ trans('admin_global.users_age') }}</label>
                      <input type="number" min="0" class="form-control" id="age" name="age"
                      value="{{$user->age}}">
                    </div>
                    <div class="form-group">
                      <label for="job">{{ trans('admin_global.users_job') }}</label>
                      <input type="text" class="form-control" id="job" name="job"
                      value="{{$user->job}}">
                    </div>
                    <div class="form-group">
                      <label for="address">{{ trans('admin_global.users_address') }}</label>
                      <input type="text" class="form-control" id="address" name="address"
                      value="{{$user->address}}">
                    </div>
                    <div class="form-group">
                      <label for="email">{{ trans('admin_global.users_email') }}</label>
                      <input type="email" class="form-control" id="email" name="email"
                      value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                      <label for="gender">{{ trans('admin_global.users_gender') }}</label>
                      <select class="form-control" id="gender" name="gender">
                          <option value="male" {{$user->gender === 'male' ? 'selected' : '' }}>male |ذكر</option>
                          <option value="female" {{$user->gender === 'female' ? 'selected' : '' }}>female |انثي</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="password">{{ trans('admin_global.users_password') }} {{ trans('admin_global.password_rule') }}</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                      <label for="newpassword">{{ trans('admin_global.users_newpassword') }} {{ trans('admin_global.password_rule') }}</label>
                      <input type="password" class="form-control" id="newpassword" name="newpassword">
                    </div>
                    <div class="form-group">
                      <label for="repassword">{{ trans('admin_global.users_repassword') }}</label>
                      <input type="password" class="form-control" id="repassword" name="repassword">
                    </div>
                </div>

                <!-- /.box -->
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
{!! csrf_field() !!}
</form>

@endsection
    <!-- /.content -->
