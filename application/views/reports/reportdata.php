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
</style>
<div style="text-align:center;width:100%;"><h3><?=$headtitle?></h3></div>
<table cellpadding=0 cellspacing=0 width="100%">
    <tr>
        <th class="tht thl">S.NO</th>
        <th class="tht thl">ID</th>
        <th class="tht thl">ID NAME</th>
        <!-- <th class="tht thl">EMAIL</th>
        <th class="tht thl">PHONE</th>
        <th class="tht thl">MEMBER</th> -->
        <!--<th class="tht thl">ID</th>-->
        <th class="tht thl">PAN</th>
        <!-- <th class="tht thl">AADHAR-NO</th>
        <th class="tht thl">BANK</th>
        <th class="tht thl">BANK-BRANCH</th> -->
        <th class="tht thl">B.A/C</th>
        <th class="tht thl">IFSE</th>        
        <th class="tht thl">V.P</th>
        <th class="tht thl thr">S.V.P</th>
        <th class="tht thl">B.P.B</th>
        <th class="tht thl">T.B</th>
        <th class="tht thl">L.B</th>
        <th class="tht thl">L.S.B</th>
        <th class="tht thl">C.H.F</th>
        <th class="tht thl">R.I</th>
        <th class="tht thl">TOTAL</th>
        <th class="tht thl thr">TDS</th>
    </tr>
    <?php
        if($res){
            $i=1;
            foreach($res as $row){
                if($row->commissions){
                    if($row->commissions['rempoints']){
                        $resrempoints = $row->commissions['rempoints'];
                        $rempoints=0;
                        for($x=0;$x<count($resrempoints); $x++){
                            $rempoints = $rempoints + $resrempoints[$x];
                        }
                    }else{
                        $rempoints = "0.00";
                    }
                }else{
                    $rempoints = "0.00";
                }                

                $brand = ($row->commissions ? $row->commissions['comm500']  + $row->commissions['comm100']: '0');
                $repurchase = ($row->commissions ? $row->commissions['valumepoints'] : '0');
                $totalincome = $row->brandComm + $repurchase;
                
                echo '<tr>';
                echo '<td class="tht thl">'.$i.'</td>';
                echo '<td class="tht thl">'.$row->refcode.'</td>';
                echo '<td class="tht thl">'.$row->name.'</td>';
                // echo '<td class="tht thl">'.$row->email.'</td>';
                // echo '<td class="tht thl">'.$row->phone.'</td>';
                // echo '<td class="tht thl">'.$row->member.'</td>';
              //  echo '<td class="tht thl">'.$row->refcode.'</td>';
                echo '<td class="tht thl">'.$row->pan.'</td>';
                // echo '<td class="tht thl">'.$row->aadhar.'</td>';
                // echo '<td class="tht thl">'.$row->bankname.'</td>';
                // echo '<td class="tht thl">'.$row->bankbranch.'</td>';
                echo '<td class="tht thl">'.$row->accno.'</td>';
                echo '<td class="tht thl">'.$row->ifsc.'</td>';
                echo '<td class="tht thl text-align-center">'.$row->valumepoints.'</td>';
                echo '<td class="tht thl thr text-align-right">'.$row->valumepointsSelf.'</td>';
                echo '<td class="tht thl text-align-right">'.$row->brandComm.'</td>';
                // echo '<td class="tht thl text-align-right">'.($row->commissions ? $row->commissions['valumepoints'] : '0.00').'</td>';
                if($row->commissions){
                    if($row->commissions['rempoints']){
                        for($i=0;$i<count($row->commissions['rempoints']);$i++){
                            echo '<td  class="tht thl text-align-right">'.$row->commissions['rempoints'][$i].'</td>';
                        }
                    }else{
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                    }
                }else{
                    echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                        echo '<td class="tht thl text-align-right">0.00</td>';
                }
                
                echo '<td class="tht thl text-align-right">'.$totalincome.'</td>';
                echo '<td class="tht thl thr text-align-right">'.($totalincome * 5 /100).'</td>';
                echo '</tr>';
                $i++;
            }
        }
    ?>
    <tr>
        <th colspan=23 class="tht thl thb thr text-align-left">&nbsp;</th>
    </tr>
</table>     
