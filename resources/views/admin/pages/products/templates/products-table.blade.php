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

                            <li class="fa fa-trash"> {{ trans('products.btn_delete') }}</li>

                        </a>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

{{ $products->links() }}
