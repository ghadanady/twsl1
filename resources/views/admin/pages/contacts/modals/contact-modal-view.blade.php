
<!--View Table Modal -->
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">رؤيه الرساله الخاصه بي {{ $contact->fullname }}</h4>
        </div>
        <div class="modal-body" id="modal-view-body">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>الاسم</label>
                    <span class="form-control">{{ $contact->fullname }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label>الايميل</label>
                    <span class="form-control">{{ $contact->email }}</span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label>موضوع الرساله</label>
                    <span class="form-control">{{ $contact->subject }}</span>
                </div>
                <div class="form-group col-sm-6">
                    <label>تاريخ الارسال</label>
                    <span class="form-control">{{ $contact->created_at }}</span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12 text-center">
                    <label>المحتوي</label>
                    <span class="form-control">{{ $contact->message }}</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" data-target="#modal-view1" >غلق</button>
            <!-- <button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#modal-New-product">
            <span class="fa fa-send"> </span> &nbsp;Replay
        </button> -->
    </div>
</div><!-- /.modal-dialog -->
