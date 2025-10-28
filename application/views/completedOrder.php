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
                <h1 class="page-header-title font-weight-bold text-dark">
                    <div class="page-header-icon"><i class="fas fa-quote-left"></i></div>
                    <span>Completed Orders</span>
                </h1>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                <table class="table table-bordered table-striped table-sm nowrap" id="dataTableAccepted" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Quotation Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Completed date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header text-dark">
        <h5 class="modal-title" id="transferModalLabel">Transfer to Finished Goods</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <form id="transferForm">
        <div class="modal-body">
          <input type="hidden" id="orderId" name="orderId">
          <input type="hidden" id="orderQty" name="orderQty">

          <div class="form-group">
            <label for="location">Select Location <span class="text-danger">*</span></label>
            <select class="form-control" id="location" name="location" required>
                    <option value="">Select</option>
                                        <?php foreach ($locationdetails->result() as $location) { ?>
                                            <option value="<?php echo $location->idtbl_location ?>">
                                                <?php echo $location->name ?>
                                            </option>
                                        <?php } ?>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-warning"><i class="fas fa-exchange-alt mr-1"></i> Transfer</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Integrated Detail Modal with Tabs -->
<div class="modal fade" id="integratedDetailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="integratedDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="integratedDetailModalLabel">Order and Material Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="detailsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="summary-tab" data-toggle="tab" href="#summaryDetails" role="tab" aria-controls="summaryDetails" aria-selected="true">Summary Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="order-tab" data-toggle="tab" href="#orderDetails" role="tab" aria-controls="orderDetails" aria-selected="false">Order Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="material-tab" data-toggle="tab" href="#materialDetails" role="tab" aria-controls="materialDetails" aria-selected="false">Material Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="receive-tab" data-toggle="tab" href="#receiveDetails" role="tab" aria-controls="receiveDetails" aria-selected="false">Received Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivery-tab" data-toggle="tab" href="#deliveryPackagingDetails" role="tab" aria-controls="deliveryPackagingDetails" aria-selected="false">Delivery & Packaging</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="payment-tab" data-toggle="tab" href="#paymentDetails" role="tab" aria-controls="paymentDetails" aria-selected="false">Payment Details</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content mt-4">
                    <!-- Summary Details Tab -->
                    <div class="tab-pane fade show active" id="summaryDetails" role="tabpanel" aria-labelledby="summary-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm small" id="summarytable">
                                <thead>
                                    <tr>
                                        <th nowrap>Customer</th>
                                        <th nowrap>Payment Type</th>
                                        <th nowrap>Bank Name</th>
                                        <th nowrap>Advance</th>
                                        <th nowrap>Cloth Images</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Order Details Tab -->
                    <div class="tab-pane fade" id="orderDetails" role="tabpanel" aria-labelledby="order-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm small" id="orderdetailtable">
                                <thead>
                                    <tr>
                                        <th nowrap>Cloth</th>
                                        <th nowrap>Material</th>
                                        <th nowrap>Size</th>
                                        <th nowrap>Qty</th>
                                        <th nowrap>Cutting Qty</th>
                                        <th nowrap>Balance</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Material Details Tab -->
                    <div class="tab-pane fade" id="materialDetails" role="tabpanel" aria-labelledby="material-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm small" id="materialdetailtable">
                                <thead>
                                    <tr>
                                        <th nowrap>Material Type</th>
                                        <th nowrap>Order Date</th>
                                        <th nowrap>Quantity (Kg)</th>
                                        <th nowrap>Balance Quantity(Kg)</th>
                                        <th nowrap>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Received Details Tab -->
                    <div class="tab-pane fade" id="receiveDetails" role="tabpanel" aria-labelledby="receive-tab">
                        <div class="table-responsive">
                            <h6>Received Order Details</h6>
                            <table class="table table-striped table-bordered table-sm small" id="receivedetailsinfotable">
                                <thead>
                                    <tr>
                                        <th nowrap>Cloth Type</th>
                                        <th nowrap>Design Type</th>
                                        <th nowrap>Printing Company</th>
                                        <th nowrap>Sewing Company</th>
                                        <th nowrap>Received Quantity</th>
                                        <th nowrap>Received Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <h6>Received Color/Cuff Details</h6>
                            <table class="table table-striped table-bordered table-sm small" id="receivedcolorcuff">
                                <thead>
                                    <tr>
                                        <th nowrap>Color/Cuff</th>
                                        <th nowrap>Company Name</th>
                                        <th nowrap>Received Quantity</th>
                                        <th nowrap>Received Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Delivery and Packaging Details Tab -->
                    <div class="tab-pane fade" id="deliveryPackagingDetails" role="tabpanel" aria-labelledby="delivery-tab">
                        <div class="table-responsive">
                            <h6>Delivery Details</h6>
                            <table class="table table-striped table-bordered table-sm small" id="deliverydetailtable">
                                <thead>
                                    <tr>
                                        <th>Cloth Type</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <h6>Packaging Details</h6>
                            <table class="table table-striped table-bordered table-sm small" id="packagingdetailtable">
                                <thead>
                                    <tr>
                                        <th>Cloth Type</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Payment Details Tab -->
                    <div class="tab-pane fade" id="paymentDetails" role="tabpanel" aria-labelledby="payment-tab">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm small" id="paymentdetailtable">
                                <thead>
                                    <tr>
                                        <th nowrap>Payment Type</th>
                                        <th nowrap>Amount</th>
                                        <th nowrap>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div> <!-- End of Tab content -->
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
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Completed Orders Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Completed Orders Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Completed Orders Information',
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
                url: "<?php echo base_url() ?>scripts/completedorderlist.php",
                type: "POST",
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_order"
                },
                {
                    "data": "name"
                },
                {
                    "data": "quot_date"
                },
                {
                    "data": "product"
                },
                {
                    "data": "quantity"
                },
                {
                    "data": "completed_date"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        button += '<button class="btn btn-primary btn-sm btnview mr-1" data-toggle="modal" data-target="#integratedDetailModal" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Payment details view"><i class="fas fa-eye"></i></button>';
                        // button += '<button class="btn btn-success btn-sm btnquotation mr-1" data-toggle="modal" data-target="#Materialmodal" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Create Order"><i class="fas fa-list"></i></button>';
                        // button += '<button class="btn btn-dark btn-sm btnpayment mr-1" data-toggle="modal" data-target="#Materialmodal" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Payment details"><i class="fas fa-credit-card"></i></button>';
                        button += '<button class="btn btn-warning btn-sm btntransfer" data-toggle="modal" data-target="#transferModal" data-orderid="' + full['idtbl_order'] + '" data-quantity="' + full['quantity'] + '" title="Transfer to Finished Goods"><i class="fas fa-exchange-alt"></i></button>';
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

        $('#dataTableAccepted').on('click', '.btnquotation', function() {
            var qid = $(this).data('qid');
            var id = $(this).data('id');
            $('#inquiryid').val(id);
        });

        $('#dataTableAccepted').on('click', '.btntransfer', function() {
            let orderId = $(this).data('orderid');
            let quantity = $(this).data('quantity');

            $('#orderId').val(orderId);
            $('#orderQty').val(quantity);
        });

        $('#transferForm').on('submit', function(e) {
            e.preventDefault();

            let orderId = $('#orderId').val();
            let location = $('#location').val();
            let transferQty = $('#orderQty').val();

            if (!location) {
                alert('Please select a valid location.');
                return;
            }

            $.ajax({
                url: "<?php echo base_url() ?>CRMCompletedorder/transferToFinishedGoods",
                type: "POST",
                data: {
                    orderId: orderId,
                    location: location,
                    transferQty: transferQty 
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#transferModal').modal('hide');
                        $('#dataTableAccepted').DataTable().ajax.reload();
                        action(JSON.stringify({
                            type: "success",
                            title: "Transfer Successful",
                            message: "Order transferred to finished goods successfully",
                            icon: "fas fa-check"
                        }));
                    } else {
                        alert(response.message || "Transfer failed. Try again.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert("An error occurred during transfer.");
                }
            });
        });

        $('#dataTableAccepted').on('click', '.btnview', function() {
            var id = $(this).data('id');
            var customerid = $(this).data('customer');
            $('#inquiryid').val(id);
            $('#customerid').val(customerid);

            // Fetch Summary Details
            $.ajax({
                url: "<?php echo base_url() ?>CRMCompletedorder/loadSummaryDetails",
                type: 'POST',
                data: { inquiryid: id, customerid: customerid },
                dataType: 'json',
                success: function(data) {
                    let summaryRows = ''; 
                    let tableBody = $('#summarytable tbody');
                    tableBody.empty();  

                    if (data.length > 0) {
                        data.forEach(function(item) {
                            var row = '<tr>' +
                                        '<td>' + item.customer_name + '</td>' +
                                        '<td>' + item.payment_type + '</td>' +
                                        '<td>' + item.bank_name + '</td>' +
                                        '<td>' + item.advance + '</td>' +
                                        // '<td><img src="' + item.product_image + '" alt="Product Image" style="width:250px;height:200px;"></td>' +
                                    '</tr>';
                            summaryRows += row;
                        });

                        tableBody.html(summaryRows);

                        $('#summaryModal').modal('show');
                    } else {
                        alert('No summary details found for this inquiry.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to load summary details. Please try again later.');
                }
            });

            // Fetch Order Details
            // $.ajax({
            //     url: "<?php echo base_url() ?>Orderdetail/Getorderdetails",
            //     type: 'POST',
            //     data: { inquiryid: id },
            //     dataType: 'json',
            //     success: function(data) {
            //         var tableBody = $('#orderdetailtable tbody');
            //         tableBody.empty();
            //         $('#commonFields').remove();

            //         if (data.length > 0) {
            //             var commonFields = '<div id="commonFields">' +
            //                             '<div><strong>Payment Type:</strong> ' + data[0].p_type + '</div>' +
            //                             '<div><strong>Advance &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong> ' + data[0].advance + '</div>';
            //             if (data[0].bname) {
            //                 commonFields += '<div><strong>Bank Name &nbsp&nbsp&nbsp&nbsp:</strong>&nbsp;  ' + data[0].bname + '</div>';
            //             }

            //             commonFields += '</div>';
            //             $('#orderdet .modal-body').prepend(commonFields);
            //             data.forEach(function(orderDetail) {
            //                 var balance = orderDetail.cutting_qty - orderDetail.quantity;
            //                 var row = '<tr>' +
            //                         '<td>' + orderDetail.cloth_type + '</td>' +
            //                         '<td>' + orderDetail.material_type + '</td>' +
            //                         '<td>' + orderDetail.size + '</td>' +
            //                         '<td>' + orderDetail.quantity + '</td>' +
            //                         '<td>' + orderDetail.cutting_qty +'</td>' +
            //                         '<td class="balance">' + (balance >= 0 ? '+' : '') + balance + '</td>' + 
            //                         '</tr>';
            //                 tableBody.append(row);
            //             });

            //             $('#orderdet').modal('show');
            //         } else {
            //             alert('No order details found for this inquiry.');
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error(error);
            //         alert('Failed to load order details. Please try again later.');
            //     }
            // });

            // Fetch Material Details
            // $.ajax({
            //     url: "<?php echo base_url() ?>Materialdetail/Getmaterialdetails",
            //     type: 'POST',
            //     data: { inquiryid: id },
            //     dataType: 'json',
            //     success: function(data) {
            //         var tableBody = $('#materialdetailtable tbody');
            //         tableBody.empty();
            //         $('#commonFields').remove();

            //         if (data.length > 0) {
            //             data.forEach(function(materialDetail) {
            //                 var row = '<tr>' +
            //                         '<td>' + materialDetail.type + '</td>' +
            //                         '<td>' + materialDetail.mat_odate + '</td>' +
            //                         '<td>' + materialDetail.mat_quantity + '</td>' +
            //                         '<td>' + materialDetail.mat_balance + '</td>' +
            //                         '<td>' + materialDetail.mat_remarks + '</td>' +
            //                         '</tr>';
            //                 tableBody.append(row);
            //             });

            //             $('#materialdetail').modal('show');
            //         } else {
            //             alert('No material details found for this inquiry.');
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error(error);
            //         alert('Failed to load material details. Please try again later.');
            //     }
            // });

            // Fetch Received Details
            // $.ajax({
            //     url: "<?php echo base_url() ?>Printingdetail/GetReceiveorderInfoDetails",
            //     type: 'POST',
            //     data: { inquiryid: id, customerid: customerid },
            //     dataType: 'json',
            //     success: function(data) {
            //         var orderTableBody = $('#receivedetailsinfotable tbody');
            //         var colorCuffTableBody = $('#receivedcolorcuff tbody');
            //         orderTableBody.empty();
            //         colorCuffTableBody.empty();

            //         if (data.received_order_details.length > 0) {
            //             $('#ReceivecustomerName').html(data.customer_name);

            //             data.received_order_details.forEach(function(orderDetail) {
            //                 if (orderDetail.printing_company !== null || orderDetail.sewing_company !== null) {
            //                     var row = '<tr>' +
            //                                 '<td>' + orderDetail.cloth_type + '</td>' +
            //                                 '<td>' + orderDetail.design_type + '</td>' +
            //                                 '<td>' + orderDetail.printing_company + '</td>' +
            //                                 '<td>' + orderDetail.sewing_company + '</td>' +
            //                                 '<td>' + orderDetail.received_qty + '</td>' +
            //                                 '<td>' + orderDetail.received_date + '</td>' +
            //                             '</tr>';
            //                     orderTableBody.append(row);
            //                 }
            //             });
            //         }

            //         if (data.received_colorcuff_details.length > 0) {
            //             data.received_colorcuff_details.forEach(function(detail) {
            //                 var colorCuffMap = { "1": "color", "2": "cuff" };
            //                 var colorCuffText = colorCuffMap[detail.colorcuff] || 'Unknown';

            //                 if (colorCuffText !== 'Unknown' && detail.colorcuff_com) {
            //                     var row = '<tr>' +
            //                                 '<td>' + colorCuffText + '</td>' +
            //                                 '<td>' + detail.colorcuff_com + '</td>' +
            //                                 '<td>' + detail.received_qty + '</td>' +
            //                                 '<td>' + detail.received_date + '</td>' +
            //                             '</tr>';
            //                     colorCuffTableBody.append(row);
            //                 }
            //             });
            //         }

            //         $('#receivedetailsinfo').modal('show');
            //     },
            //     error: function() {
            //         alert('An error occurred while fetching the details.');
            //     }
            // });

            // Fetch Delivery and Packaging Details
            // $.ajax({
            //     url: "<?php echo base_url() ?>Deliverydetail/GetDeliveryAndPackagingDetails",
            //     type: 'POST',
            //     data: { inquiryid: id },
            //     dataType: 'json',
            //     success: function(data) {
            //         var deliveryTableBody = $('#deliverydetailtable tbody');
            //         var packagingTableBody = $('#packagingdetailtable tbody');
            //         deliveryTableBody.empty();
            //         packagingTableBody.empty();

            //         if (data.delivery.length > 0) {
            //             data.delivery.forEach(function(deliveryDetail) {
            //                 var row = '<tr>' +
            //                     '<td>' + deliveryDetail.cloth_type + '</td>' +
            //                     '<td>' + deliveryDetail.size + '</td>' +
            //                     '<td>' + deliveryDetail.deliver_quantity + '</td>' +
            //                     '<td>' + deliveryDetail.delivery_date + '</td>' +
            //                     '</tr>';
            //                 deliveryTableBody.append(row);
            //             });
            //         } else {
            //             alert('No delivery details found for this inquiry.');
            //         }

            //         if (data.packaging.length > 0) {
            //             data.packaging.forEach(function(packagingDetail) {
            //                 var row = '<tr>' +
            //                     '<td>' + packagingDetail.cloth_type + '</td>' +
            //                     '<td>' + packagingDetail.size + '</td>' +
            //                     '<td>' + packagingDetail.packed_quantity + '</td>' +
            //                     '<td>' + packagingDetail.packaging_date + '</td>' +
            //                     '</tr>';
            //                 packagingTableBody.append(row);
            //             });
            //         } else {
            //             alert('No packaging details found for this inquiry.');
            //         }

            //         $('#deliverydetail').modal('show');
            //     },
            //     error: function() {
            //         alert('An error occurred while fetching the details.');
            //     }
            // });

            // $.ajax({
            //     url: "<?php echo base_url() ?>CRMCompletedorder/GetPaymentDetails",  
            //     type: 'POST',
            //     data: { inquiryid: id },
            //     dataType: 'json',
            //     success: function(data) {
            //         var tableBody = $('#paymentdetailtable tbody'); 
            //         tableBody.empty();
            //         $('#commonFields').remove();  
            //         if (data.length > 0) {
            //             data.forEach(function(paymentDetail) {
            //                 var row = '<tr>' +
            //                             '<td>' + paymentDetail.p_type + '</td>' + 
            //                             '<td>' + paymentDetail.amount + '</td>' +  
            //                             '<td>' + paymentDetail.payment_date + '</td>' +  
            //                             '</tr>';
            //                 tableBody.append(row);
            //             });

            //             $('#paymentdetail').modal('show');  
            //         } else {
            //             alert('No payment details found for this inquiry.');
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error(error);
            //         alert('Failed to load payment details. Please try again later.');
            //     }
            // });

        });

        $(document).on('input', '.cutting-qty', function() {
            var $row = $(this).closest('tr');
            var quantity = parseInt($row.find('td').eq(3).text());
            var cuttingQty = parseInt($(this).val());
            var balance = cuttingQty - quantity;
            $row.find('.balance').text((balance >= 0 ? '+' : '') + balance);
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