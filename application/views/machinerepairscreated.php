
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
                    <span>Machine Repairs Created</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 p-2">
        <div class="card">
            <div class="card-body p-2">
                <!-- Filter Form -->
                <form id="filterForm">
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Status</label>
                            <select class="form-control form-control-sm" id="status_filter" name="status">
                                <option value="">Select...</option>
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Repair Type</label>
                            <select class="form-control form-control-sm" id="repair_type_filter" name="repair_type">
                                <option value="">Select...</option>
                                <option value="inside">Inside</option>
                                <option value="outside">Outside</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Machine Type</label>
                            <select class="form-control form-control-sm" id="machine_type_filter" name="machine_type">
                                <option value="">Select...</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Serial No</label>
                            <select class="form-control form-control-sm" id="s_no_filter" name="s_no">
                                <option value="">Select...</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Date From</label>
                            <input type="date" class="form-control form-control-sm" id="date_from_filter" name="date_from">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Date To</label>
                            <input type="date" class="form-control form-control-sm" id="date_to_filter" name="date_to">
                        </div>
                        <div class="col-md-3 mb-2 align-self-end">
                            <button type="button" class="btn btn-primary btn-sm w-100" id="filter_button">Filter</button>
                        </div>
                    </div>
                </form>

                <div id="messages" class="mt-2"></div>

                <!-- Table -->
                <div class="table-responsive mt-3">
                    <table id="manageTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Machine Type</th>
                                <th>BarCode</th>
                                <th>Serial No</th>
                                <th>Repair Date</th>
                                <th>Repair Type</th>
                                <th>Sub Total</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Repair Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-sm-3">
                            <label>Machine Type :</label>
                            <span id="view_machine_type_span"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Repair Detail</h5>
                            <hr>
                            <div id="modal_msg"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm" id="view_service_detail_table">
                                    <thead>
                                        <tr>
                                            <th>Service Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" align="right"><label>Sub Total</label></td>
                                            <td align="right" id="sub_total_span"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Repair Done By :</label>
                                    <span id="repair_done_by_span"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label>Repair Charge :</label>
                                    <span id="repair_charge_span"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label>Transport Charge :</label>
                                    <span id="transport_charge_span"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label>Repair Type :</label>
                                    <span id="repair_type_span"></span>
                                </div>
                                <div class="col-sm-6">
                                    <label>Remarks :</label>
                                    <span id="remarks_span"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
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

$(document).ready(function() {

    $('#rpt_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
    $('#collapseLayoutsRPT').addClass('show');

    $('.select2').select2({
        placeholder: 'Select...',
        allowClear: true
    });

    $('#machine_type_filter').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        ajax: {
            url: base_url + 'MachineRepairsCreated/get_machine_types_select',
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

    $('#s_no_filter').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        ajax: {
            url: base_url + 'MachineRepairsCreated/get_machine_ins_select',
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


    //filter_button click event
    $('#filter_button').click(function() {
        load_dt();
    });

    // initialize the datatable
    load_dt();

    function load_dt(){

        let status = $('#status_filter').val();
        let repair_type = $('#repair_type_filter').val();
        let machine_type = $('#machine_type_filter').val();
        let machine_in_id = $('#s_no_filter').val();
        let date_from = $('#date_from_filter').val();
        let date_to = $('#date_to_filter').val();

        manageTable = $('#manageTable').DataTable({
            'ajax': {
                'url': base_url + 'MachineRepairsCreated/fetchCategoryData',
                'type': 'GET',
                'data': {
                    'status': status,
                    'repair_type': repair_type,
                    'machine_type': machine_type,
                    'machine_in_id': machine_in_id,
                    'date_from': date_from,
                    'date_to': date_to
                }
            },
            'order': [],
            destroy: true,
        });
    }


});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: base_url + 'MachineRepairsCreated/fetchMachineRepairsCreatedDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

        $("#service_detail_table tbody").empty();

        let machine_type_name = response.repair_details.machine_type_name;

        $('#machine_type_span').html(machine_type_name);
        $('#repair_charge').val(response.repair_details.repair_charge);
        $('#transport_charge').val(response.repair_details.transport_charge);
        $('#remarks').val(response.repair_details.remarks);

        let employee_id = response.repair_details.repair_done_by;
        let employee_name = response.repair_details.name_with_initial;

        let option = new Option(employee_name, employee_id, true, true);
        $('#repair_done_by').append(option);
        $('#repair_done_by').trigger('change');

        if(response.repair_details.repair_type == 'inside') {
            $('#repair_type_inside').prop('checked', true);
        } else {
            $('#repair_type_outside').prop('checked', true);
        }

        //each service_items
        let service_items = response.service_items;
        service_items.forEach(function(item) {
            let service_item_row = '<tr>';
            service_item_row += '<td>'+item.item_name+'</td>';
            service_item_row += '<td>'+item.quantity+'</td>';
            service_item_row += '<td>'+item.price+'</td>';
            service_item_row += '<td align="right">'+item.total+'</td>';
            service_item_row += '<td><button type="button" class="btn btn-danger btn-sm btn_remove_service_item" data-id="'+item.id+'"><i class="fa fa-trash"></i></button></td>';
            service_item_row += '</tr>';
            $('#service_detail_table tbody').append(service_item_row);
        });

        calculate_sub_total();

        $('#service_item_id').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            dropdownParent: $('#addModal'),
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

        $('#repair_done_by').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            dropdownParent: $('#addModal'),
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

        $('#service_item_add_form').on('submit', function(event) {
            event.preventDefault();
            let service_item_id = $('#service_item_id').val();

            if(service_item_id != ''){

                let service_item_name = $('#service_item_id option:selected').text();
                let price = $('#price').val();
                let qty = $('#quantity').val();
                let total = price * qty;
                total = total.toFixed(2);
                let service_item_row = '<tr>' +
                    '<td>' + service_item_name + '</td>' +
                    '<td>' + qty + '</td>' +
                    '<td>' + price + '</td>' +
                    '<td align="right">' + total + '</td>' +
                    '<td><button class="btn btn-danger btn-sm btn_remove_service_item" data-id="' + service_item_id + '"><i class="fa fa-trash"></i></button></td>' +
                    '</tr>';
                $('#service_detail_table tbody').append(service_item_row);
                $('#service_item_id').val('').trigger('change');
                $('#price').val('');
                $('#quantity').val('');
                calculate_sub_total();

            }
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

        $('#save_btn').on('click', function() {
            let repair_details = [];
            $('#service_detail_table tbody tr').each(function(index, element) {
                let service_detail = {};
                service_detail.service_id = id;
                service_detail.service_item_name = $(element).find('td:eq(0)').text();
                service_detail.quantity = $(element).find('td:eq(1)').text();
                service_detail.price = $(element).find('td:eq(2)').text();
                service_detail.total = $(element).find('td:eq(3)').text();
                repair_details.push(service_detail);
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
                url: base_url + 'MachineRepairsCreated/updateRepair',
                type: 'POST',
                data: {
                    repair_details: repair_details,
                    sub_total: sub_total,
                    repair_done_by: repair_done_by,
                    repair_charge: repair_charge,
                    transport_charge: transport_charge,
                    repair_type: repair_type,
                    remarks: remarks,
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if(response.success) {
                        $('#editModal').modal('hide');
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

                        $('#manageTable').DataTable().ajax.reload(null, false);

                    }
                }
            });

        });

    }
  });
}

function viewFunc(id)
{
    $.ajax({
        url: base_url + 'MachineRepairsCreated/fetchMachineRepairsCreatedDataById/'+id,
        type: 'post',
        dataType: 'json',
        success:function(response) {

            $("#view_service_detail_table tbody").empty();

            let repair_no = response.repair_details.repair_no;
            let machine_type_name = response.repair_details.machine_type_name;

            $('#view_repair_no_span').html(repair_no);
            $('#view_machine_type_span').html(machine_type_name);
            $('#repair_done_by_span').html(response.repair_details.name_with_initial);
            $('#repair_charge_span').html(response.repair_details.repair_charge);
            $('#transport_charge_span').html(response.repair_details.transport_charge);
            $('#remarks_span').html(response.repair_details.remarks);
            $('#sub_total_span').html(response.repair_details.sub_total);
            $('#repair_type_span').html(response.repair_details.repair_type);

            //each service_items
            let service_items = response.service_items;
            service_items.forEach(function(item) {
                let service_item_row = '<tr>';
                service_item_row += '<td>'+item.item_name+'</td>';
                service_item_row += '<td>'+item.quantity+'</td>';
                service_item_row += '<td>'+item.price+'</td>';
                service_item_row += '<td align="right">'+item.total+'</td>';
                service_item_row += '</tr>';
                $('#view_service_detail_table tbody').append(service_item_row);
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
        data: { id:id },
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

function completeFunc(id)
{
    if(id) {
        $("#completeForm").on('submit', function() {

            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { id:id, remarks:$('#complete_remarks').val() },
                dataType: 'json',
                success:function(response) {

                    manageTable.ajax.reload(null, false);
                    // hide the modal
                    $("#completeModal").modal('hide');

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

function removeCompleteFunc(id)
{
    if(id) {
        $("#removeCompleteForm").on('submit', function() {

            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { id:id, remarks:$('#remove_complete_remarks').val() },
                dataType: 'json',
                success:function(response) {

                    manageTable.ajax.reload(null, false);
                    // hide the modal
                    $("#removeCompleteModal").modal('hide');

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