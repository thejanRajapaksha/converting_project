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
							<span>Row Materials</span>
						</h1>
					</div>
				</div>
			</div>
			<div class="container-fluid mt-2 p-0 p-2">
				<div class="card">
					<div class="card-body p-0 p-2">
						<div class="row">
							<div class="col-3">
								<form action="<?php echo base_url() ?>Rowmaterials/Rowmaterialsinsertupdate" method="post"
									autocomplete="off">
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Material Main Category*</label>
										<select class="form-control selecter2 form-control-sm" name="materialmaincategory" id="materialmaincategory" required>
											<option value="">Select</option>
											<?php foreach ($maincategorylist as $rowmateriallist) { ?>
											<option value="<?php echo $rowmateriallist->idtbl_material_main_cat ?>">
												<?php echo $rowmateriallist->categoryname ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Material Name*</label>
										<input type="text" class="form-control form-control-sm" name="materialname" id="materialname"
											required>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Supplier*</label>
										<select class="form-control selecter2 form-control-sm" name="supplier" id="supplier" required>
											<option value="">Select</option>
											<?php foreach ($supplierlist as $rowsupplierlist) { ?>
											<option value="<?php echo $rowsupplierlist->idtbl_supplier ?>">
												<?php echo $rowsupplierlist->suppliername ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Measurment*</label>
										<select class="form-control selecter2 form-control-sm" name="measurment" id="measurment" required>
											<option value="">Select</option>
											<?php foreach ($measurmentlist as $rowmeasurmentlist) { ?>
											<option value="<?php echo $rowmeasurmentlist->idtbl_mesurements ?>">
												<?php echo $rowmeasurmentlist->measure_type ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Unit Price*</label>
										<input type="text" class="form-control form-control-sm" name="unitprice" id="unitprice"
											required>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">Sale Price*</label>
										<input type="text" class="form-control form-control-sm" name="saleprice" id="saleprice"
											required>
									</div>
									<div class="form-group mb-1">
										<label class="small font-weight-bold">ROL*</label>
										<input type="text" class="form-control form-control-sm" name="rol" id="rol"
											required>
									</div>
									<div class="form-group mt-2 text-right">
										<button type="submit" id="submitBtn" class="btn btn-primary btn-sm px-4"
											<?php if($addcheck==0){echo 'disabled';} ?>><i
												class="far fa-save"></i>&nbsp;Add</button>
									</div>
									<input type="hidden" name="recordOption" id="recordOption" value="1">
									<input type="hidden" name="recordID" id="recordID" value="">
								</form>
							</div>
							<div class="col-9">
								<div class="scrollbar pb-3" id="style-2">
									<table class="table table-bordered table-striped table-sm nowrap"
										id="tblmeasurment">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Supplier</th>
												<th>Measurment</th>
												<th>Main Material</th>
												<th>ROL</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
									</table>
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
		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';

        $('.selecter2').select2();


		$('#tblmeasurment').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" +
				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			responsive: true,
			lengthMenu: [
				[10, 25, 50, -1],
				[10, 25, 50, 'All'],
			],
			"buttons": [{
					extend: 'csv',
					className: 'btn btn-success btn-sm',
					title: 'Supplier Category Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
				{
					extend: 'pdf',
					className: 'btn btn-danger btn-sm',
					title: 'Supplier Category Information',
					text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
				},
				{
					extend: 'print',
					title: 'Supplier Category Information',
					className: 'btn btn-primary btn-sm',
					text: '<i class="fas fa-print mr-2"></i> Print',
					customize: function (win) {
						$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
					},
				},
				// 'copy', 'csv', 'excel', 'pdf', 'print'
			],

			ajax: {
				url: "<?php echo base_url() ?>scripts/rowmateriallist.php",
				type: "POST", // you can use GET
				// data: function(d) {}
			},
			"order": [
				[0, "desc"]
			],
			"columns": [{
					"data": "idtbl_row_material"
				},
				{
					"data": "material_name"
				},
				{
					"data": "suppliername"
				},
				{
					"data": "measure_type"
				},
				{
					"data": "categoryname"
				},
				{
					"data": "rol"
				},
				{
					"targets": -1,
					"className": 'text-right',
					"data": null,
					"render": function (data, type, full) {
						var button = '';
						button += '<button class="btn btn-primary btn-sm btnEdit mr-1 ';
						if (editcheck != 1) {
							button += 'd-none';
						}
						button += '" id="' + full['idtbl_row_material'] +
							'"><i class="fas fa-pen"></i></button>';
						if (full['status'] == 1) {
							button += '<a href="<?php echo base_url() ?>Rowmaterials/Rowmaterialsstatus/' +
								full['idtbl_row_material'] +
								'/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1 ';
							if (statuscheck != 1) {
								button += 'd-none';
							}
							button += '"><i class="fas fa-check"></i></a>';
						} else {
							button += '<a href="<?php echo base_url() ?>Rowmaterials/Rowmaterialsstatus/' +
								full['idtbl_row_material'] +
								'/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 ';
							if (statuscheck != 1) {
								button += 'd-none';
							}
							button += '"><i class="fas fa-times"></i></a>';
						}
						button += '<a href="<?php echo base_url() ?>Rowmaterials/Rowmaterialsstatus/' +
							full['idtbl_row_material'] +
							'/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm ';
						if (deletecheck != 1) {
							button += 'd-none';
						}
						button += '"><i class="fas fa-trash-alt"></i></a>';

						return button;
					}
				}
			],
			drawCallback: function (settings) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
		$('#tblmeasurment tbody').on('click', '.btnEdit', function () {
			var r = confirm("Are you sure, You want to Edit this ? ");
			if (r == true) {
				var id = $(this).attr('id');
				$.ajax({
					type: "POST",
					data: {
						recordID: id
					},
					url: '<?php echo base_url() ?>Rowmaterials/Rowmaterialsedit',
					success: function (result) { //alert(result);
						var obj = JSON.parse(result);
						$('#recordID').val(obj.id);
						$('#materialname').val(obj.materialname);
						$('#materialmaincategory').val(obj.maincat).trigger('change');;
						$('#supplier').val(obj.supplier).trigger('change');
						$('#measurment').val(obj.measurment).trigger('change');;
						$('#rol').val(obj.rol);
						$('#saleprice').val(obj.saleprice);
						$('#unitprice').val(obj.unitprice);

						$('#recordOption').val('2');
						$('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
					}
				});
			}
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
<?php include "include/footer.php"; ?>
