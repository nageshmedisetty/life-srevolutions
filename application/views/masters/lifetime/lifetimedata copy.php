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
                <div class="card text-left">
                    <div class="card-head">
                        <div class="row" style="padding:20px;">
                            <div class="col-lg-3">
                                <div class="breadcrumb">
                                    <h4 class="mr-2"><?=$headtitle?></h4>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center"></div>
                            <div class="col-lg-2 text-center">
                                
                                    <?php	
                                        $mon[""] = "Select Month";
                                        for($m=1;$m<=12;$m++){
                                            $mo[$m] = $this->varaha->monthname($m);
                                        }
                                        
                                        echo form_dropdown('month', $mo, date('m',time()), 'class="form-control myselect" id="month" data-placeholder="Select Category" required="required" style="width:100%"')
                                    ?>													
                              
                              
                            </div>
                            <div class="col-lg-2 text-right">
                            <?php	
                                        $yr[""] = "Select Year";
                                        for($i=2021;$i<=date('Y',time());$i++){
                                            $yr[$i] = $i;
                                        }
                                        
                                        echo form_dropdown('month', $yr, date('Y',time()), 'class="form-control myselect" id="month" data-placeholder="Select Category" required="required" style="width:100%"')
                                    ?>	
                            </div>
                            <div class="col-lg-1 text-right">
                                <button class="btn btn-primary">GO</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="min-height:550px;">


                    
                        <!-- <div class="table-responsive">
                            <table  class="display table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">S.No</th>                                        
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Brand&nbsp;Partner&nbsp;Bonus</th>
                                        <th>Lidership&nbsp;Bonus</th>
                                        <th>Education&nbsp;Bonus</th>
                                        <th>Life&nbsp;Style&nbsp;Bonus</th>
                                        <th>Car/House&nbsp;Fund&nbsp;Bonus</th>
                                        <th style="width:100px;">Royality&nbsp;Income</th>
                                        <th style="width:100px;">Totals</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $tot_brand_partner_bonus = 0;
                                        $tot_leadership = 0;
                                        $tot_education = 0;
                                        $tot_lifestyle = 0;
                                        $tot_car_fund = 0;
                                        $tot_royality_income = 0;
                                        $tot_totals = 0;

                                        if($lifetimedata){
                                            $i=1;
                                            foreach($lifetimedata as $row){
                                                echo '<tr>';
                                                echo '<td>'.$i.'</td>';
                                                echo '<td>'.$row->name.'</td>';
                                                echo '<td>'.$this->varaha->monthname($row->month).'</td>';
                                                echo '<td>'.$row->year.'</td>';
                                                echo '<td class="text-right">'.number_format($row->brand_partner_bonus,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->leadership,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->education,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->lifestyle,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->car_fund,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->royality_income,2).'</td>';
                                                echo '<td class="text-right">'.number_format($row->totals,2).'</td>';
                                                echo '</tr>';
                                                $i++;
                                                $tot_brand_partner_bonus = $tot_brand_partner_bonus + $row->brand_partner_bonus;
                                                $tot_leadership = $tot_leadership + $row->leadership;
                                                $tot_education = $tot_education + $row->education;
                                                $tot_lifestyle = $tot_lifestyle + $row->lifestyle;
                                                $tot_car_fund = $tot_car_fund + $row->car_fund;
                                                $tot_royality_income = $tot_royality_income + $row->royality_income;
                                                $tot_totals = $tot_totals + $row->totals;
                                            }

                                        }else{
                                            echo '<tr><td colspan="11">No Life time Bonus Data </td></tr>';
                                        }
                                    ?>  

                                </tbody>
                                <tfoot>
                                        <?php
                                            echo "<tr>";
                                            echo '<th colspan="4">TOTALS</th>';
                                            echo '<th class="text-right">'.number_format($tot_brand_partner_bonus,2).'</th>';
                                            echo '<th class="text-right">'.number_format($tot_leadership,2).'</th>';
                                            echo '<th class="text-right">'.number_format($tot_education,2).'</th>';
                                            echo '<th class="text-right">'.number_format($tot_lifestyle,2).'</th>';
                                            echo '<th class="text-right">'.number_format($tot_car_fund,2).'</th>';
                                            echo '<th class="text-right">'.number_format($tot_royality_income,2).'</th>';
                                            echo '<th class="text-right" style="color:#ff0000">'.number_format($tot_totals,2).'</th>';
                                            echo "</tr>";
                                        ?>  
                                </tfoot>
                            </table>
                        </div> -->
                    </div>
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


    


</script>

