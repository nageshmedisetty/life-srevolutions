<div class="modal-dialog modal-lg" id="example-modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form');
        echo form_open_multipart("items/update", $attrib)
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
                        <label for=""> Item Name *</label>
                            <input name="name" id="name" value="<?=($row ? $row->name : "")?>" class="form-control" data-error="Please input <?=$screen?> Name" placeholder="<?=$screen?> Name" required="required" type="text">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for=""> Description *</label>
                            <textarea name="description" id="description" class="form-control" data-error="Please input Date" placeholder="Percentage" required="required" type="text"><?=$row ? $row->description : ""?></textarea>
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Category</label>
                            <?php	
                                $cat[""] = "Select Category";
                                if($categorys){	
                                    foreach ($categorys as $cats) {
                                        $cat[$cats->id] = $cats->code.' - '.$cats->name;
                                    }
                                }	
                                echo form_dropdown('category', $cat, ($row ? $row->category : ""), 'class="form-control myselect" id="category" data-placeholder="Select Category" required="required" style="width:100%" onchange="getSubcategorys(this.value)"')
                            ?>													
                        </div>
                    </div>	
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Sub Category</label>
                            <?php	
                                $scat[""] = "Select Category";
                                if($subcategorys){	
                                    foreach ($subcategorys as $scats) {
                                        $scat[$scats->id] = $scats->code.' - '.$scats->name;
                                    }
                                }	
                                echo form_dropdown('subcategory', $scat, ($row ? $row->subcategory : ""), 'class="form-control myselect" id="subcategory" data-placeholder="Select Sub Category" required="required" style="width:100%"')
                            ?>													
                        </div>
                    </div>	
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> Rate *</label>
                            <input name="rate" id="rate" value="<?=$row ? $row->rate : ""?>" class="form-control" data-error="Please input Date" placeholder="Rate of the Item" required="required" type="text" onkeypress="validate(event)">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">GST</label>
                            <?php	
                                $gs[""] = "Select GST";
                                if($gsts){	
                                    foreach ($gsts as $gst) {
                                        $gs[$gst->id] = $gst->name;
                                    }
                                }	
                                echo form_dropdown('gstId', $gs, ($row ? $row->gstId : ""), 'class="form-control myselect" id="gstId" data-placeholder="Select GST" required="required" style="width:100%"')
                            ?>													
                        </div>
                    </div>	
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> Discount In (%) *</label>
                            <input name="discount" id="discount" value="<?=$row ? $row->discount : "0"?>" class="form-control" data-error="Please input Date" placeholder="Discount In (%)" required="required" type="text" onkeypress="validate(event)">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> Item Commission In (Rs) *</label>
                            <input name="commission" id="commission" value="<?=$row ? $row->commission : ""?>" class="form-control" data-error="Please input Date" placeholder="Commission In (Rs)" required="required" type="text" onkeypress="validate(event)">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div> -->
                    <input type="hidden" name="commission" id="commission" value="0">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for=""> Volume Points *</label>
                            <input name="volume_points" id="volume_points" value="<?=$row ? $row->volume_points : ""?>" class="form-control" data-error="Please input Date" placeholder="Valuam Points" required="required" type="text" onkeypress="validate(event)">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Item&nbsp;Image</label>
                        <div class="col-sm-10">
                            <div class="btn-group">
                                <label title="Upload file" for="inputFile" class="">
                                    <input type="file" name="files[]" id="inputFile" class="hide" required="" multiple accept="image/png, image/gif, image/jpeg">
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

function getSubcategorys(id){
    var $select = $('#subcategory');
	$.ajax({
		url : '<?php echo base_url('items/getSubcats'); ?>',
		type: "GET",        
		dataType: "json",
		data:{id:id},
		success: function(data)
		{
			console.log(data);
			// $select.html('');
			$select.html('<option>Select Sub Category</option>');
			$.each(data, function (s) {
				$select.append('<option value="' + data[s]["id"] + '">' + data[s]["name"]+'</option>');
			});
			
			
			$('.myselect').select2();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error deleting data' + errorThrown);
		}
	});
}

// $('.myselect').select2({dropdownParent: $("#example-modal-lg")}); 
</script>