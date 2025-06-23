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
                            <span>Supplier Bank</span>
                        </h1>
                    </div>
                </div>
            </div>
        	<div class="container-fluid mt-2 p-0 p-2">
        		<div class="card">
        			<div class="card-body p-0 p-2">
        				<div class="row">
        					<div class="col-9">
        						<form action="<?php echo base_url()?>Supplierbank/Supplierbankinsertupdate" method="post" autocomplete="off">
        							<div class="row">
        								<div class="col-3">
        									<div class="form-group mb-1">
        										<label class="small font-weight-bold">Bank Name*</label>
        										<input type="text" class="form-control form-control-sm" name="bank"
        											id="bank" required>
        									</div>
        								</div>
        								<div class="col-3">
        									<div class="form-group mb-1">
        										<label class="small font-weight-bold">Branch*</label>
        										<input type="text" class="form-control form-control-sm" name="branch"
        											id="branch" required>
        									</div>
        								</div>
        								<div class="col-3">
        									<div class="form-group mb-1">
        										<label class="small font-weight-bold">Account No*</label>
        										<input type="text" class="form-control form-control-sm" name="accno"
        											id="accno" required>
        									</div>
        								</div>
        								<div class="col-3">
        									<div class="form-group mb-1">
        										<label class="small font-weight-bold">Name*</label>
        										<input type="text" class="form-control form-control-sm" name="accname"
        											id="accname" required>
        									</div>
        								</div>
        							</div>
        							<div class="row">
        								<div class="col-12">
        									<div class="form-group mt-2 text-right">
        										<button type="submit" id="submitBtn"
        											class="btn btn-primary btn-sm px-4"><i
        												class="far fa-save"></i>&nbsp;Add</button>
        									</div>
        								</div>
        							</div>
        							<input type="hidden" name="recordOption" id="recordOption" value="1">
        							<input type="hidden" name="recordID" id="recordID" value="">
									<input type="hidden" name="supplierid" id="supplierid" value="<?php echo $supplier_id; ?>">
        						</form>
								<input type="hidden" name="hiddenid" id="hiddenid" value="<?php echo $supplier_id; ?>">
        						<hr style="border: 1px solid black;">
        						<div class="row">
        							<div class="col-12">
        								<div class="scrollbar pb-3" id="style-2">
        									<table class="table table-bordered table-striped table-sm nowrap" id="tblsupplierbank">
        										<thead>
        											<tr>
        												<th>#</th>
        												<th>Bank</th>
        												<th>Branch</th>
        												<th>Account No</th>
        												<th>Name</th>
        												<th class="text-right">Actions</th>
        											</tr>
        										</thead>
        									</table>
											<div class="col-3">
											<div class="card">
									<div class="card-body p-0 p-2">
										<a href="<?php echo base_url(); ?>Supplierbank/index/<?php echo isset($result['Supplierbankdetails']) ?>"
											class="btn font-weight-bold">
											<i class="fas fa-paper-plane"></i>&nbsp; Bank Details
										</a>
										<hr>
										<a href="<?php echo base_url(); ?>Suppliercontact/index/<?php echo isset($result['Suppliercontactdetails']) ?>"
											class="btn font-weight-bold">
											<i class="fas fa-paper-plane"></i>&nbsp; Contact Details
										</a>
									</div>
								</div>

        								</div>
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
    $(document).ready(function() {

        $('#tblsupplierbank').DataTable({
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
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Supplier Bank Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Supplier Bank Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Supplier Bank Information',
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
                url: "<?php echo base_url() ?>scripts/supplierbanklist.php",
                type: "POST", // you can use GET
                 data: function ( d ) {
                 return $.extend( {}, d, {
                 "supplier": $("#hiddenid").val()
         } );
       }
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_supplier_bank_details"
                },
                {
                    "data": "bank_name"
                },
				{
                    "data": "branch"
                },
				{
                    "data": "account_no"
                },
				{
                    "data": "account_name"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button='';
						button+='<button class="btn btn-primary btn-sm btnEdit mr-1" id="'+full['idtbl_supplier_bank_details']+'"><i class="fas fa-pen"></i></button>';
                        if(full['status']==1){
                            button+='<a href="<?php echo base_url() ?>Supplierbank/Supplierbankstatus/'+full['idtbl_supplier_bank_details']+'/'+full['tbl_supplier_idtbl_supplier']+'/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1 "><i class="fas fa-check"></i></a>';
                        }else{
                            button+='<a href="<?php echo base_url() ?>Supplierbank/Supplierbankstatus/'+full['idtbl_supplier_bank_details']+'/'+full['tbl_supplier_idtbl_supplier']+'/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1"><i class="fas fa-times"></i></a>';
                        }
                        button+='<a href="<?php echo base_url() ?>Supplierbank/Supplierbankstatus/'+full['idtbl_supplier_bank_details']+'/'+full['tbl_supplier_idtbl_supplier']+'/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';
                        
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('#tblsupplierbank tbody').on('click', '.btnEdit', function() {
            var r = confirm("Are you sure, You want to Edit this ? ");
            if (r == true) {
                var id = $(this).attr('id');
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: id
                    },
                    url: '<?php echo base_url() ?>Supplierbank/Supplierbankedit',
                    success: function(result) { //alert(result);
                        var obj = JSON.parse(result);
                        $('#recordID').val(obj.id);
                        $('#bank').val(obj.name); 
                        $('#branch').val(obj.branch); 
						$('#accno').val(obj.account_no); 
						$('#accname').val(obj.account_name); 

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
