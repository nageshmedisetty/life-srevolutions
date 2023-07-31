<div class="modal-dialog modal-lg" id="example-modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("clientmaster/update", $attrib)
    ?>   
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$model_title?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> <?=$screen?> Name *</label>
                            <input name="name" id="name" value="<?=($row ? $row->name : "")?>" class="form-control" data-error="Please input <?=$screen?> Name" placeholder="<?=$screen?> Name" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> Mobile *</label>
                            <input name="phone" id="phone" value="<?=($row ? $row->phone : "")?>" class="form-control" data-error="Please input Mobile Number" placeholder="Mobile Number" required="required" type="text" onkeypress="validate(event)" maxlength="10">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for=""> OR Code *</label>
                            <input name="qrcode" id="qrcode" value="<?=($row ? $row->qrcode : "")?>" class="form-control" data-error="Please input Mobile Number" placeholder="QR Code" required="required" type="text" onkeypress="validate(event)" maxlength="10">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for=""> Address *</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Address..."><?=($row ? $row->address : "")?></textarea>
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

$('.myselect').select2({dropdownParent: $("#example-modal-lg")}); 
</script>