@extends('admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ App\User::get()->count() }}</h3>

              <p>{{ trans('admin_global.users_dashboard') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('admin/users') }}" class="small-box-footer">{{ trans('admin_global.btn_see_more') }}<i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ App\Subscribtion::get()->count() }}</h3>

              <p>{{ trans('admin_global.subscribtions_dashboard') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">{{ trans('admin_global.btn_see_more') }}<i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ App\Contact::get()->count() }}</h3>

              <p>{{ trans('admin_global.contacts_dashboard') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">{{ trans('admin_global.btn_see_more') }}<i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
    @endsection
