<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php include "include/menubar.php"; ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header page-header-light bg-white shadow">
                <div class="container-fluid">
                    <div class="page-header-content py-3">
                        <h1 class="page-header-title font-weight-light">
                            <div class="page-header-icon"><i data-feather="list"></i></div>
                            <span>Finished Goods</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Location Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>

<?php include "include/footerscripts.php"; ?>
<script>
    $(document).ready(function() {

        $('#dataTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + 
                 "<'row'<'col-sm-12'tr>>" + 
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-success btn-sm',
                    title: 'Finished Goods',
                    text: '<i class="fas fa-file-excel mr-2"></i> CSV',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Finished Goods',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                },
                {
                    extend: 'print',
                    title: 'Finished Goods',
                    className: 'btn btn-primary btn-sm',
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    },
                },
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/finishgood.php",
                type: "POST",
            },
            order: [[0, "desc"]],
            columns: [
                { data: "id1tbl_finished_goods" },
                { data: "product" },
                { data: "quantity" },
                { data: "name" }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
<?php include "include/footer.php"; ?>
