<div class="modal-dialog modal-lg" id="example-modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form',  'enctype'=>"multipart/form-data");
        echo form_open_multipart("pinmanage/update", $attrib)
    ?>   
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$model_title?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> PIN Number *</label>
                            <input name="pin" id="pin" value="<?=($row ? $row->pin : "")?>" class="form-control" data-error="Please input Pin Number" placeholder="Pin Number" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    
                    
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?=$id?>" id="id" name="id" />                 
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary ml-2" type="submit">Save changes</button>
            </div>
            <?php echo form_close(); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    
    
    
   
});

// $('.myselect').select2({dropdownParent: $("#example-modal-lg")}); 
</script>