<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"><?=$headtitle?></h2>  
                            <div class="text-danger"><?=$this->session->flashdata('error')?></div>
                            <div class="text-success"><?=$this->session->flashdata('message')?></div>                          
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">                    
                    <?php echo $button;?>
                    </div>
                </div>
            </div>
            <div class="content-body">
                
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row" >
                        <div class="col-12">
                            <div class="card" style="padding:10px">
                                <table class="datatables-basic table" id="zero_configuration_table">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">S.No</th>
                                            <th>Member</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th style="width:10px;">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->                    
                </section>
                <!--/ Basic table -->

            </div>
        </div>
        <div class="modal modal-slide-in fade" id="modals-slide-in"><div class="modal-dialog sidebar-sm" id="model-data"></div></div>
    </div>


    <script>
    // $('.myselect').select2();
$(document).ready(function() {
    // $('.myselect').select2({minimumResultsForSearch: 5});

	table = $('#zero_configuration_table').DataTable({

        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url('admin/deposits/ajax_list') ?>",
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
            url : "<?php echo base_url('admin/deposits/add'); ?>",
            data : {id:id},
            type: "GET",
            dataType: "html",
            success: function(data)
            {
                $('#model-data').html(data);
                
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
                    url : "<?php echo base_url('admin/deposits/delete/'); ?>",
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