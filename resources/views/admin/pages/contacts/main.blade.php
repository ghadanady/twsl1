@extends('admin.master')

@section('title')
    لينكات التواصل الاجتماعي
@endsection

@section('content-title')
    لينكات التواصل الاجتماعي
@endsection

@section('content')
    <section class="content">

        <form class="ajax-form" action="{{ route('admin.contacts.main') }}" onsubmit="return false" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">لينكات التواصل الاجتماعي</h3>
                            <div class="box-tools pull-left">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>ازرار التحكم</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>الايقونه</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>المحتوي</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                @forelse ($data['icons'] as $index => $icon)
                                    <div class="row input-list">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="input-list-btn-add btn blue-soft"><li class="fa fa-plus-circle"></li></button>
                                                <button type="button" class="input-list-btn-del btn red-soft"><li class="fa fa-minus-circle"></li></button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="icons[]"  style="font-family: FontAwesome,'arial'; font-size: 20pt;"class="text-center form-control ">
                                                    @foreach(SMKFontAwesome\SMKFontAwesome::getArray() as $key => $value)
                                                    <option value="{{ $key }}" {{ $key === $icon ? 'selected' : '' }} >{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" name="contents[]" value="{{ $data['contents'][$index] }}" class="form-control " >
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row input-list">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="button" class="input-list-btn-add btn blue-soft"><li class="fa fa-plus-circle"></li></button>
                                                <button type="button" class="input-list-btn-del btn red-soft"><li class="fa fa-minus-circle"></li></button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="icons[]"  style="font-family: FontAwesome,'arial'; font-size: 20pt;"class="text-center form-control ">
                                                    @foreach(SMKFontAwesome\SMKFontAwesome::getArray() as $key => $value)
                                                    <option value="{{ $key }}" >{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" name="contents[]"  class="form-control " >
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <div class="box-body text-center box-profile">
                                <div class="form-group">
                                    <button  type="submit" class="btn btn-app ajax-submit">
                                        <i class="fa fa-save"></i> {{ trans('admin_global.btn_save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </section>
@endsection
