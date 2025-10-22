<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class AllocatedMachines extends CI_controller {
    public function index(){
        $this->load->model('Machineallocationinfo');
        $this->load->model('AllocatedMachinesinfo');
        $this->load->model('Commeninfo');
        
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['machine']=$this->Machineallocationinfo->Getmachinelist();
        $result['reason']=$this->AllocatedMachinesinfo->getRejectReason();
        $this->load->view('allocatedMachines', $result);
	}
    public function fetch()
{
    $machineId = $this->input->post('machine_id');
    $date = $this->input->post('date');

    $this->load->model('AllocatedMachinesinfo');
    $data = $this->AllocatedMachinesinfo->getAllocationByMachineAndDate($machineId, $date);

    echo json_encode($data);
}
public function getAllocationDataById(){
    $allocationId = $this->input->post('id');

    $this->load->model('AllocatedMachinesinfo');
	$result= $this->AllocatedMachinesinfo->getAllocationDataByIdview($allocationId); 

    echo json_encode($result);

}

public function InsertCompletedAmmount()
{
    $user = $_SESSION['userid'];
    $this->load->model('AllocatedMachinesinfo'); 

    $allocationId = $this->input->post('allocation_id');
    $completeQty = $this->input->post('amount');
    $wasteQty = 0;

    if (!$allocationId) {
        echo json_encode(['success' => false, 'message' => 'Required fields are missing']);
        return;
    }

    // ✅ ✅ ADD THIS BLOCK → (Order validation using machine_type, not machine_id)
    $allocation = $this->AllocatedMachinesinfo->getAllocationDataById($allocationId);
    $orderId = $allocation->tbl_order_idtbl_order;

    $machineData = $this->AllocatedMachinesinfo->getMachineById($allocation->tbl_machine_idtbl_machine);
    $currentMachineType = $machineData->machine_type_id;

    $currentOrder = $this->AllocatedMachinesinfo->getMachineOrder($orderId, $currentMachineType);
    $currentOrderNumber = $currentOrder ? $currentOrder->order_number : null;

    if ($currentOrderNumber > 1) {
        $prevOrder = $this->AllocatedMachinesinfo->getMachineByOrder($orderId, $currentOrderNumber - 1);
        $prevMachineType = $prevOrder->machine_types_id;
        $previousCompleted = $this->AllocatedMachinesinfo->isMachineTypeCompleted($prevMachineType, $orderId);

        if (!$previousCompleted) {
            echo json_encode(['success' => false, 'message' => 'Previous machine process not completed yet']);
            return;
        }
    }

    // ✅ Continue your existing code (no changes here)...
    $data = [
        'tbl_machine_allocation_idtbl_machine_allocation' => $allocationId,
        'wastageqty' => $wasteQty,
        'completedqty' => $completeQty,
        'insertuser' => $user,
        'status' => '1',
    ];

    $exists = $this->AllocatedMachinesinfo->checkAllocationExists($allocationId);

    if ($exists) {
        $this->AllocatedMachinesinfo->updateAllocationDetailsData($allocationId, ['completedqty' => $completeQty]);
    } else {
        $this->AllocatedMachinesinfo->insertQty($data);
    }

    // ✅ ✅ Mark machine allocation as fully completed if qty matched
    $this->AllocatedMachinesinfo->updateCompletedStatusIfEqual($allocationId);

    echo json_encode(['success' => true]);
}


public function InsertRejectedAmmount()
{
    $user = $_SESSION['userid'];
    $this->load->model('AllocatedMachinesinfo'); 

    $allocationId = $this->input->post('allocationId');
    $amount = $this->input->post('amount');
    $reason = $this->input->post('reason');
    $comment = $this->input->post('comment');

    if (!$allocationId) {
        echo json_encode(['success' => false, 'message' => 'Required fields are missing']);
        return;
    }

    $data = [
        'tbl_machine_allocation_idtbl_machine_allocation' => $allocationId,
        'wastageqty' => $amount,
        'tbl_reject_item_reason_id_rejected_item_reason' => $reason,
        'comment' => $comment,
        'completedqty' => 0,
        'insertuser' => $user,
        'status' => 1
    ];

    $exists = $this->AllocatedMachinesinfo->checkAllocationExists($allocationId);

    if ($exists) {

        $updateData = [
            'wastageqty' => $amount,
            'tbl_reject_item_reason_id_rejected_item_reason' => $reason,
            'comment' => $comment,
        ];
        $this->AllocatedMachinesinfo->updateAllocationDetailsData($allocationId, $updateData);
    } else {
        $this->AllocatedMachinesinfo->insertQty($data);
    }

    echo json_encode(['success' => true]);
}


}