<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped table-responsive text-center">
        <thead>
            <tr>
                <th id="ID">
                    <input id="chk-all" type="checkbox">
                </th>
                <th>عنوان السؤال</th>
                <th>حاله السؤال</th>
                <th>تاريخ النشر</th>
                <th>اخر تعديل</th>
                <th class="text-center">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
                <tr class="{{ $faq->active ? 'success' : 'warning' }}">
                    <td class="ID">
                        <input name="ids[]" class="chk-box" value="{{ $faq->id}}" type="checkbox">
                    </td>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->active ? 'فعال' : 'غير فعال' }}</td>
                    <td>{{ $faq->created_at->toCookieString() }}</td>
                    <td>{{ $faq->updated_at->diffForHumans() }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.faqs.edit' , ['id' => $faq->id ]) }}" class="btn btn-success "  >
                            <li class="fa fa-pencil"> عرض/تعديل</li>
                        </a>
                        <a data-url="{{ route('admin.faqs.delete' , ['id' => $faq->id ]) }}" class="btn btn-danger modal-delete-btn"  >
                            <li class="fa fa-trash"> حذف</li>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $faqs->links() }}
