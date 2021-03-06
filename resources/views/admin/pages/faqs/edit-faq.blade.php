
@extends('admin.master')

@section('title')
    تعديل السؤال
@endsection

@section('content')
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">تعديل السؤال</h3>
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
            <form class="form ajax-form" role="form" action="{{ route('admin.faqs.edit' , ['id' => $faq->id]) }}" enctype="multipart/form-data" method="post"
            onsubmit="return false;">

            <div class="box-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>عنوان السؤال</label>
                        <input type="text" name="question" value="{{ $faq->question }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4">حالة السؤال</label>
                        <select name="active" class="form-control">
                            <option value="1" {{ $faq->active? 'selected' : '' }}>فعال</option>
                            <option value="0" {{ !$faq->active? 'selected' : '' }}>غير فعال</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>اجابة السؤال</label>
                        <textarea  class="form-control tiny-editor" >{{ $faq->answer }}</textarea>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
                <button type="submit" class="btn ajax-submit btn-app">
                    <i class="fa fa-save"></i> حفظ
                </button>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
</section>

@endsection
