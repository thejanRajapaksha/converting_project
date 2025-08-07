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
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fas fa-clipboard-list"></i></div>
                            <span>GRN Report</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-2">
                        <div id="messages"></div>

                        <div class="row mb-3">
                            <div class="form-group col-md-3 mb-2">
                                <label class="small font-weight-bold">Part No</label>
                                <select class="form-control form-control-sm" id="part_no_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label class="small font-weight-bold">Supplier</label>
                                <select class="form-control form-control-sm" id="supplier_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label class="small font-weight-bold">Machine Type</label>
                                <select class="form-control form-control-sm" id="machine_type_filter">
                                    <option value="">Select...</option>
                                </select>
                            </div>
                            <!-- Optional date filters (uncomment to use)
                            <div class="form-group col-md-3 mb-2">
                                <label class="small font-weight-bold">Date From</label>
                                <input type="date" class="form-control form-control-sm" id="date_from_filter" name="date_from">
                            </div>
                            <div class="form-group col-md-3 mb-2">
                                <label class="small font-weight-bold">Date To</label>
                                <input type="date" class="form-control form-control-sm" id="date_to_filter" name="date_to">
                            </div>
                            -->
                            <div class="form-group col-md-3 mb-2">
                                <label class="small d-block">&nbsp;</label>
                                <button type="button" class="btn btn-primary btn-sm w-100" id="filter_button">Filter</button>
                            </div>
                        </div>

                        <hr>

                        <div class="table-responsive">
                            <table id="manageTable" class="table table-bordered table-striped table-sm nowrap" width="100%">
                                <thead>
                                    <tr>
                                        <th>GRN Type</th>
                                        <th>Date</th>
                                        <th>Batch No</th>
                                        <th>Supplier</th>
                                        <th>Location</th>
                                        <th>Invoice No</th>
                                        <th>Dispatch No</th>
                                        <th>Total</th>
                                        <th>Remarks</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- GRN View Modal -->
            <div class="modal fade" id="porderviewmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">View Good Receive Note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="viewhtml"></div>
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

        $('#part_no_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'GrnReport/get_part_no_select_from_stock',
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

        $('#supplier_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'GrnReport/get_supplier_select_from_stock',
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

        $('#machine_type_filter').select2({
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: base_url + 'GrnReport/get_machine_type_select_from_stock',
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

        load_dt();

        function load_dt(){

            let spare_part_id = $('#part_no_filter').val();
            let supplier_id = $('#supplier_filter').val();
            let machine_type_id = $('#machine_type_filter').val();

            manageTable = $('#manageTable').DataTable({
                'ajax': {
                    'url': base_url + 'GrnReport/fetchGoodReceiveDataReport',
                    'type': 'POST',
                    'data': {
                        'spare_part_id': spare_part_id,
                        'supplier_id': supplier_id,
                        'machine_type_id': machine_type_id
                    }
                },
                'order': [],
                destroy: true,
            });
        }

        $('table tbody').on('click', '.btnview', function () {
            var id = $(this).attr('id');
            $.ajax({
                type: "POST",
                data: {
                    recordID: id,
                    allowPrint: 0
                },
                url: '<?php echo base_url() ?>GrnReport/Goodreceiveview',
                success: function (result) { //alert(result);
                    $('#porderviewmodal').modal('show');
                    $('#viewhtml').html(result);
                }
            });
        });

    });


</script>