@extends('admin.master')

@section('title')
    {{ trans('categories.show_categories') }}
@endsection

@section('content')


    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('categories.show_categories') }}</h3>
                <div class="box-tools pull-left">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>

                        <div class="box-body">
                            <div class="row" style="margin-bottom: 20px;">
                                <a href="#add-modal" class="btn btn-primary" data-toggle="modal" >
                                    <i class="fa fa-plus"></i>{{ trans('categories.add_new_sub_category') }}
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ trans('categories.category_name') }}</th>
                                            <th>{{ trans('categories.category_status') }}</th>
                                            <th>{{ trans('categories.main_category') }}</th>
                                            <th class="text-center">{{ trans('categories.operations') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($categories as $category)

                                            <tr {{ $category->active ? 'info' : 'warning'}}>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->active ? 'فعال' : 'غير فعال'}}</td>
                                                <td>{{ $category->mainCategory->name }}</td>
                                                <td class="text-center">
                                                    <button type="button" data-url ="{{ route('admin.categories.info' , ['id' => $category->id ]) }}" class="btn edit-modal-btn btn-success "  >
                                                        <li class="fa fa-pencil">{{ trans('categories.edit') }}</li>
                                                    </button>
                                                    <button type="button" data-url ="{{ route('admin.categories.change' , ['id' => $category->id ,'type' => 'sub']) }}" data-type="sub" class="btn change-type-btn btn-info "  >
                                                        <li class="fa fa-pencil">{{ trans('categories.set_as_main_category') }}</li>
                                                    </button>
                                                    <a data-url="{{ route('admin.categories.delete' , ['id' => $category->id ]) }}" class="btn btn-danger modal-delete-btn"  >
                                                        <li class="fa fa-trash">{{ trans('categories.remove') }}</li>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </section>

            @section('modals')
                @include('admin.pages.categories.sub-categories.modals.edit-category')
                @include('admin.pages.categories.sub-categories.modals.add-category')
            @endsection

        @endsection
