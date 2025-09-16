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
                            <div class="page-header-icon"><i class="fas fa-truck"></i></div>
                            <span>Good Receive Note</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#staticBackdrop" onclick="getVat();"
                                    <?php if($addcheck==0){echo 'disabled';} ?>><i class="fas fa-plus mr-2"></i>Create
                                    Good Receive Note</button>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>GRN No</th>
                                                <th>GRN Date</th>
                                                <th>GRN Type</th>
                                                <th>Batch No</th>
                                                <th>Supplier</th>
                                                <th>Total</th>
                                                <th>Porder No</th>
                                                <th>Approved Status</th>
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
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Good Receive Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <form id="createorderform" autocomplete="off">
                            <div class="form-row mb-1">
                                <div class="col-6">
                                    <label class="small font-weight-bold text-dark">Order Date*</label>
                                    <input type="date" class="form-control form-control-sm" placeholder=""
                                        name="grndate" id="grndate" onchange="getVat();"
                                        value="<?php echo date('Y-m-d') ?>" required>
                                </div>
                                <div class="col-6">
                                    <label class="small font-weight-bold text-dark">Purchase Order*</label>
                                    <select class="form-control form-control-sm selecter2 px-0" name="porder"
                                        id="porder" required>
                                        <option value="">Select</option>
                                        <?php foreach($porderlist->result() as $rowporderlist){ ?>
                                        <option value="<?php echo $rowporderlist->idtbl_print_porder  ?>">
                                            <?php echo $rowporderlist->porder_no ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-1">
                            <div class="col-6">
                                    <label class="small font-weight-bold text-dark">Supplier*</label>
                                    <select class="form-control form-control-sm selecter2 px-0" name="supplier"
                                        id="supplier" required readonly>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="small font-weight-bold text-dark">GRN Type*</label>
                                    <select class="form-control form-control-sm" name="grntype" id="grntype" required>
                                        <option value="">Select</option>
                                        <?php foreach($ordertypelist->result() as $rowordertypelist){ ?>
                                        <option value="<?php echo $rowordertypelist->idtbl_order_type ?>">
                                            <?php echo $rowordertypelist->type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark d-none">Company*</label>
                                <input type="text" id="f_company_name" name="f_company_name"
                                    class="form-control form-control-sm d-none" required readonly>
                            </div>

                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark d-none">Company Branch*</label>
                                <input type="text" id="f_branch_name" name="f_branch_name"
                                    class="form-control form-control-sm d-none" required readonly>
                            </div>
                            <input type="hidden" name="f_company_id" id="f_company_id">
                            <input type="hidden" name="f_branch_id" id="f_branch_id">

                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark">Location*</label>
                                <select class="form-control form-control-sm" name="location" id="location" required>
                                    <option value="">Select</option>
                                    <?php foreach($locationlist->result() as $rowlocationlist){ ?>
                                    <option value="<?php echo $rowlocationlist->idtbl_location ?>">
                                        <?php echo $rowlocationlist->location ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Product*</label>
                                    <select class="form-control form-control-sm selecter2 px-0" name="product"
                                        id="product" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Qty*</label>
                                    <label class="small font-weight-bold text-danger" id="qtylabel"></label>
                                    <input type="text" id="newqty" name="newqty" class="form-control form-control-sm"
                                        <?php if($editcheck==0){echo 'readonly';} ?> required >
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark" hidden>MF Date*</label>
                                    <input type="date" id="mfdate" name="mfdate" class="form-control form-control-sm"
                                        value="<?php echo date('Y-m-d') ?>" required hidden>
                                </div>
                            </div>

                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">UOM*</label>
                                    <select class="form-control form-control-sm" style="pointer-events: none;"
                                        name="uom" id="uom" readonly>
                                        <option value="">Select</option>
                                        <?php foreach($measurelist->result() as $rowmeasurelist){ ?>
                                        <option value="<?php echo $rowmeasurelist->idtbl_mesurements ?>">
                                            <?php echo $rowmeasurelist->measure_type ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
            						<label class="small font-weight-bold text-dark">Pieces (Sheets)</label>
            						<input type="text" id="piecesper_qty" name="piecesper_qty"
            							class="form-control form-control-sm" value="0" readonly>
            					</div>
                            </div>

                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Unit Price</label>
                                    <input type="text" id="unitprice" name="unitprice"
                                        class="form-control form-control-sm"
                                        <?php if($editcheck==0){echo 'readonly';} ?> value="0">
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Discount</label>
                                    <input type="text" id="unitdiscount" name="unitdiscount"
                                        class="form-control form-control-sm"
                                        <?php if($editcheck==0){echo 'readonly';} ?> value="0">
                                </div>
                            </div>

                            <input type="hidden" id="porderdetailsid" name="porderdetailsid"
                            class="form-control form-control-sm" />
                            
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark">Comment</label>
                                <textarea name="comment" id="comment" class="form-control form-control-sm"
                                    <?php if($editcheck==0){echo 'readonly';} ?>></textarea>
                            </div>
                            <div class="form-group mb-1">
                                <label class="small font-weight-bold text-dark">Batch No</label>
                                <input type="text" id="batchno" name="batchno" class="form-control form-control-sm"
                                    required readonly>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                <label class="small font-weight-bold text-dark">Vat Type*</label>
                                <select class="form-control form-control-sm" name="vat_type" id="vat_type" required>
                                    <option value="">Select Vat Type</option>
                                    <option value="1">Inclusive</option>
                                    <option value="2" selected>Exclusive</option>
                                </select>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Invoice No*</label>
                                    <input type="text" id="invoice" name="invoice" class="form-control form-control-sm"
                                        required>
                                </div>
                            </div>
                            <div class="form-group mb-1">

                            </div>
                            <div class="form-group mt-3 text-right">
                                <button type="button" id="formsubmit" class="btn btn-warning btn-sm font-weight-bold px-4"
                                    <?php if($addcheck==0){echo 'disabled';} ?>><i class="fas fa-plus"></i>&nbsp;Add to
                                    list</button>
                                <input name="submitBtn" type="submit" value="Save" id="submitBtn" class="d-none">
                            </div>
                            <input type="hidden" name="refillprice" id="refillprice" value="">
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                        <div class="scrollbar pb-3" id="style-3">
                            <table class="table table-striped table-bordered table-sm small" id="tableorder">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Comment</th>
                                        <th class="d-none">ProductID</th>
                                        <th>Unitprice</th>
                                        <th class="d-none">Saleprice</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Uom</th>
                                        <th>Price</th>
                                        <th class="d-none">HideTotal</th>
                                        <th class="text-right">Discount</th>
                                        <th class="text-right">Total</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col text-right">
                                <h4 class="font-weight-600" id="divtotal">Rs. 0.00</h4>
                            </div>
                            <input type="hidden" id="hidetotalorder" value="0">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <label class="small font-weight-bold text-dark">Discount*</label>
                                <input type="text" class="form-control form-control-sm" id="discount" value="0"
                                    onkeyup="finaltotalcalculate();" required>
                            </div>
                            <div class="col-6">
                                <label class="small font-weight-bold text-dark">Sub Total </label>
                                <input type="number" step="any" name="hiddenfulltotal"
                                    class="form-control form-control-sm" id="hiddenfulltotal" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label class="small font-weight-bold text-dark">Vat (%)*</label>
                                <input type="number" id="vat" name="vat" class="form-control form-control-sm" value="0"
                                    onkeyup="finaltotalcalculate();" required>
                            </div>
                            <div class="col-3">
                                                <label class="small font-weight-bold text-dark">Vat Amount*</label>
                                                <input type="number" id="vatamount" name="vatamount"
                                                    class="form-control form-control-sm" value="0" required readonly>
                                            </div>

                            <div class="col-6">
                                <label class="small font-weight-bold text-dark"><b>Total Payment</b></label>
                                <input type="number" step="any" name="modeltotalpayment"
                                    class="form-control form-control-sm small font-weight-bold text-dark"
                                    id="modeltotalpayment" readonly>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label class="small font-weight-bold text-dark">Remark</label>
                            <textarea name="remark" id="remark" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="button" id="btncreateorder"
                                class="btn btn-primary btn-sm fa-pull-right"><i
                                    class="fas fa-save"></i>&nbsp;Create
                                Good Receive Note</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Good Recieve Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="GRNView">

                <div id="viewhtml"></div>

            </div>
            <div class="modal-footer">
                <div class="col-12 text-right">
                    <hr>
                        <?php if($approvecheck==1){ ?>
                        <button id="btnapprovereject" class="btn btn-primary btn-sm px-3"><i class="fas fa-check mr-2"></i>Approve or Reject</button>
                        <?php } ?>
                    <input type="hidden" name="grnid" id="grnid">
                </div>
                <div class="col-12 text-center">
                    <div id="alertdiv"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footerscripts.php"; ?>

<script>

$(document).ready(function() {

        $('#f_company_id').val('<?php echo ($_SESSION['company_id']); ?>');
        $('#f_company_name').val('<?php echo ($_SESSION['companyname']); ?>');
        $('#f_branch_id').val('<?php echo ($_SESSION['branch_id']); ?>');
        $('#f_branch_name').val('<?php echo ($_SESSION['branchname']); ?>');
});
</script>

<script>
$(document).ready(function() {
    $('#printgrn').click(function() {
        printJS({
            printable: 'GRNView',
            type: 'html',
            css: 'assets/css/styles.css'
        });
    });
});

$(document).ready(function() {

    $('#supplier').select2({
        dropdownParent: $('#staticBackdrop'),
        width: '100%',
    });
    $('#porder').select2({
        dropdownParent: $('#staticBackdrop'),
        width: '100%',
    });
    $('#product').select2({
        dropdownParent: $('#staticBackdrop'),
        width: '100%',
    });

    var addcheck = '<?php echo $addcheck; ?>';
    var editcheck = '<?php echo $editcheck; ?>';
    var statuscheck = '<?php echo $statuscheck; ?>';
    var deletecheck = '<?php echo $deletecheck; ?>';

    $('#dataTable').DataTable({
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
                title: 'Good Receive Note Information',
                text: '<i class="fas fa-file-csv mr-2"></i> CSV',
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger btn-sm',
                title: 'Good Receive Note Information',
                text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
            },
            {
                extend: 'print',
                title: 'Good Receive Note Information',
                className: 'btn btn-primary btn-sm',
                text: '<i class="fas fa-print mr-2"></i> Print',
                customize: function(win) {
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                },
            },
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: "<?php echo base_url() ?>scripts/goodreceivelist.php",
            type: "POST", // you can use GET
            "data": function(d) {
                return $.extend({}, d, {
                    "company_id": '<?php echo ($_SESSION['company_id']); ?>',
                });
            }
        },
        "order": [
            [0, "desc"]
        ],
        "columns": [
             {
            	"data": "grn_no"
            },
            {
                "data": "grndate"
            },
            {
                "data": "type"
            },
            {
                "data": "batchno"
            },
            {
                "data": "suppliername"
            },
            {
                "targets": -1,
                "className": 'text-right',
                "data": null,
                "render": function(data, type, full) {
                    return addCommas(parseFloat(full['total']).toFixed(2));
                }
            },
            {
                "data": "porder_no"
            },
                        {
                "targets": -1,
                "className": '',
                "data": "approvestatus_display",
                "render": function(data, type, row) {
                    return data;
                }
            }, 
            {
                "targets": -1,
                "className": 'text-right',
                "data": null,
                "render": function(data, type, full) {
                    var button = '';
                    button += '<a href="<?php echo base_url() ?>Goodreceive/pdfgrnget/' +
                        full['idtbl_print_grn'] +
                        '" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Print GRN" class="btn btn-secondary btn-sm mr-1 ';
                    if (editcheck != 1) {
                        button += 'd-none';
                    }
                    button += '"><i class="fas fa-file-pdf mr-2"></i></a>';


                    button += '<button data-toggle="tooltip" data-placement="bottom" title="View GRN" class="btn btn-dark btn-sm btnview mr-1" id="' + full[
                        'idtbl_print_grn'] + '" aproval_id="' + full[
                            'approvestatus'] + '" grn_no="' + full[
                            'grn_no'] + '"><i class="fas fa-eye"></i></button>';

                    return button;
                }
            }
        ],
        drawCallback: function(settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    $('#dataTable tbody').on('click', '.btnview', function() {
        var id = $(this).attr('id');
        var grnno = $(this).attr('grn_no');
        $('#grncode').html(grnno);
        $('#grnid').val(id);

        var approvestatus = $(this).attr('aproval_id');

        $.ajax({
            type: "POST",
            data: {
                recordID: id
            },
            url: '<?php echo base_url() ?>Goodreceive/Goodreceiveview',
            success: function(result) { //alert(result);
                $('#viewmodal').modal('show');
                $('#viewhtml').html(result.html);
                $('#viewcompanyname').text(result.details.companyname);
                $('#viewbranchname').text(result.details.branchname);
                if(approvestatus>0){
                    $('#btnapprovereject').addClass('d-none').prop('disabled', true);
                    if(approvestatus==1){$('#alertdiv').html('<div class="alert alert-success" role="alert"><i class="fas fa-check-circle mr-2"></i> GRN approved</div>');}
                    else if(approvestatus==2){$('#alertdiv').html('<div class="alert alert-danger" role="alert"><i class="fas fa-times-circle mr-2"></i> GRN rejected</div>');}
                }
            }
        });
    });
    $('#viewModel').on('hidden.bs.modal', function (event) {
        $('#alertdiv').html('');
        $('#btnapprovereject').removeClass('d-none').prop('disabled', false);
    });

    $('#btnapprovereject').click(function(){
        Swal.fire({
            title: "Do you want to approve this Good Receive Note?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Approve",
            denyButtonText: `Reject`
        }).then((result) => {
            if (result.isConfirmed) {
                var confirmnot = 1;
                approvejob(confirmnot);
            } else if (result.isDenied) {
                var confirmnot = 2;
                approvejob(confirmnot);
            } 
        });
    });

    $("#formsubmit").click(function() {
        if (!$("#createorderform")[0].checkValidity()) {
            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            $("#submitBtn").click();
        } else {
            var productID = $('#product').val();
            var comment = $('#comment').val();
            var product = $("#product option:selected").text();
            var unitprice = parseFloat($('#unitprice').val());
            var newqty = parseFloat($('#newqty').val());
            var pieces = parseFloat($('#piecesper_qty').val());
            var discount = $('#unitdiscount').val();
            var uomID = $('#uom').val();
            var uom = $("#uom option:selected").text();
            var expdate = $('#expdate').val();
            var porderdetailsid = parseFloat($('#porderdetailsid').val());

            var newtotal;
            var newprice;console.log(pieces);
            if (pieces !== 0) {
                newtotal = (unitprice * pieces) - discount;
                newprice = (unitprice * pieces / newqty)  - discount;
            } else {
                newtotal = (unitprice * newqty) - discount;
                newprice = 0;
            }

            var total = parseFloat(newtotal);
            var showtotal = addCommas(parseFloat(total).toFixed(2));

            $('#tableorder > tbody:last').append('<tr class="pointer"><td>' + product + '</td><td>' +
                comment + '</td><td class="d-none">' + productID +
                '</td><td class="text-center">' + unitprice + '</td><td class="text-center">' +
                newqty +
                '</td><td class="text-center">' + uom +
                '</td><td class="text-center">' + parseFloat(newprice).toFixed(2) +
                '</td><td class="text-center">' + discount + '</td><td class="d-none">' + uomID +
                '</td><td class="total d-none">' + total + '</td><td class="text-right">' +
                showtotal +
                '</td><td name="inquerydetailsid" class="d-none">' + porderdetailsid +
                    '</td><td name="inquerydetailsid" class="d-none">' + pieces +
                    '</td><td><button type="button" onclick= "productDelete(this);" id="btnDeleterow" class=" btn btn-danger btn-sm float-right"><i class="fas fa-trash-alt"></i></button></td> </tr>'
            );

            $('#product').val('');
            $('#unitprice').val('0');
            $('#uom').val('');
            $('#comment').val('');
            $('#unitdiscount').val('');
            $('#newqty').val('');
            $('#piecesper_qty').val('');
            $('#qtylabel').text('0');
            $('#porder').prop('readonly', true).css('pointer-events', 'none');


            var sum = 0;
            $(".total").each(function() {
                sum += parseFloat($(this).text());
            });

            var showsum = addCommas(parseFloat(sum).toFixed(2));

            $('#divtotal').html('<strong style="background-color: yellow;"> Rs. <strong>' + showsum);

            $('#hidetotalorder').val(sum);
            $('#product').focus();
        }

        finaltotalcalculate();

    });

    $(document).on("keyup", "#discount", function(event) {
        var checkdiscount = parseFloat($("#discount").val());
        if (!checkdiscount == "") {
            finaltotalcalculate();
        } else {

        }

    });

    $(document).on("keyup", "#vat", function(event) {
        var checkvat = parseFloat($("#vat").val());
        if (!checkvat == "") {
            finaltotalcalculate();
        } else {

        }

    });


    $('#tableorder').on('click', 'tr', function () {
    	var r = confirm("Are you sure you want to remove this product?");
    	if (r == true) {
    		$(this).closest('tr').remove();
            $('#piecesper_qty').val('0');

    		var sum = 0;
    		$(".total").each(function () {
    			sum += parseFloat($(this).text());
    		});

    		var showsum = addCommas(parseFloat(sum).toFixed(2));

    		$('#divtotal').html('Rs. ' + showsum);
    		$('#hidetotalorder').val(sum);

    		finaltotalcalculate();
    		$('#product').focus();
    	}
    });


    $('#tblcost').on('click', 'tr', function() {
        var r = confirm("Are you sure, You want to remove this cost? ");
        if (r == true) {
            $(this).closest('tr').remove();

            var sum = 0;
            $(".totalamount").each(function() {
                sum += parseFloat($(this).text());
            });

            var showsum = addCommas(parseFloat(sum).toFixed(2));

            $('#labelcosttotal').html('Rs. ' + showsum);
            $('#totalcost').val(sum);
        }
    });

    $('#btncreateorder').click(function() { //alert('IN');
        $('#btncreateorder').prop('disabled', true).html(
            '<i class="fas fa-circle-notch fa-spin mr-2"></i> Create Good Receive Note')
        var tbody = $("#tableorder tbody");

        if (tbody.children().length > 0) {
            jsonObj = [];
            $("#tableorder tbody tr").each(function() {
                item = {}
                $(this).find('td').each(function(col_idx) {
                    item["col_" + (col_idx + 1)] = $(this).text();
                });
                jsonObj.push(item);
            });
            // console.log(jsonObj);

            var grndate = $('#grndate').val();
            var remark = $('#remark').val();
            var total = $('#modeltotalpayment').val();
            var vatamount = $('#vatamount').val();
            var location = $('#location').val();
            var porder = $('#porder').val();
            var batchno = $('#batchno').val();
            var supplier = $('#supplier').val();
            var invoice = $('#invoice').val();
            var vat_type = $('#vat_type').val();
            var grntype = $('#grntype').val();
            var discount = $('#discount').val();
            var vat = $('#vat').val();
            var subtotal = $('#hiddenfulltotal').val();
            var branch_id = $('#f_branch_id').val();
        	var company_id = $('#f_company_id').val();

            Swal.fire({
    		title: "",
    		html: '<div class="div-spinner"><div class="custom-loader"></div></div>',
    		allowOutsideClick: false,
    		showConfirmButton: false,
    		backdrop: "rgba(255, 255, 255, 0.5)",
    		customClass: {
    			popup: "fullscreen-swal"
    		},
    		didOpen: () => {
    			document.body.style.overflow = "hidden";

                $.ajax({
                    type: "POST",
                    data: {
                        tableData: jsonObj,
                        grndate: grndate,
                        total: total,
                        remark: remark,
                        vatamount: vatamount,
                        location: location,
                        porder: porder,
                        invoice: invoice,
                        subtotal: subtotal,
                        batchno: batchno,
                        supplier: supplier,
                        grntype: grntype,
                        discount: discount,
                        vat: vat,
                        company_id: company_id,
                        branch_id: branch_id,
                        vat_type: vat_type
                    },
                    url: 'Goodreceive/Goodreceiveinsertupdate',
    				success: function (result) {
    					Swal.close();
    					document.body.style.overflow = "auto";

    					var response = JSON.parse(result);
    					if (response.status == 1) {
    						Swal.fire({
    							icon: "success",
    							title: "Order Created!",
    							text: "Good Receive Note created successfully!",
    							timer: 2000,
    							showConfirmButton: false
    						}).then(() => {
    							window.location.reload();
    						});
    					} else {
    						Swal.fire({
    							icon: "error",
    							title: "Error",
    							text: "Something went wrong. Please try again later.",
    						});
    					}
    				},
    				error: function () {
    					Swal.close();
    					document.body.style.overflow = "auto";
    					Swal.fire({
    						icon: "error",
    						title: "Error",
    						text: "Something went wrong. Please try again later.",
    					});
    				}
    			});
    		},
    	});
        }

    });

    var tempsupplier;
    var tempgrntype;
    $('#porder').change(function() {
        var porderID = $(this).val();

        $.ajax({
            type: "POST",
            data: {
                recordID: porderID
            },
            url: 'Goodreceive/Getcompanyaccoporder',
            success: function(result) { //alert(result);
                $('#company_id').val(result).css('pointer-events', 'none');
            }
        });

        $.ajax({
            type: "POST",
            data: {
                recordID: porderID
            },
            url: 'Goodreceive/Getbranchaccoporder',
            success: function(result) { //alert(result);
                $('#branch_id').val(result).css('pointer-events', 'none');
            }
        });


        function getSupplier() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: porderID
                    },
                    url: 'Goodreceive/Getsupplieraccoporder',
                    success: function(result) {
                        $('#supplier').val(result).css('pointer-events', 'none');

                        tempsupplier = result;
                        resolve();
                    },
                    error: reject
                });
            });
        }

        function getGrntype() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    type: "POST",
                    data: {
                        recordID: porderID
                    },
                    url: 'Goodreceive/Getpordertpeaccoporder',
                    success: function(result) {
                        $('#grntype').val(result).css('pointer-events', 'none');

                        tempgrntype = result;
                        getitems(porderID, result);
                        resolve();
                    },
                    error: reject
                });
            });
        }


        getSupplier()
            .then(getGrntype)
            .then(function() {

                getbatchno(tempsupplier, tempgrntype);
            })
            .catch(function(error) {
                console.error("An error occurred:", error);
            });

    });

    $('#porder').change(function () {
    	var porderID = $(this).val();

    	$.ajax({
    		type: "POST",
    		data: {
    			recordID: porderID
    		},
    		url: 'Goodreceive/Getsupplier',
    		success: function (result) {
    			$('#supplier').empty();

    			if (result) {
    				var data = JSON.parse(result);
    				if (data.id) {
    					$('#supplier').append('<option value="' + data.id + '">' + data.name + '</option>');
    				}
    			}
    		},
    	});
    });

    function getbatchno(supplierID, typeID) {

        $.ajax({
            type: "POST",
            data: {
                recordID: supplierID
            },
            url: 'Goodreceive/Getbatchnoaccosupplier',
            success: function(result) {
                // alert(result);
                $('#batchno').val(result);
            }
        });
    }

    function getitems(porderID, grntype) {
        if (grntype == 4) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: porderID
                },
                url: 'Goodreceive/Getproductformachine',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var html1 = '';
                    html1 += '<option value="">Select</option>';
                    $.each(obj, function(i, item) {
                        html1 += '<option value="' + obj[i]
                            .idtbl_machine + '">';
                        html1 += obj[i].machine;
                        html1 += '</option>';
                    });
                    $('#product').empty().append(html1);
                }
            });
        } else if (grntype == 3) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: porderID
                },
                url: 'Goodreceive/Getproductaccoporder',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var html1 = '';
                    html1 += '<option value="">Select</option>';
                    $.each(obj, function(i, item) {
                        html1 += '<option value="' + obj[i]
                            .idtbl_print_material_info +
                            '">';
                        html1 += obj[i].materialname + ' / ' + obj[i]
                            .materialinfocode;
                        html1 += '</option>';
                    });
                    $('#product').empty().append(html1);
                }
            });
        } else if (grntype == 1) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: porderID
                },
                url: 'Goodreceive/Getproductforsparepart',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var html1 = '';
                    html1 += '<option value="">Select</option>';
                    $.each(obj, function(i, item) {
                        html1 += '<option value="' + obj[i]
                            .id +
                            '">';
                        html1 += obj[i].name;
                        html1 += '</option>';
                    });
                    $('#product').empty().append(html1);
                }
            });
        }
    };

    $('#product').change(function() {
        var productID = $(this).val();
        var grntype = tempgrntype;
        var grn_id = $('#porder').val();

        console.log(productID, grntype);

        if (grntype == 3) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: productID,
                    grn_id: grn_id
                },
                url: 'Goodreceive/Getproductinfoaccoproduct',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var newqty = (obj.qty) - (obj.actual_qty);
                    $('#newqty').val(newqty);
                    $('#qtylabel').html(newqty);
                    $('#uom').val(obj.uom);
                    $('#unitprice').val(obj.unitprice);
                    $('#piecesper_qty').val(obj.pieces);
                    $('#comment').val(obj.comment);
                    $('#porderdetailsid').val(obj.detailsid);
                }
            });
        } else if (grntype == 4) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: productID,
                    grn_id: grn_id
                },
                url: 'Goodreceive/Getproductinfoamachine',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var newqty = (obj.qty) - (obj.actual_qty);
                    $('#newqty').val(newqty);
                    $('#qtylabel').html(newqty);
                    $('#uom').val(obj.uom);
                    $('#unitprice').val(obj.unitprice);
                    $('#comment').val(obj.comment);
                    $('#porderdetailsid').val(obj.detailsid);
                }
            });
        } else if (grntype == 1) {
            $.ajax({
                type: "POST",
                data: {
                    recordID: productID,
                    grn_id: grn_id
                },
                url: 'Goodreceive/Getproductinfosparepart',
                success: function(result) { //alert(result);
                    var obj = JSON.parse(result);
                    var newqty = (obj.qty) - (obj.actual_qty);
                    $('#newqty').val(newqty);
                    $('#qtylabel').html(newqty);
                    $('#uom').val(obj.uom);
                    $('#unitprice').val(obj.unitprice);
                    $('#comment').val(obj.comment);
                    $('#porderdetailsid').val(obj.detailsid);
                }
            });
        }
    });

    $('#dataTable tbody').on('click', '.btnLabel', function() {
        var id = $(this).attr('id');
        $('#lablemodal').modal('show');

        $.ajax({
            type: "POST",
            data: {
                recordID: id
            },
            url: '<?php echo base_url() ?>Goodreceive/Getmateriallistaccogrn',
            success: function(result) { //alert(result);
                var obj = JSON.parse(result);
                var html1 = '';
                html1 += '<option value="">Select</option>';
                $.each(obj, function(i, item) {
                    html1 += '<option value="' + obj[i]
                        .idtbl_print_material_info +
                        '">';
                    html1 += obj[i].materialname + ' / ' + obj[i]
                        .materialinfocode;
                    html1 += '</option>';
                });
                $('#materiallist').empty().append(html1);
            }
        });
    });

    $('#btncreatelable').click(function() {
        if (!$("#formlable")[0].checkValidity()) {
            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            $("#hidesubmitbtn").click();
        } else {
            let mname = $('#mname').val();
            let mcode = $('#mcode').val();
            let grnno = $('#grnno').val();
            let pono = $('#pono').val();
            let mfdate = $('#lmfdate').val();
            let expdate = $('#lexpdate').val();
            let batchno = $('#lbatchno').val();

            var link = '<?php echo base_url() ?>Goodreceive/Createlabel/' + mname + '/' +
                mcode + '/' +
                grnno + '/' + pono + '/' + mfdate + '/' + expdate + '/' + batchno;
            window.open(link, '_blank');
            $('#hideresetbtn').click();
            $('#lablemodal').modal('hide');
        }
    });
});

function deactive_confirm() {
    return confirm("Are you sure you want to deactive this?");
}

function active_confirm() {
    return confirm("Are you sure you want to approve this good receive note?");
}

function delete_confirm() {
    return confirm("Are you sure you want to reject this good receive note?");
}

function finaltotalcalculate() {
    var vat = parseFloat($("#vat").val()) || 0;
    var discount = parseFloat($("#discount").val()) || 0;
    var total = parseFloat($("#hidetotalorder").val()) || 0;
    var vatType = $("#vat_type").val();

    if (isNaN(discount)) {
        discount = 0;
        $("#discount").val(0);
    }

    if (isNaN(vat)) {
        vat = 0;
        $("#vat").val(0);
    }

    var subTotal = total - discount;
    $('#hiddenfulltotal').val(subTotal.toFixed(2));

    var vatAmount = 0;
    var finalTotal;

    if (vatType === "1") { 
        vatAmount = (subTotal * vat) / 100;
        $('#vatamount').val(vatAmount.toFixed(2));
        finalTotal = subTotal + vatAmount;
    } else { 
        $('#vatamount').val("0.00");
        finalTotal = subTotal;
    }

    $('#modeltotalpayment').val(finalTotal.toFixed(2));
}



function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
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
<script>
function getVat() {
    var currentDate = $('#grndate').val();

    $.ajax({
        type: "POST",
        data: {
            currentDate: currentDate,
        },
        url: 'Goodreceive/Getvatpresentage',
        success: function(result) { //alert(result);
            var obj = JSON.parse(result);

            $('#vat').val(obj);
        }
    });
}
function approvejob(confirmnot){
    Swal.fire({
        title: '',
        html: '<div class="div-spinner"><div class="custom-loader"></div></div>',
        allowOutsideClick: false,
        showConfirmButton: false, // Hide the OK button
        backdrop: `
            rgba(255, 255, 255, 0.5) 
        `,
        customClass: {
            popup: 'fullscreen-swal'
        },
        didOpen: () => {
            document.body.style.overflow = 'hidden';

            $.ajax({
                type: "POST",
                data: {
                    grnid: $('#grnid').val(),
                    confirmnot: confirmnot
                },
                url: '<?php echo base_url() ?>Goodreceive/Approvestatus',
                success: function(result) {
                    Swal.close();
                    document.body.style.overflow = 'auto';
                    var obj = JSON.parse(result);
                    if(obj.status==1){
                        window.location.reload();
                    }
                    else{
                        action(obj.action);
                    }
                },
                error: function(error) {
                    // Close the SweetAlert on error
                    Swal.close();
                    document.body.style.overflow = 'auto';
                    
                    // Show an error alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.'
                    });
                }
            });
        }
    });
}
</script>
<?php include "include/footer.php"; ?>