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
                    <div class="page-header-icon"><i class="fas fa-list"></i></div>
                    <span>WIP Customer Report</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 p-2">
        <div class="card">
            <div class="card-body p-2">
                
                <form id="searchform">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label class="small font-weight-bold text-dark">Customer*</label>
                            <select class="form-control form-control-sm" name="customername" id="customername" required>
                                <option value="" selected disabled>Select Customer</option>
                                <?php foreach ($result['customername'] as $customernames):?>
                                    <option value="<?php echo $customernames->idtbl_customer;?>">
                                    <?php echo htmlspecialchars($customernames->name);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="small font-weight-bold text-dark">PO Number*</label>
                            <div class="input-group input-group-sm mb-3">
                                <select type="text" class="form-control dpd1a rounded-0" id="selectedPo"
                                    name="selectedPo" required>
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table id="allocationTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Machine</th>
                                <th>Order / Delivery</th>
                                <th>End date</th>
                                <th>Delivery date</th>
                                <th>Order Quantity</th>
                                <th>Delivery Quantity</th>
                                <th>Completed Quantity</th>
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
    $(document).ready(function () {

        var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';
        
        let table = $('#allocationTable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            responsive: true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Machine Allocation Data', text: '<i class="fas fa-file-csv mr-2"></i> CSV' },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Machine Allocation Data', text: '<i class="fas fa-file-pdf mr-2"></i> PDF' },
                {
                    extend: 'print',
                    title: 'Machine Allocation Data',
                    className: 'btn btn-primary btn-sm',
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/CustomerPOWIPlist.php",
                type: "POST",
                data: function (d) {
                    d.customerId = $('#customername').val();
                    d.poId = $('#selectedPo').val();
                }
            },
            order: [[0, "desc"]],
            "columns": [
                { "data": "machine" },
                { "data": "order_delivery" },
                { "data": "order_date" },
                { "data": "delivery_date" },
                { "data": "quantity" },
                { "data": "deliver_quantity" },
                {
                    "data": "completedqty",
                    render: function(data, type, row) {
                        return data ? data : 0;
                    }
                }
            ]
        });

        // Reload table when dropdowns change
        $('#customername, #selectedPo').on('change', function () {
            table.ajax.reload();
        });

        $('#customername').on('change', function () {
            const customerId = $(this).val();
            $('#selectedPo').html('<option value="">Loading...</option>');

            if (customerId) {
                $.ajax({
                    url: "<?php echo site_url('CustomerPOWIP/getPOForCustomer'); ?>",
                    type: "POST",
                    data: { customerId: customerId },
                    dataType: "json",
                    success: function (data) {
                        let options = '<option value="">All POs</option>';
                        data.forEach(function (po) {
                            options += `<option value="${po.idtbl_order}">PO - ${po.idtbl_order}</option>`;
                        });
                        $('#selectedPo').html(options);
                    },
                    error: function () {
                        $('#selectedPo').html('<option value="">Error loading POs</option>');
                    }
                });
            } else {
                $('#selectedPo').html('<option value="">Select Customer First</option>');
            }
        });

    });
</script>


