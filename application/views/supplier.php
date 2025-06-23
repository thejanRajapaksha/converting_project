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
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fas fa-users"></i></div>
                            <span>Supplier</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <form action="<?php echo base_url() ?>Supplier/Supplierinsertupdate" method="post"
                              enctype="multipart/form-data" autocomplete="off">

                            <div class="form-row">
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold">Registered Name of the Company*</label>
                                    <input type="text" class="form-control form-control-sm" name="supplier_name" id="supplier_name" required>
                                </div>
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold">Supplier Type*</label>
                                    <select class="form-control form-control-sm" name="suppliertype" id="suppliertype" required>
                                        <option value="">Select</option>
                                        <?php foreach ($Suppliercategory->result() as $rowsuppliercategory) { ?>
                                            <option value="<?php echo $rowsuppliercategory->idtbl_supplier_type ?>">
                                                <?php echo $rowsuppliercategory->type ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">VAT Registration No*</label>
                                    <input type="text" class="form-control form-control-sm" name="vatno" id="vatno">
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Telephone No*</label>
                                    <input type="number" class="form-control form-control-sm" name="telephoneno" id="telephoneno">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold">Company*</label>
                                    <input type="text" id="f_company_name" name="f_company_name"
                                           class="form-control form-control-sm" required readonly>
                                </div>
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold">Company Branch*</label>
                                    <input type="text" class="form-control form-control-sm" name="f_branch_name" id="f_branch_name">
                                </div>
                                <input type="hidden" name="f_company_id" id="f_company_id">
                                <input type="hidden" name="f_branch_id" id="f_branch_id">
                            </div>

                            <hr>

                            <div class="form-row">
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold"><b>Business Address*</b></label>
                                    <input type="text" class="form-control form-control-sm" name="line1" id="line1" placeholder="Address Line 1" required>
                                </div>
                                <div class="form-group col-md-3 mb-1">
                                    <label class="small font-weight-bold">&nbsp;</label>
                                    <input type="text" class="form-control form-control-sm" name="line2" id="line2" placeholder="Address Line 2" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">City*</label>
                                    <input type="text" class="form-control form-control-sm" name="city" id="city">
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">State*</label>
                                    <input type="text" class="form-control form-control-sm" name="state" id="state">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4 mb-1">
                                    <label class="small font-weight-bold">Business Status*</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bstatus" id="Proprietorship" value="Proprietorship">
                                        <label class="form-check-label" for="Proprietorship">Proprietorship</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bstatus" id="bstatusPartnership" value="Partnership">
                                        <label class="form-check-label" for="bstatusPartnership">Partnership</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="bstatus" id="bstatusIncorporation" value="Incorporation">
                                        <label class="form-check-label" for="bstatusIncorporation">Incorporation</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 mb-1">
                                    <label class="small font-weight-bold">Method of Payment*</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payementmethod" id="cashpayementmethod" value="Cash">
                                        <label class="form-check-label" for="cashpayementmethod">Cash</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payementmethod" id="bankpayementmethod" value="Bank">
                                        <label class="form-check-label" for="bankpayementmethod">Bank</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Credit Days*</label>
                                    <input type="text" class="form-control form-control-sm" name="credit_days" id="credit_days">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12 text-right mt-2">
                                    <button type="submit" id="submitBtn" class="btn btn-primary btn-sm px-5" <?php if($addcheck==0){echo 'disabled';} ?>>
                                        <i class="far fa-save"></i>&nbsp;Add Supplier
                                    </button>
                                </div>
                            </div>

                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                        </form>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap" id="tblsuppliertype" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Supplier Type</th>
                                                <th>Company Branch</th>
                                                <th>Address</th>
                                                <th>City</th>
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

        <!-- Modal Image View -->
        <div class="modal fade" id="modalimageview" data-backdrop="static" data-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div id="imagelist" class=""></div>
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
	$(document).ready(function () {
		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';

		$('#tblsuppliertype').DataTable({
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
					title: 'Supplier  Information',
					text: '<i class="fas fa-file-csv mr-2"></i> CSV',
				},
				{
					extend: 'pdf',
					className: 'btn btn-danger btn-sm',
					title: 'Supplier  Information',
					text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
				},
				{
					extend: 'print',
					title: 'Supplier  Information',
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
				url: "<?php echo base_url() ?>scripts/supplierlist.php",
				type: "POST", // you can use GET
			},
			"order": [
				[0, "desc"]
			],
			"columns": [{
					"data": "idtbl_supplier"
				},
				{
					"data": "suppliername"
				},
				{
					"data": "type"
				},
				{
					"data":  "branch"
				},
				{
					"data": null,
					"render": function(data, type, row) {
						return row.address_line1 + ', ' + row.address_line2;
					}
				},
				{
					"data": "city"
				},

				{
					"targets": -1,
					"className": 'text-right',
					"data": null,
					"render": function (data, type, full) {
						var button = '';
						button += '<a href="<?php echo base_url() ?>Supplierbank/index/' + full[
								'idtbl_supplier'] +
							'" target="_self" class="btn btn-secondary btn-sm mr-1"><i class="fas fa-file"></i></a>';

						button += '<button class="btn btn-primary btn-sm btnEdit mr-1 ';
						if (editcheck != 1) {
							button += 'd-none';
						}
						button += '" id="' + full['idtbl_supplier'] +
							'"><i class="fas fa-pen"></i></button>';
						if (full['status'] == 1) {
							button += '<a href="#" class="btn btn-success btn-sm mr-1 btnStatusToggle" data-id="' +
								full['idtbl_supplier'] +
								'" data-status="2" data-url="<?php echo base_url() ?>Supplier/Supplierstatus/' +
								full['idtbl_supplier'] + '/2" ';
							if (statuscheck != 1) {
								button += 'd-none';
							}
							button += '><i class="fas fa-check"></i></a>';
						} else {
							button += '<a href="#" class="btn btn-warning btn-sm mr-1 btnStatusToggle" data-id="' +
								full['idtbl_supplier'] +
								'" data-status="1" data-url="<?php echo base_url() ?>Supplier/Supplierstatus/' +
								full['idtbl_supplier'] + '/1" ';
							if (statuscheck != 1) {
								button += 'd-none';
							}
							button += '><i class="fas fa-times"></i></a>';
						}

						button += '<a href="#" class="btn btn-danger btn-sm btnDeleteSupplier" data-url="<?php echo base_url() ?>Supplier/Supplierstatus/' +
							full['idtbl_supplier'] +
							'/3" ';
						if (deletecheck != 1) {
							button += 'd-none';
						}
						button += '><i class="fas fa-trash-alt"></i></a>';

						return button;
					}
				}
			],
			drawCallback: function (settings) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
$('#tblsuppliertype tbody').on('click', '.btnEdit', function () {
    let id = $(this).attr('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to edit this record?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Edit it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url() ?>Supplier/Supplieredit',
                data: { recordID: id },
                success: function (result) {
                    var obj = JSON.parse(result);

                    $('#recordID').val(obj.id);
                    $('#supplier_name').val(obj.name);
                    $('#telephoneno').val(obj.telephoneno);
                    $('#f_branch_name').val(obj.company);
                    $('#line1').val(obj.line1);
                    $('#line2').val(obj.line2);
                    $('#city').val(obj.city);
                    $('#state').val(obj.state);
                    $('#credit_days').val(obj.credit_days);
                    $('#vatno').val(obj.vat_no);
                    $('#suppliertype').val(obj.type);

                    if (obj.payementmethod == "Cash") {
                        $('#cashpayementmethod').prop('checked', true);
                    } else if (obj.payementmethod == "Bank") {
                        $('#bankpayementmethod').prop('checked', true);
                    }

                    if (obj.business_status == "Proprietorship") {
                        $('#Proprietorship').prop('checked', true);
                    } else if (obj.business_status == "Partnership") {
                        $('#bstatusPartnership').prop('checked', true);
                    } else if (obj.business_status == "Incorporation") {
                        $('#bstatusIncorporation').prop('checked', true);
                    }

                    $('#recordOption').val('2');
                    $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');

                    Swal.fire(
                        'Loaded!',
                        'Record is ready to edit.',
                        'success'
                    );
                }
            });
        }
    });
});

	});

$(document).on('click', '.btnStatusToggle', function (e) {
	e.preventDefault();

	let url = $(this).data('url');
	let status = $(this).data('status');

	let actionText = status == 1 ? 'activate' : 'deactivate';
	let confirmButtonColor = status == 1 ? '#28a745' : '#dc3545';

	Swal.fire({
		title: `Are you sure?`,
		text: `You are about to ${actionText} this supplier.`,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: confirmButtonColor,
		cancelButtonColor: '#6c757d',
		confirmButtonText: `Yes, ${actionText} it!`
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
});


$(document).on('click', '.btnDeleteSupplier', function (e) {
	e.preventDefault();

	let url = $(this).data('url');

	Swal.fire({
		title: 'Are you sure?',
		text: "You want to remove this.",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d62020',
		confirmButtonText: 'Confirm!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.href = url;
		}
	});
});

</script>

<script>
	$(document).ready(function () {
		$('.zoom-image-link').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});
	});
</script>

<script>
	/** Variables */
	let files = [],
		dragArea = document.querySelector('.drag-area'),
		input = document.querySelector('.drag-area input'),
		button = document.querySelector('.card button'),
		select = document.querySelector('.drag-area .select'),
		container = document.querySelector('.container');

	/** CLICK LISTENER */
	// select.addEventListener('click', () => input.click());

	/* INPUT CHANGE EVENT */
	// input.addEventListener('change', () => {
	// 	let file = input.files;

	// 	// if user select no image
	// 	if (file.length == 0) return;

	// 	for (let i = 0; i < file.length; i++) {
	// 		if (file[i].type.split("/")[0] != 'image') continue;
	// 		if (!files.some(e => e.name == file[i].name)) files.push(file[i])
	// 	}

	// 	showImages();
	// });

	/** SHOW IMAGES */
	// function showImages() {
	// 	container.innerHTML = files.reduce((prev, curr, index) => {
	// 		return `${prev}
	// 	    <div class="image">
	// 		    <span onclick="delImage(${index})">&times;</span>
	// 		    <img src="${URL.createObjectURL(curr)}" />
	// 		</div>`
	// 	}, '');
	// }

	/* DELETE IMAGE */
	function delImage(index) {
		files.splice(index, 1);
		showImages();
	}

	/* DRAG & DROP */
	dragArea.addEventListener('dragover', e => {
		e.preventDefault()
		dragArea.classList.add('dragover')
	})

	/* DRAG LEAVE */
	dragArea.addEventListener('dragleave', e => {
		e.preventDefault()
		dragArea.classList.remove('dragover')
	});

	/* DROP EVENT */
	dragArea.addEventListener('drop', e => {
		e.preventDefault()
		dragArea.classList.remove('dragover');

		let file = e.dataTransfer.files;
		for (let i = 0; i < file.length; i++) {
			/** Check selected file is image */
			if (file[i].type.split("/")[0] != 'image') continue;

			if (!files.some(e => e.name == file[i].name)) files.push(file[i])
		}
		showImages();
	});
</script>
<!-- <script>
  // Get the form element
  const form = document.querySelector('form');

  // Add a submit event listener to the form
  form.addEventListener('submit', function(event) {
    // Get the certificates image field
    const certificatesInput = document.getElementById('certificates');

    // Check if the field is empty
    if (!certificatesInput.files.length) {
      // Prevent form submission
      event.preventDefault();

      // Show an alert message indicating the field is required
      alert('The VAT,NBT,SVAT certificates image field is required.');
    }
  });
</script> -->
