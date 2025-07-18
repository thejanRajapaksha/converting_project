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
                            <span>CRM Order</span>
                        </h1>
                    </div>
                </div>
            </div>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                 <!-- <div class="col-12 text-right">
					<button class="btn btn-primary btn-sm mb-3" id="directorder"><i class="fas fa-plus mr-2"></i>Add Direct Order</button>
			    </div> -->
                <table class="table table-bordered table-striped table-sm nowrap" id="dataTableAccepted" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Quotation Date</th>
                            <th>Due Date</th>
                            <th>Total</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
                        <form id="createorderform" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Item*</label>
                                    <select class="form-control form-control-sm" name="item" id="item" required>
                                        <option selected disabled>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Order Date*</label>
                                    <input type="date" class="form-control form-control-sm" name="order_date" id="order_date" required>
                                </div>
                                <div class="col">
                                    <label class="small font-weight-bold text-dark">Quantity*</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="" name="qty" id="qty" required>
                                </div>
                            </div>
                            <hr class="border-dark">
                            <div class="form-group mt-3 text-right">
                                    <button type="button" id="formsubmit" class="btn btn-primary btn-sm px-5">
                                        <i class="far fa-save"></i>&nbsp;Add to list
                                    </button>
                                <input name="submitBtn" type="submit" value="Save" id="submitBtn" class="d-none">
                                <input type="hidden" id="recordOption" value="1">
                                <input type="hidden" id="inquiryid" value="">
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-9">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-striped table-bordered table-sm small" id="tableorder">
                                <thead>
                                    <tr>
                                        <!-- <th>Cloth</th>
                                        <th>Material</th>
                                        <th>Size</th> -->
                                        <th>Item</th>
                                        <th>Date</th>
                                        <!-- <th>Unitprice</th> -->
                                        <th class="d-none">Order details ID</th>
                                        <th class="text-right">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label class="small font-weight-bold text-dark">Remark</label>
                            <textarea name="remark" id="remark" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <!-- <h1 class="font-weight-600" id="divtotal">Rs. 0.00</h1> -->
                            </div>
                            <input type="hidden" id="hidetotalorder" value="0">
                            <input type="hidden" id="sumdis" value="0">
                        </div>
                        <hr>
                        
                        <div class="form-group mt-2">
                            <button type="button" id="btncreateorder" class="btn btn-outline-primary btn-sm fa-pull-right"><i class="fas fa-save"></i>&nbsp;Create Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="Paymentmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="PaymentmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PaymentmodalLabel">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="paymentform" autocomplete="off" enctype="multipart/form-data">
                            <div class="form-row mb-3">
                                <div class="col-md-6">
                                    <label for="bank" class="small font-weight-bold text-dark">Bank Name*</label>
                                    <select class="form-control form-control-sm" name="bank" id="bank">
                                        <option value="">Select</option>
                                        <!-- Add bank options here -->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="paymenttype" class="small font-weight-bold text-dark">Payment type*</label>
                                    <select class="form-control form-control-sm" name="paymenttype" id="paymenttype" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-md-6">
                                    <label for="advance" class="small font-weight-bold text-dark">Advance Rs.*</label>
                                    <input type="number" class="form-control form-control-sm" placeholder="" name="advance" id="advance" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pdate" class="small font-weight-bold text-dark">Date*</label>
                                    <input type="date" class="form-control form-control-sm" name="pdate" id="pdate" required>
                                </div>
                            </div>
                            <hr class="border-dark">
                            <div class="form-group text-right">
                                    <button type="button" id="payformsubmit" class="btn btn-primary btn-sm px-5" <?php if ($addcheck == 0) { echo 'disabled'; } ?>>
                                        <i class="far fa-save"></i>&nbsp;Save details
                                    </button>
                                <input type="hidden" id="recordOption" value="1">
                                <input type="hidden" id="inquiryid" value="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="orderdet" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="orderdetLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderdetLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <div class="scrollbar" id="style-2" style="max-height: 60vh; overflow-y: auto;">
                    <table class="table table-striped table-bordered table-sm small w-100" id="orderdetailtable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
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
    $(document).ready(function() {
  
		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';

        $('#dataTableAccepted').DataTable({
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
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Order detail Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Order detail Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Order detail Information',
                    className: 'btn btn-primary btn-sm', 
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    customize: function (win) {
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }, 
                },
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/qutationAccList.php",
                type: "POST",
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
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        button += '<button class="btn btn-primary btn-sm btnview mr-1" data-toggle="modal"  data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Order details"><i class="fas fa-eye"></i></button>';
                        button += '<button class="btn btn-success btn-sm btnquotation mr-1" data-toggle="modal" data-target="#staticBackdrop" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Create Order"><i class="fas fa-list"></i></button>';
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

    $(document).on('click', '.btnquotation', function() {
    var customerId = $(this).data('customer'); 

    if (customerId) {
        $.ajax({
            url: '<?= base_url("CRMOrderdetail/getItemsByCustomer") ?>', 
            type: 'POST',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function (response) {
                $('#item').html('<option selected disabled>Select</option>'); 

                if (response.length > 0) {
                    $.each(response, function (index, product) {
                        $('#item').append('<option value="' + product.idtbl_product + '">' + product.product + '</option>');
                    });
                } else {
                    $('#item').append('<option disabled>No items available</option>');
                }
            }
        });
    } else {
        $('#item').html('<option selected disabled>Select</option>'); 
    }
});


        $('#dataTableAccepted').on('click', '.btnquotation', function() {
            var qid = $(this).data('qid');
            var id = $(this).data('id');
            $('#inquiryid').val(id);

            $('#staticBackdrop').modal('show');
        });

        $('#dataTableAccepted').on('click', '.btnpayment', function() {
            var qid = $(this).data('qid');
            var id = $(this).data('id');
            $('#inquiryid').val(id);
        });


        $('#dataTableAccepted').on('click', '.btnview', function () {
            var id = $(this).data('id');
            $('#inquiryid').val(id);

            $.ajax({
                url: "<?php echo base_url() ?>CRMOrderdetail/Getorderdetails",
                type: 'POST',
                data: { inquiryid: id },
                dataType: 'json',
                success: function (data) {
                    var tableBody = $('#orderdetailtable tbody');
                    tableBody.empty();

                    if (data.length > 0) {
                        data.forEach(function (orderDetail) {
                            var row = '<tr>' +
                                '<td>' + orderDetail.product + '</td>' +
                                '<td>' + orderDetail.quantity + '</td>' +
                                '<td>' + orderDetail.order_date + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });

                        $('#orderdet').modal('show'); 
                    } else {
                        alert('No order details found for this inquiry.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error(error);
                    alert('Failed to load order details. Please try again later.');
                }
            });
        });


        $(document).on('input', '.cutting-qty', function() {
            var $row = $(this).closest('tr');
            var quantity = parseInt($row.find('td').eq(3).text());
            var cuttingQty = parseInt($(this).val());
            var balance = cuttingQty - quantity;
            $row.find('.balance').text((balance >= 0 ? '+' : '') + balance);
        });

        $("#bank").select2({  
            dropdownParent: $('#Paymentmodal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMOrderdetail/Getbankname",
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
        $("#paymenttype").select2({  
            dropdownParent: $('#Paymentmodal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMOrderdetail/Getpaymenttype",
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

        $('#payformsubmit').click(function() { 
            var formData = {
                bank: $('#bank').val(),
                paymenttype: $('#paymenttype').val(),
                advance: $('#advance').val(),
                pdate: $('#pdate').val(),
                inquiryid: $('#inquiryid').val(),
                recordOption: $('#recordOption').val()
            };

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() ?>CRMOrderdetail/PaymentDetailInsertUpdate",
                data: formData,
                dataType: 'json',
                encode: true,
                success: function(data) {
                    // console.log(data);
                    window.location.reload();
                }
            });
        });

        $("#materialtype").select2({
            dropdownParent: $('#staticBackdrop'),
            placeholder: "Select material type",
            allowClear: true
        });

        $("#clothtype").on('change', function() {
            var clothtypeId = $(this).val();
            if (clothtypeId) {
                $("#materialtype").prop("disabled", false);
                $("#materialtype").select2({
                    dropdownParent: $('#staticBackdrop'),
                    ajax: {
                        url: "<?php echo base_url() ?>CRMOrderdetail/Getmaterialtype",
                        type: "post",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                inquiryid: $('#inquiryid').val(),
                                clothtypeId: clothtypeId,
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

                $.ajax({
                    url: "<?php echo base_url() ?>CRMOrderdetail/GetQuantity",
                    type: "post",
                    data: {
                        inquiryid: $('#inquiryid').val(),
                        clothtypeId: clothtypeId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.quantity) {
                            $('#quantity').val(response.quantity);
                        } else {
                            $('#quantity').val('');
                            alert('Failed to fetch quantity');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#quantity').val('');
                        alert('Error in fetching quantity');
                    }
                });
            } else {
                $("#materialtype").prop("disabled", true);
                $("#materialtype").val(null).trigger('change');
            }
        });

    });

    $("#formsubmit").click(function() {
        if (!$("#createorderform")[0].checkValidity()) {
            // If the form is invalid, submit it. The form won't actually submit;
            // this will just cause the browser to display the native HTML5 error messages.
            $("#submitBtn").click();
        } else {
            // var clothTypeID = $('#clothtype').val();
            // var materialTypeID = $('#materialtype').val();
            // var sizeTypeID = $('#sizetype').val();
            // var clothType = $("#clothtype option:selected").text();
            // var materialType = $("#materialtype option:selected").text();
            // var sizeType = $("#sizetype option:selected").text();
            var recordOption = $('#recordOption').val();
            var itemId = $('#item').val();
            var item = $("#item option:selected").text();
            var orderDate = $('#order_date').val();
            var qty = parseFloat($('#qty').val());
            var description = $('#remark').val();

            // $('.selecter2').select2();

            $('#tableorder > tbody:last').append(
                '<tr class="pointer">' +
                '<td class="d-none">' + recordOption + '</td>' +
                '<td class="d-none">' + itemId + '</td>' +
                '<td>' + item + '</td>' +
                '<td>' + orderDate + '</td>' +
                '<td>' + qty + '</td>' +
                '<td class="d-none total">' + qty + '</td>' + 
                '</tr>'
            );

            $('#item').val('').trigger('change');
            $('#order_date').val('').trigger('change');
            $('#qty').val('');
            $('#remark').val(''); 

            // var sum = 0;
            // $(".total").each(function() {
            //     sum += parseFloat($(this).text());
            // });
        }
    });

    $('#btncreateorder').click(function() {
        $('#btncreateorder').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Creating Order');

        var tbody = $("#tableorder tbody");
        var formData = new FormData();

        if (tbody.children().length > 0) {
            var jsonObj = [];
            $("#tableorder tbody tr").each(function() {
                item = {}
				$(this).find('td').each(function(col_idx) {
					item["col_" + (col_idx + 1)] = $(this).text();
				});
				jsonObj.push(item);
            });

           // console.log(jsonObj);
            var recordOption = $('#recordOption').val();
            var itemId = $('#item').val();
            var date = $('#order_date').val();
            var qty = parseFloat($('#qty').val());
            var inquiryid = $('#inquiryid').val();
            var quotationid = $('#quotationid').val();

            formData.append('tableData', JSON.stringify(jsonObj)); 
            formData.append('recordOption', recordOption);
            formData.append('itemId', itemId);
            formData.append('date', date);
            formData.append('qty', qty);
            formData.append('inquiryid', inquiryid);
            formData.append('quotationid', quotationid);

            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                url: '<?php echo base_url() ?>CRMOrderdetail/Orderdetailinsertupdate',
                success: function(result) {
                    var obj = result;//JSON.parse(result);
                    $('#staticBackdrop').modal('hide');
                    $('#btncreateorder').prop('disabled', false).html('<i class="fas fa-save mr-2"></i> Create Order');
                    if (obj.status == 1) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                    action(obj);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    $('#btncreateorder').prop('disabled', false).html('Create Order');
                }
            });
        }
    });

    // direct order formsubmit
    $("#formsubmitdirectorder").click(function() {
        if (!$("#createdirectorderform")[0].checkValidity()) {
            $("#submitBtn").click();
        } else {
            var custId = $('#customer').val();
            var customer = $("#customer option:selected").text();
            var itemId = $('#d_item').val();
            var item = $("#d_item option:selected").text();
            var orderDate = $('#d_order_date').val();
            var qty = parseFloat($('#d_qty').val());
            var description = $('#remark').val();

            $('#tabledirectorder > tbody:last').append(
                '<tr class="pointer">' +
                '<td class="d-none">' + custId + '</td>' +
                '<td>' + customer + '</td>' +
                '<td class="d-none">' + itemId + '</td>' +
                '<td>' + item + '</td>' +
                '<td>' + orderDate + '</td>' +
                '<td>' + qty + '</td>' +
                '<td class="d-none total">' + qty + '</td>' + 
                '</tr>'
            );

            $('#d_item option:selected').text('').trigger('change');
            $('#d_item').val('').trigger('change');
            $('#d_order_date').val('').trigger('change');
            $('#d_qty').val('');
            $('#remark').val(''); 
        }
    });

    $('#btncreatedirectorder').click(function() {
        $('#btncreatedirectorder').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Creating Order');

        var tbody = $("#tabledirectorder tbody");
        var formData = new FormData();

        if (tbody.children().length > 0) {
            var jsonObj = [];
            $("#tabledirectorder tbody tr").each(function() {
                item = {}
				$(this).find('td').each(function(col_idx) {
					item["col_" + (col_idx + 1)] = $(this).text();
				});
				jsonObj.push(item);
            });

            // console.log(jsonObj);
            var custId =$('#customer').val();
            var itemId = $('#d_item').val();
            var date = $('#d_order_date').val();
            var qty = parseFloat($('#d_qty').val());
            var inquiryid = $('#inquiryid').val();
            var quotationid = $('#quotationid').val();

            formData.append('tableData', JSON.stringify(jsonObj)); 
            formData.append('itemId', itemId);
            formData.append('date', date);
            formData.append('qty', qty);
            formData.append('inquiryid', inquiryid);
            formData.append('quotationid', quotationid);

            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                url: '<?php echo base_url() ?>CRMOrderdetail/Orderdetailinsertupdate',
                success: function(result) {
                    var obj = result;//JSON.parse(result);
                    $('#staticBackdrop').modal('hide');
                    $('#btncreatedirectorder').prop('disabled', false).html('<i class="fas fa-save mr-2"></i> Create Order');
                    if (obj.status == 1) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                    action(obj);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + error);
                    $('#btncreatedirectorder').prop('disabled', false).html('Create Order');
                }
            });
        }
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