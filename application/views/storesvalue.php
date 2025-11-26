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
							<span>Stores Value Report</span>
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
											<label class="small font-weight-bold">Part Name*</label>
											<select class="form-control form-control-sm select2-ajax" name="partname" id="partname" style="width:100%;">
												<option value="">Select</option>
											</select>
										</div>

										<div class="col-2">
											<label class="small font-weight-bold">Select Month</label>
											<input type="month" class="form-control form-control-sm" id="select_month" name="select_month">
										</div>

										<div class="col-2 align-self-end">
											<button class="btn btn-sm btn-primary px-4" id="btnSearch">Search</button>
										</div>
									</div>

								<div class="row mt-2">
									<div class="col-2">
										<label class="small font-weight-bold">Closing Month*</label>
										<input type="month" class="form-control form-control-sm" id="closing_month">
									</div>

									<div class="col-2 align-self-end">
										<button class="btn btn-sm btn-danger px-4" id="btnCloseMonth">Close Month</button>
									</div>
									
								</div>


								<hr>

								<div class="row">
									<div class="col-12">
										<table id="storesvaluetable" class="table table-bordered table-striped table-sm w-100">
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

	let storesvaluetable = $('#storesvaluetable').DataTable({
    "destroy": true,
    "processing": true,
    "serverSide": true,
    "deferLoading": 0,
    dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    responsive: true,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
    "buttons": [
        {
            extend: 'csv',
            className: 'btn btn-success btn-sm',
            title: 'Stores Value Report',
            text: '<i class="fas fa-file-csv mr-2"></i> CSV',
        },
        {
            text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
            className: 'btn btn-danger btn-sm',
            action: function () {
                let rows = storesvaluetable.rows({ search: 'applied' }).data().toArray(); 
                $.ajax({
                    url: "<?php echo base_url('StoresValue/StoresValueReport'); ?>",
                    type: "POST",
                    data: {
                        rows: rows,
                        select_month: $('#select_month').val()
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
        url: "<?php echo base_url() ?>scripts/storesvaluelist.php",
        type: "POST",
        data: function (d) {
            let month = $('#select_month').val();

            if (!month) {
                alert("Please select a month to search.");
                return false;
            }

            d.machinetype = $('#machinetype').val() || 0;
            d.machinemodel = $('#machinemodel').val() || 0;
            d.partname = $('#partname').val() || 0;
            d.select_month = month;
        },
        error: function(xhr, error, thrown) {
            console.error('Ajax error:', error);
            console.log('Response:', xhr.responseText);
            
            try {
                let response = JSON.parse(xhr.responseText);
                if (response.error) {
                    alert('Error: ' + response.error);
                } else {
                    alert('Error loading data. Check console for details.');
                }
            } catch(e) {
                alert('Error loading data. Check console for details.');
            }
        }
    },
    "order": [[0, "asc"]],
    columns: [
        { data: "spare_part", title: "Spare Part" },
        { data: "starting", title: "Starting Stock" },
        { data: "grn", title: "GRN" },
        { data: "consumption", title: "Consumption" },
        { data: "finishing", title: "Finishing Stock" }
    ],
    drawCallback: function (settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }
});

	$('#btnSearch').on('click', function() {
		storesvaluetable.ajax.reload();
	});

	$('#machinetype').on('change', function () {
		var typeId = $(this).val();
		$('#machinemodel').html('<option value="">Loading...</option>');
		$('#machineNoContainer').hide();
		$('#machineno').html('<option value="">Select</option>');

		if (typeId) {
			$.ajax({
				url: "<?php echo base_url('StoresValue/getModelsByType'); ?>",
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

	$('#partname').select2({
        placeholder: 'Search part name or part number',
        width: '100%',
        allowClear: true,
        ajax: {
            url: "<?php echo base_url('StockReport/Getpartname'); ?>",
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        }
    });

	$('#btnCloseMonth').on('click', function() {
		let closing_month = $('#closing_month').val();

		if (closing_month === "") {
			alert("Please select the month to close.");
			return;
		}

		if (!confirm("Are you sure you want to close stock for " + closing_month + "?")) {
			return;
		}

		$.ajax({
			url: "<?= base_url('StoresValue/close_month_stock') ?>",
			type: "POST",
			data: { month: closing_month },
			dataType: "json", // <-- important
			success: function(res) {
				if (res.status === "success") {
					alert("Month closed successfully!");
				} else {
					alert(res.message);
				}
			},
			error: function() {
				alert("Server Error. Please try again.");
			}
		});
	});


});
</script>

<?php include "include/footer.php"; ?>
