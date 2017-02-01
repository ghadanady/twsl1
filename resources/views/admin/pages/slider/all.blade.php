
@extends('admin.master')

@section('title')
   صور الاسليدر  
@endsection

@section('content')


    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                
                

                        <div class="box-body">
                            <div class="row" 
                            style="margin: 0px 0px 20px 0px;">
                                <a href="#add" class="btn btn-primary" data-toggle="modal" >
                                    <i class="fa fa-plus"></i>
                                   اضافه صورة 
                                </a>
                            </div>
@if(count($imgs)>0)
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>العنوان </th>
                                            <th>تاريخ الاضافة</th>
                                           
                                            <th class="text-center">العمليات </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($imgs as $a)
                                            <tr>
                                            
                                                <td>{{$a->title}}</td>
                                                <td>{{$a->created_at->diffForHumans()}}</td>
                                                <td class="text-center">
                                                    <button 
                                                    data-url="{{url('admin/slider/info/'.$a->id)}}" 
                                                    class="users-edit-modal-btn btn btn-primary" data-original="">
                                                        <li class="fa fa-pencil"> تعديل </li>
                                                    </button >
                                                    <a data-url="{{url('admin/slider/delete/'.$a->id)}}" class="btn btn-danger modal-delete-btn"  >
                                                        <li class="fa fa-trash"> حذف</li>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $imgs->links() }}
@else
<div class="alert alert-info"> لم يتم اضافه اعلانات حتى الان</div>
@endif
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </section>

            @section('modals')
                @include('admin.pages.slider.modals.add')
                @include('admin.pages.slider.modals.edit')
            @endsection

            @section('templates')
                <script id="users-edit-modal-template" type="text/html">
                    @include('admin.pages.slider.templates.edit')
                </script>
            @endsection

        @endsection
