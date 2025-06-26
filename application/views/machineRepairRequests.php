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
                                <div class="page-header-icon"><i class="fas fa-tools"></i></div>
                                <span>Machine Repair Requests</span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2p-0 p-2">
                    <div class="card">
                        <div class="card-body p-0 p-2">
                            <div class="row">
                                <div class="col">
                                <button class="btn btn-primary float-right btn-sm <?php if($addcheck==0){echo 'disabled';} ?>" data-toggle="modal" data-target="#addModal">
                                    Add Machine Repair Request
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Machine Type</th>
                                    <th>Bar Code</th>
                                    <th>Serial No</th>
                                    <th>Repair Request Date</th>
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Machine RepairRequest</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineRepairRequests/create') ?>" method="post"
                                id="createForm">

                                <div class="modal-body">

            <!--                        <div class="form-group">-->
            <!--                            <label for="service_no">RepairRequest No</label>-->
            <!--                            <input type="text" class="form-control form-control-sm" id="service_no" name="service_no"-->
            <!--                                   placeholder="Enter RepairRequest No" autocomplete="off" readonly>-->
            <!--                        </div>-->

                                    <div class="form-group">
                                        <label for="machine_in_id">Machine</label>
                                        <select class="form-control form-control-sm" id="machine_in_id" name="machine_in_id">
                                            <option value="">Select...</option>
                                        </select>
                                        <div id="machine_in_id_error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="factory_code">Factory Code</label>
                                        <input type="text" id="factory_code" readonly class="form-control form-control-sm"
                                            name="factory_code" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="repair_date">Repair Request Date</label>
                                        <input type="date" class="form-control form-control-sm" id="repair_date"
                                            name="repair_date" placeholder="Enter Date" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label for="item_list">Request Item List</label>
                                        <input type="textarea" class="form-control form-control-sm" id="item_list"
                                            name="item_list" placeholder="Request Ite List..." autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <input type="textarea" class="form-control form-control-sm" id="comment"
                                            name="comment" placeholder="Comment..." autocomplete="off">
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Machine RepairRequest</h4>
                                <button type="button" class="close <?php if($editcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineRepairRequests/update') ?>" method="post"
                                id="updateForm">

                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="edit_machine_in_id">Machine</label>
                                        <select class="form-control form-control-sm" id="edit_machine_in_id" name="edit_machine_in_id">
                                            <option value="">Select...</option>
                                        </select>
                                        <div id="edit_machine_in_id_error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_factory_code">Factory Code</label>
                                        <input type="text" id="edit_factory_code" readonly class="form-control form-control-sm"
                                            name="factory_code" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_service_date">Repair Request Date</label>
                                        <input type="date" class="form-control form-control-sm" id="edit_repair_date"
                                            name="edit_repair_date" placeholder="Enter Date" autocomplete="off">
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
                                <h4 class="modal-title">Remove Machine Repair Request</h4>
                                <button type="button" class="close <?php if($deletecheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineRepairRequests/remove') ?>" method="post"
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

                <!-- create brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="repairAddModal">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Repair Details</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">

                                <div class="row mb-4">
            <!--                        <div class="col-sm-3">-->
            <!--                            <label for="service_date">Service No :</label>-->
            <!--                            <span id="service_no_span"></span>-->
            <!--                        </div>-->
                                    <div class="col-sm-3">
                                        <label for="service_date">Machine Type :</label>
                                        <span id="machine_type_span"></span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <form method="post" id="service_item_add_form">
                                            <div class="form-group">
                                                <label for="service_item_id">Service Item</label>
                                                <select class="form-control form-control-sm" id="service_item_id"
                                                        name="service_item_id" required>
                                                    <option value="">Select...</option>
                                                </select>
                                                <div id="service_item_id_error"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" class="form-control form-control-sm" id="quantity"
                                                    name="quantity" step="0.01"
                                                    placeholder="Quantity" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control form-control-sm" id="price" name="price"
                                                    step="0.01"
                                                    placeholder="Price" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-success float-right"
                                                        id="btn_add_service_item">Add
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Repair Detail</h5>
                                        <hr>
                                        <div id="modal_msg"></div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm" id="service_detail_table">
                                                <thead>
                                                <tr>
                                                    <th>Service Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right"><label> Sub Total</label></td>
                                                    <td id="sub_total"></td>
                                                    <td></td>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="repair_done_by">Repair Done By</label>
                                                    <select class="form-control form-control-sm" id="repair_done_by" name="repair_done_by"
                                                            required>
                                                        <option value="">Select...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="repair_charge">Repair Charge</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                                        id="repair_charge"
                                                        name="repair_charge" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="transport_charge">Transport Charge</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                                        id="transport_charge"
                                                        name="transport_charge" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="repair_type">Repair Type</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="repair_type"
                                                            id="repair_type_inside" value="inside" checked>
                                                        <label class="form-check-label" for="repair_type_inside">Inside</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="repair_type"
                                                            id="repair_type_outside" value="outside">
                                                        <label class="form-check-label" for="repair_type_outside">Outside</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="remarks">Remarks</label>
                                                    <textarea class="form-control form-control-sm" id="remarks" name="remarks"
                                                            placeholder="Remarks"></textarea>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm" id="save_btn">Save changes</button>
                            </div>


                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- create brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="postponeModal">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Postpone Repair</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form method="post" id="postpone_repair_form">

                                <div class="modal-body">

                                    <div class="row mb-4">
            <!--                            <div class="col-sm-6">-->
            <!--                                <label for="service_date">Service No :</label>-->
            <!--                                <span id="postpone_service_no_span"></span>-->
            <!--                            </div>-->
                                        <div class="col-sm-12">
                                            <label for="service_date">Machine Type :</label>
                                            <span id="postpone_machine_type_span"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="repair_in_date">Repair In Date</label>
                                        <input type="date" class="form-control form-control-sm" id="repair_in_date"
                                            name="repair_in_date"
                                            placeholder="Repair In Date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <textarea class="form-control form-control-sm" id="reason" name="reason"
                                                placeholder="Reason" required></textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="postpne_save_btn">Save changes</button>
                                </div>

                            </form>


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
    var addcheck='<?php echo $addcheck; ?>';
    var editcheck='<?php echo $editcheck; ?>';
    var statuscheck='<?php echo $statuscheck; ?>';
    var deletecheck='<?php echo $deletecheck; ?>';

    $('#machine_repair_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
    $('#collapseLayoutsMachineRepairs').addClass('show');

    get_service_no();

    function get_service_no(){
        $.ajax({
            url: base_url + 'MachineService/getServiceNo',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                $('#service_no').val(response);
            }
        });
    }

    $('#machine_in_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url: base_url + 'MachineIn/get_machine_ins_select_id',
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

    $('#edit_machine_in_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        ajax: {
            url: base_url + 'MachineIn/get_machine_ins_select_id',
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

    //machine_in_id change event get factory code for machine_in_id from machine_ins table
    $('#machine_in_id').on('change', function() {
        var machine_in_id = $(this).val();
        if (machine_in_id) {
            $.ajax({
                url: base_url + 'MachineIn/getFactoryCodeByMachineInId',
                type: 'POST',
                data: {
                    machine_in_id: machine_in_id
                },
                dataType: 'json',
                success: function(response) {
                    $('#factory_code').val(response);
                }
            });
        }
    });

    $('#edit_machine_in_id').on('change', function() {
        var machine_in_id = $(this).val();
        if (machine_in_id) {
            $.ajax({
                url: base_url + 'MachineIn/getFactoryCodeByMachineInId',
                type: 'POST',
                data: {
                    machine_in_id: machine_in_id
                },
                dataType: 'json',
                success: function(response) {
                    $('#edit_factory_code').val(response);
                }
            });
        }
    });

    // initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'MachineRepairRequests/fetchCategoryData',
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
          $('#machine_in_id').val('').trigger('change');
          get_service_no();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              let id = $("#"+index);

                if (index == 'buyer_id') {
                    id = $("#buyer_id_error");
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

    $(document).on('click', '.repair_add_btn', function() {

        let id = $(this).data('id');
        //let service_no = $(this).data('service_no');
        let machine_type_name = $(this).data('machine_type_name');

        //$('#service_no_span').html(service_no);
        $('#machine_type_span').html(machine_type_name);

        //save_btn click event
        $('#save_btn').on('click', function() {
            let repair_details = [];
            $('#service_detail_table tbody tr').each(function(index, element) {
                let repair_detail = {};
                repair_detail.repair_id = id;
                repair_detail.repair_item_name = $(element).find('td:eq(0)').text();
                repair_detail.quantity = $(element).find('td:eq(1)').text();
                repair_detail.price = $(element).find('td:eq(2)').text();
                repair_detail.total = $(element).find('td:eq(3)').text();
                repair_details.push(repair_detail);
            });
            let sub_total = $('#sub_total').text();
            let repair_done_by = $('#repair_done_by').val();
            let repair_charge = $('#repair_charge').val();
            let transport_charge = $('#transport_charge').val();
            let repair_type = $('input[name=repair_type]:checked').val();
            let remarks = $('#remarks').val();

            $('#modal_msg').html('');

            if(repair_details.length == 0){
                //modal_msg
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Please Add at least one Item'
                    +
                    '</div>');
                return false;
            }
            if(repair_done_by == ''){
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Repair Done By required'
                    +
                    '</div>');
                return false;
            }

            if(repair_charge == ''){
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Repair Charge required'
                    +
                    '</div>');
                return false;
            }

            if(transport_charge == ''){
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Transport Charge required'
                    +
                    '</div>');
                return false;
            }

            if(repair_type == ''){
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Repair Type required'
                    +
                    '</div>');
                return false;
            }

            if(remarks == ''){
                $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                    'Remarks required'
                    +
                    '</div>');
                return false;
            }

            $.ajax({
                url: base_url + 'MachineRepairs/createRepair',
                type: 'POST',
                data: {
                    repair_details: repair_details,
                    sub_total: sub_total,
                    repair_done_by: repair_done_by,
                    repair_charge: repair_charge,
                    transport_charge: transport_charge,
                    repair_type: repair_type,
                    remarks: remarks,
                    repair_request_id: id
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        $('#repairAddModal').modal('hide');
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
                        $("#service_detail_table tbody").empty();
                        $('#sub_total').val('');
                        $('#repair_done_by').val('');
                        $('#repair_charge').val('');
                        $('#transport_charge').val('');
                        $('#remarks').val('');
                        $('input[name=repair_type]').attr('checked',false);

                        //reload page after 2 second
                        setTimeout(function() {
                            location.reload();
                        }, 2000);

                    }
                }
            });

        });

    });

    $('#repair_done_by').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#repairAddModal'),
        ajax: {
            url: base_url + 'MachineServicesCalendar/get_employees_select',
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

    $('#service_item_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#repairAddModal'),
        ajax: {
            url: base_url + 'ServiceItems/get_items_select',
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

    //service_item_id change event
    $('#service_item_id').on('change', function() {
        let service_item_id = $(this).val();
        $.ajax({
            url: base_url + 'ServiceItems/get_service_item_price',
            type: 'POST',
            data: {
                service_item_id: service_item_id
            },
            dataType: 'json',
            success: function(response) {
                $('#price').val(response);
            }
        });
    });

    $('#service_item_add_form').on('submit', function(event) {
        event.preventDefault();
        let service_item_id = $('#service_item_id').val();
        let service_item_name = $('#service_item_id option:selected').text();
        let price = $('#price').val();
        let qty = $('#quantity').val();
        let total = price * qty;
        total = total.toFixed(2);
        let service_item_row = '<tr>' +
            '<td>' + service_item_name + '</td>' +
            '<td>' + qty + '</td>' +
            '<td>' + price + '</td>' +
            '<td>' + total + '</td>' +
            '<td><button class="btn btn-danger btn-sm btn_remove_service_item" data-id="' + service_item_id + '"><i class="fa fa-trash"></i></button></td>' +
            '</tr>';
        $('#service_detail_table tbody').append(service_item_row);
        $('#service_item_id').val('').trigger('change');
        $('#price').val('');
        $('#quantity').val('');
        calculate_sub_total();
    });

    $(document).on('click', '.btn_remove_service_item', function() {
        $(this).closest('tr').remove();
        calculate_sub_total();
    });

    function calculate_sub_total(){
        let sub_total = 0;
        $('#service_detail_table tbody tr').each(function(index, element) {
            sub_total += parseFloat($(element).find('td:eq(3)').text());
        });
        sub_total = sub_total.toFixed(2);
        $('#sub_total').html(sub_total);
    }

    $(document).on('click', '.btn_postpone', function() {

        let id = $(this).data('id');
        let machine_type_name = $(this).data('machine_type_name');

        $('#postpone_machine_type_span').html(machine_type_name);

        $('#postponeModal').modal('show');

        $('#postpone_repair_form').on('submit', function(event) {
            event.preventDefault();
            let repair_in_date = $('#repair_in_date').val();
            let reason = $('#reason').val();
            $.ajax({
                url: base_url + 'MachineRepairs/postponeRepair',
                type: 'POST',
                data: {
                    id: id,
                    repair_in_date: repair_in_date,
                    reason: reason
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        $('#postponeModal').modal('hide');
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                            '</div>');
                        $('#repair_in_date').val('');
                        $('#reason').val('');
                        //refresh page after 3 seconds
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    }
                }
            });
        });

    });

});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'MachineRepairRequests/fetchMachineRepairRequestsDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

        let option = new Option(response.s_no, response.machine_in_id, true, true);
        $('#edit_machine_in_id').append(option);
        $('#edit_machine_in_id').trigger('change');

        $("#edit_repair_date").val(response.repair_in_date);

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
                  var id = $("#edit_"+index);
                    if (index == 'edit_machine_in_id') {
                        id = $("#edit_machine_in_id_error");
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

    }
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
        data: { machine_repair_id:id },
        dataType: 'json',
        success:function(response) {

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
<?php include "include/footer.php"; ?>
