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
                            <div class="page-header-icon"><i class="fas fa-chart-bar"></i></div>
                            <span>Spare Part GRN Report</span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <div class="col-12">
                            <form id="frequencyForm">
                                <div class="form-row">
                                    <div class="col-3">
                                        <label class="small font-weight-bold text-dark">Machine Type</label>
                                        <select class="form-control form-control-sm" name="machinetype"
                                            id="machinetype">
                                            <option value="">Select</option>
                                            <option value="0">All</option>
                                            <?php foreach ($getmachinetype->result() as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-3">
                                        <label class="small font-weight-bold text-dark">Machine Model</label>
                                        <select class="form-control form-control-sm" name="machinemodel"
                                            id="machinemodel">
                                            <option value="">Select</option>
                                            <option value="0">All</option>
                                            <?php foreach ($getmachinemodel->result() as $row) { ?>
                                                <option value="<?php echo $row->id ?>"><?php echo $row->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="small font-weight-bold text-dark">Spare Part*</label>
                                        <select class="form-control form-control-sm select2-ajax" name="sparepart_id"
                                            id="sparepart_id" style="width:100%;">
                                            <option value="">Select</option>
                                        </select>
                                    </div>



                                    <div class="col-3">
                                        <label class="small font-weight-bold text-dark">Month*</label>
                                        <input type="month" class="form-control form-control-sm" name="month" id="month"
                                            required value="<?php echo date('Y-m'); ?>">
                                    </div>


                                </div>

                                <div class="form-row mt-2">
                                    <div class="col-2">
                                        <label class="small font-weight-bold text-dark">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block">
                                            <i class="fas fa-search mr-1"></i> Search
                                        </button>
                                    </div>
                                    <div class="col-2">
                                        <label class="small font-weight-bold text-dark">&nbsp;</label>
                                        <button type="button" id="generateReport"
                                            class="btn btn-danger btn-sm btn-block " disabled>
                                            <i class="fas fa-file-pdf mr-1"></i> Report
                                        </button>
                                    </div>

                                    <div class="col-2">
                                        <label class="small font-weight-bold text-dark">&nbsp;</label>
                                        <button type="button" id="resetForm" class="btn btn-warning btn-sm btn-block">
                                            <i class="fas fa-redo mr-1"></i> Reset
                                        </button>
                                    </div>

                                </div>
                            </form>

                            <div class="col-12 mt-4">
                                <div class="alert alert-info" id="summaryAlert" style="display: none;">
                                    <strong>Summary:</strong>
                                    <span id="summaryText"></span>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="frequencyTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>GRN Number</th>
                                                <th>Batch No</th>
                                                <th>GRN Date</th>
                                                <th>Supplier</th>
                                                <th>Location</th>
                                                <th>Quantity</th>
                                                <th class="text-right">Unit Price (Rs.)</th>
                                                <th class="text-right">Total (Rs.)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr>
                                                <td colspan="9" class="text-center text-muted">
                                                    Please select a spare part and month to view GRN frequency
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="thead-light" id="tableFooter" style="display: none;">
                                            <tr>
                                                <td colspan="6" class="text-right"><strong>Grand Total:</strong></td>
                                                <td><strong id="totalQty">0</strong></td>
                                                <td></td>
                                                <td class="text-right"><strong id="totalAmount">Rs. 0.00</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include "include/footerbar.php"; ?>
    </div>
</div>
<?php include "include/footerscripts.php"; ?>

<script>
    $(document).ready(function () {

        $('#sparepart_id').select2({
            placeholder: 'Search part name or part number',
            width: '100%',
            allowClear: true,
            ajax: {
                url: "<?php echo base_url('StockReport/Getpartname'); ?>",
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1
                    }
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data.results,
                        pagination: {
                            more: data.pagination.more
                        }
                    };
                },
                cache: true
            }
        });

        // Machine type change event
        $('#machinetype').on('change', function () {
            var typeId = $(this).val();
            $('#machinemodel').html('<option value="">Loading...</option>');

            if (typeId && typeId !== '0') {
                $.ajax({
                    url: "<?php echo base_url('SparepartFrequency/getModelsByType'); ?>",
                    type: "POST",
                    data: { type_id: typeId },
                    dataType: "json",
                    success: function (data) {
                        let options = '<option value="">Select</option><option value="0">All</option>';
                        $.each(data, function (index, item) {
                            options += `<option value="${item.id}">${item.name}</option>`;
                        });
                        $('#machinemodel').html(options);
                    },
                    error: function () {
                        $('#machinemodel').html('<option value="">Select</option><option value="0">All</option>');
                    }
                });
            } else {
                $('#machinemodel').html('<option value="">Select</option><option value="0">All</option>');
            }
        });

        $('#frequencyForm').submit(function (event) {
            event.preventDefault();
            searchFrequency();
        });

        $('#generateReport').click(function () {
            generateReport();
        });

        $('#resetForm').click(function () {
            resetForm();
        });

        function searchFrequency() {
            var sparepart_id = $('#sparepart_id').val();
            var month = $('#month').val();
            var machinetype = $('#machinetype').val();
            var machinemodel = $('#machinemodel').val();

            console.log('Filter parameters:', {
                sparepart_id: sparepart_id,
                month: month,
                machinetype: machinetype,
                machinemodel: machinemodel
            });

            if (!sparepart_id || sparepart_id === '') {
                alert('Please select a spare part');
                return;
            }

            if (!month || month === '') {
                alert('Please select a month');
                return;
            }

            $('#tableBody').html('<tr><td colspan="9" class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</td></tr>');
            $('#generateReport').prop('disabled', true);

            var formData = new FormData();
            formData.append('sparepart_id', sparepart_id);
            formData.append('month', month);
            formData.append('machinetype', machinetype || '');
            formData.append('machinemodel', machinemodel || '');

            $.ajax({
                url: "<?php echo base_url('SparepartFrequency/getFrequencyData'); ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    console.log('Response received:', response);
                    if (response.success) {
                        displayData(response.data, sparepart_id, month, machinetype, machinemodel);
                        $('#generateReport').prop('disabled', false);
                    } else {
                        $('#tableBody').html('<tr><td colspan="9" class="text-center text-danger">' + (response.message || 'Error loading data') + '</td></tr>');
                        $('#generateReport').prop('disabled', true);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#tableBody').html('<tr><td colspan="9" class="text-center text-danger">Error loading data. Please try again.</td></tr>');
                    $('#generateReport').prop('disabled', true);
                }
            });
        }

        function generateReport() {
            var sparepart_id = $('#sparepart_id').val();
            var month = $('#month').val();
            var sparepart_name = $('#sparepart_id option:selected').text();
            var machinetype = $('#machinetype').val();
            var machinemodel = $('#machinemodel').val();

            if (!sparepart_id || !month) {
                alert('Please select both spare part and month');
                return;
            }

            var form = $('<form>', {
                action: "<?php echo base_url('SparepartFrequency/generatePDF'); ?>",
                method: "POST",
                target: "_blank"
            }).append(
                $('<input>', { type: 'hidden', name: 'sparepart_id', value: sparepart_id }),
                $('<input>', { type: 'hidden', name: 'month', value: month }),
                $('<input>', { type: 'hidden', name: 'sparepart_name', value: sparepart_name }),
                $('<input>', { type: 'hidden', name: 'machinetype', value: machinetype }),
                $('<input>', { type: 'hidden', name: 'machinemodel', value: machinemodel })
            );

            $('body').append(form);
            form.submit();
            form.remove();
        }

        function resetForm() {
            $('#frequencyForm')[0].reset();
            $('#machinemodel').html('<option value="">Select</option><option value="0">All</option>');
            $('#tableBody').html('<tr><td colspan="9" class="text-center text-muted">Please select a spare part and month to view GRN frequency</td></tr>');
            $('#tableFooter').hide();
            $('#summaryAlert').hide();
            $('#generateReport').prop('disabled', true);
        }

        function displayData(data, sparepart_id, month, machinetype, machinemodel) {
            var tableBody = $('#tableBody');
            var tableFooter = $('#tableFooter');
            var summaryAlert = $('#summaryAlert');
            var summaryText = $('#summaryText');

            if (!data || data.length === 0) {
                tableBody.html('<tr><td colspan="9" class="text-center text-muted">No GRN records found for the selected criteria</td></tr>');
                tableFooter.hide();
                summaryAlert.hide();
                return;
            }

            var html = '';
            var totalQty = 0;
            var totalAmount = 0;
            var sparepartName = $('#sparepart_id option:selected').text();

            data.forEach(function (item, index) {
                var total = item.qty * item.unitprice;
                totalQty += parseInt(item.qty);
                totalAmount += total;

                html += '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + (item.grn_no || 'N/A') + '</td>' +
                    '<td>' + (item.batchno || 'N/A') + '</td>' +
                    '<td>' + (item.grndate || 'N/A') + '</td>' +
                    '<td>' + (item.suppliername || 'N/A') + '</td>' +
                    '<td>' + (item.location || 'N/A') + '</td>' +
                    '<td>' + item.qty + '</td>' +
                    '<td class="text-right">Rs. ' + parseFloat(item.unitprice).toFixed(2) + '</td>' +
                    '<td class="text-right">Rs. ' + total.toFixed(2) + '</td>' +
                    '</tr>';
            });

            tableBody.html(html);
            $('#totalQty').text(totalQty);
            $('#totalAmount').text('Rs. ' + totalAmount.toFixed(2));
            tableFooter.show();

            // Update summary with filter info
            var filterInfo = '';
            if (machinetype && machinetype !== '0') {
                var machineTypeName = $('#machinetype option:selected').text();
                filterInfo += ' | Machine Type: <strong>' + machineTypeName + '</strong>';
            }
            if (machinemodel && machinemodel !== '0') {
                var machineModelName = $('#machinemodel option:selected').text();
                filterInfo += ' | Model: <strong>' + machineModelName + '</strong>';
            }

            summaryText.html('Spare Part: <strong>' + sparepartName + '</strong> | ' +
                'Month: <strong>' + month + '</strong>' + filterInfo + ' | ' +
                'Total GRN Count: <strong>' + data.length + '</strong> | ' +
                'Total Quantity: <strong>' + totalQty + '</strong> | ' +
                'Total Amount: <strong>Rs. ' + totalAmount.toFixed(2) + '</strong>');
            summaryAlert.show();
        }
    });
</script>

<style>
    .table th {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .table td {
        font-size: 0.8rem;
    }
</style>

<?php include "include/footer.php"; ?>