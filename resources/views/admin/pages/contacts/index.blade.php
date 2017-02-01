
@extends('admin.master')

@section('title')
    عرض الرسائل
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('admin/contacts/') }}" class="ajax-form" data-url="{{ route('admin.contacts.send') }}" onsubmit="return false;">
            <!-- Default box -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">ارسال رساله جديده</h3>
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
                            <label>عنوان الرساله</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>محتوي الرساله</label>
                            <textarea  class="form-control tiny-editor" ></textarea>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <button type="submit" class="btn ajax-submit btn-app">
                        <i class="fa fa-send"></i> ارسال
                    </button>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">عرض الرسائل</h3>
                    <div class="box-tools pull-left">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <div class="box-body" >
                        <div class="margin-bottom row">
                            <div class="row top-table">
                                <div class=" col-md-8 col-xs-8">
                                    <div class="col-md-8 col-xs-8">
                                        <div class="btn-group" data-toggle="buttons">

                                            <label class="btn btn-sm btn-default" title="All Products">
                                                <input type="radio" name="options" class="btn-filter" data-filter="all" autocomplete="off" >
                                                الكل
                                            </label>
                                            <label class="btn btn-sm btn-default" title="Active Products">
                                                <input type="radio" name="options"  class="btn-filter" data-filter="seen" autocomplete="off">
                                                <i class="fa fa-eye text-success"></i>
                                                ما تم رؤيته
                                            </label>
                                            <label class="btn btn-sm btn-default" title="Rejected Products">
                                                <input type="radio" name="options" class="btn-filter" data-filter="unseen" autocomplete="off">
                                                <i class="fa fa-eye-slash text-danger"></i>
                                                ما لم يتم رؤيته
                                            </label>
                                            <label class="btn btn-sm btn-default" title="Today products">
                                                <input type="radio" name="options" class="btn-filter" data-filter="today" autocomplete="off">
                                                <i class="fa fa-bell text-info "></i>
                                                اليوم
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-3">
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                تغيير الي <i class="fa fa-cogs text-danger"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="#" class="btn-action"  data-action="seen"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;تم المشاهده  </a></li>
                                                <li><a href="#" class="btn-action"  data-action="unseen"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;لم يتم المشاهده  </a></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                <div class=" ser-a-del col-md-4 col-xs-4">
                                    <div class="col-xs-8 inner-col">
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm"  id="input-search" placeholder="البحث عن...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-sm btn-success btn-search" data-search="product" type="button">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="addNew col-md-4 bcol-xs-4">
                                        <button type="button" class="btn btn-danger btn-sm btn-action"  data-action="deleted">
                                            <i class="fa fa-trash"></i>
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="ajax-table">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            {{ csrf_field() }}
        </form>
    </section>

@endsection
