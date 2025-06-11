<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <?php 
        include "include/menubar.php";
         ?>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="page-header page-header-light bg-white shadow">
                <div class="container-fluid">
                    <div class="page-header-content py-3">
                        <h1 class="page-header-title font-weight-light">
                            <div class="page-header-icon"><i class="fas fa-desktop"></i></div>
                            <span>Dashboard</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card rounded-0">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-mb-4 col-lg-4 col-xl-4">
                                <div class="row no-gutters h-100">
                                    <div class="col">
                                        <div class="card-body p-0 p-2 text-right">
                                            <div class="progress" style="height: 3px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 100%;" aria-valuenow="" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <table class="table table-bordered table-striped table-sm nowrap" id="dataTableAccepted" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Material</th>
                                    <th class="text-center">Cutting</th>
                                    <th class="text-center">Printing</th>
                                    <th class="text-center">Delivery</th>
                                </tr>
                            </thead>
                        </table>
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
    $('#dataTableAccepted').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        dom: "<'row'<'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        responsive: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        ajax: {
            url: "<?php echo base_url() ?>scripts/qutationAccList.php", 
            type: "POST",
        },
        "order": [[ 0, "desc" ]],
        "columns": [
            {
                "data": "tbl_inquiry_idtbl_inquiry"  
            },
            {
                "data": "name"  
            },
            {
                "data": null, 
                "defaultContent": "<i>Checking...</i>" 
            },
            {
                "data": null, 
                "defaultContent": "<i>Checking...</i>" 
            },
            {
                "data": null, 
                "defaultContent": "<i>Checking...</i>" 
            },
            {
                "data": null, 
                "defaultContent": "<i>Checking...</i>" 
            }
        ],
        "createdRow": function(row, data, dataIndex) {
            var inquiryid = data.tbl_inquiry_idtbl_inquiry;

            $.ajax({
                url: "<?php echo base_url() ?>dashboard/checkMaterial", 
                type: "POST",
                data: { inquiryid: inquiryid },
                success: function(response) {
                    if (response == 1) { 
                        $('td:eq(2)', row).html('<i class="fas fa-check text-success"></i>'); 
                    } else {
                        $('td:eq(2)', row).html('<i class="fas fa-times text-danger"></i>'); 
                    }
                }
            });

            $.ajax({
                url: "<?php echo base_url() ?>Dashboard/checkCutting", 
                type: "POST",
                data: { inquiryid: inquiryid },
                success: function(response) {
                    if (response == 1) { 
                        $('td:eq(3)', row).html('<i class="fas fa-check text-success"></i>'); 
                    } else {
                        $('td:eq(3)', row).html('<i class="fas fa-times text-danger"></i>'); 
                    }
                }
            });

            $.ajax({
                url: "<?php echo base_url() ?>Dashboard/checkPrinting", 
                type: "POST",
                data: { inquiryid: inquiryid },
                success: function(response) {
                    if (response == 1) { 
                        $('td:eq(4)', row).html('<i class="fas fa-check text-success"></i>'); 
                    } else {
                        $('td:eq(4)', row).html('<i class="fas fa-times text-danger"></i>'); 
                    }
                }
            });

            $.ajax({
                url: "<?php echo base_url() ?>Dashboard/checkDelivery",
                type: "POST",
                data: { inquiryid: inquiryid },
                success: function(response) {
                    if (response == 1) { 
                        $('td:eq(5)', row).html('<i class="fas fa-check text-success"></i>'); 
                    } else {
                        $('td:eq(5)', row).html('<i class="fas fa-times text-danger"></i>'); 
                    }
                }
            });
        },
        drawCallback: function(settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    $('#dataTableAccepted').on('click', '.btnquotation', function() {
        var qid = $(this).data('qid');
        var id = $(this).data('id');
        $('#inquiryid').val(id);
        $('#staticBackdrop').modal('show');
    });
});
</script>

<?php include "include/footer.php"; ?>
