<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"><?=$headtitle?></h2>                            
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <?=$button?>
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
                                            <th>refCode</th>
                                            <th>Member Type</th>
                                            <th>Name</th>
                                            <th style="width:100px;">User Name</th>
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
            "url": "<?php echo base_url('admin/profile/ajax_list') ?>",
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
            url : "<?php echo base_url('admin/category/add'); ?>",
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
                    url : "<?php echo base_url('admin/category/delete/'); ?>",
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

