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
                            <span>CRM Quotation</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <table class="table table-bordered table-striped table-sm nowrap" id="dataTable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th class="d-none"></th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inquirydetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="page-header-title font-weight-bold">
                    <div class="page-header-icon"><i class="fas fa-address-book"></i> <span>Inquiry Details</span></div>
                </h1>
                <button type="button" class="close" id="closeCC" name="closeCC" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <div class="row">
                    <div class="col-12">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap" id="dataTableInquiryDetail" style="width: 100%;">
                                <thead>
                                    <tr>
                                                <th>Inquiry ID</th>
                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>Delivery Date</th>
                                                <th>Date</th>
                                                <th>Bag Length</th>
                                                <th>Bag Width</th>
                                                <th>Inner Bag</th>
                                                <th>Printing</th>
                                                <th>Printing Type</th>
                                                <th>Colour No</th>
                                    </tr>
                                </thead>
                            </table>
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


        $('#dataTable').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "responsive": true,
            dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            responsive: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            "buttons": [{
                    extend: 'csv',
                    className: 'btn btn-success btn-sm',
                    title: 'Quotation Information',
                    text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-danger btn-sm',
                    title: 'Quotation Information',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                },
                {
                    extend: 'print',
                    title: 'Quotation Information',
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
                url: "<?php echo base_url() ?>scripts/quotationlist.php",
                type: "POST", // you can use GET
                data: function(d) {
                    d.userID = '<?php echo $_SESSION['userid']; ?>';

                }
            },
            "order": [
                [0, "desc"]
            ],
            "columns": [{
                    "data": function(data, type, full) {
                        return "INQ-" + data.idtbl_inquiry;
                    }
                },
                {
                    "data": "name"
                },
                {
                    "data": "date"
                },
                {
                    "className": 'd-none',
					"data": "idtbl_customer"
                },
                {
                    "targets": -1,
                    "className": 'text-right',
                    "data": null,
                    "render": function(data, type, full) {
                        var button = '';
                        button += '<button class="btn btn-primary btn-sm btnview mr-1" id="' + full['idtbl_inquiry'] + '" data-toggle="tooltip" data-placement="bottom" title="Inquiry Details"><i class="fas fa-eye"></i></button>';
                        if(addcheck == 1){
                        button += '<a href="<?php echo base_url() ?>CRMQuotationform/Getquotation/' + full['idtbl_inquiry'] + '/' + full['idtbl_customer'] + '" class="btn btn-success btn-sm btnquotation mr-1" data-toggle="tooltip" data-placement="bottom" title="Create Quotation"><i class="fas fa-list"></i></a>';
                        }
                        return button;
                    }
                }
            ],
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });


        $('#dataTable tbody').on('click', '.btnquotation', function() {
            var idtbl_inquiry = $(this).attr('id');
        });

        $('#dataTable tbody').on('click', '.btnview', function() {
            var id = $(this).attr('id')
            //  alert(id);
            $('#inquirydetail').modal('show');
            
            $('#dataTableInquiryDetail').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                responsive: true,
                dom: "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                responsive: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                "buttons": [{
                        extend: 'csv',
                        className: 'btn btn-success btn-sm',
                        title: 'Inquiry Details Information',
                        text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger btn-sm',
                        title: 'Inquiry Details Information',
                        text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    },
                    {
                        extend: 'print',
                        title: 'Inquiry Details Information',
                        className: 'btn btn-primary btn-sm',
                        text: '<i class="fas fa-print mr-2"></i> Print',
                        customize: function(win) {
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                    },
                ],
                ajax: {
                    url: "<?php echo base_url() ?>scripts/inquirydetaillist.php",
                    type: "POST",
                    data: function(d) {
                        d.userID = '<?php echo $_SESSION['userid']; ?>';
                        d.id = id;
                        // console.log(id);
                    }
                },
                "order": [
                    [0, "desc"]
                ],
                "columns": [
                    { "data": "idtbl_inquiry_detail" },
                    { "data": "item" },
                    { "data": "quantity" },
                    { "data": "d_date" },
                    { "data": "date" },
                    { "data": "bag_length" },
                    { "data": "bag_width" },
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
                ],
                drawCallback: function(settings) {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        });
        // $('#dataTable tbody').on('click', '.btnquotation', function() {
        //     var idtbl_inquiry = $(this).attr('id');
        //     alert(id);
        //     $.ajax({
        // 		type: "POST",
        // 		data: {
        // 			idtbl_inquiry: idtbl_inquiry	
        // 		},
        // 		url: 'Quotationform/Quotationforminsertupdate',
        // 		success: function(result) { //alert(result);

        // 		}
        // 	});

        // });

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


