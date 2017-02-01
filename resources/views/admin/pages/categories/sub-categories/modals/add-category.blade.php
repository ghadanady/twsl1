
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">اضافه قسم جديد</h4>
            </div>
            <form action="{{ route('admin.categories.add',['type' => 'sub']) }}" enctype="multipart/form-data" method="post"
                onsubmit="return false;">
                {!! csrf_field() !!}
                <div class="modal-body">
                <div class="row">
                        <div class=" col-md-12">
                            <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile file-box">
                                  <img   style="cursor:pointer;" 
                                  class="  def-img file-btn img-responsive" 
                                  src="{{url('storage/uploads/images/def.png')}}"  alt="category  picture">

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
                            <input type="text" class="form-control" placeholder="مثال: اخبار السعوديه"  name="name">
                        </div>
                    
                    
                        <div class="form-group col-md-4">
                            <label>حاله القسم</label>
                            <select class="form-control" name="active">
                                <option value="">-- اختر الحاله --</option>
                                <option value="1">فعال</option>
                                <option value="0">غير فعال</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
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
                    <button type="button" id="add-modal-submit" class="btn btn-primary btn-sm btn-flat">
                        حفظ<span class="glyphicon glyphicon-save"> </span>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
