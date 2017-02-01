<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">تعديل قسم {{ $category->name }}</h4>
</div>
<form action="{{ route('admin.categories.edit' , ['id' => $category->id , 'type' => 'sub']) }}" enctype="multipart/form-data" method="post"
    onsubmit="return false;">
    {!! csrf_field() !!}
    <div class="modal-body">

      <div class="row">
                        <div class=" col-md-12">
                            <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile file-box">
                                  <img   style="cursor:pointer;" 
                                  class=" def-img file-btn img-responsive" 
                                  src="{{url('storage/uploads/images/category')}}/{{$category->img}}"  
                                  alt="category picture">

                                  <input type="file"  style="visibility: hidden;" name="avatar">

                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                        </div>
                    </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label>اسم القسم</label>
                <input type="text" class="form-control" value="{{ $category->name }}" placeholder="مثال: اخبار السعوديه"  name="name">
            </div>
       
       
            <div class="form-group col-md-4">
                <label>حاله القسم</label>
                <select class="form-control" name="active">
                    <option value="1" {{ $category->active? 'selected' : '' }}>فعال</option>
                    <option value="0" {{ !$category->active? 'selected' : '' }}>غير فعال</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>القسم الرئيسي</label>
                <select class="form-control" name="parent_id">
                    @foreach (App\Category::all() as $cat)
                        @if($cat->isMain())
                            <option value="{{ $cat->id }}" {{ $category->parent_id === $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        <button type="button" class="btn edit-modal-submit btn-primary btn-sm btn-flat">
            حفظ<span class="glyphicon glyphicon-save"> </span>
        </button>
    </div>
</form>
