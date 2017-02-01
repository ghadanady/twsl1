@extends('admin.master')

@section('title')
    اضافة صفحة تعريفية
@endsection

@section('content-title')
    اضافة صفحة تعريفية
@endsection

@section('content')
    <section class="content">
        <form  action="{{ route('admin.infos.add') }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <div class="box-tools pull-left">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-md-4">
                                        اسم الصفحة
                                    </label>
                                    <input class="form-control" type="text" name="name" placeholder="مثال: سامسنج اس7" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label class="col-md-4">
                                        حاله الصفحة
                                    </label>
                                    <select name="active" class="form-control">
                                        <option value="">
                                            اختر حاله الصفحة
                                        </option>
                                        <option value="1">
                                            فعالة</option>
                                            <option value="0"> غير فعالة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-md-6"> وصف المنتج</label>
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control tiny-editor"
                                        name="desc" rows="3" placeholder=""></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-app ajax-submit">
                                    <i class="fa fa-save"></i> {{ trans('products.btn_save') }}
                                </button>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                </div>

                {{ csrf_field() }}
            </form>
        </section>
    @endsection
