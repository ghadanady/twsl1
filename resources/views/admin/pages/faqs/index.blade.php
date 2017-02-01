
@extends('admin.master')

@section('title')
    عرض الاسئلة الشائعه
@endsection

@section('content')
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">عرض الاسئلة الشائعه</h3>
                <div class="box-tools pull-left">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form action="{{ url('admin/faqs/') }}" onsubmit="return false;">
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
                                                <input type="radio" name="options"  class="btn-filter" data-filter="active" autocomplete="off">
                                                <i class="fa fa-eye text-success"></i>
                                                الفعال
                                            </label>
                                            <label class="btn btn-sm btn-default" title="Rejected Products">
                                                <input type="radio" name="options" class="btn-filter" data-filter="rejected" autocomplete="off">
                                                <i class="fa fa-eye-slash text-danger"></i>
                                                غير الفعال
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
                                                <li><a href="#" class="btn-action"  data-action="active"><span><i class="fa fa-eye text-primary"></i></span> &nbsp;فعال  </a></li>
                                                <li><a href="#" class="btn-action"  data-action="rejected"><span><i class="fa fa-eye-slash text-danger"></i></span> &nbsp;غير فعال  </a></li>
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
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </section>

@endsection
