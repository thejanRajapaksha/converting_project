<style>
    .fc-daygrid-event {
        text-align: center;
    }
</style>
<?php 
include "include/header.php";  
include "include/topnavbar.php"; 
?>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav"><?php include "include/menubar.php"; ?></div>
    <div id="layoutSidenav_content">
        <main> 
            <div class="container-fluid mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h2 class="">Machine Services Calendar</h2>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <hr>
                        <div id="messages"></div>
                        <div class="row">
                            <div class="col">
                                <div id='calendar'></div>

                                <div class="mt-2">
                                    <button class="btn btn-default btn-sm" style="background-color: #00b7eb"></button>
                                    New &nbsp;
                                    <button class="btn btn-default btn-sm" style="background-color: #77dd77"></button>
                                    Service Created &nbsp;
                                    <button class="btn btn-default btn-sm" style="background-color: #33ffbd"></button>
                                    Current &nbsp;
                                    <button class="btn btn-default btn-sm" style="background-color: #ff6347"></button>
                                    Postponed &nbsp;
                                    <button class="btn btn-default btn-sm" style="background-color: #ff0000"></button>
                                    Overdue &nbsp;
                                    <button class="btn btn-default btn-sm" style="background-color: #560319"></button>
                                    Postponed & Overdue &nbsp;
                                </div>

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h2 class=""> Service Event Details </h2>
                                        <div id="service_res"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2 class="">Required Spare Parts for today (<?= date('Y-m-d') ?>) </h2>
                                                <table class="table table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th>Spare Part</th>
                                                        <th>Quantity</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach ($sp as $s) {
                                                        echo '<tr>';
                                                        echo '<td> ' . $s['name'] . ' </td>';
                                                        echo '<td> ' . $s['total_rec'] . ' </td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

                <!-- create brand modal -->
                <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Service Details</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">

                                <div class="row mb-4">
                                    <div class="col-sm-3">
                                        <label for="service_date">Service No :</label>
                                        <span id="service_no_span"></span>
                                        <input type="hidden" id="service_id_span">
                                    </div>
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
                                        <h5>Service Detail</h5>
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
                                                    <label for="service_done_by">Service Done By</label>
                                                    <select class="form-control form-control-sm" id="service_done_by"
                                                            name="service_done_by"
                                                            required>
                                                        <option value="">Select...</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="service_charge">Service Charge</label>
                                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                                        id="service_charge"
                                                        name="service_charge" placeholder="">
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
                                                    <label for="service_type">Service Type</label>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="service_type"
                                                            id="service_type_inside" value="inside" checked>
                                                        <label class="form-check-label" for="service_type_inside">Inside</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="service_type"
                                                            id="service_type_outside" value="outside">
                                                        <label class="form-check-label" for="service_type_outside">Outside</label>
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
                                <h5 class="modal-title">Postpone Service</h5>
                                <button type="button" class="close <?php if($addcheck==0){echo 'disabled';} ?>" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                            </div>

                            <form method="post" id="postpone_service_form">

                                <div class="modal-body">

                                    <div class="row mb-4">
                                        <div class="col-sm-6">
                                            <label for="service_date">Service No :</label>
                                            <span id="postpone_service_no_span"></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="service_date">Machine Type :</label>
                                            <span id="postpone_machine_type_span"></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="service_date">Service Date</label>
                                        <input type="date" class="form-control form-control-sm" id="service_date"
                                            name="service_date"
                                            placeholder="Service Date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <textarea class="form-control form-control-sm" id="reason" name="reason"
                                                placeholder="Reason" required></textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-sm" id="save_btn">Save changes</button>
                                </div>

                            </form>


                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
                <div class="modal-dialog " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Service</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>

                        <form method="post" id="delete_service_form">

                            <div class="modal-body">

                                <p>Do you really want to remove?</p>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="save_btn">Save Changes</button>
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
        
    var add_url = '<?php echo base_url('MachineServicesCalendar/add'); ?>';
    var edit_url = '<?php echo base_url('MachineServicesCalendar/edit'); ?>';                   
    var addcheck='<?php echo $addcheck; ?>';
    var editcheck='<?php echo $editcheck; ?>';
    var statuscheck='<?php echo $statuscheck; ?>';
    var deletecheck='<?php echo $deletecheck; ?>';

    var manageTable;
    var base_url = "<?php echo base_url(); ?>";

    initialize_calendar();

    function initialize_calendar(){
        document.addEventListener('DOMContentLoaded', function() {

            let events = [];
            $.ajax({
                url: base_url + 'MachineServicesCalendar/getServiceEvents',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    response.forEach(function(event) {
                        events.push({
                            id: event.id,
                            title: event.service_no,
                            start: event.service_date_from,
                            end: event.service_date_to,
                            url:'#',
                            color: event.color,
                            //textColor: event.textColor,
                            //allDay: event.allDay
                        });
                    });

                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: events,
                        eventLimit: true,

                        eventClick: function(info) {
                            info.jsEvent.preventDefault(); // don't let the browser navigate

                            //get service_res
                            $.ajax({
                                url: base_url + 'MachineServicesCalendar/getServiceRes',
                                type: 'POST',
                                data: {
                                    service_id: info.event.id
                                },
                                dataType: 'json',
                                success: function(response) {
                                    $('#service_res').html(response);
                                }
                            });
                        }

                    });


                    calendar.render();

                }
            });

        });
    }

    $(document).ready(function() {

        $('#machine_services_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
        $('#collapseLayoutsMachineServices').addClass('show');

        $(document).on('click', '.btn_create', function() {

            let id = $(this).data('id');
            let service_no = $(this).data('service_no');
            let machine_type_name = $(this).data('machine_type_name');

            $('#service_no_span').html(service_no);
            $('#service_id_span').val(id);
            $('#machine_type_span').html(machine_type_name);

            //save_btn click event
            $('#save_btn').on('click', function() {
                let service_details = [];
                $('#service_detail_table tbody tr').each(function(index, element) {
                    let service_detail = {};
                    service_detail.service_id = id;
                    service_detail.service_item_id = $(element).find('td:eq(0) .sp_id').val();
                    service_detail.service_item_name = $(element).find('td:eq(0)').text();
                    service_detail.quantity = $(element).find('td:eq(1)').text();
                    service_detail.price = $(element).find('td:eq(2)').text();
                    service_detail.total = $(element).find('td:eq(3)').text();
                    service_details.push(service_detail);
                });
                let sub_total = $('#sub_total').text();
                let service_done_by = $('#service_done_by').val();
                let service_charge = $('#service_charge').val();
                let transport_charge = $('#transport_charge').val();
                let service_type = $('input[name=service_type]:checked').val();
                let remarks = $('#remarks').val();

                $('#modal_msg').html('');

                if(service_details.length == 0){
                    //modal_msg
                    $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                        'Please Add at least one Item'
                        +
                        '</div>');
                    return false;
                }
                if(service_done_by == ''){
                    $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                        'Service Done By required'
                        +
                        '</div>');
                    return false;
                }

                if(service_charge == ''){
                    $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                        'Service Charge required'
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

                if(service_type == ''){
                    $("#modal_msg").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+
                        'Service Type required'
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
                    url: base_url + 'MachineServicesCalendar/createService',
                    type: 'POST',
                    data: {
                        service_details: service_details,
                        sub_total: sub_total,
                        service_done_by: service_done_by,
                        service_charge: service_charge,
                        transport_charge: transport_charge,
                        service_type: service_type,
                        remarks: remarks,
                        service_id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            $('#addModal').modal('hide');
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                '</div>');
                            $("#service_detail_table tbody").empty();
                            $('#sub_total').val('');
                            $('#service_done_by').val('');
                            $('#service_charge').val('');
                            $('#transport_charge').val('');
                            $('#remarks').val('');
                            $('input[name=service_type]').attr('checked',false);

                            //reload page after 2 second
                            setTimeout(function() {
                                location.reload();
                            }, 2000);

                        }
                    }
                });

            });

            $('#addModal').modal('show');
        });

        $('#service_done_by').select2({
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

        $('#service_item_id').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'MachineServicesCalendar/get_sp_for_service_id_select',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1,
                        service_id: $('#service_id_span').val()
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
                '<td> <input class="sp_id" type="hidden" value="'+service_item_id+'"> ' + service_item_name + '</td>' +
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
            let service_no = $(this).data('service_no');
            let machine_type_name = $(this).data('machine_type_name');

            $('#postpone_service_no_span').html(service_no);
            $('#postpone_machine_type_span').html(machine_type_name);

            $('#postponeModal').modal('show');

            $('#postpone_service_form').on('submit', function(event) {
                event.preventDefault();
                let service_date = $('#service_date').val();
                let reason = $('#reason').val();
                $.ajax({
                    url: base_url + 'MachineServicesCalendar/postponeService',
                    type: 'POST',
                    data: {
                        id: id,
                        service_date: service_date,
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
                            $('#service_date').val('');
                            $('#reason').val('');
                            initialize_calendar();
                            //refresh page after 3 seconds
                            setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }
                    }
                });
            });

        });

        //btn_delete
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let service_no = $(this).data('service_no');
            let machine_type_name = $(this).data('machine_type_name');
            $('#delete_service_no_span').html(service_no);
            $('#delete_machine_type_span').html(machine_type_name);
            $('#deleteModal').modal('show');
            $('#delete_service_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: base_url + 'MachineServicesCalendar/deleteService',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.success) {
                            $('#deleteModal').modal('hide');
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                '</div>');
                            $('#service_date').val('');
                            $('#reason').val('');
                            initialize_calendar();
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
                        '<td style="text-align: right">' + value.unitprice + '</td>' +
                        '</tr>';
                    total += (parseFloat(value.issued_qty)) * ( parseFloat(value.unitprice));
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
