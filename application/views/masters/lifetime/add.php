<div class="modal-dialog modal-lg" id="example-modal-lg">
    <div class="modal-content">
    <?php
        $attrib = array('data-toggle' => 'validator', 'role' => 'form',  'enctype'=>"multipart/form-data");
        echo form_open_multipart("lifetime/update", $attrib)
    ?>   
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><?=$model_title?></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Brand Partner *</label>
                            <?php	
                                $bp[""] = "Select Brand Partner";
                                if($vendors){	
                                    foreach ($vendors as $vend) {
                                        $bp[$vend->id] = $vend->refcode.' - '.$vend->name;
                                    }
                                }	
                                echo form_dropdown('vendorId', $bp, ($row ? $row->vendorId : ""), 'class="form-control myselect" id="vendorId" data-placeholder="Select Brand Partner" required="required" style="width:100%" onchange="getSubcategorys(this.value)"')
                            ?>													
                        </div>
                    </div>	
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for=""> Month *</label>
                        <?php	
                                $mo[""] = "Select Month";
                                $mmonth = date('m-Y',time());
                                $mon = explode("-",$mmonth);
                                for($i=1;$i<=12;$i++){
                                    $mo[$i]= $this->varaha->monthname($i);
                                }
                                echo form_dropdown('month', $mo, ($row ? $row->month : $mon[0]), 'class="form-control myselect" id="month" data-placeholder="Select Month" required="required" style="width:100%"')
                            ?>	
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for=""> Year *</label>
                         <?php	
                                $yr[""] = "Select Year";
                                $currentyear = date('Y',time());
                                $startyear = $currentyear - 10;
                                for($y=$startyear;$y<=$currentyear;$y++){
                                    $yr[$y] = $y;
                                }
                                echo form_dropdown('year', $yr, ($row ? $row->year : date('Y',time())), 'class="form-control myselect" id="year" data-placeholder="Select Year" required="required" style="width:100%"')
                            ?>	
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for=""> Transfer VIA *</label>
                            <input name="transfervia" id="transfervia" value="<?=($row ? $row->transfervia: "")?>" class="form-control" data-error="Please input" placeholder="Transfer VIA" required="required" type="text" >
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for=""> Brand Partner Bouns *</label>
                            <input name="brand_partner_bonus" id="brand_partner_bonus" value="<?=($row ? sprintf('%.2f', $row->brand_partner_bonus): "0")?>" class="form-control" data-error="Please input" placeholder="" required="required" type="text"  onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> Leader Ship Bonus *</label>
                            <input name="leadership" id="leadership" value="<?=$row ? sprintf('%.2f', $row->leadership) : "0"?>" class="form-control" data-error="Please input Date" placeholder="Percentage" required="required" type="text" onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> Education Bonus *</label>
                            <input name="education" id="education" value="<?=$row ? sprintf('%.2f', $row->education) : "0"?>" class="form-control" data-error="Please input Date" placeholder="Education" required="required" type="text"  onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> Lifestyle Bouns *</label>
                            <input name="lifestyle" id="lifestyle" value="<?=$row ? sprintf('%.2f', $row->lifestyle) : "0"?>" class="form-control" data-error="Please input Date" placeholder="Lifestyle Bouns" required="required" type="text" onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> Car/Home Fund Bouns *</label>
                            <input name="car_fund" id="car_fund" value="<?=$row ? sprintf('%.2f', $row->car_fund) : "0"?>" class="form-control" data-error="Please input Date" placeholder="car/home fund" required="required" type="text" onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for=""> Royality Income Bouns *</label>
                            <input name="royality_income" id="royality_income" value="<?=$row ? sprintf('%.2f', $row->royality_income) : "0"?>" class="form-control" data-error="Please input Date" placeholder="royality_income" required="required" type="text" onkeypress="validate(event)" onkeyup= "caluc()" onblur="caluc()">
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for=""> TDS *</label>
                            <input name="tds" id="tds" value="<?=($row ? $row->tds: "")?>" class="form-control" data-error="Please input" placeholder="TDS" required="required" type="text" >
                            <div class="help-block form-text with-errors form-control-feedback"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" value="<?=$id?>" id="id" name="id" />  
                <h2>TOTAL : <span id="totals">0.00</span> </h2>              
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary ml-2" type="submit">Save changes</button>
            </div>
            <?php echo form_close(); ?>
    </div>
</div>

<script>
$(document).ready(function() {
    
    caluc();
    
   
});

function caluc(){
    var brand_partner_bonus = $('#brand_partner_bonus').val();
    var leadership = $('#leadership').val();
    var education = $('#education').val();
    var lifestyle = $('#lifestyle').val();
    var car_fund = $('#car_fund').val();
    var royality_income = $('#royality_income').val();

    console.log('brand_partner_bonus',brand_partner_bonus);

    var total = Number(brand_partner_bonus) + Number(leadership) + Number(education) + Number(lifestyle) + Number(car_fund) + Number(royality_income);
     $('#totals').text(total.toFixed(2));
}

// $('.myselect').select2({dropdownParent: $("#example-modal-lg")}); 
</script>