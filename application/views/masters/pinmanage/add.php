<div class="modal-dialog sidebar-sm">
    <form action="<?=base_url('admin/pinmanage/update')?>" class="add-new-record modal-content pt-0" method="post" enctype="multipart/form-data">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
            <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
        </div>
        <div class="modal-body flex-grow-1">
            <div class="form-group">
                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                <input name="pin" id="pin" value="<?=($row ? $row->pin : "")?>" class="form-control" data-error="Please input Pin Number" placeholder="Pin Number" required="required" type="text">
            </div>
            
            <input type="hidden" value="<?=$id?>" id="id" name="id" /> 
            <button type="submit" class="btn btn-primary data-submit mr-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
        </div>
</form>
</div>
