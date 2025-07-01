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
                    <span>Employee Machine Services</span>
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
                            <label class="small font-weight-bold text-dark">Employee</label>
                            <select class="form-control form-control-sm" id="employee_filter" name="employee_id">
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
                                <th>Employee Name</th>
                                <th>No of Services</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Employee Services: <strong><span id="employee_name"></span></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <div id="viewMsg"></div>
                    <div id="viewResponse"></div>
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


    $(document).ready(function () {

        $('#rpt_main_nav_link').prop('aria-expanded', 'true').removeClass('collapsed');
        $('#collapseLayoutsRPT').addClass('show');

        $('#employee_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'MachineServicesEmployee/get_employees_select',
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

        $('#filter_button').click(function() {
            load_dt();
        });

        // initialize the datatable
        load_dt();

        function load_dt(){

            let employee_id = $('#employee_filter').val();
            let date_from = $('#date_from_filter').val();
            let date_to = $('#date_to_filter').val();

            manageTable = $('#manageTable').DataTable({
                'ajax': {
                    'url': base_url + 'MachineServicesEmployee/fetchCategoryData',
                    'type': 'GET',
                    'data': {
                        'employee_id': employee_id,
                        'date_from': date_from,
                        'date_to': date_to
                    }
                },
                'order': [],
                destroy: true,
            });
        }

    });

    //view function
    function viewFunc(id, date_from, date_to, employee_name)
    {
        $.ajax({
            url: base_url + 'MachineServicesEmployee/fetchServiceDataById',
            data : {
                'id': id,
                'date_from': date_from,
                'date_to': date_to
            },
            type: 'post',
            dataType: 'json',
            success:function(response) {

                let res_table = '<table class="table table-striped table-sm" id="viewTable">';
                let res_tr = '<thead>' +
                    '<tr>' +
                    '<th>Machine Type</th>' +
                    '<th>BarCode</th> ' +
                    '<th> Serial No </th> ' +
                    '<th> Service No </th> ' +
                    '<th> Service Date From </th> ' +
                    '<th> Service Date To </th> ' +
                    '<th> Service Type </th> ' +
                    '<th> Sub Total </th> ' +
                    '<th> Remarks </th> ' +
                    '</tr>' +
                    '</thead> ' +
                    '<tbody>';
                $.each(response, function(index, value) {
                    res_tr += '<tr>' +
                        '<td>' + value.machine_type_name + '</td>' +
                        '<td>' + value.bar_code + '</td>' +
                        '<td>' + value.s_no + '</td>' +
                        '<td>' + value.service_no + '</td>' +
                        '<td>' + value.service_date_from + '</td>' +
                        '<td>' + value.service_date_to + '</td>' +
                        '<td>' + value.service_type + '</td>' +
                        '<td>' + value.sub_total + '</td>' +
                        '<td>' + value.remarks + '</td>' +

                        '</tr>';
                });
                res_table += res_tr + '</tbody> </table>';
                 $('#viewModal').modal('show');
                 $('#employee_name').text(employee_name);
                $("#viewModal .modal-body #viewResponse").html(res_table);
                $('#viewTable').DataTable();

            }
        });
    }

</script>