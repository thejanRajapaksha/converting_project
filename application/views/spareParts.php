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
            <div class="container-fluid mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="">Spare Parts</h2>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#addModal" <?php if($addcheck==0){echo 'disabled';} ?>>Add Spare Part</button>
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm" width="100%">
                                <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Spare Part name</th>
                                    <th>Model</th>
                                    <th>Type</th>
                                    <th>Supplier</th>
                                    <th>Part No</th>
                                    <th>Rack No</th>
                                    <th>Unit Price</th>
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
                    <h5 class="modal-title">Add SparePart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
                </div>

                <form role="form" action="<?php echo base_url('SpareParts/create') ?>" method="post" id="createForm">

                    <div class="modal-body">

                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span> </label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter SparePart name" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="machine_type_id">Machine Type <span class="text-danger">*</span></label>
                        <select class="form-control form-control-sm" name="machine_type_id" id="machine_type_id">
                            <option value="">Select Machine</option>
                        </select>
                        <div id="machine_type_id_error"></div>
                    </div>

                        <div class="form-group">
                            <label for="machine_model_id">Machine Model <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="machine_model_id" id="machine_model_id">
                                <option value="">Select Machine</option>
                            </select>
                            <div id="machine_model_id_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="part_no">Part No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="part_no" name="part_no" placeholder="Enter Part No" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="rack_no">Rack No </label>
                            <input type="text" class="form-control form-control-sm" id="rack_no" name="rack_no" placeholder="Enter Rack No" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="unit_price">Unit Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control form-control-sm" id="unit_price" name="unit_price" placeholder="Enter Unit Price" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="supplier_id[]" id="supplier_id">
                            </select>
                            <div id="supplier_id_error"></div>
                        </div>

                    <div class="form-group">
                            <label for="machine_model_id">Select Status <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="active" id="active">
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
                            </select>
                            <!-- <div id="machine_model_id_error"></div> -->
                        <!-- <input type="hidden" name="active" id="active" value="1"> -->
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
                    <h4 class="modal-title">Edit SparePart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
                </div>

                <form role="form" action="<?php echo base_url('SpareParts/update') ?>" method="post" id="updateForm">

                    <div class="modal-body">
                    <div id="messages"></div>

                    <div class="form-group">
                        <label for="edit_name">Spare Part Name</label>
                        <input type="text" class="form-control form-control-sm" id="edit_name" name="edit_name" placeholder="Enter SparePart name" autocomplete="off">
                    </div>

                        <div class="form-group">
                            <label for="edit_machine_type_id">Machine Type <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="edit_machine_type_id" id="edit_machine_type_id">
                                <option value="">Select Machine</option>
                            </select>
                            <div id="edit_machine_type_id_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="edit_machine_model_id">Machine Model <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="edit_machine_model_id" id="edit_machine_model_id">
                                <option value="">Select Machine</option>
                            </select>
                            <div id="edit_machine_model_id_error"></div>
                        </div>

                        <div class="form-group">
                            <label for="edit_part_no">Part No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="edit_part_no" name="edit_part_no" placeholder="Enter Part No" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="edit_rack_no">Rack No </label>
                            <input type="text" class="form-control form-control-sm" id="edit_rack_no" name="edit_rack_no" placeholder="Enter Rack No" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="edit_unit_price">Unit Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control form-control-sm" id="edit_unit_price" name="edit_unit_price" placeholder="Enter Unit Price" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="edit_supplier_id">Supplier <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="edit_supplier_id[]" id="edit_supplier_id">
                            </select>
                            <div id="edit_supplier_id_error"></div>
                        </div>

                    <div class="form-group">
                    <label for="machine_model_id">Select Status <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="edit_active" id="edit_active">
                            <option value="1">Active</option>
                            <option value="2">In Active</option>
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
                    <h4 class="modal-title">Remove SparePart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
                </div>

                <form role="form" action="<?php echo base_url('SpareParts/remove') ?>" method="post" id="removeForm">
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

    var manageTable = $('#manageTable').DataTable({
        "destroy": true,
        "processing": true,
        "serverSide": true,

        ajax: {
            url: "<?php echo base_url() ?>scripts/sparepartslist.php",
            type: "POST", // you can use GET
        },
        "order": [
            [0, "desc"]
        ],
        "columns": [
        {
            "className": 'd-none',
            "data": "id"
        },
        {
            "data": "name"
        },
        {
            "data": "machine_models"
        },
        {
            "data": "machine_types"
        },
        {
          "data": "suppliername",
          "render": function(data, type, row) {
              return '<span class="badge badge-info">' + row.suppliername + '</span>';
          }
        },
        {
            "data":  "part_no"
        },
        {
            "data":  "rack_no"
        },
        {
            "data":  "unit_price"
        },
        {
            "data": "active",
            "render": function(data, type, row) {
                return (data == 1) 
                    ? '<span class="badge badge-success">Active</span>' 
                    : '<span class="badge badge-warning">Inactive</span>';
            }
        },
        {
            "targets": -1,
            "className": 'text-right',
            "data": null,
            "render": function(data, type, full) {
                var button = '';

                // Edit button with permission check
                button += '<button type="button" class="btn btn-default btn-sm btnEdit mr-1 ';
                if (editcheck != 1) { button += 'd-none'; }
                button += '" onclick="editFunc(' + full['id'] + ')" data-toggle="modal" data-target="#editModal">' +
                        '<i class="text-primary fa fa-edit"></i></button>';

                // Delete button with permission check
                button += '<button type="button" class="btn btn-default btn-sm ';
                if (deletecheck != 1) { button += 'd-none'; }
                button += '" onclick="removeFunc(' + full['id'] + ')" data-toggle="modal" data-target="#removeModal">' +
                        '<i class="text-danger fa fa-trash"></i></button>';

                return button;
            }
        }

        ],
            drawCallback: function (settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
		});

    $('#machine_type_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url:  base_url + 'MachineTypes/get_machine_types_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });

    $('#machine_model_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url:  base_url + 'MachineModels/get_machine_models_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });

    $('#supplier_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        multiple: true,
        ajax: {
            url:  base_url + 'Suppliers/get_suppliers_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });

    $('#edit_machine_type_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        ajax: {
            url:  base_url + 'MachineTypes/get_machine_types_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });

    $('#edit_machine_model_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        ajax: {
            url:  base_url + 'MachineModels/get_machine_models_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });

    $('#edit_supplier_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#editModal'),
        multiple: true,
        ajax: {
            url:  base_url + 'Suppliers/get_suppliers_select',
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });




  // // initialize the datatable 
  // manageTable = $('#manageTable').DataTable({
  //   'ajax': base_url + 'SpareParts/fetchCategoryData',
  //   'order': []
  // });

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

                if (index == 'machine_type_id'){
                    id = $("#machine_type_id_error");
                }

                if (index == 'machine_model_id'){
                    id = $("#machine_model_id_error");
                }

                if (index == 'supplier_id'){
                    id = $("#supplier_id_error");
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
    $('#edit_supplier_id').val('').trigger('change');
  $.ajax({
    url: base_url + 'SpareParts/fetchSparePartsDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(data) {

        let response = data.main_data;

      $("#edit_name").val(response.name);
      $("#edit_active").val(response.active);
      $("#edit_part_no").val(response.part_no);
      $("#edit_rack_no").val(response.rack_no);
      $("#edit_unit_price").val(response.unit_price);

        let optionSection3 = new Option(response.machine_type_name, response.type, true, true);
        $('#edit_machine_type_id').append(optionSection3).trigger('change');

        let optionSection4 = new Option(response.machine_model, response.model, true, true);
        $('#edit_machine_model_id').append(optionSection4).trigger('change');

        var op = data.sc;

        $.each(op, function(key, value) {
            let supplier_id = value.id;
            let supplier_name = value.sup_name;

            let optionSection5 = new Option(supplier_name, supplier_id, true, true);
            $('#edit_supplier_id').append(optionSection5).trigger('change');
        });

      // submit the edit from 
      // $("#updateForm").unbind('submit').bind('submit', function()
      $("#updateForm").off('submit').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success: function(response) {

          //   manageTable.ajax.reload(null, false); 

          //   if(response.success === true) {
              // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              // '</div>');
          if (response.success === true) {
                        // Reload DataTable
                        if ($.fn.DataTable.isDataTable("#manageTable")) {
                            $("#manageTable").DataTable().ajax.reload(null, false);
                        }


              // hide the modal
              $("#editModal").modal('hide');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                    if (index == 'edit_machine_type_id'){
                        id = $("#edit_machine_type_id_error");
                    }

                    if (index == 'edit_machine_model_id'){
                        id = $("#edit_machine_model_id_error");
                    }

                    if (index == 'edit_supplier_id'){
                        id = $("#edit_supplier_id_error");
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
function removeFunc(id) {
    if (id) {
        $("#removeForm").off('submit').on('submit', function(e) {
            e.preventDefault();

            console.log("Deleting ID:", id);

            var form = $(this);
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { machine_type_id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success === true) {
                        // Reload DataTable
                        if ($.fn.DataTable.isDataTable("#manageTable")) {
                            $("#manageTable").DataTable().ajax.reload(null, false);
                        }

                        // Hide the modal
                        $("#removeModal").modal('hide');
                        $(".modal-backdrop").remove();

                        // Show success message
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span></button>'+
                            '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> ' + response.messages +
                        '</div>');
                    } else {
                        $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span></button>'+
                            '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong> ' + response.messages +
                        '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });
    }
}

</script>
<?php include "include/footer.php"; ?>
