

@extends('admin.master')

@section('title')

    عرض المنتجات

@endsection

@section('content')

    <section class="content">

        <!-- Default box -->

        <div class="box">

            <div class="box-header with-border">

                <div class="box-tools pull-left">

                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

                        <i class="fa fa-minus"></i>

                    </button>

                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">

                        <i class="fa fa-times"></i>

                    </button>

                </div>

                <form action="{{ url('admin/products/') }}" onsubmit="return false;">

                    <div class="box-body" >

                        <div class="margin-bottom row">

                            <div class="row top-table">

                                <div class=" col-md-9 col-sm-9">

                                    <div class="col-md-10 col-xs-10">

                                        <div class="btn-group" data-toggle="buttons">

                                            <label class="btn btn-sm btn-default" >

                                                <input type="radio" name="options" class="btn-filter" data-filter="all" autocomplete="off" >

                                                الكل

                                            </label>
                                            <label class="btn btn-sm btn-default" >

                                                <input type="radio" name="options" class="btn-filter" data-filter="out_of_stock" autocomplete="off" >

                                                المنتهى في الكمية

                                            </label>
                                            <label class="btn btn-sm btn-default" >

                                                <input type="radio" name="options" class="btn-filter" data-filter="low_of_stock" autocomplete="off" >

                                                الشاحح فى الكمية

                                            </label>
                                            <label class="btn btn-sm btn-default" >

                                                <input type="radio" name="options" class="btn-filter" data-filter="in_stock" autocomplete="off" >

                                                المتوفر فى الكمية

                                            </label>
                                            <label class="btn btn-sm btn-default" title="Active Products">

                                                <input type="radio" name="options"  class="btn-filter" data-filter="active" autocomplete="off">

                                                <i class="fa fa-eye text-success"></i>

                                                الفعال

                                            </label>

                                            <label class="btn btn-sm btn-default" title="Rejected Products">

                                                <input type="radio" name="options" class="btn-filter" data-filter="rejected" autocomplete="off">

                                                <i class="fa fa-eye-slash text-danger"></i>
                                                الغير فعال

                                            </label>

                                            <label class="btn btn-sm btn-default" title="Today products">

                                                <input type="radio" name="options" class="btn-filter" data-filter="today" autocomplete="off">

                                                <i class="fa fa-bell text-info "></i>

                                                اليوم

                                            </label>

                                        </div>

                                    </div>

                                    <div class="col-md-2 col-xs-2">

                                        <div class="dropdown">

                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

                                                {{ trans('products.set_as') }}<i class="fa fa-cogs text-danger"></i>

                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                                <li><a href="#" class="btn-action"  data-action="active"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;{{ trans('products.active') }}  </a></li>

                                                <li><a href="#" class="btn-action"  data-action="rejected"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;{{ trans('products.not_active') }}  </a></li>

                                            </ul>

                                        </div>
                                    </div>
                                </div>

                                <div class=" ser-a-del col-md-3 col-sm-3">

                                    <div class="col-md-8 bcol-sm-8 inner-col">

                                        <div class="input-group">

                                            <input type="text" class="form-control input-sm"  id="input-search" placeholder="{{ trans('products.search_placeholder') }}">

                                            <span class="input-group-btn">

                                                <button class="btn btn-sm btn-success btn-search" data-search="product" type="button">

                                                    <i class="fa fa-search"></i>

                                                </button>

                                            </span>

                                        </div>

                                    </div>

                                    <div class="addNew col-md-2 bcol-sm-2">

                                        <button type="button" class="btn btn-danger btn-sm btn-action"  data-action="deleted">

                                            <i class="fa fa-trash"></i>

                                            {{ trans('products.btn_delete') }}

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row" id="ajax-table">

                            <div class="table-responsive">

                                <table id="example" class="table table-bordered table-striped table-responsive text-center">

                                    <thead>

                                        <tr>

                                            <th id="ID">

                                                <input id="chk-all" type="checkbox">

                                            </th>

                                            <th>{{ trans('products.name_col') }}</th>

                                            <th>{{ trans('products.status_col') }}</th>

                                            <th>{{ trans('products.category_col') }}</th>

                                            <th>{{ trans('products.stock_status_col') }}</th>

                                            <th>{{ trans('products.updated_at_col') }}</th>

                                            <th class="text-center">{{ trans('products.operations_col') }}</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($products as $product)

                                            <tr class="{{ $product->active ? 'success' : 'warning' }}">

                                                <td class="ID">

                                                    <input name="ids[]" class="chk-box" value="{{ $product->id}}" type="checkbox">

                                                </td>

                                                <td>{{ $product->name }}</td>

                                                <td>{{ $product->active ?  trans('products.active') : trans('products.not_active')}}</td>

                                                <td>{{ $product->category->name }}</td>

                                                <td>
                                                    @if ($product->outOfStock())
                                                        <label class="label label-danger">{{ trans('products.label_out_of_stock') }}</label>
                                                    @elseif ($product->hasLowStock())
                                                        <label class="label label-warning">{{ trans('products.label_low_of_stock') }}</label>
                                                    @else
                                                        <label class="label label-success">{{ trans('products.label_in_stock') }}</label>
                                                    @endif
                                                </td>

                                                <td>{{ $product->updated_at->diffForHumans() }}</td>

                                                <td class="text-center">

                                                    <a href="{{ route('admin.products.edit' , ['id' => $product->id ]) }}" class="btn btn-success "  >

                                                        <li class="fa fa-pencil"> {{ trans('products.btn_edit_view') }}</li>

                                                    </a>

                                                    <a data-url="{{ route('admin.products.delete' , ['id' => $product->id ]) }}" class="btn btn-danger modal-delete-btn"  >

                                                        <li class="fa fa-trash"> {{trans('products.btn_delete')}}</li>

                                                    </a>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            {{ $products->links() }}

                        </div>

                    </div>

                    {{ csrf_field() }}

                </form>

            </div>

        </div>

        <!-- /.box-body -->

    </section>



@endsection
