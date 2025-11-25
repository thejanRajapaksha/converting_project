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
                    <span>Used Repair Items</span>
                </h1>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2 p-2">
        <div class="card">
            <div class="card-body p-2">
                <form id="filterForm">
                    <div class="form-row">
                        <div class="col-md-3 mb-2">
                            <label class="small font-weight-bold text-dark">Service Item</label>
                            <select class="form-control form-control-sm" id="service_item_filter" name="service_item">
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

                <div class="table-responsive mt-3">
                    <table id="manageTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                        <thead>
                            <tr>
                                <th>Service Item Name</th>
                                <th>Count</th>
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
                    <h5 class="modal-title">View Repair Item Usage: <strong><span id="service_item_name"></span></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

        $('#service_item_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'UsedRepairItems/get_service_item_select',
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

        function load_dt() {

            let service_item_id = $('#service_item_filter').val();
            let date_from = $('#date_from_filter').val();
            let date_to = $('#date_to_filter').val();

            manageTable = $('#manageTable').DataTable({
                'ajax': {
                    'url': base_url + 'UsedRepairItems/fetchCategoryData',
                    'type': 'GET',
                    'data': {
                        'service_item_id': service_item_id,
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
                                service_item_id: $('#service_item_filter').val(),
                                date_from: $('#date_from_filter').val(),
                                date_to: $('#date_to_filter').val()
                            };

                            $.ajax({
                                url: base_url + 'UsedRepairItems/generatePDF',
                                type: "POST",
                                data: filters,
                                xhrFields: { responseType: 'blob' },
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


    });

    //view function
    function viewFunc(id, date_from, date_to, service_item_name)
    {
        $.ajax({
            url: base_url + 'UsedRepairItems/fetchRepairDataById',
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
                    '<th>Service Item</th>' +
                    '<th> Repair In Date </th> ' +
                    '<th> Used Employee </th> ' +
                    '</tr>' +
                    '</thead> ' +
                    '<tbody>';
                $.each(response, function(index, value) {
                    res_tr += '<tr>' +
                        '<td>' + value.name + '</td>' +
                        '<td>' + value.repair_in_date + '</td>' +
                        '<td>' + value.name_with_initial + '</td>' +
                        '</tr>';
                });
                res_table += res_tr + '</tbody> </table>';
                 $('#viewModal').modal('show');
                 $('#service_item_name').text(service_item_name);
                $("#viewModal .modal-body #viewResponse").html(res_table);
                $('#viewTable').DataTable();

            }
        });
    }

</script>