<!-- =============== Left side End ================-->
<style>
    .imgClass{
        width: 200px;
    height: 79px;
    background: #ffb6c1;
    }
    .thl{
        padding:5px;
        border-left:1px solid #9d9d9d;
    }
    .thr{
        padding:5px;
        border-right:1px solid #9d9d9d;
    }
    .tht{
        padding:5px;
        border-top:1px solid #9d9d9d;
    }
    .thb{
        padding:5px;
        border-bottom:1px solid #9d9d9d;
    }
    .text-align-right{
        text-align:right;
    }
    .text-align-left{
        text-align:left;
    }
    .text-align-center{
        text-align:center;
    }
    .title-string{
        font-size:16px;
        font-weight:bold;
    }
</style>
<div style="text-align:center;width:100%;"><h3><?=$headtitle?></h3></div>
<table cellpadding=0 cellspacing=0 width="100%">
    <tr>
        <th class="tht thl">S.NO</th>
        <th class="tht thl">PRODUCT</th>
        <th class="tht thl">CATEGORY</th>
        <th class="tht thl">RATE</th>
        <th class="tht thl">TOTAL&nbsp;QTY</th>
        <th class="tht thl">DATE OF SELLING</th>
        <th class="tht thl">REFERENCE NO</th>
        <th class="tht thl">INVOICE NO</th>
        <th class="tht thl">ORDER NO</th>
        <th class="tht thl">SOLD QTY</th>
        <th class="tht thl">BALANCE QTY</th>
        <th class="tht thl">AMOUNT</th>
        <th class="tht thl">GST AMT</th>
        <th class="tht thl thr">TOTAL AMT</th>
    </tr>
    <?php
        if($res){
            
            foreach($res as $row){

                echo '<tr>';
                echo '<td class="tht thl thr text-align-center title-string" colspan="14">'.strtoupper($row->name.' - '.$row->address.' - '.$row->phone).'</td>';
                echo '</tr>';
                if($row->products){
                    $i=1;
                    foreach($row->products as $pro){
                        echo '<tr>';
                        echo '<td class="tht thl">'.$i.'</td>';
                        echo '<td class="tht thl">'.$pro->code.' - '.$pro->name.'</td>';
                        echo '<td class="tht thl">'.$pro->category.'</td>';
                        echo '<td class="tht thl">'.$pro->rate.'</td>';
                        echo '<td class="tht thl">'.$pro->qty.'</td>';
                        if($pro->saledata){
                            if(count($pro->saledata) >= 1){
                                $m=0;
                                $soldqty= $pro->qty;
                                foreach($pro->saledata as $sale){
                                    $soldqty= $soldqty - $sale->qty ;
                                    $totalamt = $sale->discount_amount + $sale->gst_amt;
                                    if($m==0){
                                        echo '<td class="tht thl text-align-center">'.date('d-m-Y H:i:s', strtotime($sale->created_at)).'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->refno.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->invno.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->order_id.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->qty.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$soldqty.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->discount_amount.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->gst_amt.'</td>';
                                        echo '<td class="tht thl thr text-align-center">'.$totalamt.'</td>';
                                    }else{
                                        echo '<tr>';
                                        echo '<td class="tht thl"></td>';
                                        echo '<td class="tht thl"></td>';
                                        echo '<td class="tht thl"></td>';
                                        echo '<td class="tht thl"></td>';
                                        echo '<td class="tht thl"></td>';
                                        echo '<td class="tht thl text-align-center">'.date('d-m-Y H:i:s', strtotime($sale->created_at)).'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->refno.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->invno.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->order_id.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->qty.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$soldqty.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->discount_amount.'</td>';
                                        echo '<td class="tht thl text-align-center">'.$sale->gst_amt.'</td>';
                                        echo '<td class="tht thl thr text-align-center">'.$totalamt.'</td>';
                                        echo '</tr>';
                                    }
                                    
                                    $m++;
                                }
                            }else{
                                foreach($pro->saledata as $sale){
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl text-align-center">NA</td>';
                                    echo '<td class="tht thl thr text-align-center">NA</td>';
                                }
                            }

                        }else{
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl text-align-center">NA</td>';
                            echo '<td class="tht thl thr text-align-center">NA</td>';
                        }
                        echo '</tr>';
                        $i++;
                    }
                }


            //     if($row->commissions){
            //         if($row->commissions['rempoints']){
            //             $resrempoints = $row->commissions['rempoints'];
            //             $rempoints=0;
            //             for($x=0;$x<count($resrempoints); $x++){
            //                 $rempoints = $rempoints + $resrempoints[$x];
            //             }
            //         }else{
            //             $rempoints = "0.00";
            //         }
            //     }else{
            //         $rempoints = "0.00";
            //     }                
                
            
            //     echo '<td class="tht thl">'.$row->refcode.'</td>';
            //     echo '<td class="tht thl">'.$row->name.'</td>';
            //     echo '<td class="tht thl">'.$row->email.'</td>';
            //     echo '<td class="tht thl">'.$row->phone.'</td>';
            //     echo '<td class="tht thl">'.$row->member.'</td>';
            //     echo '<td class="tht thl">'.$row->member.'</td>';
            //     echo '<td class="tht thl">'.$row->pan.'</td>';
            //     echo '<td class="tht thl">'.$row->aadhar.'</td>';
            //     echo '<td class="tht thl">'.$row->bankname.'</td>';
            //     echo '<td class="tht thl">'.$row->bankbranch.'</td>';
            //     echo '<td class="tht thl">'.$row->accno.'</td>';
            //     echo '<td class="tht thl">'.$row->ifsc.'</td>';
            //     echo '<td class="tht thl text-align-center">'.$row->valumepoints.'</td>';
            //     echo '<td class="tht thl text-align-right">'.($row->commissions ? $row->commissions['comm500']  + $row->commissions['comm100']: '0.00').'</td>';
            //     echo '<td class="tht thl text-align-right">'.($row->commissions ? $row->commissions['valumepoints'] : '0.00').'</td>';
            //     echo '<td class="tht thl text-align-right">'.$rempoints.'</td>';
            //     echo '<td class="tht thl thr text-align-right">'.$row->valumepointsSelf.'</td>';
            //     echo '</tr>';
                
            }
        }
    ?>
    <tr>
        <th colspan=18 class="tht thl thb thr text-align-left">&nbsp;</th>
    </tr>
</table>     
