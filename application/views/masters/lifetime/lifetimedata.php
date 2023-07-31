<!-- =============== Left side End ================-->
<style>
    .imgClass{
        width: 200px;
    height: 79px;
    background: #ffb6c1;
    }
</style>
<div class="main-content-wrap sidenav-close d-flex flex-column">
    <!-- ============ Body content start ============= -->
    <div class="main-content">
        <div class="row">
        <div class="col-md-12 mb-4">
                <div class="row" style="padding:0px;">
                    <div class="col-lg-12 text-center">
                        <div class="text-danger"><?=$this->session->flashdata('error')?></div>
                        <div class="text-success"><?=$this->session->flashdata('message')?></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card text-left">
                            <div class="card-head">
                                <div class="row" style="padding:10px;">
                                    
                                    <div class="col-lg-4">
                                        <div class="breadcrumb">
                                            <h4 class="mr-2"><?=$headtitle?></h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="breadcrumb">
                                            <?php	
                                                $mon[""] = "Select Month";
                                                for($m=1;$m<=12;$m++){
                                                    $mo[$m] = $this->varaha->monthname($m);
                                                }
                                                
                                                echo form_dropdown('month', $mo, $month, 'class="form-control myselect" id="month" data-placeholder="Select Category" required="required" style="width:100%"')
                                            ?>	                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="breadcrumb">
                                            <?php	
                                                $yr[""] = "Select Year";
                                                for($i=2021;$i<=date('Y',time());$i++){
                                                    $yr[$i] = $i;
                                                }
                                                
                                                echo form_dropdown('year', $yr, $year, 'class="form-control myselect" id="year" data-placeholder="Select Category" required="required" style="width:100%"')
                                            ?>	 
                                                                                  
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div style="text-align:center;">
                                            <button class="btn btn-primary" style="width:100%;" onclick="getReport()">GO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="min-height:550px;">                    
                                <table  class="display table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <?php
                                            if($lifetimedata){
                                        ?>
                                        <tr  style="background-color: #ffde89;color: black;">
                                            <td style="width:100%" colspan=2>
                                                <div style="font-size:16px;font-weight:bold;">Transfer VIA</div>
                                                <?=($lifetimedata ? $lifetimedata->transfervia :"")?>
                                            </td>
                                        </tr>
                                        <tr style="background-color: #ffc300;color: black;">
                                            <th style="width:65%"><i class="fa fa-user-circle" aria-hidden="true"></i> <?=($lifetimedata ? $lifetimedata->name :"")?></th>
                                            <th style="width:35%;text-align:right "><i class="fa fa-calendar" aria-hidden="true"></i> Bonus Amount</th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Brand Partner Bonus</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->brand_partner_bonus,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Team(5%) Leadership(5%) Bonus = (10%)</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->leadership,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Education(5%) Safety(5%) Bonus = (10%)</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->education,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Lifestyle(5%) Travel Fund(5%) Bonus = (10%)</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->lifestyle,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Car Fund(5%) House Fund(5%) Bonus = (10%)</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->car_fund,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #00b2ff;color: black;">
                                            <th style="width:65%; ">Royality Income(10%) Bonus = (10%)</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->royality_income,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: red;color: white;">
                                            <th style="width:65%; ">TDS</th>
                                            <th style="width:35%;text-align:right"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->tds,2) :"")?></th>
                                        </tr>
                                        <tr style="background-color: #d1ff00;color: black;">
                                            <th style="width:65%;font-size:20px; ">Total Bonus Amount</th>
                                            <th style="width:35%;text-align:right;font-size:20px;"><i class="fa fa-inr" aria-hidden="true"></i> <?=($lifetimedata ? number_format($lifetimedata->totals - $lifetimedata->tds,2) :"")?></th>
                                        </tr>
                                        <?php
                                            }else{
                                                echo '<tr>
                                                <th colspan=2 style="text-align:center;width:100%">No Data Found.</th></tr>';
                                            }
                                        ?>

                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                
            </div>
        </div>




        <div class="flex-grow-1"></div>

<link href="<?php echo base_url('public/dist-assets/css/plugins/select2.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('public/dist-assets/js/plugins/select2.min.js'); ?>"></script>

<script>
    // $('.myselect').select2();
$(document).ready(function() {
    // $('.myselect').select2({minimumResultsForSearch: 5});

	
});

function getReport(){
    var month = $('#month').val();
    var year = $('#year').val();
    window.location.href = "<?=base_url('lifetime/lifetimedata/')?>" + month +"/"+year;
}
    


</script>

