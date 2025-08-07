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
                            <div class="page-header-icon"><i class="fas fa-boxes"></i></div>
                            <span>Stock Report</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="row mb-3">
                            <div class="form-group col-md-2 mb-1">
                                <label class="small font-weight-bold">Part No</label>
                                <select class="form-control form-control-sm" id="part_no_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 mb-1">
                                <label class="small font-weight-bold">Supplier</label>
                                <select class="form-control form-control-sm" id="supplier_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 mb-1">
                                <label class="small font-weight-bold">Machine Type</label>
                                <select class="form-control form-control-sm" id="machine_type_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 mb-1">
                                <label class="small font-weight-bold">Part Name</label>
                                <select class="form-control form-control-sm" id="spare_part_name_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 mb-1">
                                <label class="small d-block">&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-sm w-100" id="filter_button">Filter</button>
                            </div>
                        </div>

                        <hr>

                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Available Quantity</th>
                                        <th>Allocated Quantity</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Modal -->
            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Allocated Records: <strong><span id="service_item_name"></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div id="viewMsg"></div>
                            <div id="viewResponse"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remove Modal -->
            <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="<?php echo base_url('MachineServices/remove_allocation') ?>" method="post" id="removeForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Remove Service Item Allocation</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to remove?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>
<script type="text/javascript">
    var manageTable;
    var base_url = "<?php echo base_url(); ?>";


    $(document).ready(function () {

        var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';


        $('#part_no_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'StockReport/get_part_no_select_from_stock',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true
            }
        });

        $('#supplier_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'StockReport/get_supplier_select_from_stock',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true
            }
        });

        $('#machine_type_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'StockReport/get_machine_type_select_from_stock',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true
            }
        });

        $('#spare_part_name_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'StockReport/get_spare_part_name_from_stock',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                cache: true
            }
        });

        $('#filter_button').click(function() {
            load_dt();
        });

        // initialize the datatable
        load_dt();

        function load_dt(){

            let spare_part_id = $('#part_no_filter').val();
            let supplier_id = $('#supplier_filter').val();
            let machine_type_id = $('#machine_type_filter').val();

            manageTable = $('#manageTable').DataTable({
                'ajax': {
                    'url': base_url + 'StockReport/fetchStockReport',
                    'type': 'POST',
                    'data': {
                        'spare_part_id': spare_part_id,
                        'supplier_id': supplier_id,
                        'machine_type_id': machine_type_id
                    }
                },
                'order': [],
                destroy: true,
            });
        }

        $(document).on("click", ".btn_view", function (e) {
            e.preventDefault();
            let id = $(this).data('spare_part_id');

            $.ajax({
                url: base_url + 'MachineService/fetchViewStock/'+id,
                type: 'post',
                dataType: 'json',
                success:function(data) {
                    let res_table = "<div class='table-responsive mt-3'>";
                    res_table += '<table class="table table-striped table-sm" id="viewTable">';
                    let res_tr = '<thead><tr><th>Service No</th> <th> Estimated Quantity </th> <th>Allocated Quantity</th> <th> </th> </tr></thead> <tbody>';
                    let response = data.ac;
                        $.each(response, function(index, value) {
                            let allocate_id = value.allocate_id;
                            res_tr += '<tr>' +
                                '<td>' + value.service_no + '</td>' +
                                '<td>' + value.estimated_qty + '</td>' +
                                '<td>' + value.allocated_qty + '</td>';

                            if (deletecheck == 1) {
                                res_tr += '<td><button type="button" class="btn btn-sm btn-danger btn-delete-edit" data-id="' + allocate_id + '" onclick="removeFunc(' + allocate_id + ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash text-white"></i></button></td>';
                            } else {
                                res_tr += '<td></td>';
                            }

                            res_tr += '</tr>';
                        });

                    res_table += res_tr + '</tbody> ';

                    res_table += '</table>';
                    res_table += '</div>  ';

                    let machine_type_name = data.main_data.part_no + ' - ' + data.main_data.name;
                    $('#service_item_name').html(machine_type_name);

                    $("#viewModal .modal-body #viewResponse").html(res_table);
                    $('#viewTable').DataTable();

                }
            });

        });

    });

    $("#removeModal").on("hide.bs.modal", function (e) {
        //hide viewModal
        //$('#viewModal').modal('show');
    });

    $("#removeModal").on("show.bs.modal", function (e) {
        //hide viewModal
        $('#viewModal').modal('hide');
    });

    function removeFunc(id)
    {
        if(id) {
            $("#removeForm").on('submit', function() {

                var form = $(this);

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: { id:id },
                    dataType: 'json',
                    success:function(response) {

                        let service_id = response.service_id;

                        manageTable.ajax.reload(null, false);
                        // hide the modal
                        $("#removeModal").modal('hide');

                        if(response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                '</div>');
                        } else {
                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                '</div>');
                        }
                    }
                });

                return false;
            });
        }
    }


</script>