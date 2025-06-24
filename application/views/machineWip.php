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
                    <span>WIP Machines Report</span>
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
                            <label class="small font-weight-bold text-dark">Machine*</label>
                            <select class="form-control form-control-sm" name="machine" id="machine" required>
                                <option value="">Select</option>
                                <?php foreach ($result['machine'] as $machines): ?>
                                    <option value="<?php echo $machines->id; ?>">
                                        <?php echo $machines->name . '-' . $machines->s_no; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="small font-weight-bold text-dark">Date*</label>
                            <input type="date" class="form-control form-control-sm" id="date" name="date" required>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-3">
                    <table id="allocationTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Order / Delivery</th>
                                <th>End date</th>
                                <th>Delivery date</th>
                                <th>Order Qty</th>
                                <th>Delivery Qty</th>
                                <th>Completed Qty</th>
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
        
        var table = $('#allocationTable').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "responsive": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'WIP Machine Report', text: '<i class="fas fa-file-csv mr-2"></i> CSV' },
                {
                    extend: 'pdf', 
                    className: 'btn btn-danger btn-sm',
                    title: 'WIP Machine Report',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (doc) {
                        doc.content[0].alignment = 'left';
                        doc.content[1].alignment = 'left';
                        doc.defaultStyle.fontSize = 9;
                        var tableBody = doc.content[1].table.body;
                        var columnCount = tableBody[0].length;
                        doc.content[1].table.widths = Array(columnCount).fill('*');
                    }
                },
                {
                    extend: 'print',
                    title: 'WIP Machine Report',
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
                url: "<?php echo base_url() ?>scripts/MachineWIPlist.php",
                type: "POST",
                data: function (d) {
                    d.machineId = $('#machine').val();
                    d.date = $('#date').val();
                }
            },
            "order": [[0, "desc"]],
            "columns": [
                { "data": "name" },
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

        $('#machine, #date').on('change', function () {
            table.ajax.reload();
        });
    });

</script>
