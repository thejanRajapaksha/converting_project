<?php 
include_once "include/header.php";  
include_once "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav"><?php include_once "include/menubar.php"; ?></div>
        <div id="layoutSidenav_content">
            <main>
                <div class="page-header page-header-light bg-white shadow">
                    <div class="container-fluid">
                        <div class="page-header-content py-3">
                            <h1 class="page-header-title font-weight-light">
                                <div class="page-header-icon"><i class="fas fa-wrench"></i></div>
                                <span>Machine Services</span>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-2p-0 p-2">
                    <div class="card">
                        <div class="card-body p-0 p-2">
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-primary float-right btn-sm" <?php if($addcheck==0){echo 'disabled';} ?> data-toggle="modal" data-target="#addModal">
                                        Add Machine Service
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
                                        <th>Job Type</th>
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
                                    <h5 class="modal-title">Add Machine Service</h5>
                                    <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                </div>

                                <form role="form" action="<?php echo base_url('MachineService/create') ?>" method="post"
                                    id="createForm">

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service_no">Service No</label>
                                                    <input type="text" class="form-control form-control-sm" id="service_no" name="service_no"
                                                        placeholder="Enter Service No" autocomplete="off" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="service_no">Job Type</label>
                                                    <br>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="is_repair" value="0">Service
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="is_repair" value="1">Repair
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="machine_in_id">Machine</label>
                                                    <select class="form-control form-control-sm" id="machine_in_id" name="machine_in_id">
                                                        <option value="">Select...</option>
                                                    </select>
                                                    <div id="machine_in_id_error"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="employee_id">Employee</label>
                                                    <select class="form-control form-control-sm" id="employee_id" name="employee_id">
                                                        <option value="">Select...</option>
                                                    </select>
                                                    <div id="employee_id_error"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="factory_code">Factory Code</label>
                                                    <input type="text" id="factory_code" readonly class="form-control form-control-sm"
                                                        name="factory_code" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="service_date_from">Service Date From</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" id="service_date_from"
                                                        name="service_date_from" placeholder="Enter Date" autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label for="service_date_to">Service Date To</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" id="service_date_to"
                                                        name="service_date_to" placeholder="Enter Date" autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label for="estimated_service_hours">Estimated Hours</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" id="estimated_service_hours"
                                                        name="estimated_service_hours" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="estimated_service_items">Estimated Service Items</label>
                                                            <select class="form-control form-control-sm" id="estimated_service_items" name="estimated_service_items">
                                                            </select>
                                                            <div id="estimated_service_items_error"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="qty">QTY</label>
                                                            <input type="number" id="qty" class="form-control form-control-sm" />
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm mt-2 mb-2 float-right" id="addBtn"> Add </button>
                                                </div>

                                                <div class="form-group table-responsive">
                                                    <table class="table table-sm" id="colorTable">
                                                        <thead>
                                                            <tr>
                                                                <th> Spare Part </th>
                                                                <th> Quantity </th>
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
                                    <h4 class="modal-title">Edit MachineService</h4>
                                    <button type="button" class="close <?php if($editcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                </div>

                                <form role="form" action="<?php echo base_url('MachineServices/update') ?>" method="post"
                                    id="updateForm">

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_service_no">Service No</label>
                                                    <input type="text" class="form-control form-control-sm" id="edit_service_no" name="edit_service_no"
                                                        placeholder="Enter Service No" autocomplete="off" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="service_no">Job Type</label>
                                                    <br>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" id="service" name="is_repair" value="0">Service
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" id="repair" name="is_repair" value="1">Repair
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_machine_in_id">Machine</label>
                                                    <select class="form-control form-control-sm" id="edit_machine_in_id" name="edit_machine_in_id">
                                                        <option value="">Select...</option>
                                                    </select>
                                                    <div id="edit_machine_in_id_error"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_employee_id">Employee</label>
                                                    <select class="form-control form-control-sm" id="edit_employee_id" name="edit_employee_id">
                                                        <option value="">Select...</option>
                                                    </select>
                                                    <div id="edit_employee_id_error"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_factory_code">Factory Code</label>
                                                    <input type="text" id="edit_factory_code" readonly class="form-control form-control-sm"
                                                        name="factory_code" placeholder="">
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_service_date_from">Service Date From</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" id="edit_service_date_from"
                                                        name="edit_service_date_from" placeholder="Enter Date" autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_service_date_to">Service Date To</label>
                                                    <input type="datetime-local" class="form-control form-control-sm" id="edit_service_date_to"
                                                        name="edit_service_date_to" placeholder="Enter Date" autocomplete="off">
                                                </div>

                                                <div class="form-group">
                                                    <label for="edit_estimated_service_hours">Estimated Hours</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm" id="edit_estimated_service_hours"
                                                        name="edit_estimated_service_hours" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="edit_estimated_service_items">Estimated Service Items</label>
                                                            <select class="form-control form-control-sm" id="edit_estimated_service_items" name="edit_estimated_service_items">
                                                            </select>
                                                            <div id="edit_estimated_service_items"></div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="edit_qty">QTY</label>
                                                            <input type="number" id="edit_qty" class="form-control form-control-sm" />
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm mt-2 mb-2 float-right" id="edit_addBtn"> Add </button>
                                                </div>

                                                <div class="form-group table-responsive">
                                                    <table class="table table-sm" id="edit_colorTable">
                                                        <thead>
                                                        <tr>
                                                            <th> Spare Part </th>
                                                            <th> Quantity </th>
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

                    <!-- remove brand modal -->
                    

                <div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Estimated Service Items : <strong> <span id="machine_type_name"></span></strong></h5>
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

    $('#employee_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url: base_url + 'MachineService/get_employee_id_select_id',
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

    $('#estimated_service_items').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url: base_url + 'SpareParts/get_parts_select',
            dataType: 'json',
            delay: 250, // optional: adds a delay for better performance
            data: function (params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        }
    });


    $('#edit_estimated_service_items').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        ajax: {
            url: base_url + 'SpareParts/get_parts_select',
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

    $('#edit_employee_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        ajax: {
            url: base_url + 'MachineService/get_employee_id_select_id',
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

    let colorTable = $('#colorTable').DataTable({searching: false, paging: false, info: false});

    $("#addBtn").on('click', function (e) {
        e.preventDefault();
        let btn = $(this);
        let btn_text = btn.html();

        let sp = $('#estimated_service_items').select2('data');
        let qty = $('#qty').val();

        let sp_id = sp[0].id;
        let sp_text = sp[0].text;

        btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        btn.prop('disabled', true);

        let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + sp_text + '';
        let qty_input = '<input type="number" name="qty[]" class="form-control form-control-sm qty" value="'+qty+'" /> ';

        colorTable.row.add([
            sp_id_input,
            qty_input,
            '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
        ]).draw(false);

        btn.html(btn_text);
        btn.prop('disabled', false);

        $('#estimated_service_items').val('').trigger('change');
        $('#qty').val('');

    });

    $('#colorTable tbody').on('click', '.btn-delete', function () {
        colorTable.row($(this).parents('tr')).remove().draw();
    });

    // initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'MachineService/fetchCategoryData',
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
          colorTable.clear().draw();

          // reset the form
          $("#createForm")[0].reset();
          $('#machine_in_id').val('').trigger('change');
          get_service_no();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              let id = $("#"+index);

                if (index == 'machine_in_id') {
                    id = $("#machine_in_id_error");
                }

                if (index == 'estimated_service_items') {
                    id = $("#estimated_service_items_error");
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
function editFunc(id) {
  Swal.fire({
    title: 'Edit Machine Service?',
    text: 'Do you want to edit this machine service?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, edit',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {

      $('#edit_estimated_service_items').val('').trigger('change');

      let colorTable = $('#edit_colorTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        destroy: true
      });

      colorTable.clear();

      $.ajax({
        url: base_url + 'MachineService/fetchMachineServicesDataById/' + id,
        type: 'post',
        dataType: 'json',
        success: function (data) {
          var response = data.main_data;

          $("#edit_service_no").val(response.service_no);

          let option = new Option(response.s_no, response.machine_in_id, true, true);
          $('#edit_machine_in_id').append(option);
          $('#edit_machine_in_id').trigger('change');

          $("#edit_service_date_from").val(response.service_date_from);
          $("#edit_service_date_to").val(response.service_date_to);
          $("#edit_estimated_service_hours").val(response.estimated_service_hours);

          let is_repair = response.is_repair;
          if (is_repair == 0) {
            $('#service').attr('checked', true);
          } else {
            $('#repair').attr('checked', true);
          }

          var op = data.sc;
          $.each(op, function (key, value) {
            let sp_id = value.id;
            let sp_name = value.name;
            let part_no = value.part_no;
            let qty = value.qty;

            let f = sp_name + ' - ' + part_no;

            let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="' + sp_id + '"/> ' + f;
            let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="' + qty + '" /> ';

            colorTable.row.add([
              sp_id_input,
              qty_input,
              '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
            ]).draw(false);
          });

          $('#edit_colorTable tbody').on('click', '.btn-delete', function () {
            colorTable.row($(this).parents('tr')).remove().draw();
          });

          $("#edit_addBtn").on('click', function (e) {
            e.preventDefault();
            let btn = $(this);
            let btn_text = btn.html();

            let sp = $('#edit_estimated_service_items').select2('data');

            let sp_id = sp[0].id;
            let sp_text = sp[0].text;
            let qty = $('#edit_qty').val();

            btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            btn.prop('disabled', true);

            let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="' + sp_id + '"/> ' + sp_text;
            let qty_input = '<input type="number" name="qty[]" class="form-control form-control-sm qty" value="' + qty + '" /> ';

            colorTable.row.add([
              sp_id_input,
              qty_input,
              '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
            ]).draw(false);

            btn.html(btn_text);
            btn.prop('disabled', false);

            $('#edit_estimated_service_items').val('').trigger('change');
            $('#edit_qty').val('');
          });

          // Only show the modal after data is loaded
          $("#editModal").modal('show');

          // Form submission
          $("#updateForm").unbind('submit').bind('submit', function () {
            var form = $(this);
            $(".text-danger").remove();

            $.ajax({
              url: form.attr('action') + '/' + id,
              type: form.attr('method'),
              data: form.serialize(),
              dataType: 'json',
              success: function (response) {
                manageTable.ajax.reload(null, false);

                if (response.success === true) {
                  $("#editModal").modal('hide');
                  $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                  Swal.fire({
                    icon: 'success',
                    title: 'Updated Successfully!',
                    text: response.messages,
                    timer: 2000,
                    showConfirmButton: false
                  });

                } else {
                  if (response.messages instanceof Object) {
                    $.each(response.messages, function (index, value) {
                      var idField = $("#" + index);
                      if (index == 'edit_estimated_service_items') {
                        idField = $("#edit_estimated_service_items_error");
                      }

                      idField.closest('.form-group')
                        .removeClass('has-error')
                        .removeClass('has-success')
                        .addClass(value.length > 0 ? 'has-error' : 'has-success');

                      idField.after(value);
                    });
                  } else {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Validation Error',
                      text: response.messages
                    });
                  }
                }
              }
            });

            return false;
          });

        }
      });
    }
  });
}


// remove functions 
function removeFunc(id) {
  if (id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This action will permanently delete the service record.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: base_url + 'MachineService/remove',
          type: 'post',
          data: { machine_service_id: id },
          dataType: 'json',
          success: function (response) {
            manageTable.ajax.reload(null, false);

            if (response.success === true) {
              Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: response.messages,
                timer: 2000,
                showConfirmButton: false
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: response.messages
              });
            }
          }
        });
      }
    });
  }
}


function viewFunc(id)
{
    $.ajax({
        url: base_url + 'MachineService/fetchAllocatedServiceItems/'+id,
        type: 'post',
        dataType: 'json',
        success:function(data) {

            let res_table = '<table class="table table-striped table-sm" id="viewTable">';
            let res_tr = '<thead><tr><th>Service Item</th><th>Quantity</th> <th style="text-align: right">Unit Price</th>  </tr></thead> <tbody>';
            let response = data.sc;
            let total = 0;
            $.each(response, function(index, value) {

                res_tr += '<tr>' +
                    '<td>' + value.name + ' - ' + value.part_no +  '</td>' +
                    '<td>' + value.qty + '</td>' +
                    '<td style="text-align: right">' + value.unit_price + '</td>' +
                    '</tr>';
                total = (parseFloat(value.qty)) * (total + parseFloat(value.unit_price));
            });
            res_table += res_tr + '</tbody> ';

            res_table += '<tfoot>';
            res_table += '<tr> ' +
                '<td> </td>' +
                '<th style="text-align: right"> Total </th>' +
                '<th style="text-align: right"> '+ total.toFixed(2) +' </th>' +
                '</tr>';
            res_table += '</tfoot>';

            res_table += '</table>';

            let machine_type_name = data.main_data.service_no;
            $('#machine_type_name').html(machine_type_name);

            $("#viewModal .modal-body #viewResponse").html(res_table);
            $('#viewTable').DataTable({
                    searching: false, paging: false, info: false
            });

        }
    });
}

</script>
<?php include "include/footer.php"; ?>
