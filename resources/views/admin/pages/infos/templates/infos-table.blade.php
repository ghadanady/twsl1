<div class="table-responsive">

    <table id="example" class="table table-bordered table-striped table-responsive text-center">

        <thead>

            <tr>

                <th id="ID">

                    <input id="chk-all" type="checkbox">

                </th>

                <th>اسم الصفحة</th>

                <th>حالة الصفحة</th>

                <th>اخر تعديل</th>

                <th class="text-center">العمليات</th>

            </tr>

        </thead>

        <tbody>

            @foreach($infos as $info)

                <tr class="{{ $info->active ? 'success' : 'warning' }}">

                    <td class="ID">

                        <input name="ids[]" class="chk-box" value="{{ $info->id}}" type="checkbox">

                    </td>

                    <td>{{ $info->name }}</td>

                    <td>{{ $info->active ?  trans('products.active') : trans('products.not_active')}}</td>

                    <td>{{ $info->updated_at->diffForHumans() }}</td>

                    <td class="text-center">

                        <a href="{{ route('admin.infos.edit' , ['id' => $info->id ]) }}" class="btn btn-success "  >

                            <li class="fa fa-pencil"> {{ trans('products.btn_edit_view') }}</li>

                        </a>

                        <a data-url="{{ route('admin.infos.delete' , ['id' => $info->id ]) }}" class="btn btn-danger modal-delete-btn"  >

                            <li class="fa fa-trash"> {{ trans('products.btn_delete') }}</li>

                        </a>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

{{ $infos->links() }}
