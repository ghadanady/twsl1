<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped table-responsive text-center">
        <thead>
            <tr>
                <th id="ID">
                    <input id="chk-all" type="checkbox">
                </th>
                <th>الاسم</th>
                <th>موضوع الرسالة</th>
                <th>الايميل</th>
                <th>تاريخ الارسال</th>
                <th class="text-center">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr class="{{ $contact->seen ? 'success' : 'warning' }}">
                    <td class="ID">
                        <input name="ids[]" class="chk-box" value="{{ $contact->id}}" type="checkbox">
                    </td>
                    <td>{{ $contact->fullname }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->created_at->diffForHumans() }}</td>
                    <td class="text-center">
                        <a data-url="{{ route('admin.contacts.view' , ['id' => $contact->id ]) }}" class="btn btn-modal-view btn-success "  >
                            <li class="fa fa-eye"> عرض</li>
                        </a>
                        <a data-url="{{ route('admin.contacts.delete' , ['id' => $contact->id ]) }}" class="btn btn-danger modal-delete-btn"  >
                            <li class="fa fa-trash"> حذف</li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $contacts->links() }}
