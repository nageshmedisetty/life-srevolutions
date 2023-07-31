<div class="modal-dialog modal-lg" id="example-modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form',  'enctype'=>"multipart/form-data");
        echo form_open_multipart("category/update", $attrib)
    ?>   
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$model_title?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> Code *</label>
                            <input name="code" id="code" value="<?=$code?>" class="form-control" data-error="Please input Date" placeholder="Code" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> Category Name *</label>
                            <input name="name" id="name" value="<?=($row ? $row->name : "")?>" class="form-control" data-error="Please input <?=$screen?> Name" placeholder="<?=$screen?> Name" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> Percentage *</label>
                            <input name="per" id="per" value="<?=$row ? $row->per : ""?>" class="form-control" data-error="Please input Date" placeholder="Percentage" required="required" type="text" onkeypress="validate(event)">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category&nbsp;Image</label>
                        <div class="col-sm-10">
                            <div class="btn-group">
                                <label title="Upload file" for="inputFile" class="">
                                    <input type="file" name="files" id="inputFile" class="hide" required="" accept="image/png, image/gif, image/jpeg">
                                </label>
                                <span id="inputFileName"></span>
                            </div><br/>
                            
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