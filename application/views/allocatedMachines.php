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
                            <div class="page-header-icon"><i class="fas fa-list"></i></div>
                            <span>Allocated Machines</span>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2 p-0 p-2">
                <div class="card">
                    <div class="card-body p-0 p-2">
                        <form id="searchform">
                            <div class="form-row">
                                        <div class="col-3">
                                    <label class="small font-weight-bold text-dark">Machine*</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <select class="form-control form-control-sm" name="machine" id="machine"
                                            required>
                                            <option value="">Select</option>
                                            <?php foreach ($machine as $machines): ?>
                                                <option value="<?php echo $machines->id; ?>">
                                                    <?php echo $machines->name.'-'.$machines->s_no; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label class="small font-weight-bold text-dark">Date*</label>
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="date" class="form-control dpd1a rounded-0" id="date"
                                            name="date" required>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="d-none" id="hidesubmit">
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap"
                                        id="machineAllocationTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order Id</th>
                                                <th>Delivery Plan Id</th>
                                                <th>Product</th>
                                                <th>Machine</th>
                                                <!-- <th>Cost Item Name</th> -->
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id = "machineAllocationTableBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Allocation View Modal -->
        <div class="modal fade" id="allocationModal" tabindex="-1" role="dialog" aria-labelledby="allocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Machine Allocation Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="container mt-2">
                <div class="row">
                <div class="col-md-12 text-right">
                    <h6><strong>Balance Quantity:</strong> <span id="balanceQty">0</span></h6>
                </div>
                </div>
            </div>

                <div class="modal-body">
                                <div class="col-12">
                                <div class="scrollbar pb-3" id="style-2">
                                    <table class="table table-bordered table-striped table-sm nowrap"
                                        id="machineAllocationTable">
                                        <thead>
                                            <tr>
                                                <td>Machine</td>
                                                <td>Start Date</td>
                                                <td>End Date</td>
                                                <td>Allocated Quantity</td>
                                                <td>Completed Quantity</td>
                                                <td>Waste Quantity</td>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id = "tableBody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        </div>

        <!-- modal completed quantity-->

        <div class="modal fade" id="addCompletedModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Completed Amount</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="completedAmountForm">
                <input type="hidden" id="allocationId">
                <div class="form-group">
                    <label for="completedAmount">Amount Completed Today</label>
                    <input type="number" class="form-control" id="completedAmount" required>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCompletedAmount">Save</button>
            </div>
            </div>
        </div>
        </div>

        <!-- modal rejected add-->
        <div class="modal fade" id="addRejectedModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Rejected Amount</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="rejectedAmountForm">
                <input type="hidden" id="allocationMid">
                <div class="form-group">
                    <label for="rejectedAmmount">Amount Rejected Today</label>
                    <input type="number" class="form-control" id="rejectedAmmount" required>
                </div>
                    <div class="form-group">
                    <label for="rejectReason">Reject Reason Type*</label>
                            <select class="form-control form-control-sm" name="rejectReason" id="rejectReason" required>
                                <option value="">Select</option>
                                <?php foreach ($reason as $reasons): ?>
                                                <option value="<?php echo $reasons->id; ?>">
                                                    <?php echo $reasons->reason_type; ?>
                                                </option>
                                            <?php endforeach; ?>
                        </select>
                    </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" class="form-control" id="comment" required>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveRejectedAmount">Save</button>
            </div>
            </div>
        </div>
        </div>
                <?php include "include/footerbar.php"; ?>
        </div>
        </div>
        <?php include "include/footerscripts.php"; ?>

<script>
	$(document).ready(function(){
        var addcheck = '<?php echo $addcheck; ?>';
		var editcheck = '<?php echo $editcheck; ?>';
		var statuscheck = '<?php echo $statuscheck; ?>';
		var deletecheck = '<?php echo $deletecheck; ?>';
        
	});
	$("#tblmachinelist").on('click', '.btnDeleterow', function () {
		$(this).closest('tr').remove();
	});

	
$(document).ready(function () {
    $('#machine, #date').on('change', function () {
        let machineId = $('#machine').val();
        let selectedDate = $('#date').val();

        if (machineId && selectedDate) {
            $.ajax({
                url: '<?= base_url('AllocatedMachines/fetch') ?>',
                method: 'POST',
                data: {
                    machine_id: machineId,
                    date: selectedDate
                },
                success: function (response) {
                    $('#machineAllocationTableBody').empty();
                    
                    let data = typeof response === "string" ? JSON.parse(response) : response;

                    if (data.length > 0) {
                        $.each(data, function (index, item) {
                            let row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>PO-${item.idtbl_order}</td>
                                    <td>${item.deliveryId}</td>
                                    <td>${item.product}</td>
                                    <td>${item.name}-${item.s_no}</td>
                                    <td class="text-right">
                                         <button class="btn btn-sm btn-primary view-btn" 
                                            data-id="${item.idtbl_machine_allocation}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary add-completed-btn" 
                                            data-id="${item.idtbl_machine_allocation}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger add-rejected-btn" 
                                            data-id="${item.idtbl_machine_allocation}">
                                            <i class="fa fa-times"></i>
                                        </button>

                                    </td>
                                </tr>`;
                            $('#machineAllocationTableBody').append(row);
                        });
                    } else {
                        $('#machineAllocationTableBody').append('<tr><td colspan="6">No data found.</td></tr>');
                    }
                },

                error: function () {
                    alert('Error loading data.');
                }
            });
        }
    });
});
$(document).on('click', '.view-btn', function () {
    let allocationId = $(this).data('id');

    $.ajax({
        url: '<?= base_url('AllocatedMachines/getAllocationDataById') ?>',
        method: 'POST',
        data: { id: allocationId },
        dataType: 'json',
        success: function (data) {
            if (data) {
               console.log(data);
              $('#tableBody').empty();
                $.each(data, function(index, item) {
                    let row = `<tr>
                        <td>${item.name || 'N/A'}_${item.s_no || 'N/A'}</td>
                        <td>${item.startdatetime || 'N/A'}</td>
                        <td>${item.enddatetime || 'N/A'}</td>
                        <td>${item.allocatedqty || 'N/A'}</td>
                        <td>${item.completedqty || 'N/A'}</td>
                        <td>${item.wastageqty || 'N/A'}</td>
                    </tr>`;
                    $('#tableBody').append(row);
                });
                calculateBalanceQty();
                $('#allocationModal').modal('show');
              
            } else {
                alert('No data found for this allocation.');
            }
        },
        error: function () {
            alert('Error fetching allocation details.');
        }
    });
});
$(document).on('click', '.add-completed-btn', function() {
    const allocationId = $(this).data('id');
    $('#addCompletedModal #allocationId').val(allocationId);
   $('#addCompletedModal').modal('show');
});
$(document).on('click', '.add-rejected-btn', function() {
    const allocationId = $(this).data('id');
    $('#addRejectedModal #allocationMid').val(allocationId);
   $('#addRejectedModal').modal('show');
});

$('#saveCompletedAmount').click(function() {
    const allocationId = $('#allocationId').val();
    const amount = $('#completedAmount').val();
    // const date = $('#completedDate').val();
    
    if (!amount) {
        alert('Please fill all fields');
        return;
    }

    $.ajax({
        url: '<?= base_url('AllocatedMachines/InsertCompletedAmmount') ?>',
        method: 'POST',
        data: {
            allocation_id: allocationId,
            amount: amount,
            // date: date
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Completed amount saved successfully');
                $('#addCompletedModal').modal('hide');
                // You might want to refresh the data here
            } else {
                alert(response.message || 'Error saving completed amount');
            }
        },
        error: function() {
            alert('Error saving completed amount');
        }
    });
});

$('#saveRejectedAmount').click(function() {
    const allocationId = $('#allocationMid').val();
    const amount = $('#rejectedAmmount').val();
    const reason = $('#rejectReason').val();
    const comment = $('#comment').val();
    
    if (!amount) {
        alert('Please fill all fields');
        return;
    }

    $.ajax({
        url: '<?= base_url('AllocatedMachines/InsertRejectedAmmount') ?>',
        method: 'POST',
        data: {
            allocationId: allocationId,
            amount: amount,
            reason: reason,
            comment: comment
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert('Rejected amount saved successfully');
                $('#addRejectedModal').modal('hide');
                // You might want to refresh the data here
            } else {
                alert(response.message || 'Error saving rejected amount');
            }
        },
        error: function() {
            alert('Error saving Rejected amount');
        }
    });
});

function calculateBalanceQty() {
    let totalAllocated = 0;
    let totalCompleted = 0;

    $('#tableBody tr').each(function() {
        const allocated = parseInt($(this).find('td:eq(3)').text()) || 0; 
        const completed = parseInt($(this).find('td:eq(4)').text()) || 0;

        totalAllocated += allocated;
        totalCompleted += completed;
    });

    const balance = totalAllocated - totalCompleted;
    $('#balanceQty').text(balance);
}

</script>
