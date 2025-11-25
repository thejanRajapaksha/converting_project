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
                    <div class="page-header-icon"><i class="fas fa-chart-line"></i></div>
                    <span>Machine Services Cost Analysis</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 p-2">
        <div class="card">
            <div class="card-body p-2">
                <!-- Filter Form -->
                <form id="filterForm">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Status</label>
                            <select class="form-control form-control-sm select2" id="status_filter" name="status">
                                <option value="" disabled selected>Select...</option>
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Service Type</label>
                            <select class="form-control form-control-sm select2" id="service_type_filter" name="service_type">
                                <option value="" disabled selected>Select...</option>
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
                            <label class="small font-weight-bold text-dark">Machine Serial No</label>
                            <select class="form-control form-control-sm" id="s_no_filter" name="s_no">
                                <option value="">Select...</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Service No</label>
                            <select class="form-control form-control-sm" id="service_no_filter" name="service_no">
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
                            <th>Service No</th>
                            <th>Service Date</th>
                            <th>Service Type</th>
                            <th>Sub Total</th>
                            <th>Service Charge</th>
                            <th>Transport Charge</th>
                            <th>Remarks</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="text-dark">Monthly Service Cost Chart</h4>
                <hr>
                <canvas id="monthly_service_cost_chart"></canvas>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-dark">Machine Type And Service Counts Chart</h4>
                    <div style="width: 200px;">
                        <input type="date" rel="txtTooltip" title="Today records shown by default." data-toggle="tooltip" data-placement="left" class="form-control form-control-sm" id="machine_type_chart_date_filter" value="<?= date('Y-m-d') ?>" />
                    </div>
                </div>
                <hr>
                <canvas id="machine_type_chart"></canvas>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Service Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label>Service No :</label>
                            <span id="view_service_no_span"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Machine Type :</label>
                            <span id="view_machine_type_span"></span>
                        </div>
                    </div>
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
                                    <td colspan="3" align="right"><label> Sub Total</label></td>
                                    <td align="right" id="sub_total_span"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right"><label> Service Charge</label></td>
                                    <td align="right" id="service_charge_span"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right"><label> Transport Charge</label></td>
                                    <td align="right" id="transport_charge_span"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right"><label> Total</label></td>
                                    <td align="right" id="total_span"></td>
                                </tr>
                            </tfoot>
                        </table>
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
            url: base_url + 'MachineServicesCreated/get_machine_types_select',
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
            url: base_url + 'MachineServicesCreated/get_machine_ins_select',
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

    //service_no_filter
    $('#service_no_filter').select2({
        placeholder: 'Select...',
        width: '100%',
        allowClear: true,
        ajax: {
            url: base_url + 'MachineServicesCreated/get_service_no_select',
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
    let service_type = $('#service_type_filter').val();
    let machine_type = $('#machine_type_filter').val();
    let machine_in_id = $('#s_no_filter').val();
    let service_no = $('#service_no_filter').val();
    let date_from = $('#date_from_filter').val();
    let date_to = $('#date_to_filter').val();
    
    manageTable = $('#manageTable').DataTable({
        'ajax': {
            'url': base_url + 'MachineServicesCostAnalysis/fetchCategoryData',
            'type': 'GET',
            'data': {
                'status': status,
                'service_type': service_type,
                'machine_type': machine_type,
                'machine_in_id': machine_in_id,
                'service_no': service_no,
                'date_from': date_from,
                'date_to': date_to
            }
        },
        'order': [],
        destroy: true,

        dom:
            "<'row'<'col-sm-5'B><'col-sm-2'l><'col-sm-5'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [

            {
                text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                className: 'btn btn-danger btn-sm',
                action: function () {

                    let filters = {
                        status: $('#status_filter').val(),
                        service_type: $('#service_type_filter').val(),
                        machine_type: $('#machine_type_filter').val(),
                        machine_in_id: $('#s_no_filter').val(),
                        service_no: $('#service_no_filter').val(),
                        date_from: $('#date_from_filter').val(),
                        date_to: $('#date_to_filter').val()
                    };

                    $.ajax({
                        url: base_url + 'MachineServicesCostAnalysis/generateCostAnalysisPDF',
                        type: "POST",
                        data: filters,
                        xhrFields: { responseType: 'blob' }, // important for PDF
                        success: function (data) {
                            const blob = new Blob([data], { type: 'application/pdf' });
                            const url = window.URL.createObjectURL(blob);
                            window.open(url);
                        }
                    });
                }
            }
        ]
    });

}



    //get service cost for each month
    $.ajax({
        url: base_url + 'MachineServicesCostAnalysis/fetchMonthlyServiceCost',
        type: 'post',
        dataType: 'json',
        success:function(response) {

            let xValues = response.months;
            var yValues = response.costs;

            new Chart("monthly_service_cost_chart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    title: {
                        display: true,
                        text: 'Monthly Service Cost'
                    }

                }
            });

        },
        error:function(response) {
           alert(response);
        }
    });

    show_tooltip();

    function show_tooltip()
    {
        $('input[rel="txtTooltip"]').tooltip();
        $('#machine_type_chart_date_filter').tooltip('show');
    }

    $('#machine_type_chart_date_filter').change(function() {
        init_service_items_chart();
    });

    //onhover hide tooltip
    $('#machine_type_chart_date_filter').mouseover(function() {
        $('#machine_type_chart_date_filter').tooltip('hide');
    });

    //on focus
    $('#machine_type_chart_date_filter').focus(function() {
        $('#machine_type_chart_date_filter').tooltip('hide');
    });

    init_service_items_chart();

    function init_service_items_chart()
    {
        $.ajax({
            url: base_url + 'MachineServicesCostAnalysis/fetchMachineTypeServiceItems',
            type: 'post',
            dataType: 'json',
            data: {
                'date': $('#machine_type_chart_date_filter').val()
            },
            success:function(response) {

                var xValues = response.machine_types;
                var yValues = response.total_counts;
                var barColors = response.colors;

                new Chart("machine_type_chart", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: "Machine Types Service Count " + $('#machine_type_chart_date_filter').val(),
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                barPercentage: 0.4
                            }]
                        }
                    }
                });

            },
            error:function(response) {
                alert(response);
            }
        });
    }


});

function viewFunc(id)
{
    $.ajax({
        url: base_url + 'MachineServicesCreated/fetchMachineServicesCreatedDataById/'+id,
        type: 'post',
        dataType: 'json',
        success:function(response) {

            $("#view_service_detail_table tbody").empty();

            let service_no = response.service_details.service_no;
            let machine_type_name = response.service_details.machine_type_name;

            $('#view_service_no_span').html(service_no);
            $('#view_machine_type_span').html(machine_type_name);
            $('#service_done_by_span').html(response.service_details.name_with_initial);
            $('#service_charge_span').html(response.service_details.service_charge);
            $('#transport_charge_span').html(response.service_details.transport_charge);
            $('#remarks_span').html(response.service_details.remarks);
            $('#sub_total_span').html(response.service_details.sub_total);
            $('#service_type_span').html(response.service_details.service_type);

            let total = parseFloat(response.service_details.service_charge) + parseFloat(response.service_details.transport_charge) + parseFloat(response.service_details.sub_total);
            $('#total_span').html(total);

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