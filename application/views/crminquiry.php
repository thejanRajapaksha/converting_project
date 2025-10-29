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
                            <span>Customer Inquiry</span>
                        </h1>
                    </div>
                </div>
        </div>
    <div class="container-fluid mt-2 p-0 p-2">
        <div class="card">
            <div class="card-body p-0 p-2">
                <div class="row">
                    <div class="col-12">
                        <form method="post" autocomplete="off" id="grnform">
                            <div class="form-row">
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Customer Name</label>
                                    <select class="form-control form-control-sm" name="customername" id="customername" required>
                                        <option value="" selected disabled>Select Customer</option>
                                        <?php foreach ($customername as $customernames):?>
                                            <option value="<?php echo $customernames->idtbl_customer;?>">
                                            <?php echo htmlspecialchars($customernames->name);?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold text-dark">Item*</label>
                                    <select class="form-control form-control-sm" name="item" id="item" required>
                                        <option selected disabled>Select</option>
                                        <?php foreach($product as $products):?>
                                            <option value="<?php echo $products->idtbl_product; ?>">
                                            <?php echo $products->product;?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Quantity*</label>
                                    <input type="text" class="form-control form-control-sm" name="quantity" id="quantity" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Date*</label>
                                    <input type="date" class="form-control form-control-sm" name="date" id="date" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Delivery Date*</label>
                                    <input type="date" class="form-control form-control-sm" name="d_date" id="d_date" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Bag Length*</label>
                                    <input type="number" class="form-control form-control-sm" name="bg_length" id="bg_length" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Bag Width*</label>
                                    <input type="number" class="form-control form-control-sm" name="bg_width" id="bg_width" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Liner Size*</label>
                                    <input type="number" class="form-control form-control-sm" name="liner_size" id="liner_size" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Liner Color*</label>
                                    <input type="number" class="form-control form-control-sm" name="liner_color" id="liner_color" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Bag Weight*</label>
                                    <input type="number" class="form-control form-control-sm" name="bg_weight" id="bg_weight" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Liner Weight*</label>
                                    <input type="number" class="form-control form-control-sm" name="ln_weight" id="ln_weight" required>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Printing Type</label>
                                    <select class="form-control form-control-sm" name="printing_type" id="printing_type" required>
                                        <option value="" selected disabled>Select Type</option>
                                        <option value="offPrint">Off Print</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2 mb-1">
                                    <label class="small font-weight-bold">Color No*</label>
                                    <input type="number" class="form-control form-control-sm" name="col_no" id="col_no" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2 mb-1 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="inner_bag" name="inner_bag" value="false">
                                        <label class="form-check-label font-weight-bold ml-2" for="inner_bag">Inner Bag</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 mb-1 d-flex align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="off_print" name="off_print" value="false">
                                        <label class="form-check-label font-weight-bold ml-2" for="off_print">Printing</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 mb-1 text-right">
                                    <label class="d-block">&nbsp;</label>
                                    <button type="button" id="submitlist" class="btn btn-primary btn-sm px-4" <?php if($addcheck==0){echo 'disabled';} ?>>
                                        <i class="far fa-save"></i>&nbsp;Add List
                                    </button>
                                    <input name="submitBtn" type="submit" value="Save" id="submitBtn" class="d-none">
                                </div>
                            </div>

                            <input type="hidden" name="recordOption" id="recordOption" value="1">
                            <input type="hidden" name="recordID" id="recordID" value="">
                            <input type="hidden" id="hinquiry_id" value="">
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-sm nowrap" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Delivery Date</th>
                                    <th>Date</th>
                                    <th>Length</th>
                                    <th>Width</th>
                                    <th>Liner Size</th>
                                    <th>Liner Color</th>
                                    <th>Bag Weight</th>
                                    <th>Liner Weight</th>
                                    <th>Inner Bag</th>
                                    <th>Printing</th>
                                    <th>Printing Type</th>
                                    <th>Color No</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <div class="form-group text-right p-2">
                            <button type="button" id="submitdata" class="btn btn-primary btn-sm px-4" <?php if($addcheck==0){echo 'disabled';} ?>>
                                <i class="far fa-save"></i>&nbsp;Submit All
                            </button>
                        </div>

                        <table class="table table-bordered table-striped table-sm nowrap mt-3" id="inquiryTable" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="inquiryDetailsModal" tabindex="-1" role="dialog" aria-labelledby="inquiryDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="inquiryDetailsModalLabel">Inquiry Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="inquiryDetailsTable" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Inquiry ID</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Delivery Date</th>
                                                <th>Date</th>
                                                <th>Bag Length</th>
                                                <th>Bag Width</th>
                                                <th>Liner Size</th>
                                                <th>Liner Color</th>
                                                <th>Bag Weight</th>
                                                <th>Liner Weight</th>
                                                <th>Inner Bag</th>
                                                <th>Printing</th>
                                                <th>Printing Type</th>
                                                <th>Color No</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
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
    var dt;
    $(document).ready(function() {

		var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';
        
        $('#submitlist').click(function() {
            if (!$("#grnform")[0].checkValidity()) {
                $("#submitBtn").click();
            } else {
                var customernameid = $('#customername').val();
                var customername = $('#customername option:selected').text();
                var itemId = $('#item').val();
                var item = $('#item option:selected').text();
                var quantity = $('#quantity').val();
                var d_date = $('#d_date').val();
                var date = $('#date').val();
                var bg_length = $('#bg_length').val();
                var bg_width = $('#bg_width').val();
                var liner_size =$('#liner_size').val();
                var liner_color = $('#liner_color').val();
                var bg_weight = $('#bg_weight').val();
                var ln_weight =$('#ln_weight').val();
                var inner_bag = $('#inner_bag').is(':checked') ? 'Yes' : 'No'; 
                var off_print = $('#off_print').is(':checked') ? 'Yes' : 'No'; 
                var printing_type = $('#printing_type').val();
                var col_no = $('#col_no').val();

                $('#dataTable > tbody:last').append(
                    '<tr><td>' + customername +
                    '<td class="d-none">' + itemId + '</td>' +
                    '</td><td>' + item +
                    '</td><td>' + quantity +
                    '</td><td>' + d_date +
                    '</td><td>' + date +
                    '</td><td>' + bg_length +
                    '</td><td>' + bg_width +
                    '</td><td>' + liner_size +
                    '</td><td>' + liner_color +
                    '</td><td>' + bg_weight +
                    '</td><td>' + ln_weight +
                    '</td><td>' + inner_bag +
                    '</td><td>' + off_print +
                    '</td><td>' + printing_type +
                    '</td><td>' + col_no +
                    '</td><td class="text-right"><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td></tr>');

                //$('#customername').val(null).trigger('change');
                // $('#item').val('');
                $('#quantity').val('');
                $('#bg_length').val('');
                $('#bg_width').val('');
                $('#liner_size').val('');
                $('#liner_color').val('');
                $('#bg_weight').val('');
                $('#ln_weight').val('');
                $('#inner_bag').prop('checked', false);
                $('#off_print').prop('checked', false);
                $('#printing_type').val('');
                $('#col_no').val('');

            }
        });

        $('#submitdata').click(function() {
            var tableData = [];
            $('#dataTable tbody tr').each(function() {
                var row = {
                    tbl_customer_idtbl_customer: $('#customername').val(),
                    itemId: $(this).find('td:eq(1)').text(),
                    date: $(this).find('td:eq(5)').text(),
                    quantity: $(this).find('td:eq(3)').text(),
                    d_date: $(this).find('td:eq(4)').text(),
                    bag_length: $(this).find('td:eq(6)').text(),
                    bag_width: $(this).find('td:eq(7)').text(),
                    liner_size: $(this).find('td:eq(8)').text(),
                    liner_color: $(this).find('td:eq(9)').text(),
                    bg_weight: $(this).find('td:eq(10)').text(),
                    ln_weight: $(this).find('td:eq(11)').text(),
                    inner_bag: $(this).find('td:eq(12)').text() === 'Yes' ? true : false,
                    off_print: $(this).find('td:eq(13)').text() === 'Yes' ? true : false,
                    printing_type: $(this).find('td:eq(14)').text(),
                    colour_no: $(this).find('td:eq(15)').text()
                };
               
                  tableData.push(row);
            // console.log(row);
            });

            if (tableData.length === 0) {
                alert("Please add items to the list before submitting.");
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("CRMInquiry/Inquiryinsertupdate"); ?>',
                data: { data: tableData },
                dataType: 'json',
                success: function(data) {
                    if(data.success){
                        location.reload();
                    }else{
                        alert('Error');
                    }
                }
            });
        });

        $(document).on("click", ".btnView", function(){
        var inquiryId = $(this).data('id');
        $("#hinquiry_id").val(inquiryId);
            dt.ajax.reload();

        $('#inquiryDetailsModal').modal('show');
});

        
        $('#inquiryTable').DataTable({          
            "destroy": true,
            "processing": true,
            "serverSide": true,
            //dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            ajax: {
                url: "<?php echo base_url() ?>scripts/inquirylist.php",
                type: "POST", // you can use GET
                // data: function(d) {}
            },
            "order": [[ 0, "desc" ]],
            "columns": [
                {
                    "data": "idtbl_inquiry"
                },
                {
                    "data": "name"
                },
                {
                    "data": "date"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        button += '<button class="btn btn-primary btn-sm btnView mr-1" data-id="' + full['idtbl_inquiry'] + '"><i class="fas fa-eye"></i></button>';
                        if (full['status'] == 1) {
                            button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirystatus/' + full['idtbl_inquiry'] + '/2" onclick="return deactive_confirm()" target="_self" class="btn btn-success btn-sm mr-1"><i class="fas fa-check"></i></a>';
                        } else {
                            button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirystatus/' + full['idtbl_inquiry'] + '/1" onclick="return active_confirm()" target="_self" class="btn btn-warning btn-sm mr-1"><i class="fas fa-times"></i></a>';
                        }
                        button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirystatus/' + full['idtbl_inquiry'] + '/3" onclick="return delete_confirm()" target="_self" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';
                        
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        var dt;
$(document).ready(function () {
    dt = $('#inquiryDetailsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true, // Consider removing this if reinitializing is unnecessary
        dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        responsive: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        buttons: [
            { extend: 'csv', className: 'btn btn-success btn-sm', title: 'Inquiry Detail Information', text: '<i class="fas fa-file-csv mr-2"></i> CSV' },
            { extend: 'pdf', className: 'btn btn-danger btn-sm', title: 'Inquiry Detail Information', text: '<i class="fas fa-file-pdf mr-2"></i> PDF' },
            { 
                extend: 'print', className: 'btn btn-primary btn-sm', title: 'Inquiry Detail Information', 
                text: '<i class="fas fa-print mr-2"></i> Print',
                customize: function (win) {
                    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                }
            }
        ],
        ajax: {
            url: "<?php echo base_url() ?>scripts/inquirydetaillist.php",
            type: "POST",
            data: function (d) {
                var inquiryId = $('#hinquiry_id').val();
                    d.id = inquiryId;
            }
        },
        "order": [[0, "desc"]],
        "columns": [
            { "data": "idtbl_inquiry_detail" },
            { "data": "item" },
            { "data": "quantity" },
            { "data": "d_date" },
            { "data": "date" },
            { "data": "bag_length" },
            { "data": "bag_width" },
            { "data": "liner_size" },
            { "data": "liner_color" },
            { "data": "bg_weight" },
            { "data": "ln_weight" },
            { 
                "data": "inner_bag",
                "render": function (data) {
                    return data == 1 ? 'Yes' : 'No';
                }
            },
            { 
                "data": "off_print",
                "render": function (data) {
                    return data == 1 ? 'Yes' : 'No';
                }
            },
            { "data": "printing_type" },
            { "data": "colour_no" },
            {
                "targets": -1,
                "className": 'text-right',
                "data": null,
                "render": function (data, type, full) {
                    var button = '';
                    if (full['status'] == 1) {
                        button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirydetailstatus/' + full['idtbl_inquiry_detail'] + '/2" onclick="return deactive_confirm()" class="btn btn-success btn-sm mr-1 ' + (typeof statuscheck !== "undefined" && statuscheck != 1 ? 'd-none' : '') + '"><i class="fas fa-check"></i></a>';
                    } else {
                        button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirydetailstatus/' + full['idtbl_inquiry_detail'] + '/1" onclick="return active_confirm()" class="btn btn-warning btn-sm mr-1 ' + (typeof statuscheck !== "undefined" && statuscheck != 1 ? 'd-none' : '') + '"><i class="fas fa-times"></i></a>';
                    }
                    button += '<a href="<?php echo base_url() ?>CRMInquiry/Inquirydetailstatus/' + full['idtbl_inquiry_detail'] + '/3" onclick="return delete_confirm()" class="btn btn-danger btn-sm ' + (typeof deletecheck !== "undefined" && deletecheck != 1 ? 'd-none' : '') + '"><i class="fas fa-trash-alt"></i></a>';
                    return button;
                }
            }
        ],
        drawCallback: function (settings) {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});


        $('#dataTable').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });

        document.getElementById('off_print').addEventListener('change', function() {
        this.value = this.checked ? "true" : "false";
        });
        // Function to submit all data

    });


    function deactive_confirm() {
        return confirm("Are you sure you want to deactivate this?");
    }

    function active_confirm() {
        return confirm("Are you sure you want to activate this?");
    }

    function delete_confirm() {
        return confirm("Are you sure you want to remove this?");
    }
</script>
