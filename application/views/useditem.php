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
							<span>Machines Used Items</span>
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
										<label class="small font-weight-bold">Machine Model*</label>
										<select class="form-control form-control-sm selecter2 px-0" name="machinemodel" id="machinemodel">
											<option value="">Select</option>
											<option value="0">All</option>
											<?php foreach ($getmachinemodel->result() as $row) { ?>
												<option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
											<?php } ?>
										</select>
									</div>

									<div class="col-2">
										<label class="small font-weight-bold">Machine*</label>
										<select class="form-control form-control-sm selecter2 px-0" name="machine" id="machine">
											<option value="">Select</option>
											<option value="0">All</option>
											<?php foreach ($getmachine->result() as $row) { ?>
												<option value="<?php echo $row->id ?>">
													<?php echo $row->reference . '-' . $row->s_no; ?>
												</option>
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

									<div class="col-2 align-self-end">
										<button class="btn btn-sm btn-primary" id="btnSearch">Search</button>
									</div>
								</div>


								<hr>

								<div class="row">
									<div class="col-12">
										<table id="useitemtable" class="table table-bordered table-striped table-sm w-100">
											<thead>
												<tr>

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
				title: 'Used Item Report',
				text: '<i class="fas fa-file-csv mr-2"></i> CSV',
			},
			{
				text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
				className: 'btn btn-danger btn-sm',
				action: function () {
					let rows = useitemtable.rows({ search: 'applied' }).data().toArray(); 
					$.ajax({
						url: "<?php echo base_url('UsedItem/useItemReport'); ?>",
						type: "POST",
						data: {
							rows: rows
						},
						xhrFields: { responseType: 'blob' },
						success: function (data) {
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
			url: "<?php echo base_url() ?>scripts/useditemlist.php",
			type: "POST",
			data: function (d) {
				d.machinetype = $('#machinetype').val();
				d.machinemodel = $('#machinemodel').val();
				d.machine = $('#machine').val();
				d.from_date = $('#from_date').val(); 
        		d.to_date = $('#to_date').val(); 
			}
		},

		"order": [[0, "desc"]],
		columns: [
				{ data: 'used_date', title: 'Used Date' },
				{ data: 'machine_type', title: 'Machine Type' },
				{ data: 'machine_model', title: 'Machine Model' },
				{ data: 'machine_name', title: 'Machine' },
				{ data: 'spare_part_name', title: 'Spare Part' },
				{ data: 'unit_price', title: 'Unit price' },
				{ data: 'qty', title: 'Quantity' },
				{ data: null,
					title: 'Total',
					render: function (data, type, row) {
						let unit = parseFloat(row.unit_price) || 0;
						let qty = parseFloat(row.qty) || 0;
						return (unit * qty).toFixed(2);
					},
					className: 'text-right'
				},
				{ data: 'source', title: 'Source' }, 			
			],
		drawCallback: function (settings) {
			$('[data-toggle="tooltip"]').tooltip();
		}
	});

	$('#btnSearch').on('click', function () {
		useitemtable.ajax.reload();
	});



	$('#machinetype').on('change', function () {
		var typeId = $(this).val();
		$('#machinemodel').html('<option value="">Loading...</option>');
		$('#machineNoContainer').hide();
		$('#machineno').html('<option value="">Select</option>');

		if (typeId) {
			$.ajax({
				url: "<?php echo base_url('UsedItem/getModelsByType'); ?>",
				type: "POST",
				data: { type_id: typeId },
				dataType: "json",
				success: function (data) {
					let options = '<option value="">Select</option>';
					$.each(data, function (index, item) {
						options += `<option value="${item.id}">${item.name}</option>`;
					});
					$('#machinemodel').html(options);
				}
			});
		} else {
			$('#machinemodel').html('<option value="">Select</option>');
		}
	});

	$('#machinemodel').on('change', function () {
    var modelId = $(this).val();
    $('#machine').html('<option value="">Loading...</option>');

    if (modelId) {
        $.ajax({
            url: "<?php echo base_url('UsedItem/getMachinesByModel'); ?>",
            type: "POST",
            data: { model_id: modelId },
            dataType: "json",
            success: function (data) {
                let options = '<option value="">Select</option><option value="0">All</option>';
                $.each(data, function (index, item) {
                    options += `<option value="${item.id}">${item.reference} - ${item.s_no}</option>`;
                });
                $('#machine').html(options);
            },
            error: function () {
                $('#machine').html('<option value="">Error loading data</option>');
            }
        });
    } else {
        $('#machine').html('<option value="">Select</option><option value="0">All</option>');
    }
});


});
</script>

<?php include "include/footer.php"; ?>
