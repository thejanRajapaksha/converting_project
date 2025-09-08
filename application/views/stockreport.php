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
							<div class="page-header-icon"><i class="fas fa-users"></i></div>
							<span>Stock Report</span>
						</h1>
					</div>
				</div>
			</div>
			<div class="container-fluid mt-2 p-0 p-2">
				<div class="card">
					<div class="card-body p-0 p-2">
						<div class="row">
							<div class="container-fluid mt-3">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="small font-weight-bold">Type*</label>
                                        <select class="form-control form-control-sm" name="type" id="type" required>
                                            <option value="">Select</option>
                                            <option value="1">Spare Parts</option>
                                            <option value="2">Material</option>
                                            <option value="3">Machine</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label class="small font-weight-bold">Supplier*</label>
                                        <select class="form-control form-control-sm selecter2 px-0" name="supplier" id="supplier" required>
                                            <option value="">Select</option>
                                            <option value="0">All</option>
                                            <?php foreach ($getsuppier->result() as $row) { ?>
                                                <option value="<?php echo $row->idtbl_supplier ?>"><?php echo $row->suppliername ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-2 align-self-end">
                                        <button class="btn btn-sm btn-primary" id="btnSearch">Search</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <table id="stockTable" class="table table-bordered table-striped table-sm w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    let stockTable; // declare variable

$(document).ready(function () {
    var selectedType = $("#type").val();
    var typeName;

    if (selectedType == 1) {
        typeName = 'Spare Parts'; 
    } else if (selectedType == 2){
        typeName = 'Material';
    } else if (selectedType == 3){
        typeName = 'Machine';
    }

    stockTable = $('#stockTable').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,   // 🚀 don’t load data on page load
        dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        responsive: true,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
        ],
        "buttons": [
            {
                extend: 'csv',
                className: 'btn btn-success btn-sm',
                title: 'Stock Report',
                text: '<i class="fas fa-file-csv mr-2"></i> CSV',
            },
            {
                text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                className: 'btn btn-danger btn-sm',
                action: function () {
                    let rows = stockTable.rows().data().toArray(); 

                    $.ajax({
                        url: "<?php echo base_url('StockReport/stockReportPDF'); ?>",
                        type: "POST",
                        data: {
                            rows: rows,  
                            search_date: $("#date").val(),
                            search_week: $("#week").val(),
                            search_month: $("#month").val(),
                            search_from_date: $("#date_from").val(),
                            search_to_date: $("#date_to").val(),
                            report_type: "5",
                            search_type: $("#type").val(),
                            supplier: $("#supplier").val()
                        },
                        xhrFields: {
                            responseType: 'blob' 
                        },
                        success: function(data) {
                            var blob = new Blob([data], { type: 'application/pdf' });
                            var url = window.URL.createObjectURL(blob);
                            window.open(url); 
                        }
                    });
                }
            },
            {
                extend: 'print',
                title: 'Stock Report',
                className: 'btn btn-primary btn-sm',
                text: '<i class="fas fa-print mr-2"></i> Print',
                customize: function (win) {
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },
            }
        ],
        ajax: {
            url: "<?php echo base_url() ?>scripts/stockReportlist.php",
            type: "POST",
            data: function (d) {
                d.type = $('#type').val();
                d.supplier = $('#supplier').val();
            }
        },
        "order": [[0, "desc"]],
        "columns": [
            { "data": "idtbl_print_stock" },
            { "data": "name" },
            { "data": "batchno" },
            { "data": "qty" },
            { "data": "unitprice" }
        ],
        drawCallback: function (settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    $('#btnSearch').on('click', function () {
        stockTable.ajax.reload();
    });
});

		
</script>
<?php include "include/footer.php"; ?>
