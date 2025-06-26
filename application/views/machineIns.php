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
                            <div class="page-header-icon"><i class="fas fa-cogs"></i></div>
                            <span>Machine In</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#addModal" <?php if($addcheck==0){echo 'disabled';} ?>>
                                    Add Machine In
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
                                    <th>Model</th>
                                    <th>S NO</th>
                                    <th>Bar Code</th>
                                    <th>Next Service Date</th>
                                    <th>Origin Date</th>
                                    <th>Reference</th>
                                    <th>Status</th>
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
                <div class="modal fade fullscreen" tabindex="-1" role="dialog" id="addModal">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Machine In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form role="form" action="<?php echo base_url('MachineIn/create') ?>" method="post" id="createForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="machine_type_id">Machine Type <span class="text-danger">*</span></label>
                                        <select name="machine_type_id" id="machine_type_id" class="select2 form-control-sm">
                                            <option value="">Select</option>
                                            <?php foreach ($machine_types as $machine_type): ?>
                                                <option value="<?php echo $machine_type['id']; ?>">
                                                    <?php echo $machine_type['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="machine_type_id_error"></div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="machine_model_id">Machine Model <span class="text-danger">*</span></label>
                                        <select name="machine_model_id" id="machine_model_id" class="select2 form-control-sm">
                                            <<option value="">Select</option>
                                            <?php foreach ($machine_models as $machine_model): ?>
                                                <option value="<?php echo $machine_model['id']; ?>">
                                                    <?php echo $machine_model['name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div id="machine_model_id_error"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="s_no">S NO <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="s_no" name="s_no" placeholder="Enter S NO">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="bar_code">Bar Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="bar_code" name="bar_code" placeholder="Enter Bar Code">
                                    </div>
                                </div>

                                <div class="row">
                                    <input type="hidden" name="in_type_id" id="in_type_id" value="1">

                                    <div class="col-md-6 form-group">
                                        <label for="next_service_date">Next Service Date</label>
                                        <input type="date" class="form-control form-control-sm" id="next_service_date" name="next_service_date" placeholder="Enter Next Service Date">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="origin_date">Origin Date</label>
                                        <input type="date" class="form-control form-control-sm" id="origin_date" name="origin_date" placeholder="Enter Origin Date">
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="reference">Reference <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-sm" id="reference" name="reference" placeholder="Enter Reference"></textarea>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="active">Status <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="active" name="active">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
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
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Machine In</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineIn/update') ?>" method="post" id="updateForm">

                                <div class="modal-body">
                                    <div id="messages"></div>

                                    <div class="form-group">
                                        <label for="edit_machine_type_id">Machine Type <span class="text-danger">*</span> </label>
                                        <select name="machine_type_id" id="edit_machine_type_id" class="select2 form-control-sm">
                                            <option value="">Select Machine Type</option>
                                            <?php if (!empty($machine_types) && is_array($machine_types)): ?>
                                                <?php foreach ($machine_types as $machine_type): ?>
                                                    <option value="<?php echo $machine_type['id']; ?>">
                                                        <?php echo $machine_type['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div id="edit_machine_type_id_error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_machine_model_id">Machine Model <span class="text-danger">*</span></label>
                                        <select name="machine_model_id" id="edit_machine_model_id" class="select2 form-control-sm">
                                            <option value="">Select Machine Model</option>
                                            <?php if (!empty($machine_models) && is_array($machine_models)): ?>
                                                <?php foreach ($machine_models as $machine_model): ?>
                                                    <option value="<?php echo $machine_model['id']; ?>">
                                                        <?php echo $machine_model['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <div id="edit_machine_model_id_error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_s_no">S NO <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="edit_s_no" name="s_no" placeholder="Enter S NO">
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_bar_code">Bar Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="edit_bar_code" name="bar_code" placeholder="Enter Bar Code">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="in_type_id" id="in_type_id" value="1">
                                    </div>

                                    <div class="form-group">
                                        <label for="next_service_date">Next Service Date</label>
                                        <input type="date" class="form-control form-control-sm" id="edit_next_service_date" name="next_service_date" placeholder="Enter Next Service Date">
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_origin_date">Origin Date</label>
                                        <input type="date" class="form-control form-control-sm" id="edit_origin_date" name="origin_date" placeholder="Enter Origin Date">
                                    </div>


                                    <div class="form-group">
                                        <label for="edit_reference">Reference <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-sm" id="edit_reference" name="reference" placeholder="Enter Reference"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_active">Status</label>
                                        <select class="form-control form-control-sm" id="edit_active" name="active">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
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
                                <h4 class="modal-title">Remove Machine In</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineIn/remove') ?>" method="post" id="removeForm">
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

    $('.select2').select2({
        placeholder: 'Select an option',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#addModal'),
    });

    $('#editModal').on('shown.bs.modal', function () {
        $('#edit_machine_type_id, #edit_machine_model_id').select2({
            width: '100%'
        });
    });

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'MachineIn/fetchCategoryData',
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

          $('#machine_type_id').val('').trigger('change');
          $('#machine_model_id').val('').trigger('change');
          $('#in_type_id').val('1');

          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
                let id = $("#"+index);
                if (index == 'machine_type_id'){
                    id = $("#machine_type_id_error");
                }

                if (index == 'machine_model_id'){
                    id = $("#machine_model_id_error");
                }

                if (index == 'in_type_id'){
                    id = $("#in_type_id_error");
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
  $.ajax({
    url: base_url + 'MachineIn/fetchMachineInsDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_machine_model_id").val(response.machine_model_id).trigger('change');
      $("#edit_machine_type_id").val(response.machine_type_id).trigger('change');
      $("#edit_s_no").val(response.s_no);
      $("#edit_bar_code").val(response.bar_code);
      $("#edit_in_type_id").val(response.in_type_id).trigger('change');
      $("#next_service_date").val(response.next_service_date);
      $("#edit_origin_date").val(response.origin_date);
      $("#edit_reference").val(response.reference);
      $("#edit_active").val(response.active);


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

                    if (index == 'machine_type_id'){
                        id = $("#edit_machine_type_id_error");
                    }

                    if (index == 'machine_model_id'){
                        id = $("#edit_machine_model_id_error");
                    }

                    if (index == 'in_type_id'){
                        id = $("#edit_in_type_id_error");
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
        data: { machine_in_id:id },
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
