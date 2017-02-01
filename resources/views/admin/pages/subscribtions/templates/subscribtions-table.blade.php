<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped table-responsive text-center">
        <thead>
            <tr>
                <th id="ID">
                    <input id="chk-all" type="checkbox">
                </th>
                <th>الايميل</th>
                <th>تاريخ الارسال</th>
                <th class="text-center">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscribtions as $subscribtion)
                <tr class="{{ $subscribtion->seen ? 'success' : 'warning' }}">
                    <td class="ID">
                        <input name="ids[]" class="chk-box" value="{{ $subscribtion->id}}" type="checkbox">
                    </td>
                    <td>{{ $subscribtion->email }}</td>
                    <td>{{ $subscribtion->created_at->diffForHumans() }}</td>
                    <td class="text-center">
                        <a data-url="{{ route('admin.subscribtions.view' , ['id' => $subscribtion->id ]) }}" class="btn btn-modal-view btn-success "  >
                            <li class="fa fa-eye"> عرض</li>
                        </a>
                        <a data-url="{{ route('admin.subscribtions.delete' , ['id' => $subscribtion->id ]) }}" class="btn btn-danger modal-delete-btn"  >
                            <li class="fa fa-trash"> حذف</li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $subscribtions->links() }}
