<?php 
include_once "include/header.php";  
include_once "include/topnavbar.php"; 
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
                            <div class="page-header-icon"><i class="fas fa-desktop"></i></div>
                            <span>Dashboard</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2p-0 p-2">
                <div class="row mt-1">
                    <!-- First Column - Stacked Cards -->
                    <div class="col-md-3">
                        <!-- All Machine List Card -->
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h6 class="card-title">All Machine List</h6>
                                <p class="card-text text-success" style="font-size: 2.5rem; margin: 10px 0;">
                                    <?php echo $count_machine_ins; ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url(); ?>MachineIn" class="text-primary float-right">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>

                        <!-- Repairs Card -->
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h6 class="card-title">Repairs To Be Done</h6>
                                <h3 class="text-warning"><?php echo $repairs_count; ?></h3>
                            </div>
                        </div>

                        <!-- Services Card -->
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <h6 class="card-title">Services To Be Done Today</h6>
                                <h3 class="text-info"><?php echo $services_count; ?></h3>
                            </div>
                        </div>
                    </div>

                    <!-- Second Column - Machine Types Chart -->
                    <div class="col-md-5">
                        <div class="card h-100">
                            <div class="card-body" style="padding-top: 15px;">
                                <<canvas id="machine_ins_pie_chart" style="width: 100% !important; height: 400px !important;"></canvas>
                            </div>
                            <div class="card-footer">
                                <a href="<?php echo base_url(); ?>MachineIn" class="text-primary float-right">View More <i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Third Column - Machine By Aging -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Machine By Aging</h5>

                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Type</th>
                                                <?php
                                                foreach ($counts as $key => $val){
                                                    echo '<th>'.$key.'</th>';
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($count_data as $cd){
                                                echo '<tr>';
                                                echo '<td>'.$i.'</td>';
                                                echo '<td>'.$cd['machine_type_name'].'</td>';
                                                echo '<td>'.$cd['count_0_1'].'</td>';
                                                echo '<td>'.$cd['count_2_3'].'</td>';
                                                echo '<td>'.$cd['count_4_5'].'</td>';
                                                echo '<td>'.$counts['5<'].'</td>';
                                                echo '</tr>';
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Machine by Type Section -->
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Machine by Type</h5>
                        <hr>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="machine_in_id">Machine Type</label>
                                    <select class="form-control form-control-sm" name="machine_type_id" id="machine_type_id">
                                        <option value="">Select Machine</option>
                                    </select>
                                    <div id="machine_type_id_error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="count_div"></div>
                            </div>
                            <div class="col-md-8">
                                <div class="allocated_machines_div"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modals remain the same -->
            <div class="modal fade" tabindex="-1" role="dialog" id="availableMachinesModal">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Available Machines : <strong> <span id="machine_type_name"></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="availableMachinesMsg"></div>
                            <div id="availableMachinesResponse"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="repairingMachinesModal">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Repairing Machines : <strong> <span id="r_machine_type_name"></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="repairingMachinesMsg"></div>
                            <div id="repairingMachinesResponse"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
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

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        init_repair_items_chart();

        function init_repair_items_chart()
        {
            $.ajax({
                url: base_url + 'MachineDashboard/fetchMachineInsChartData',
                type: 'post',
                dataType: 'json',
                data: {

                },
                success:function(response) {
                    machine_type_id
                    var xValues = response.machine_types;
                    var yValues = response.total_counts;
                    var barColors = response.colors;

                    new Chart("machine_ins_pie_chart", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        options: {
                            //legend: {display: true},
                            responsive:true,
                            title: {
                                display: true,
                                text: "Machine Types Count ",
                            }
                        }
                    });

                },
                error:function(response) {
                    alert(response);
                }
            });
        }

        $('#machine_type_id').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'machineTypes/get_machine_types_select',
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

        //machine_type_id change event
        $('#machine_type_id').on('change', function (e){
            let id = $(this).val();
            $.ajax({
                url: base_url + 'MachineDashboard/fetch_machine_types_data',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },
                success:function(response) {

                    let available_machines = response.available_machines;
                    let repairing_machines = response.repairing_machines;

                    let html = '';
                    html += ' <div class="card card-icon">' +
                        '<div class="row no-gutters">'+
                            '<div class="col-auto card-icon-aside p-1 text-white bg-primary">'+
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="card-body py-3">'+
                                    '<h5 class="card-title">Available Machines <span class="badge badge-pill badge-light float-right" > ' +
                                        available_machines +
                                            '</span> <button data-status="0" data-types="" class="badge badge-pill badge-light float-right btn btn-sm btn_view_available_machines" id="" value="1"><span class="text-primary">View</span> </button></h5>'+

                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div> ';

                    html += ' <div class="card card-icon mt-2">' +
                        '<div class="row no-gutters">'+
                        '<div class="col-auto card-icon-aside p-1 text-white bg-warning">'+
                        '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>'+
                        '</div>'+
                        '<div class="col">'+
                        '<div class="card-body py-3">'+
                        '<h5 class="card-title">Repairing Machines <span class="badge badge-pill badge-light float-right" > ' +
                        repairing_machines +
                        '</span> <button data-status="0" data-types="" class="badge badge-pill badge-light float-right btn btn-sm btn_view_repairing_machines" id="" value="1"> <span class="text-primary">View</span> </button></h5>'+

                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div> ';

                    $('.count_div').html(html);

                    let $allocated_machines = response.allocated_machines;

                    let html2 = '<h4> Allocated Machines </h4>' +
                        '<hr>';
                    html2 += '<div class="table-responsive">' +
                            '<table class="table table-striped table-bordered table-hover table-sm">' +
                            '<thead>' +
                                '<tr>' +
                                    '<th>Serial No</th>' +
                                    '<th>Allocated Date</th>' +
                                    '<th>Start Date Time</th>' +
                                    '<th>End Date Time</th>' +
                                    '<th>Allocated Quantity</th>' +
                                    // '<th>Po</th>' +
                                    // '<th>Delivery Id</th>' +
                                '</tr>' +
                            '</thead>' +
                            '<tbody>';
                    $.each($allocated_machines, function(key, value){
                        html2 += '<tr>' +
                            '<td>' + value.s_no + '</td>' +
                            '<td>' + value.allocatedate + '</td>' +
                            '<td>' + value.startdatetime + '</td>' +
                            '<td>' + value.startdatetime + '</td>' +
                            '<td>' + value.allocatedqty + '</td>' +
                            // '<td>' + value.department_name + '</td>' +
                            // '<td>' + value.factory_name + '</td>' +
                        '</tr>';
                    });

                    html2 += '</tbody>' +
                            '</table>' +
                            '</div>';

                    $('.allocated_machines_div').html(html2);

                },
                error:function(response) {
                    alert(response);
                }
            });

        });

        //btn_view_available_machines
        $(document).on('click', '.btn_view_available_machines', function(e) {
            e.preventDefault();
            let machine_type_id = $('#machine_type_id').val();
            $.ajax({
                url: base_url + 'MachineDashboard/fetch_available_machines_data',
                type: 'post',
                dataType: 'json',
                data: {
                    machine_type_id: machine_type_id
                },
                success: function (response) {
                    let html = '';

                    html += '<div class="table-responsive">' +
                        '<table class="table table-striped table-bordered table-hover table-sm">' +
                        '<thead>' +
                            '<tr>' +
                                '<th>Serial No</th>' +
                                '<th>Bar Code</th>' +
                                '<th>Machine Type</th>' +
                                '<th>Machine Model</th>' +
                                '<th>In Type</th>' +
                                '<th>Next Service Date</th>' +
                                '<th>Origin Date</th>' +
                                // '<th>Factory</th>' +
                            '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    let machine_type_name = '';

                    $.each(response, function(key, value){
                        // console.log(value);
                        machine_type_name = value.machine_type_name;
                        html += '<tr>' +
                            '<td>' + value.s_no + '</td>' +
                            '<td>' + value.bar_code + '</td>' +
                            '<td>' + value.machine_type_name + '</td>' +
                            '<td>' + value.machine_model_name + '</td>' +
                            '<td>' + value.in_type_name + '</td>' +
                            '<td>' + value.next_service_date + '</td>' +
                            '<td>' + value.origin_date + '</td>' +
                            // '<td>' + value.factory_name + '</td>' +
                        '</tr>';
                    });

                    html += '</tbody>' +
                        '</table>' +
                        '</div>';

                    $('#availableMachinesResponse').html(html);
                    $('#machine_type_name').html(machine_type_name);
                    $('#availableMachinesModal').modal('show');

                },
                error: function (response) {
                    alert(response);
                }

            });

        });

        //btn_view_repairing_machines
        $(document).on('click', '.btn_view_repairing_machines', function(e) {
            e.preventDefault();
            let machine_type_id = $('#machine_type_id').val();
            $.ajax({
                url: base_url + 'MachineDashboard/fetch_repairing_machines_data',
                type: 'post',
                dataType: 'json',
                data: {
                    machine_type_id: machine_type_id
                },
                success: function (response) {
                    let html = '';

                    html += '<div class="table-responsive">' +
                        '<table class="table table-striped table-bordered table-hover table-sm">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Serial No</th>' +
                        '<th>Bar Code</th>' +
                        '<th>Machine Type</th>' +
                        '<th>Machine Model</th>' +
                        '<th>In Type</th>' +
                        '<th>Next Service Date</th>' +
                        '<th>Origin Date</th>' +
                        // '<th>Factory</th>' +
                        '<th>Repair In Date</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    let machine_type_name = '';

                    $.each(response, function(key, value){
                        // console.log("Machine", value);
                        machine_type_name = value.machine_type_name;
                        html += '<tr>' +
                            '<td>' + value.s_no + '</td>' +
                            '<td>' + value.bar_code + '</td>' +
                            '<td>' + value.machine_type_name + '</td>' +
                            '<td>' + value.machine_model_name + '</td>' +
                            '<td>' + value.in_type_name + '</td>' +
                            '<td>' + value.next_service_date + '</td>' +
                            '<td>' + value.origin_date + '</td>' +
                            // '<td>' + value.factory_name + '</td>' +
                            '<td>' + value.repair_in_date + '</td>' +
                            '</tr>';
                    });

                    html += '</tbody>' +
                        '</table>' +
                        '</div>';

                    $('#repairingMachinesResponse').html(html);
                    $('#r_machine_type_name').html(machine_type_name);
                    $('#repairingMachinesModal').modal('show');

                },
                error: function (response) {
                    alert(response);
                }

            });

        });

    });

</script>

<?php include "include/footer.php"; ?>
