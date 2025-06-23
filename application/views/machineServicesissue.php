<?php 
include_once "include/header.php";  
include_once "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav"><?php include_once "include/menubar.php"; ?></div>
        <div id="layoutSidenav_content">
            <main>
            <div class="container-fluid mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="">Service Item Issue</h2>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary float-right btn-sm <?php if($addcheck==0){echo 'disabled';} ?>" data-toggle="modal" data-target="#addModal">
                                    New Issue
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Service No</th>
                                    <th>Employee Name</th>
                                    <th>Machine Type</th>
                                    <th>Machine Serial No</th>
                                    <th>Service Date From</th>
                                    <th>Service Date To</th>
                                    <th>Estimated Service Hours</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                <!-- create brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">New Service Item Issue</h5>
                                    <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>"
                                        data-dismiss="modal" aria-label="Close"><spanaria-hidden="true">&times;</spanaria-hidden=>
                                    </button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/issue_new') ?>" method="post"
                                id="createForm">

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="service_no">Service No</label>
                                                <select class="form-control form-control-sm" id="service_no" name="service_no">
                                                    <option value="">Select...</option>
                                                </select>
                                                <div id="service_no_error"></div>
                                            </div>

                                            <div class="form-group">
                                                <div class="info"></div>
                                            </div>

                                        </div>
                                        <div class="col-md-9">

                                            <div class="form-group table-responsive">
                                                <table class="table table-sm" id="colorTable">
                                                    <thead>
                                                    <tr>
                                                        <th> Spare Part </th>
                                                        <th> Allocated Quantity </th>
                                                        <th> Issued Quantity </th>
                                                        <th> New Issue Quantity </th>
                                                        <th>  </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>

                            </form>


                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- edit brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Service Item Issue : <span id="service_no_span"></span> </h4>
                                <button type="button" class="close <?php if($editcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/update_issue') ?>" method="post"
                                id="updateForm">

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="form-group table-responsive">
                                                <table class="table table-sm" id="edit_colorTable">
                                                    <thead>
                                                    <tr>
                                                        <th> Spare Part </th>
                                                        <th> Allocated Quantity </th>
                                                        <th> Issued Quantity </th>
                                                        <th>  </th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>

                                            <span id="edit_service_no"></span>

                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>

                            </form>


                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- remove brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Remove Service Item Remove</h4>
                                <button type="button" class="close <?php if($deletecheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/remove_issue') ?>" method="post"
                                id="removeForm">
                                <div class="modal-body">
                                    <p>Do you really want to remove?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                                </div>
                            </form>


                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Issued Service Items : <strong> <span id="machine_type_name"></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="viewMsg"></div>
                            <div id="viewResponse"></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>


                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>

<script type="text/javascript">
    var manageTable;
    var base_url = "<?php echo base_url(); ?>";


    $(document).ready(function() {

        $('#machine_services_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
        $('#collapseLayoutsMachineServices').addClass('show');

        var addcheck='<?php echo $addcheck; ?>';
        var editcheck='<?php echo $editcheck; ?>';
        var statuscheck='<?php echo $statuscheck; ?>';
        var deletecheck='<?php echo $deletecheck; ?>';

        $('#service_no').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            dropdownParent: $('#addModal'),
            ajax: {
                url: base_url + 'MachineService/get_service_no_select_id',
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

        let colorTable = $('#colorTable').DataTable({
            searching: false, paging: false, info: false,
            "createdRow": function( row, data, dataIndex){
                if( data[3] == ''){
                    $(row).addClass('bg-success');
                }else {

                }
            }
        });

        $('#service_no').on('change', function() {
            var service_no = $(this).val();
            colorTable.clear();
            if (service_no) {
                $.ajax({
                    url: base_url + 'MachineService/fetchMachineServicesDataById/'+service_no,
                    type: 'post',
                    dataType: 'json',
                    success:function(data) {

                        var op = data.ic_det;

                        $.each(op, function(key, value) {
                            let sp_id = value.sp_id;
                            let sp_name = value.sp_name;
                            let a_id = value.a_id;
                            let allocated_qty = value.allocated_qty;
                            let issued_qty = value.issued_qty;

                            let f = sp_name;

                            let pending_qty = allocated_qty - issued_qty;


                            let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + f + '';
                            let a_id_input = '<input type="hidden" name="a_id[]" class="id" value="'+a_id+'"/> ' + '';
                            let allocated_qty_input = '<input type="text" name="allocated_qty[]" readonly="true" class="form-control form-control-sm allocated_qty" value="'+allocated_qty+'" /> ';
                            let issued_qty_input = '<input type="text" name="issued_qty[]" readonly="true" class="form-control form-control-sm issued_qty" value="'+issued_qty+'" /> ';
                            let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="'+pending_qty+'" /> ';

                            colorTable.row.add([
                                sp_id_input+a_id_input,
                                allocated_qty_input,
                                issued_qty_input,
                                qty_input,
                                '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
                            ]).draw(false);

                        });

                        if(op == ''){
                            colorTable.clear().draw()
                        }

                        let main_data = data.main_data;

                        let html = "" +
                            "<div class=''>" +
                            "<table class=''>" +
                            "<tr>" +
                            "<td> <label> Machine Type </label> " + "</td>" +
                            "<td style='padding-left:15px'> "+ main_data.machine_type_name + "</td>" +
                            "</tr>" +
                            "<tr>" +
                            "<td> <label> Machine Serial No </label> " + "</td>" +
                            "<td style='padding-left:15px'> "+ main_data.s_no + "</td>" +
                            "</tr>" +
                            "</table> " +
                            "</div>";

                        $('.info').html(html);

                    }
                });

            }
        });

        $('#colorTable tbody').on('click', '.btn-delete', function () {
            colorTable.row($(this).parents('tr')).remove().draw();
        });

        $("#addModal").on("hide.bs.modal", function (e) {
            //hide viewModal
            colorTable.clear();
        });

        // initialize the datatable
        manageTable = $('#manageTable').DataTable({
            'ajax': base_url + 'MachineService/fetchCategoryDataIssue',
            'order': []
        });

        // submit the create from
        $("#createForm").unbind('submit').on('submit', function() {
            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success:function(response) {

                    manageTable.ajax.reload(null, false);

                    if(response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');

                        // hide the modal
                        $("#addModal").modal('hide');

                        // reset the form
                        $("#createForm")[0].reset();
                        $('#service_no').val('').trigger('change');
                        $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

                    } else {

                        if(response.messages instanceof Object) {
                            $.each(response.messages, function(index, value) {
                                let id = $("#"+index);

                                if (index == 'service_no') {
                                    id = $("#service_no_error");
                                }

                                id.closest('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success');

                                id.after(value);

                            });
                        } else {
                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                '</div>');
                        }
                    }
                }
            });

            return false;
        });

    });

    // edit function
    function editFunc(id)
    {

        let colorTable = $('#edit_colorTable').DataTable({
            searching: false,
            paging: false,
            info: false,
            destroy:true
        });

        colorTable.clear().draw();

        $.ajax({
            url: base_url + 'MachineService/fetchIssuedServiceItems/'+id,
            type: 'post',
            dataType: 'json',
            success:function(data) {

                var op = data.sc;

                $.each(op, function(key, value) {
                    let sp_id = value.id;
                    let sp_name = value.name;
                    let part_no = value.part_no;
                    let issue_id = value.issue_id;
                    let allocated_qty = value.allocated_qty;
                    let qty = value.qty;

                    let f = sp_name + ' - ' + part_no ;


                    let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + f + '';
                    let issue_id_input = '<input type="hidden" name="issue_id[]" class="id" value="'+issue_id+'"/> '  + '';
                    let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="'+qty+'" /> ';
                    let allocated_qty_input = '<input type="text" name="allocated_qty[]" readonly="true" class="form-control form-control-sm allocated_qty" value="'+allocated_qty+'" /> ';

                    colorTable.row.add([
                        sp_id_input+issue_id_input,
                        allocated_qty_input,
                        qty_input,
                        '<button type="button" class="btn btn-sm btn-danger btn-delete-edit" data-id="" onclick="removeFunc('+issue_id+')" data-toggle="modal" data-target="#removeModal" ><i class="fa fa-trash text-white"></i></button>'
                    ]).draw(false);

                });


                let machine_type_name = data.main_data.service_no;
                $('#service_no_span').html(machine_type_name);

                $('#edit_colorTable tbody').on('click', '.btn-delete', function () {
                    colorTable.row($(this).parents('tr')).remove().draw();
                });

                // submit the edit from
                $("#updateForm").unbind('submit').bind('submit', function() {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: form.attr('method'),
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        success:function(response) {

                            manageTable.ajax.reload(null, false);

                            if(response.success === true) {
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                    '</div>');

                                // hide the modal
                                $("#editModal").modal('hide');
                                // reset the form
                                $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                            } else {

                                if(response.messages instanceof Object) {
                                    $.each(response.messages, function(index, value) {
                                        var id = $("#"+index);
                                        // if (index == 'edit_service_no') {
                                        //     id = $("#edit_estimated_service_items_error");
                                        // }

                                        id.closest('.form-group')
                                            .removeClass('has-error')
                                            .removeClass('has-success')
                                            .addClass(value.length > 0 ? 'has-error' : 'has-success');

                                        id.after(value);

                                    });
                                } else {
                                    $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                        '</div>');
                                }
                            }
                        }
                    });

                    return false;
                });

            }
        });

        $("#removeModal").on("hide.bs.modal", function (e) {
            //hide viewModal
            $('#editModal').modal('show');
        });

        $("#removeModal").on("show.bs.modal", function (e) {
            //hide viewModal
            $('#editModal').modal('hide');
        });

    }

    // remove functions
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
                        editFunc(service_id);

                        //manageTable.ajax.reload(null, false);
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

    function viewFunc(id)
    {
        $.ajax({
            url: base_url + 'MachineService/fetchIssuedServiceItems/'+id,
            type: 'post',
            dataType: 'json',
            success:function(data) {
                let res_table = "<div class='table-responsive mt-3'>";
                res_table += '<table class="table table-striped table-sm" id="viewTable">';
                let res_tr = '<thead><tr><th>Service Item</th> <th> Allocated Quantity </th> <th>Issued Quantity</th> <th>Unit Price</th> </tr></thead> <tbody>';
                let response = data.sc_det;
                let total = 0;
                $.each(response, function(index, value) {
                    res_tr += '<tr>' +
                        '<td>' + value.sp_name + '</td>' +
                        '<td>' + value.allocated_qty + '</td>' +
                        '<td>' + value.issued_qty + '</td>' +
                        '<td style="text-align: right">' + value.unit_price + '</td>' +
                        '</tr>';
                    total += (parseFloat(value.issued_qty)) * ( parseFloat(value.unit_price));
                });
                res_table += res_tr + '</tbody>';

                res_table += '<tfoot>';
                res_table += '<tr> ' +
                    '<td> </td>' +
                    '<td> </td>' +
                    '<th style="text-align: right"> Total </th>' +
                    '<th style="text-align: right"> '+ total.toFixed(2) +' </th>' +
                    '</tr>';
                res_table += '</tfoot>';

                res_table += '</table>';
                res_table += '</div> <hr>' +
                    '<h4> Issued Records </h4>';

                res_table += "<div class='table-responsive mt-3'>" +
                    " ";
                res_table += '<table class="table table-striped table-sm" id="viewTable">';
                let res_tr1 = '<thead><tr><th>Service Item</th> <th> Issued Quantity </th> <th>Unit Price</th> <th>Issued At</th>  </tr></thead> <tbody>';
                let response1 = data.sc;
                $.each(response1, function(index, value) {
                    res_tr1 += '<tr>' +
                        '<td>' + value.name + ' - ' + value.part_no + '</td>' +
                        '<td>' + value.qty + '</td>' +
                        '<td>' + value.unit_price + '</td>' +
                        '<td>' + value.issued_at + '</td>' +
                        '</tr>';
                });
                res_table += res_tr1 + '</tbody> </table>';
                res_table += '</div>';

                let machine_type_name = data.main_data.service_no;
                $('#machine_type_name').html(machine_type_name);

                $("#viewModal .modal-body #viewResponse").html(res_table);
                $('#viewTable').DataTable();

            }
        });
    }


</script>
<?php include "include/footer.php"; ?>
