
<div class="modal fade" id="adduser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('admin_global.users_new') }}</h4>
            </div>
            <form action="{{url('admin/drivers/add')}}" class="ajax-form" enctype="multipart/form-data" method="post"
             onsubmit="return false;">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile file-box">
                                  <img   style="cursor:pointer;" class="profile-user-img file-btn img-responsive img-circle" src="{{url('storage/uploads/images/avatars/default.jpg')}}"  alt="User profile picture">

                                  <input type="file"  style="visibility: hidden;" name="avatar">

                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_name') }}</label>
                            <input type="text" class="form-control required" placeholder="مثال: محمد الراجي" required name="name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_email') }}</label>
                            <input type="email" class="form-control required" placeholder="مثال:h@h.com " required name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_username') }}</label>
                            <input type="text" class="form-control required" placeholder="مثال: mohamed123" required name="username">
                        </div>
                       <div class="form-group col-sm-6">
                           <label>{{ trans('admin_global.users_address') }}</label>
                           <input type="text" class="form-control required" placeholder="مثال:الرياض السعوديه " required name="address">
                       </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_phone') }}</label>
                            <input type="text" class="form-control required" placeholder="مثال: 0093658621666" required name="phone">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_national') }}</label>
                            <input type="text" class="form-control required" placeholder="مثال: 2983648623156" required name="national_id">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_password') }} {{ trans('admin_global.password_rule') }}</label>
                            <input type="password" class="form-control required" name="password">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_repassword') }}</label>
                            <input type="password" class="form-control required" name="repassword">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin_global.btn_cancel') }}</button>
                    <button type="submit" data-loading="{{ trans('admin_global.loading') }}" class="ajax-submit btn btn-primary btn-sm btn-flat">
                        {{ trans('admin_global.btn_save') }} <span class="glyphicon glyphicon-save"> </span>
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
