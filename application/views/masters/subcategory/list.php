<!-- =============== Left side End ================-->
<div class="main-content-wrap sidenav-close d-flex flex-column">
<style>
    .imgClass{
        width: 200px;
    height: 79px;
    background: #ffb6c1;
    }
</style>
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
                            <div class="col-lg-7 text-center">
                                
                            </div>
                            <div class="col-lg-2 text-right">
                                <button class="btn btn-primary mb-sm-0 mb-3 print-invoice" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="add(0)"> Add <?=$screen?></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="min-height:550px;">
                        <div class="table-responsive">
                            <table  class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10px;">S.No</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th style="width:100px;">Image</th>
                                        <th style="width:10px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
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

	table = $('#zero_configuration_table').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('subcategory/ajax_list') ?>",
            "type": "POST",
            "data": function ( data ) {

            }
        },
        "columnDefs": [
        {
            "targets": [ 0 ],
            "orderable": false,
        },
        ],

    });

    $('#btn-filter').click(function(){
        table.ajax.reload();
    });
    $('#btn-reset').click(function(){
        $('#form-filter')[0].reset();
        table.ajax.reload();
    });

});


    function add(id){
        $.ajax({
            url : "<?php echo base_url('subcategory/add'); ?>",
            data : {id:id},
            type: "GET",
            dataType: "html",
            success: function(data)
            {
                $('#model-data').html(data);
                // $('.myselect').select2({minimumResultsForSearch: 5});
                // $('.myselect').select2({dropdownParent: $("#example-modal-lg")}); 
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Database Error : ' + errorThrown);
            }
        });
    }

    
    function deleter(id){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                    url : "<?php echo base_url('subcategory/delete/'); ?>",
                    data : {id: id},
                    type: "POST",
                    dataType: "html",
                    success: function(data)
                    {

                        if(data){
                            var arr = data.split('-!-');
                            if(arr[0]==1){
                                swal(arr[1], {
                                icon: "success",
                                });
                                window.location.reload();
                            }else{
                                swal({
                                    title: "Error",
                                    text: arr[1],
                                    confirmButtonColor: "#2196F3",
                                    type: "error"
                                });
                            }
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Database Error : ' + errorThrown);
                    }
                });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });

        }


</script>

