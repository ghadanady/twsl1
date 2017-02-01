
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
                                    <i class="fa fa-plus"></i>{{ trans('admin_global.users_new') }}
                                </a>
                            </div>

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

                                        @foreach($users as $u)
                                            <tr>
                                                <td>{{$u->name}}</td>
                                                <td>{{$u->email}}</td>
                                                <td>{{$u->created_at}}</td>
                                                <td class="text-center">
                                                    <button data-url="{{url('admin/users/info/'.$u->id)}}" class="users-edit-modal-btn btn btn-primary" data-original="">
                                                        <li class="fa fa-pencil"> {{ trans('admin_global.btn_edit') }}</li>
                                                    </button >
                                                    <a data-url="{{url('admin/users/delete/'.$u->id)}}" class="btn btn-danger modal-delete-btn"  >
                                                        <li class="fa fa-trash"> {{ trans('admin_global.btn_delete') }}</li>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </section>

            @section('modals')
                @include('admin.pages.users.modals.add-user')
                @include('admin.pages.users.modals.edit-user')
            @endsection

            @section('templates')
                <script id="users-edit-modal-template" type="text/html">
                    @include('admin.pages.users.templates.edit-user')
                </script>
            @endsection

        @endsection
