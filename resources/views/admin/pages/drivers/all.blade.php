
@extends('admin.master')

@section('title')
    {{ trans('admin_global.users_name') }}
@endsection

@section('content')


    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('admin_global.users_view') }}</h3>
                <div class="box-tools pull-left">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>

                        <div class="box-body">
                            <div class="row" style="margin-bottom: 20px;">
                                <a href="#adduser" class="btn btn-primary" data-toggle="modal" >
                                    <i class="fa fa-plus"></i>اضافة   سائق 
                                </a>
                            </div>
@if(count($drivers)>0)
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('admin_global.users_name') }}</th>
                                            <th>{{ trans('admin_global.users_email') }}</th>
                                            <th>{{ trans('admin_global.users_register') }}</th>
                                            <th class="text-center">{{ trans('admin_global.col_operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($drivers as $u)
                                            <tr>
                                                <td>{{$u->name}}</td>
                                                <td>{{$u->email}}</td>
                                                <td>{{$u->created_at}}</td>
                                                <td class="text-center">
                                                    <button data-url="{{url('admin/drivers/info/'.$u->id)}}" class="users-edit-modal-btn btn btn-primary" data-original="">
                                                        <li class="fa fa-pencil"> {{ trans('admin_global.btn_edit') }}</li>
                                                    </button >
                                                    <a data-url="{{url('admin/drivers/delete/'.$u->id)}}" class="btn btn-danger"  >
                                                        <li class="fa fa-trash"> {{ trans('admin_global.btn_delete') }}</li>
                                                    </a>
                                                @if(!$u->active=='1')
                                                    <a style="min-width: 80px" href="{{url('admin/drivers/active/'.$u->active)}}" class="btn btn-info modal-delete-btn"  >
                                                        <li class="fa fa-check">   فعال  </li>
                                                    </a>
                                                    
                                                @else
                                                    <a href="{{url('admin/drivers/active/'.$u->id.'/'.$u->active)}}" class="btn btn-danger"  >
                                                        <li class="fa fa-ban"> غير فعال</li>
                                                    </a>
                                                @endif    

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $drivers->links() }}
@else
<div class="alert alert-info"> لم يتم اضافه سائقين</div>
@endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </section>

            @section('modals')
                @include('admin.pages.drivers.modals.add')
                @include('admin.pages.drivers.modals.edit')
            @endsection

            @section('templates')
                <script id="users-edit-modal-template" type="text/html">
                    @include('admin.pages.drivers.templates.edit')
                </script>
            @endsection

        @endsection
