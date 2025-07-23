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
                            <div class="page-header-icon"><i class="fas fa-undo-alt"></i></div>
                            <span>Return Items to Supplier</span>
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
                                    New Return
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Is Approved</th>
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
                                <h5 class="modal-title">Return Item to Supplier</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/create_return_to_supplier') ?>" method="post"
                                id="createForm">

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="supplier_id">Supplier</label>
                                                <select class="form-control form-control-sm" id="supplier_id" name="supplier_id">
                                                    <option value="">Select</option>
                                                </select>
                                                <div id="supplier_id_error"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date">Date </label>
                                                <input type="date" class="form-control form-control-sm" id="date" value="<?= Date('Y-m-d') ?>"
                                                    name="date" placeholder="Enter Date" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="item">Item</label>
                                                        <select class="form-control form-control-sm" id="spare_part_id" name="spare_part_id">
                                                        </select>
                                                        <div id="spare_part_id_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="qty">QTY</label>
                                                        <input type="number" name="qty" id="qty" class="form-control form-control-sm qty"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button class="btn btn-primary btn-sm" style="margin-top: 25px;" id="addBtn"> Add </button>
                                                </div>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="remarks">Remarks</label>
                                                <textarea cols="3" class="form-control-sm form-control" name="remarks"></textarea>
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
                                <h4 class="modal-title">Edit Spare Part Return To Supplier</h4>
                                <button type="button" class="close <?php if($editcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/update_return_to_supplier') ?>" method="post"
                                id="updateForm">

                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="edit_supplier_id">Supplier</label>
                                                <select class="form-control form-control-sm" id="edit_supplier_id" name="edit_supplier_id">
                                                    <option value="">Select</option>
                                                </select>
                                                <div id="supplier_id_error"></div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="edit_date">Date </label>
                                                <input type="date" class="form-control form-control-sm" id="edit_date" value="<?= Date('Y-m-d') ?>"
                                                    name="edit_date" placeholder="Enter Date" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="edit_item">Item</label>
                                                        <select class="form-control form-control-sm" id="edit_spare_part_id" name="edit_spare_part_id">
                                                        </select>
                                                        <div id="edit_spare_part_id_error"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="edit_qty">QTY</label>
                                                        <input type="number" name="edit_qty" id="edit_qty" class="form-control form-control-sm edit_qty"/>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button class="btn btn-primary btn-sm" style="margin-top: 25px" id="edit_addBtn"> Add </button>
                                                </div>
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="edit_remarks">Remarks</label>
                                                <textarea cols="3" class="form-control-sm form-control" name="edit_remarks" id="edit_remarks"></textarea>
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
                <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Remove Record?</h4>
                                <button type="button" class="close <?php if($deletecheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form role="form" action="<?php echo base_url('MachineService/remove_return_to_supplier') ?>" method="post"
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
                            <h5 class="modal-title">View Returned Items : <strong> <span id="machine_type_name"></span></strong></h5>
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

    $('#return_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
    $('#collapseLayoutsReturn').addClass('show');

    $('#spare_part_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
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

    $('#supplier_id').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        dropdownParent: $('#addModal'),
        ajax: {
            url: base_url + 'Suppliers/get_suppliers_select',
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

    $('#edit_spare_part_id').select2({
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

    let colorTable = $('#colorTable').DataTable({searching: false, paging: false, info: false});

    $("#addBtn").on('click', function (e) {
        e.preventDefault();
        let btn = $(this);
        let btn_text = btn.html();

        let sp = $('#spare_part_id').select2('data');
        let qty = $('#qty').val();

        let sp_id = sp[0].id;
        let sp_text = sp[0].text;

        btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
        btn.prop('disabled', true);

        let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + sp_text + '';
        let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="'+qty+'" /> ';

        colorTable.row.add([
            sp_id_input,
            qty_input,
            '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
        ]).draw(false);

        btn.html(btn_text);
        btn.prop('disabled', false);

        $('#spare_part_id').val('').trigger('change');
        $('#qty').val('');

    });

    $('#colorTable tbody').on('click', '.btn-delete', function () {
        colorTable.row($(this).parents('tr')).remove().draw();
    });

    // initialize the datatable
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'MachineService/fetchCategoryData_return_to_supplier',
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

                if (index == 'supplier_id') {
                    id = $("#supplier_id_error");
                }

                if (index == 'spare_part_id') {
                    id = $("#spare_part_id_error");
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

    $('#spare_part_id').val('').trigger('change');

    let colorTable = $('#edit_colorTable').DataTable({
        searching: false,
        paging: false,
        info: false,
        destroy:true
    });

    colorTable.clear().draw();

  $.ajax({
    url: base_url + 'MachineService/fetchReturnToSupplierServiceItems/'+id,
    type: 'post',
    dataType: 'json',
    success:function(data) {

        var response = data.main_data;

        let option = new Option(response.suppliername, response.supplier_id, true, true);
        $('#edit_supplier_id').append(option).trigger('change');

        $("#edit_date").val(response.date);
        $("#edit_remarks").val(response.remarks);

        var op = data.sc;

        $.each(op, function(key, value) {
            let sp_id = value.id;
            let sp_name = value.name;
            let part_no = value.part_no;
            let qty = value.qty;

            let f = sp_name + ' - ' + part_no;


            let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + f + '';
            let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="'+qty+'" /> ';

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

            let sp = $('#edit_spare_part_id').select2('data');
            let qty = $('#edit_qty').val();

            let sp_id = sp[0].id;
            let sp_text = sp[0].text;

            btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
            btn.prop('disabled', true);

            let sp_id_input = '<input type="hidden" name="sp_id[]" class="id" value="'+sp_id+'"/> ' + sp_text + '';
            let qty_input = '<input type="text" name="qty[]" class="form-control form-control-sm qty" value="'+qty+'" /> ';

            colorTable.row.add([
                sp_id_input,
                qty_input,
                '<button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash text-white"></i></button>'
            ]).draw(false);

            btn.html(btn_text);
            btn.prop('disabled', false);

            $('#edit_spare_part_id').val('').trigger('change');
            $('#edit_qty').val('')

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
                    if (index == 'edit_spare_part_id') {
                        id = $("#edit_spare_part_id_error");
                    }
                    if (index == 'edit_supplier_id') {
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
        data: { machine_service_id:id },
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

function viewFunc(id)
{
    $.ajax({
        url: base_url + 'MachineService/fetchReturnToSupplierServiceItems/'+id,
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
                total += (parseFloat(value.qty)) * ( parseFloat(value.unit_price));
            });
            res_table += res_tr + '</tbody>';

            res_table += '<tfoot>';
            res_table += '<tr> ' +
                '<td> </td>' +
                '<th style="text-align: right"> Total </th>' +
                '<th style="text-align: right"> '+ total.toFixed(2) +' </th>' +
                '</tr>';
            res_table += '</tfoot>';

            res_table += '</table>';

            let machine_type_name = data.main_data.suppliername;
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
