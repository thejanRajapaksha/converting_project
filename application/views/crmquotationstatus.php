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
					<div class="page-header-icon"><i class="fas fa-shopping-basket"></i></div>
					<span>Quotation Status</span>
				</h1>
			</div>
		</div>
	</div>
	<div class="container-fluid mt-2 p-0 p-2">
		<div class="card">
			<!-- Boostrap Tabs Start -->
			<nav>
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Approved</a><!-- GM Approved -->
					<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rejected</a>
					<!-- <a class="nav-item nav-link" id="nav-contact1-tab" data-toggle="tab" href="#nav-contact1" role="tab" aria-controls="nav-contact1" aria-selected="false">Rejected</a> -->
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<div class="card-body p-0 p-2">
						<div class="row">
							<!-- <div class="col-12 text-right">
								<button class="btn btn-primary btn-sm mb-3" id="addnewrequest"><i class="fas fa-plus mr-2"></i>Add New Request</button>
							</div> -->
							<div class="col-12">
								<div class="scrollbar pb-3" id="style-2">
									<table class="table table-bordered table-striped table-sm nowrap" id="dataTablePending">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Quotation Date</th>
												<th>Due Date</th>
												<th>Total</th>
												<th>Remarks</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<div class="card-body p-0 p-2">
						<div class="row">
							<div class="col-12">
								<div class="scrollbar pb-3" id="style-2">
									<table class="table table-bordered table-striped table-sm nowrap w-100" id="dataTableapproved">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Quotation Date</th>
												<th>Due Date</th>
												<th>Total</th>
												<th>Remarks</th>
												<!-- <th class="text-right">Actions</th> -->
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="card-body p-0 p-2">
						<div class="row">
							<div class="col-12">
								<div class="scrollbar pb-3" id="style-2">
									<table class="table table-bordered table-striped table-sm nowrap w-100" id="dataTableRejected">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Quotation Date</th>
												<th>Due Date</th>
												<th>Total</th>
												<th>Remarks</th>
												<th>Reason</th>
												<th>Additional Reason</th>
												<!-- <th class="text-right">Actions</th> -->
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

				

				<!-- <div class="tab-pane fade" id="nav-contact1" role="tabpanel" aria-labelledby="nav-contact1-tab">
					<div class="card-body p-0 p-2">
						<div class="row">
							<div class="col-12">
								<div class="scrollbar pb-3" id="style-2">
									<table class="table table-bordered table-striped table-sm nowrap w-100" id="dataTableRejected">
										<thead>
											<tr>
												<th>#</th>
												<th>Customer</th>
												<th>Quotation Date</th>
												<th>Due Date</th>
												<th>Total</th>
												<th>Discount</th>
												<th>NetTotal</th>
												<th>Delivery Charge</th>
												<th>Remarks</th>
												<th>Reason</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
			<!-- Boostrap Tabs End -->
		</div>
	</div>

	<!-- Disapproval Modal -->
<div class="modal fade" id="disapprovalModal" tabindex="-1" role="dialog" aria-labelledby="disapprovalModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="disapprovalModalLabel">Disapprove Quotation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="disapprovalForm">
                    <div class="form-group mb-1">
                        <label for="disapprovalReason">Reason for Disapproval</label>
                        <select class="form-control form-control-sm" id="disapprovalReason" required>
                            <option value="">Select </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="additionalReason">Additional Comments</label>
                        <textarea class="form-control" id="additionalReason" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger" value="2">Submit</button>
                </form>
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
    $(document).ready(function() {
		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';

        $('#dataTablePending').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "buttons": [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Supplier detail Information',
                    className: 'btn btn-primary btn-sm', 
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }, 
                },
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/qutationPenList.php",
                type: "POST", // you can use GET
                // data: function(d) {}
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
                    "data": "quot_date"
                },
                {
                    "data": "duedate"
                },
                {
                    "data": "total"
                },
                {
                    "data": "remarks"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        return `
                            <button class="btn btn-success approvebtn" data-id="${full.idtbl_quotation}" value="1">Approve Quotation</button>
                            <button class="btn btn-danger approvebtnelse" data-id="${full.idtbl_quotation}" value="2">Disapprove Quotation</button>
                        `;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        $('#dataTableapproved').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "buttons": [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Supplier detail Information',
                    className: 'btn btn-primary btn-sm', 
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }, 
                },
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/qutationAccList.php",
                type: "POST", // you can use GET
                // data: function(d) {}
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
                    "data": "quot_date"
                },
                {
                    "data": "duedate"
                },
                {
                    "data": "total"
                },
                {
                    "data": "remarks"
                },
                // {
                //     "targets": -1,
                //     "className": 'text-right',
                //     "data": null,
                //     "render": function(data, type, full) {
                //         var button='';
                //         button+='<button class="btn btn-primary btn-sm btnCreate mr-1 ';if(editcheck!=1){button+='d-none';}button+='" id="'+full['idtbl_quotation']+'"><i class="fas fa-list"></i></button>';
                //         if(full['status']==1){
                //             button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-check"></i></a>';
                //         }else{
                //             button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-times"></i></a>';
                //         }
                //         button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm ';if(deletecheck!=1){button+='d-none';}button+='"><i class="fas fa-trash-alt"></i></a>';
                        
                //         return button;
                //     }
                // }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        $('#dataTableRejected').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "buttons": [
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Rejected Inquiry Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Rejected Inquiry Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Rejected Inquiry Information',
                    className: 'btn btn-primary btn-sm', 
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function ( win ) {
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }, 
                },
                // 'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/qutationRejList.php",
                type: "POST", // you can use GET
                // data: function(d) {}
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
                    "data": "quot_date"
                },
                {
                    "data": "duedate"
                },
                {
                    "data": "total"
                },
                {
                    "data": "remarks"
                },
                {
                    "data": "type"
                },
                {
                    "data": "reject_resone"
                },
                // {
                //     "targets": -1,
                //     "className": 'text-right',
                //     "data": null,
                //     "render": function(data, type, full) {
                //         var button='';
                //         button+='<button class="btn btn-primary btn-sm btnEdit mr-1 ';if(editcheck!=1){button+='d-none';}button+='" id="'+full['idtbl_quotation']+'"><i class="fas fa-pen"></i></button>';
                //         if(full['status']==1){
                //             button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-check"></i></a>';
                //         }else{
                //             button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-times"></i></a>';
                //         }
                //         button+='<a href="<?php echo base_url() ?>Rejectedinquiry/Rejectedinquirystatus/'+full['idtbl_quotation']+'/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm ';if(deletecheck!=1){button+='d-none';}button+='"><i class="fas fa-trash-alt"></i></a>';
                        
                //         return button;
                //     }
                // }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        

        // $('#dataTable tbody').on('click', '.btnEdit', function() {
        //     var r = confirm("Are you sure, You want to Edit this ? ");
        //     if (r == true) {
        //         var id = $(this).attr('id');
        //         $.ajax({
        //             type: "POST",
        //             data: {
        //                 recordID: id
        //             },
        //             url: '<?php echo base_url() ?>Rejectedinquiry/Rejectedinquiryedit',
        //             success: function(result) { //alert(result);
        //                 var obj = JSON.parse(result);
        //                 $('#recordID').val(obj.id);
        //                 $('#tbl_reason_idtbl_reason').val(obj.tbl_reason_idtbl_reason); 
        //                 $('#tbl_quotation_idtbl_quotation').val(obj.tbl_quotation_idtbl_quotation);                       
        //                 $('#remarks').val(obj.remarks);                      

        //                 $('#recordOption').val('2');
        //                 $('#submitBtn').html('<i class="far fa-save"></i>&nbsp;Update');
        //             }
        //         });
        //     }
        // });
    });


    $("#disapprovalReason").select2({
			dropdownParent: $('#disapprovalModal'),
			ajax: {
				url: "<?php echo base_url() ?>CRMQuotationform/Getreasontype",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});

		$(document).ready(function() {
			// Event handler for approve buttons
			$('#dataTablePending').on('click', '.approvebtn', function() {
				var recordID = $(this).data('id');
				var type = $(this).val();

				var confirmationMessage = type == 2 ? "Are you sure, You want to disapprove this?" : "Are you sure, You want to approve this?";
				var r = confirm(confirmationMessage);

				if (r == true) {
					$.ajax({
						type: "POST",
						data: {
							recordID: recordID,
							type: type,
						},
						url: '<?php echo base_url() ?>CRMQuotationform/Quotationformapprovestatus',
						success: function(result) {
							var obj = JSON.parse(result);
							if (obj.status == 1) {
								setTimeout(function() {
									window.location.reload();
								}, 700);
							}
							action(obj.action);
						}
					});
				}
			});

			$('#dataTablePending').on('click', '.approvebtnelse', function() {
                var recordID = $(this).data('id');
                $('#disapprovalForm').data('id', recordID);
				$('#disapprovalModal').modal('show');
			});

			// Event handler for reject buttons
			$('#disapprovalForm').on('submit', function(event) {
				event.preventDefault(); // Prevent default form submission

				var recordID = $(this).data('id');
				var reasonID = $('#disapprovalReason').val(); // Get the value from the select input
				var reasonAdd = $('#additionalReason').val(); // Get the value from the textarea
				var type = $(this).find('button[type="submit"]').val();

				var confirmationMessage = type == 2 ? "Are you sure, You want to disapprove this?" : "Are you sure, You want to approve this?";
				var r = confirm(confirmationMessage);

				if (r == true) {
					$.ajax({
						type: "POST",
						data: {
							recordID: recordID,
							type: type,
							reasonID: reasonID,
							reasonAdd: reasonAdd,
						},
						url: '<?php echo base_url() ?>CRMQuotationform/Quotationformapprovestatus',
						success: function(result) {
							var obj = JSON.parse(result);
							if (obj.status == 1) {
								setTimeout(function() {
									// window.location.reload();
								}, 700);
							}
							action(obj.action);
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

    function action(data) { //alert(data);
		var obj = JSON.parse(data);
		$.notify({
			// options
			icon: obj.icon,
			title: obj.title,
			message: obj.message,
			url: obj.url,
			target: obj.target
		}, {
			// settings
			element: 'body',
			position: null,
			type: obj.type,
			allow_dismiss: true,
			newest_on_top: false,
			showProgressbar: false,
			placement: {
				from: "top",
				align: "center"
			},
			offset: 100,
			spacing: 10,
			z_index: 1031,
			delay: 5000,
			timer: 1000,
			url_target: '_blank',
			mouse_over: null,
			animate: {
				enter: 'animated fadeInDown',
				exit: 'animated fadeOutUp'
			},
			onShow: null,
			onShown: null,
			onClose: null,
			onClosed: null,
			icon_type: 'class',
			template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
				'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
				'<span data-notify="icon"></span> ' +
				'<span data-notify="title">{1}</span> ' +
				'<span data-notify="message">{2}</span>' +
				'<div class="progress" data-notify="progressbar">' +
				'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
				'</div>' +
				'<a href="{3}" target="{4}" data-notify="url"></a>' +
				'</div>'
		});
	}
</script>
