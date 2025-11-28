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
                            <span>Machines Overall Cost</span>
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
                                    <input type="hidden" name="type" id="type" value="1">

                                    <div class="col-2">
                                        <label class="small font-weight-bold">Machine Type*</label>
                                        <select class="form-control form-control-sm selecter2 px-0" name="machinetype" id="machinetype">
                                            <option value="">Select</option>
                                            <option value="0">All</option>
                                            <?php foreach ($getmachinetype->result() as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-2">
                                        <label class="small font-weight-bold">From</label>
                                        <input type="date" class="form-control form-control-sm" id="from_date" name="from_date">
                                    </div>

                                    <div class="col-2">
                                        <label class="small font-weight-bold">To</label>
                                        <input type="date" class="form-control form-control-sm" id="to_date" name="to_date">
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-sm btn-primary px-4" id="btnSearch">Search</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <table id="useitemtable" class="table table-bordered table-striped table-sm w-100">
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" class="text-right">Grand Total:</th>
                                                    <th id="grand_total" class="text-right"></th>
                                                </tr>
                                            </tfoot>
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
var base_url = '<?php echo base_url(); ?>';
$(document).ready(function () {

    let useitemtable = $('#useitemtable').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "deferLoading": 0,
        dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
		"buttons": [
			{ 
				extend: 'csv', 
				className: 'btn btn-success btn-sm', 
				title: 'Machines Overall Cost', 
				text: '<i class="fas fa-file-csv mr-2"></i> CSV' 
			},
			{
				text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
				className: 'btn btn-danger btn-sm',
				action: function () {
					let filters = {
						machinetype: $('#machinetype').val(),
						from_date: $('#from_date').val(),
						to_date: $('#to_date').val()
					};

					$.ajax({
						url: base_url + 'MachineOverallCost/generatePDF',
						type: "POST",
						data: filters,
						xhrFields: { responseType: 'blob' },
						success: function (data) {
							const blob = new Blob([data], { type: 'application/pdf' });
							const url = window.URL.createObjectURL(blob);
							window.open(url);
						}
					});
				}
			},
			{ 
				extend: 'print', 
				className: 'btn btn-primary btn-sm', 
				title: 'Machines Overall Cost', 
				text: '<i class="fas fa-print mr-2"></i> Print' 
			}

		],

        ajax: {
            url: "<?php echo base_url() ?>scripts/machineoverallcostlist.php",
            type: "POST",
            data: function (d) {
                d.machinetype = $('#machinetype').val();
                d.from_date = $('#from_date').val(); 
                d.to_date = $('#to_date').val(); 
            }
        },
        "order": [[0, "desc"]],
        columns: [
            { data: 'machine_type', title: 'Machine Type' },
            { data: 'machine', title: 'Machine' },
            { data: 'source', title: 'Source' },
            { data: 'sub_total', title: 'Item Cost' },
            { data: 'transport_charge', title: 'Transport Charge' },
            { data: 'charge', title: 'Repair/Service Charge' },
            { data: 'total', title: 'Total', className: "text-right" }
        ],
        drawCallback: function (settings) {
            // Calculate grand total
            let api = this.api();
            let total = api.column(6, { page: 'current' }).data().reduce(function (a, b) {
                return parseFloat(a.toString().replace(/,/g, '')) + parseFloat(b.toString().replace(/,/g, ''));
            }, 0);
            $('#grand_total').html(total.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}));
        }
    });

    $('#btnSearch').on('click', function () {
        useitemtable.ajax.reload();
    });

});
</script>

<?php include "include/footer.php"; ?>
