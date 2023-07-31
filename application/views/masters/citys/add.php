<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("city/update", $attrib)
    ?>   
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$model_title?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> City Code *</label>
                            <input name="code" id="code" value="<?=$code?>" class="form-control" data-error="Please input Supplier Code" placeholder="City Code" required="required" readonly type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> Country *</label>
                            <?php
                            $ci[''] = '';
                            if ($countries) {
                                foreach ($countries as $county) {
                                    $ci[$county->mid] = $county->sName;
                                }
                            }
                            echo form_dropdown('iCountryID', $ci, ($row ? $row->iCountryID : ""), 'id="iCountryID" class="myselect"  data-placeholder="Select Country"  style="width:100%;" onchange="getStatesR(this.value)"');
                            ?>
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> Country *</label>
                            <?php
                            $si[''] = '';
                            if ($states) {
                                foreach ($states as $state) {
                                    $si[$state->mid] = $state->sName;
                                }
                            }
                            echo form_dropdown('iStateID', $si, ($row ? $row->iStateID : ""), 'id="iStateID" class="myselect"  data-placeholder="Select State"  style="width:100%;"');
                            ?>
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for=""> City Name *</label>
                            <input name="name" id="name" value="<?=($row ? $row->name : "")?>" class="form-control" data-error="Please input City Name" placeholder="City Name" required="required" type="text">
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

function getStatesR(src){
       
        var $select = $('#iStateID');
        $.ajax({
            url : "<?php echo base_url('city/getStates/'); ?>"+src,
            type: "GET",        
            dataType: "json",
            success: function(data)
            {
                $select.html('');
                $.each(data, function(i, val) {
                    
                    //alert(item.name);
                    if(val.id==src){
                        $select.append('<option value="' + val.mid + '" selected>' + val.sName + '</option>');
                    }else{
                        $select.append('<option value="' + val.mid + '">' + val.sName + '</option>');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data' + errorThrown);
            }
        });
}
    </script>