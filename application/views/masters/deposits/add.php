<form action="<?=base_url('admin/deposits/update')?>" class="add-new-record modal-content pt-0" method="post" enctype="multipart/form-data">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
    <div class="modal-header mb-1">
        <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
    </div>
    <div class="modal-body flex-grow-1">
        <div class="form-group">
            <label class="form-label" for="basic-icon-default-fullname">Member</label>
            <?php	
            $gs[""] = "Select Member";
            if($members){	
                foreach ($members as $mem) {
                    $gs[$mem->id] = $mem->name;
                }
            }	
            echo form_dropdown('memberId', $gs, ($row ? $row->memberId : ""), 'class="form-control myselect" id="memberId" data-placeholder="Select Category" required="required" style="width:100%"')
        ?>		
        </div>
        <div class="form-group">
            <label class="form-label" for="basic-icon-default-fullname">Amount</label>
            <input name="amount" id="amount" value="<?=($row ? $row->amount : "")?>" class="form-control" data-error="Please input Pin Number" placeholder="Amount" required="required" type="text">
        </div>
        <div class="form-group">
            <label class="form-label" for="basic-icon-default-fullname">Description</label>
            <textarea name="description" id="description" class="form-control" data-error="Please input Pin Number" placeholder="Description"><?=($row ? $row->description : "")?></textarea>
        </div>
        
        <input type="hidden" value="<?=$id?>" id="id" name="id" /> 
        <button type="submit" class="btn btn-primary data-submit mr-1">Submit</button>
        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>

