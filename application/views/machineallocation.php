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
                    <span>Machine Allocation</span>
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                <form id="searchform">
                    <div class="form-row">
					<div class="col-3">
                            <label class="small font-weight-bold text-dark">Customer*</label>
                            <div class="input-group input-group-sm mb-3">
                                <select class="form-control form-control-sm" name="customer" id="customer"
                                    required>
                                    <option value="">Select</option>
                                    <?php foreach ($customer as $customer): ?>
										<option value="<?php echo $customer->idtbl_customer; ?>">
											<?php echo $customer->name; ?>
										</option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>

						<!-- <div class="col-3">
                            <label class="small font-weight-bold text-dark">Inquiry*</label>
                            <div class="input-group input-group-sm mb-3">
                                <select type="text" class="form-control dpd1a rounded-0" id="selectedInquiry"
                                    name="selectedInquiry" required>
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div> -->

                        <div class="col-3">
                            <label class="small font-weight-bold text-dark">PO Number*</label>
                            <div class="input-group input-group-sm mb-3">
                                <select type="text" class="form-control dpd1a rounded-0" id="selectedPo"
                                    name="selectedPo" required>
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="d-none" id="hidesubmit">
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap"
                                id="machineAllocationTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Po Number</th>
                                        <!-- <th>Job</th> -->
                                        <th>Qty</th>
                                        <th>Cost Item Name</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id = "machineAllocationTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="machineallocatemodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Machine Allocation</h5><hr>
				<div class="small font-weight-bold text-dark mb-0 mt-1">
					Customer: <span id="selectedCustomer">-</span> |
					PO Number: <span id="selectedPO">-</span>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="alert"></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-4">
						<form action="" id="allocationform" autocomplete="off">
							<div class="form-row mb-1">
							<input type="hidden" class="form-control form-control-sm" name="poid"
							id="poid" required>
								<input type="hidden" class="form-control form-control-sm" name="costitemid"
									id="costitemid" required>
								<input type="hidden" class="form-control form-control-sm" name="hiddenselectjobid"
									id="hiddenselectjobid" required>
								<label class="small font-weight-bold text-dark">Machine*</label><br>
								<select class="form-control form-control-sm" style="width: 100%;" name="machine"
									id="machine" required>
									<option value="">Select</option>
									<?php foreach ($machine as $rowmachine): ?>
										<option value="<?php echo $rowmachine->id; ?>">
											<?php echo $rowmachine->name . ' - ' . $rowmachine->s_no; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-row mb-1">
								<label class="small font-weight-bold text-dark">Employee*</label><br>
								<select class="form-control form-control-sm" style="width: 100%;" name="employee"
									id="employee" required>
									<option value="">Select</option>
									<?php foreach ($employee as $rowemployee): ?>
										<option value="<?php echo $rowemployee->id; ?>">
											<?php echo $rowemployee->emp_fullname . ' - ' . $rowemployee->emp_id; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-row mb-1">
								<label class="small font-weight-bold text-dark">Delivery Plan*</label>
								<div class="input-group input-group-sm">
									<select type="text" class="form-control dpd1a rounded-0" id="deliveryplan"
											name="deliveryplan" required>
										<option value="">Select</option>
                                    </select>
								</div>
							</div>
							<div class="form-row mb-1">
								<label class="small font-weight-bold">Allocation Qty*</label>
								<input type="number" class="form-control form-control-sm" placeholder=""
									name="allocationqty" id="allocationqty" required>
							</div>
							<div class="form-row mb-1">
								<label class="small font-weight-bold">Start Date*</label>
								<input type="datetime-local" class="form-control form-control-sm" placeholder=""
									name="startdate" id="startdate" required>
							</div>
							<div class="form-row mb-1">
								<label class="small font-weight-bold">End Date*</label>
								<input type="datetime-local" class="form-control form-control-sm" placeholder=""
									name="enddate" id="enddate" required>
							</div>
							<div class="form-group mt-3 px-2 text-right">
								<button type="button" name="BtnAddmachine" id="BtnAddmachine"
									class="btn btn-primary btn-m  fa-pull-right"><i
										class="fas fa-plus"></i>&nbsp;Add</button>
							</div>
							<button type="submit" id="allocationsubmit" class='d-none'>Submit</button>
						</form>
					</div>
					<div class="col-8">
						<div class="row mt-4">
							<div class="col-12 col-md-12">
								<div class="table" id="style-2">
									<table class="table table-bordered table-striped  nowrap display"
										id="tblmachinelist">
										<thead>
											<th class="d-none">Costing ID</th>
											<th>Machine</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Allocated Qty</th>
											<th>Action</th>
										</thead>
										<tbody id="tblmachinebody">

										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="form-group mt-3 text-right">
							<button type="button" id="submitBtn2" class="btn btn-outline-primary btn-sm fa-pull-right" <?php if($addcheck==0){echo 'disabled';} ?>>
									<i class="far fa-save"></i>&nbsp;Allocate
								Machine</button>
						</div>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-12 col-md-12">
						<div class="table" id="style-2">
							<table class="table table-bordered table-striped  nowrap display" id="tblallocationlist">
								<thead>
									<th>Start Date</th>
									<th>End Date</th>
									<!-- <th>Cost Item</th> -->
									<th>Quantity</th>
								</thead>
								<tbody id="tblallocationlistbody">

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
     <?php include "include/footerbar.php"; ?>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>

<script>
	$(document).ready(function(){
		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';

	});
	$("#tblmachinelist").on('click', '.btnDeleterow', function () {
		$(this).closest('tr').remove();
	});

	$(document).on("click", "#BtnAddmachine", function () {

		
		if (!$("#allocationform")[0].checkValidity()) {
			$("#allocationsubmit").click();
		} else {
			var machine = $('#machine').val();
			var machinelist = $("#machine option:selected").text();
			var startdate = $('#startdate').val();
			var enddate = $('#enddate').val();
			var allocationqty = $('#allocationqty').val();
			var deliveryplan = $('#deliveryplan').val();

			$.ajax({
				type: "POST",
				data: {
					machineid: machine,
					startdate: startdate,
					enddate: enddate,
				},
				url: '<?php echo base_url() ?>Machinealloction/Checkmachineavailability',
				success: function (result) { //alert(result);
					var obj = JSON.parse(result);
					var html = '';

					if (obj.actiontype == 1) {
						html +=
							'<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Sorry!</strong> Machine is Not Available.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
						$('#alert').html(html);
					} else {
						
						$('#tblmachinelist> tbody:last').append(
							'<tr><td class="text-center">' +machinelist + 
							'</td><td class="d-none text-center">' + machine +
							'</td><td class="text-center">' + startdate.replace('T', ' ') +
    						'</td><td class="text-center">' + enddate.replace('T', ' ') +
							'</td><td class="text-center">' + allocationqty +
							'</td><td class="d-none text-center">' + deliveryplan +
							'</td><td> <button type="button" class="btnDeleterow btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td></tr>'
						);
						$('#machine').val('');
						$('#startdate').val('');
						$('#enddate').val('');
						$('#deliveryplan').val('');
						$('#allocationqty').val('');
					}

				}
			});


		}
	});

	$(document).on("click", "#submitBtn2", function () {

		var costitemid = $('#costitemid').val();
		var jobid = $('#hiddenselectjobid').val();
		var deliveryplan = $('#deliveryplan').val();
		var employee = $('#employee').val();
		var poid = $('#poid').val();

		// get table data into array
		var tbody = $('#tblmachinelist tbody');
		if (tbody.children().length > 0) {
			var jsonObj = []
			$("#tblmachinelist tbody tr").each(function () {
				item = {}
				$(this).find('td').each(function (col_idx) {
					item["col_" + (col_idx + 1)] = $(this).text();
				});
				jsonObj.push(item);
			});
		}
		// console.log(jsonObj);

		$.ajax({
			type: "POST",
			data: {
				tableData: jsonObj,
				jobid: jobid,
				employee: employee,
				costitemid: costitemid,
				poid:poid

			},
			url: '<?php echo base_url() ?>Machinealloction/Machineinsertupdate',
			success: function (result) {
				//console.log(result);
				location.reload();
			}
		});

	});

	$('#machine').change(function () {
		var recordID = $(this).val()

		$.ajax({
            type: "POST",
            url: "<?php echo site_url('Machinealloction/FetchAllocationData'); ?>",
            data: {
                recordID: recordID
            },
            success: function (result) {
                $('#tblallocationlist> tbody:last').empty().append(result);
            }
        });
	})


	$('#customer').change(function () {
		let recordId = $('#customer :selected').val();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('Machinealloction/FetchCustomerInquiryAndOrderData'); ?>",
			data: { recordId: recordId },
			success: function (result) {
				try {
					var obj = JSON.parse(result);
					var html1 = '<option value="">Select</option>';
					$.each(obj, function (i, item) {
						// Check both fields exist before adding
						if (item.idtbl_order && item.idtbl_inquiry) {
							html1 += '<option value="' + item.idtbl_order + '">';
							html1 += 'INQ ' + item.idtbl_inquiry + ' - PO ' + item.idtbl_order;
							html1 += '</option>';
						}
					});
					$('#selectedPo').empty().append(html1);
				} catch (e) {
					console.error("JSON parsing error: ", e);
					console.log("Raw result: ", result);
				}
			}
		});
	});

	$('#selectedPo').change(function () {
        let recordId = $('#selectedPo :selected').val();
        $.ajax({
            type: "POST",
            data: {
                recordId: recordId
            },
            url: "<?php echo site_url('Machinealloction/FetchItemDataForAllocation'); ?>",
            success: function (result) {
                $('#machineAllocationTable> tbody:last').empty().append(result);
            }
        });

		$.ajax({
            type: "POST",
            url: "<?php echo site_url('Machinealloction/GetDeliveryPlanDetails'); ?>",
            data: {
                recordId: recordId
            },
            success: function (result) {
                var obj = JSON.parse(result);

                var html1 = '';
                html1 += '<option value="">Select</option>';
                $.each(obj, function (i, item) {
                    // alert(result[i].id);
                    html1 += '<option value="' + obj[i].idtbl_delivery_detail + '">';
                    html1 += 'Id: ' + obj[i].deliveryId + ' /Date: ' + obj[i].delivery_date + ' /Qty: ' + obj[i].deliver_quantity;
                    html1 += '</option>';
                });
                $('#deliveryplan').empty().append(html1);
            }
        });
	})

	

	$(document).ready(function () {
    // Load Orders
		$.ajax({
			type: "GET",
			url: "<?php echo site_url('Machinealloction/GetOrderList'); ?>",
			success: function (result) {
				const obj = JSON.parse(result);
				let html = '<option value="">Select</option>';
				obj.forEach(row => {
					html += `<option value="${row.tbl_order_idtbl_order}">
								PO${row.tbl_order_idtbl_order} - ${row.name} - ${row.product} - ${row.quantity}
							</option>`;
				});
				$('#orderid').html(html);
			}
		});

		$('#orderid').change(function () {
			const selectedOrder = $(this).val();

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Machinealloction/GetDeliveryIdsForOrder'); ?>",
				data: { orderId: selectedOrder },
				success: function (result) {
					const obj = JSON.parse(result);
					let html = '';
					let index = 1;

					obj.forEach(item => {
						html += `
							<tr>
								<td>${index++}</td>
								<td>${item.customer_name}</td>
								<td>PO${item.tbl_order_idtbl_order}</td>
								<td>${item.deliveryId}</td>
								<td>${item.deliver_quantity}</td>
								<td>${item.cost_item_name}</td>
								<td class="text-right">
									<button type="button" class="btn btn-dark btn-sm float-right btnAdd" id="${item.deliveryId}">
										<i class="fas fa-tools"></i>
									</button>
								</td>
							</tr>
						`;
					});

					$('#machineAllocationTable tbody').html(html);
				}
			});
		});

		// Button click to open modal
		$('#machineAllocationTable tbody').on('click', '.btnAdd', function () {
			var costItemId = 0;
			var poId = $(this).attr('id');
			var jobId = $('#selectedInquiry').val();
			var customerName = $('#customer option:selected').text();
			var poDisplayText = $('#selectedPo option:selected').text();
			$('#poid').val(poId);
			$('#costitemid').val(costItemId);
			$('#hiddenselectjobid').val(jobId);$('#selectedCustomer').text(customerName);
			$('#selectedPO').text(poDisplayText);
			$('#machineallocatemodal').modal('show');
		});


	});


	function deactive_confirm() {
		return confirm("Are you sure you want to deactive this?");
	}

	function active_confirm() {
		return confirm("Are you sure you want to active this?");
	}

	function delete_confirm() {
		return confirm("Are you sure you want to remove this?");
	}
</script>
