                     <div class="row">
                        <div class=" col-md-12">
                            <!-- Profile Image -->
                              <div class="box box-primary">
                                <div class="box-body box-profile file-box">
                                  <img   style="cursor:pointer;" 
                                  class=" def-img file-btn img-responsive" 
                                  src="{{url('storage/uploads/images/slider/{img}')}}"  alt="ads picture">

                                  <input type="file"  style="visibility: hidden;" name="avatar">

                                </div>
                                <!-- /.box-body -->
                              </div>
                              <!-- /.box -->
                        </div>
                    </div>



                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>رابط الاعلان </label>
                            <input type="text" class="form-control required" placeholder="www.google.com.eg"   value="{title}" name="title">
                        </div>
                       
                    </div>
                  
                    <input type="hidden" name="id" value="{id}">
       
                