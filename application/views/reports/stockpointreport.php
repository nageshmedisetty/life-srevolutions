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
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
                    $attrib = array('data-toggle' => 'validator', 'role' => 'form',  'enctype'=>"multipart/form-data");
                    echo form_open_multipart("reports/stockpointreportdata", $attrib)
                ?> 
                <div class="card" style="padding:10px;">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="account-name">From Date</label>
                                <input class="form-control form-control-rounded" value="" id="fromdt" name="fromdt" type="date" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                            <label for="email">To Date</label>
                            <input class="form-control form-control-rounded" id="todt"  value="" name="todt" type="date" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <input type="hidden" value="" id="print_type" name="print_type" />
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" onclick="getPrint(1)">PRINT REPORT</button>
                                <button type="submit" class="btn btn-danger" onclick="getPrint(2)">PDF REPORT</button>
                                <button type="submit" class="btn btn-success" onclick="getPrint(3)">EXCEL REPORT</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- <div class="row">
            <table cellpadding=0 cellspacing=0 width="100%">
                <tr>
                    <th>S.No</th>
                </tr>
            </table>
        </div> -->
    </div>
</div>      

<script>
    function getPrint(src){
        $('#print_type').val(src);
    }
</script>
