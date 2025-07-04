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
                            <span>Delivery Details</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap" id="dataTableAccepted" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Porder Id</th>
                                                <th>Customer</th>
                                                <th>Order Date</th>
                                                <th>Total Quantity</th>
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

        <!-- Delivery Plan Modal -->
        <div class="modal fade" id="deliveryPlanModal" tabindex="-1" aria-labelledby="deliveryPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delivery Plan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="deliveryPlanForm" method="post" action="<?= site_url('CRMDeliverydetail/Deliverydetailinsertupdate') ?>">
                <div class="mb-2 text-right">
                    <button type="button" class="btn btn-sm btn-primary" id="addDeliveryRow">+ Add Delivery</button>
                </div>

                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>Delivery Date</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="deliveryRows"></tbody>
                </table>

                <div class="text-right">
                    <input type="hidden" name="inquiryid" id="inquiryid">
                    <input type="hidden" name="orderid" id="orderid">
                    <button type="submit" class="btn btn-success btn-sm">Save Delivery Plan</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>

        <!-- Delivery Detail View Modal -->
        <div class="modal fade" id="deliverydetail" tabindex="-1" aria-labelledby="deliverydetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deliverydetailLabel">Delivery Plan Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm" id="deliverydetailtable">
                <thead class="thead-light">
                    <tr>
                    <!-- <th>#</th> -->
                    <th>Dilevary Id</th>
                    <th>Delivery Quantity</th>
                    <th>Delivery Date</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- data -->
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="editDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="editDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="editDeliveryForm" method="post" action="<?= site_url('CRMDeliverydetail/Deliverydetailupdate') ?>">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editDeliveryModalLabel">Edit Delivery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
                <input type="hidden" id="editDeliveryId" name="deliveryId">

                <div class="form-group">
                    <label for="editDeliverQuantity">Quantity</label>
                    <input type="number" class="form-control" id="editDeliverQuantity" name="deliver_quantity" required>
                </div>

                <div class="form-group">
                    <label for="editDeliveryDate">Delivery Date</label>
                    <input type="date" class="form-control" id="editDeliveryDate" name="delivery_date" required>
                </div>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>

            </div>
            </form>
        </div>
        </div>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>

<script>
    $(document).ready(function() {
        document.getElementById('addDeliveryRow').addEventListener('click', function () {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td><input type="date" class="form-control form-control-sm" name="delivery_date[]" required></td>
        <td><input type="number" class="form-control form-control-sm" name="delivery_qty[]" required></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="this.closest('tr').remove()">Remove</button></td>
    `;
    document.getElementById('deliveryRows').appendChild(row);
});
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
                { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV', },
                { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Supplier detail Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF', },
                { 
                    extend: 'print', 
                    title: 'Supplier detail Information',
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
                url: "<?php echo base_url() ?>scripts/crmdeliverydetail.php",
                type: "POST",
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": function(data, type, full) {
                        return "PO-" + data.idtbl_order;
                    }
                },
                {
                    "data": "name"
                },
                {
                    "data": "order_date"
                },
                {
                    "data": "quantity"
                },

                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        button += '<button class="btn btn-dark btn-sm btnview mr-1" data-toggle="modal" data-target="#deliverydetail" data-id="' + full['idtbl_order'] + '" data-customer="' + full['idtbl_customer'] + '" title="Delivery details view"><i class="fas fa-eye"></i></button>';
                        // button += '<button class="btn btn-dark btn-sm btnquotation mr-1" data-toggle="modal" data-target="#Deliverymodal" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Enter Packaging Details"><i class="fas fa-box"></i></button>';
                        // button += '<button class="btn btn-dark btn-sm btnpayment mr-1" data-toggle="modal" data-target="#paymentDetailModal" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['tbl_inquiry_idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" data-total="' + full['total'] + '" title="payment details"><i class="fas fa-credit-card"></i></button>';
                        button += '<button class="btn btn-dark btn-sm btndelivery mr-1" data-toggle="modal" data-target="#deliveryPlanModal" data-oid="' + full['idtbl_order'] + '" data-qid="' + full['idtbl_quotation'] + '" data-id="' + full['idtbl_inquiry'] + '" data-customer="' + full['idtbl_customer'] + '" title="Delivery details"><i class="fas fa-truck"></i></button>';
                        // if(full['status']==1){
                        //     button+='<a href="<?php echo base_url() ?>CRMDeliverydetail/Deliverydetailstatus/'+full['idtbl_quotation']+'/4" onclick="return deactive_confirm()" target="_self" class="btn btn-dark btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-check"></i></a>';
                        // }else{
                        //     button+='<a href="<?php echo base_url() ?>CRMDeliverydetail/Deliverydetailstatus/'+full['idtbl_quotation']+'/1" onclick="return active_confirm()" target="_self" class="btn btn-success btn-sm mr-1 ';if(statuscheck!=1){button+='d-none';}button+='"><i class="fas fa-times"></i></a>';
                        // }
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
        $('#dataTableAccepted').on('click', '.btndelivery', function() {
            var qid = $(this).data('qid');
            var id = $(this).data('id');
            var oid = $(this).data('oid');
            // console.log(id);
            // console.log(oid);
            $('#inquiryid').val(id);
            $('#orderid').val(oid);
        });

        $("#paymenttype").select2({
            dropdownParent: $('#paymentDetailModal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMDeliverydetail/Getpaymenttype",
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

        $("#machineType").select2({
            dropdownParent: $('#jobPlanModal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMDeliverydetail/GetMachineType",
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
        $("#machineModel").select2({  
            dropdownParent: $('#jobPlanModal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMDeliverydetail/GetMachineModel",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        machineType: $("#machineType").val(),
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

        $("#serialNumber").select2({  
            dropdownParent: $('#jobPlanModal'),
            ajax: {
                url: "<?php echo base_url() ?>CRMDeliverydetail/GetSerialNumber",
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        machineType: $("#machineType").val(),
                        machineModel: $("#machineModel").val(),
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

        // Disable dependent dropdowns until a selection is made
        $("#machineModel, #serialNumber").prop("disabled", true);

        // Enable Machine Model when Machine Type is selected
        $("#machineType").on("change", function() {
            $("#machineModel").prop("disabled", false).val(null).trigger("change");
            $("#serialNumber").prop("disabled", true).val(null).trigger("change");
        });

        // Enable Serial Number when Machine Model is selected
        $("#machineModel").on("change", function() {
            $("#serialNumber").prop("disabled", false).val(null).trigger("change");
        });
        // $("#dclothtype").select2({
        //     dropdownParent: $('#deliveryDetailModal'),
        //     ajax: {
        //         url: "<?php echo base_url() ?>CRMDeliverydetail/Getclothtype",
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 inquiryid: $('#inquiryid').val(),
        //                 searchTerm: params.term // search term
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }
        // });

        $(document).on('click', '.btnpayment', function() {
            var total = $(this).data('total');
            var inquiryid = $(this).data('id'); 
            $('#paymentDetailTableBody').empty();

            var advance = 0;
            var totalPayments = 0;

            $.ajax({
                url: "<?php echo base_url() ?>CRMDeliverydetail/Getadvancepayment",
                type: 'POST',
                data: { inquiryid: inquiryid },
                dataType: 'json',
                success: function(response) {
                    if (response.advance !== undefined) {
                        advance = response.advance;
                    }

                    var balance = total - advance;
                    $.ajax({
                        url: "<?php echo base_url(); ?>CRMDeliverydetail/GetPaymentDetails",
                        type: 'POST',
                        data: { inquiryid: inquiryid },
                        dataType: 'json',
                        success: function(payments) {
                            $.each(payments, function(index, payment) {
                                $('#paymentDetailTableBody').append(
                                    '<tr>' +
                                    '<td>' + payment.p_type + '</td>' +
                                    '<td>' + payment.payment_date + '</td>' +
                                    '<td>' + payment.amount + '</td>' +
                                    '</tr>'
                                );
                                totalPayments += parseFloat(payment.amount);
                            });
                            balance -= totalPayments;
                            $('#balanceAmount').text(balance.toFixed(2));
                        },
                    });
                },
                error: function() {
                    alert('Error fetching advance payment');
                }
            });
        });


        $(document).on('click', '#addPaymentBtn', function() {
            var paymentType = $('#paymenttype').val();
            var paymentDate = $('#paymentDate').val();
            var paymentAmount = $('#paymentAmount').val();
            var inquiryid = $('.btnpayment').data('id'); 
            if (paymentType === "" || paymentDate === "" || paymentAmount === "") {
                alert('Please fill all required fields');
                return;
            }

            $.ajax({
                url: "<?php echo base_url(); ?>CRMDeliverydetail/AddPayment",
                type: 'POST',
                data: {
                    paymenttype: paymentType,
                    paymentDate: paymentDate,
                    paymentAmount: paymentAmount,
                    inquiryid: inquiryid
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#paymentDetailTableBody').append(
                            '<tr>' +
                            '<td>' + $('#paymenttype option:selected').text() + '</td>' +
                            '<td>' + paymentDate + '</td>' +
                            '<td>' + paymentAmount + '</td>' +
                            '</tr>'
                        );

                        $('#paymenttype').val('');
                        $('#paymentDate').val('');
                        $('#paymentAmount').val('');

                        alert('Payment added successfully');
                    } else {
                        alert('Failed to add payment');
                    }
                },
            });
        });


    $("#formsubmit").click(function() {
        if (!$("#createorderform")[0].checkValidity()) {
            $("#submitBtn").click();
        } else {
            var clothTypeID = $('#clothtype').val();            
            var clothType = $("#clothtype option:selected").text();
            var sizeID = $('#size').val();            
            var size = $("#size option:selected").text();
            var quantity = $('#quantity').val();
            var date = $('#date').val();

            $('.selecter2').select2();

            $('#tablepackaging > tbody:last').append(
                '<tr class="pointer">' +
                '<td class="d-none">' + clothTypeID + '</td>' +
                '<td>' + clothType + '</td>' +
                '<td class="d-none">' + sizeID + '</td>' +
                '<td>' + size + '</td>' +
                '<td>' + quantity + '</td>' +
                '<td>' + date + '</td>' +
                '</tr>'
            );

            $('#clothtype').val('').trigger('change');
            $('#size').val('').trigger('change');
            $('#quantity').val('');
            $('#date').val('');

        }
    });

    $('#btncreateorder').click(function() {
        $('#btncreateorder').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Saving packaging details');

        var tbody = $("#tablepackaging tbody");
        var formData = new FormData();

        if (tbody.children().length > 0) {
            var jsonObj = [];
            $("#tablepackaging tbody tr").each(function() {
                var item = {
                    clothTypeID: $(this).find('td').eq(0).text(),   
                    sizeID: $(this).find('td').eq(2).text(),             
                    quantity: $(this).find('td').eq(4).text(),    
                    date: $(this).find('td').eq(5).text(),             
                };

                jsonObj.push(item);
            });

            console.log(jsonObj);

            var inquiryid = $('#inquiryid').val();

            formData.append('tableData', JSON.stringify(jsonObj)); 
            formData.append('inquiryid', inquiryid);

            $.ajax({
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                url: '<?php echo base_url() ?>CRMDeliverydetail/Packagingdetailinsertupdate',
                success: function(result) {
                    var obj = result;//JSON.parse(result);
                    $('#Deliverymodal').modal('hide');
                    if (obj.status == 1) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                    action(obj);
                },
            });
        }
    });

    $('#addDeliveryBtn').click(function() {
        if (!$("#deliveryDetailForm")[0].checkValidity()) {
            $("#deliveryDetailForm")[0].reportValidity();
        } else {
            var clothTypeID = $('#dclothtype').val();            
            var clothType = $("#dclothtype option:selected").text();
            var sizeID = $('#dsize').val();            
            var size = $("#dsize option:selected").text();
            var quantity = $('#deliveryQuantity').val();
            var deliveryDate = $('#deliveryDate').val();

            $('#deliveryDetailTableBody').append(
                '<tr class="pointer">' +
                '<td class="d-none">' + clothTypeID + '</td>' +
                '<td>' + clothType + '</td>' +
                '<td class="d-none">' + sizeID + '</td>' +
                '<td>' + size + '</td>' +
                '<td>' + quantity + '</td>' +
                '<td>' + deliveryDate + '</td>' +
                '</tr>'
            );

            $('#dclothtype').val('').trigger('change');
            $('#dsize').val('').trigger('change');
            $('#deliveryQuantity').val('');
            $('#deliveryDate').val('');
        }
    });

    // $('#btnSaveDelivery').click(function() {
    //     $('#btnSaveDelivery').prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin mr-2"></i> Saving delivery details');

    //     var tbody = $("#deliveryDetailTableBody");
    //     var formData = new FormData();

    //     if (tbody.children().length > 0) {
    //         var jsonObj = [];
    //         tbody.find('tr').each(function() {
    //             var item = {
    //                 clothTypeID: $(this).find('td').eq(0).text(),    
    //                 sizeID: $(this).find('td').eq(2).text(),             
    //                 quantity: $(this).find('td').eq(4).text(),    
    //                 deliveryDate: $(this).find('td').eq(5).text() 
    //             };

    //             jsonObj.push(item);
    //         });

    //         console.log(jsonObj);

    //         var inquiryid = $('#inquiryid').val();

    //         formData.append('tableData', JSON.stringify(jsonObj)); 
    //         formData.append('inquiryid', inquiryid);

    //         $.ajax({
    //             type: "POST",
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //             url: '<?php echo base_url() ?>CRMDeliverydetail/Deliverydetailinsertupdate',
    //             success: function(result) {
    //                 var obj = JSON.parse(result);
    //                 $('#deliveryDetailModal').modal('hide');
    //                 if (obj.status == 1) {
    //                     setTimeout(function() {
    //                         window.location.reload();
    //                     }, 3000);
    //                 }
    //                 action(obj);
    //             },
    //         });
    //     }
    // });


    $('#dataTableAccepted').on('click', '.btnview', function () {
    var id = $(this).data('id');
    $('#orderid').val(id);

    $.ajax({
        url: "<?php echo base_url('CRMDeliverydetail/GetDeliveryDetails'); ?>",
        type: 'POST',
        data: { orderId: id },
        dataType: 'json',
        success: function (data) {
            var deliveryTableBody = $('#deliverydetailtable tbody');
            deliveryTableBody.empty();

            if (data.delivery.length > 0) {
                data.delivery.forEach(function (delivery) {
                    var row = '<tr>' +
                        '<td>' + delivery.deliveryId + '</td>' +
                        '<td>' + delivery.deliver_quantity + '</td>' +
                        '<td>' + delivery.delivery_date + '</td>' +
                        '<td>' +
                        '<button class="btn btn-sm btn-primary btnEdit edit-delivery" data-id="' + delivery.deliveryId + '" data-quantity="' + delivery.deliver_quantity + '" data-date="' + delivery.delivery_date + '">' +
                            '<i class="fas fa-pen"></i>' + 
                        '</button>' +
                        '</td>'
                        '</tr>';
                    deliveryTableBody.append(row);
                });
            } else {
                deliveryTableBody.append('<tr><td colspan="4" class="text-center text-muted">No delivery data found.</td></tr>');
            }

            $('#deliverydetail').modal('show');
        },
        error: function () {
            alert('Something went wrong while fetching the delivery details.');
        }
    });
});

$('#deliverydetailtable').on('click', '.edit-delivery', function () {
    var deliveryId = $(this).data('id');
    var quantity = $(this).data('quantity');
    var date = $(this).data('date');

    if (confirm('Are you sure you want to edit this delivery?')) {
        $('#editDeliveryId').val(deliveryId);
        $('#editDeliverQuantity').val(quantity);
        $('#editDeliveryDate').val(date);

        $('#deliverydetail').modal('hide');
        $('#editDeliveryModal').modal('show');
    }
});


    $(document).ready(function() {
    $('#checkMachineAvailability').on('click', function() {
        $('#machineAvailabilityModal').modal('show');

        $('#machineTable').DataTable().destroy();

        $('#machineTable').DataTable({
            "processing": true,
            "serverSide": false, 
            "ajax": {
                "url": "<?php echo base_url()?>CRMDeliverydetail/GetAllAvailableMachines", 
                "type": "GET",
                "dataSrc": "" 
            },
            "columns": [
                { "data": "id" },
                { "data": "s_no" },
                { "data": "name"},
                { "data": "model"},
                {
                    "data": "booking_startdate",
                    "render": function(data, type, row) {
                        return data ? data : "Not set"; 
                    }
                },
                {
                    "data": "booking_enddate",
                    "render": function(data, type, row) {
                        return data ? data : "Not set"; 
                    }
                },
                { 
                    "data": "id",
                    "render": function(data, type, row) {
                        return `<button class="btn btn-success btn-sm select-machine" data-id="${data}">Select</button>`;
                    }
                }
            ]
        });
        
    });

    $(document).on('click', '.select-machine', function() {
        let machineId = $(this).data('id');
        $('#selectedMachineId').val(machineId);
        $('#machineAvailabilityModal').modal('hide');
    });
});
});


    function deactive_confirm() {
        return confirm("Are you sure you want to complete order?");
    }

    function active_confirm() {
        return confirm("Are you sure you want to remove complete order?");
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

<?php include "include/footer.php"; ?>
