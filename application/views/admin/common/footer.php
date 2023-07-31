<div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023 Life Srevolutions</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Nagesh Medisetty<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Theme JS-->
    <script src="<?=base_url('public/admin/')?>app-assets/js/core/app-menu.js"></script>
    <script src="<?=base_url('public/admin/')?>app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?=base_url('public/admin/')?>app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->
<div class="modal modal-slide-in fade" id="modals-slide-in">

</div>
</html>