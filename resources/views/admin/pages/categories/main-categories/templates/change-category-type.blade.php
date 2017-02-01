<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">تعيين قسم {name} كقسم رئيسي</h4>
</div>
<form action="{{ url('admin/categories/change')}}/main/{id}" enctype="multipart/form-data" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{id}">
    <div class="modal-body">

        <div class="row">
            <div class="form-group text-center col-md-6 col-md-offset-3">
                <label>القسم الرئيسي</label>
                <select class="form-control" name="parent_id">
                    <option value="">-- اختر القسم الرئيسي --</option>
                    @foreach (App\Category::all() as $cat)
                        @if($cat->isMain())
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary btn-sm btn-flat">
            حفظ<span class="glyphicon glyphicon-save"> </span>
        </button>
    </div>
</form>
