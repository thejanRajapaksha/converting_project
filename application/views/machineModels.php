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
                            <span>Machine Models</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#addModal" <?php if($addcheck==0){echo 'disabled';}?>>Add Machine Model</button>
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Machine Model name</th>
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
            <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add MachineModel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
                </div>

                <form role="form" action="<?php echo base_url('MachineModels/create') ?>" method="post" id="createForm">

                    <div class="modal-body">

                    <div class="form-group">
                        <label for="brand_name">MachineModel Name</label>
                        <input type="text" class="form-control form-control-sm" id="machine_model_name" name="machine_model_name" placeholder="Enter MachineModel name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="active">Status</label>
                        <select class="form-control form-control-sm" id="active" name="active">
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

            <!-- edit brand modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit MachineModel</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
                </div>

                <form role="form" action="<?php echo base_url('MachineModels/update') ?>" method="post" id="updateForm">

                    <div class="modal-body">
                    <div id="messages"></div>

                    <div class="form-group">
                        <label for="brand_name">MachineModel Name</label>
                        <input type="text" class="form-control form-control-sm" id="edit_machine_model_name" name="edit_machine_model_name" placeholder="Enter MachineModel name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="active">Status</label>
                        <select class="form-control form-control-sm" id="edit_active" name="edit_active">
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
  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'MachineModels/fetchCategoryData',
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
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

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
    title: 'Are you sure?',
    text: "Do you want to edit this machine model?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, edit it',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        url: base_url + 'MachineModels/fetchMachineModelsDataById/' + id,
        type: 'post',
        dataType: 'json',
        success: function (response) {

          $("#edit_machine_model_name").val(response.name);
          $("#edit_active").val(response.active);
          $("#editModal").modal('show');

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
                  Swal.fire('Updated!', response.messages, 'success');
                  $("#editModal").modal('hide');
                  $("#updateForm .form-group").removeClass('has-error has-success');
                } else {
                  if (response.messages instanceof Object) {
                    $.each(response.messages, function (index, value) {
                      var id = $("#" + index);
                      id.closest('.form-group')
                        .removeClass('has-error has-success')
                        .addClass(value.length > 0 ? 'has-error' : 'has-success');
                      id.after(value);
                    });
                  } else {
                    Swal.fire('Warning', response.messages, 'warning');
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
  Swal.fire({
    title: 'Are you sure?',
    text: "This will permanently delete the machine model!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
    confirmButtonColor: '#e3342f'
  }).then((result) => {
    if (result.isConfirmed) {

      $.ajax({
        url: base_url + 'MachineModels/remove', // adjust URL if needed
        type: 'post',
        data: { machine_model_id: id },
        dataType: 'json',
        success: function (response) {
          manageTable.ajax.reload(null, false);

          if (response.success === true) {
            Swal.fire('Deleted!', response.messages, 'success');
          } else {
            Swal.fire('Error!', response.messages, 'error');
          }

          // hide the modal if using it for fallback
          $("#removeModal").modal('hide');
        }
      });

    }
  });
}


</script>
<?php include "include/footer.php"; ?>
