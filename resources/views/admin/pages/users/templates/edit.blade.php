
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile file-box">
                                  <img  style="cursor:pointer;"  class="profile-user-img file-btn img-responsive img-circle" src="{{url('storage/uploads/images/avatars/{avatar}')}}"  alt="User profile picture">
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
                            <input type="text" value="{name}" class="form-control required" placeholder="مثال: محمد الراجي" required name="name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_email') }}</label>
                            <input type="email" value="{email}" class="form-control required" placeholder="مثال:h@h.com " required name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_username') }}</label>
                            <input type="text" value="{username}" class="form-control required" placeholder="مثال: mohamed123" required name="username">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_role') }}</label>
                            <select class="form-control" name="role_id">
                                <option value="{role_id}">{alias}</option>
                                @foreach (App\Role::get() as $role)
                                    <option value="{{$role->id}}">{{$role->alias}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_phone') }}</label>
                            <input type="text" value="{phone}" class="form-control required" placeholder="مثال: 0093658621666" required name="phone">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_national') }}</label>
                            <input type="text" value="{national_id}" class="form-control required" placeholder="مثال: 2983648623156" required name="national_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_address') }}</label>
                            <input type="text" value="{address}" class="form-control required" placeholder="مثال:الرياض السعوديه " required name="address">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_gender') }}</label>
                            <select class="form-control" name="gender">
                                <option value="{gender}">{gender_text}</option>
                                <option value="male">male |ذكر</option>
                                <option value="female">female |انثي</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_age') }}</label>
                            <input type="number" value="{age}" min="0" class="form-control required" placeholder="مثال: 33" required name="age">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_job') }}</label>
                            <input type="text" value="{job}" class="form-control required" placeholder="مثال: مدير المبيعات" required name="job">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_newpassword') }} {{ trans('admin_global.password_rule') }}</label>
                            <input type="password" class="form-control required" name="newpassword">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>{{ trans('admin_global.users_repassword') }}</label>
                            <input type="password" class="form-control required" name="repassword">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{id}">
                </div>
