<?php
class AllocatedMachinesinfo extends CI_Model{
    public function getAllocationByMachineAndDate($machineId, $date) {
        $startOfDay = $date . ' 00:00:00';
        $endOfDay = $date . ' 23:59:59';

        $this->db->select('
            ma.allocatedate,
            ma.allocatedqty,
            ma.idtbl_machine_allocation,
            de.deliveryId,
            de.delivery_date,
            p.product,
            o.idtbl_order,
            mt.name,
            m.s_no
        ');
        $this->db->from('tbl_machine_allocation as ma');
        $this->db->join('machine_ins as m', 'm.id = ma.tbl_machine_idtbl_machine');
        $this->db->join('machine_types as mt', 'mt.id = m.machine_type_id');
        $this->db->join('tbl_order as o', 'o.idtbl_order = ma.tbl_order_idtbl_order');
        $this->db->join('tbl_order_detail as od', 'od.tbl_order_idtbl_order = o.idtbl_order');
        $this->db->join('tbl_products as p', 'p.idtbl_product = od.tbl_products_idtbl_products');
        $this->db->join('tbl_delivery_detail as de', 'de.idtbl_delivery_detail = ma.tbl_delivery_plan_details_idtbl_delivery_plan_details');
        $this->db->where('m.id', $machineId);
        $this->db->where('ma.startdatetime <=', $endOfDay);
        $this->db->where('ma.enddatetime >=', $startOfDay);

        $query = $this->db->get();
        return $query->result();
    }

public function getAllocationDataById($allocationId)
{
    $this->db->select('
        mt.name,
        m.s_no,
        ma.startdatetime,
        ma.enddatetime,
        ma.allocatedqty,
        ma.idtbl_machine_allocation,
        md.completedqty,
        md.wastageqty,
        ma.tbl_order_idtbl_order,
        ma.tbl_machine_idtbl_machine
    ');
    $this->db->from('tbl_machine_allocation as ma');
    $this->db->join('machine_ins as m', 'm.id = ma.tbl_machine_idtbl_machine','left');
    $this->db->join('machine_types as mt', 'mt.id = m.machine_type_id','left');
    $this->db->join('tbl_machine_allocation_details as md', 'md.tbl_machine_allocation_idtbl_machine_allocation = ma.idtbl_machine_allocation','left');
    $this->db->where('idtbl_machine_allocation', $allocationId);
    $query = $this->db->get();
    return $query->row();
}

public function getAllocationDataByIdview($allocationId)
{
    $this->db->select('
        mt.name,
        m.s_no,
        ma.startdatetime,
        ma.enddatetime,
        ma.allocatedqty,
        ma.idtbl_machine_allocation,
        md.completedqty,
        md.wastageqty,
        ma.tbl_order_idtbl_order,
        ma.tbl_machine_idtbl_machine
    ');
    $this->db->from('tbl_machine_allocation as ma');
    $this->db->join('machine_ins as m', 'm.id = ma.tbl_machine_idtbl_machine','left');
    $this->db->join('machine_types as mt', 'mt.id = m.machine_type_id','left');
    $this->db->join('tbl_machine_allocation_details as md', 'md.tbl_machine_allocation_idtbl_machine_allocation = ma.idtbl_machine_allocation','left');
    $this->db->where('idtbl_machine_allocation', $allocationId);
    $query = $this->db->get();
    return $query->result();
}

public function InsertCompletedAmmount($data){
    $data = [
            'tbl_machine_allocation_idtbl_machine_allocation' => $allocationId,
            'completedqty' => $amount
        ];
    return $this->db->insert('tbl_machine_allocation_details', $data);
}
public function getRejectReason(){
    $this->db->select('reason_type , id_rejected_item_reason as id');
    $this->db->from('rejected_item_reason');
    $query = $this->db->get();
    return $query->result();

}
 public function checkAllocationExists($allocationId)
    {
        $this->db->where('tbl_machine_allocation_idtbl_machine_allocation', $allocationId);
        $query = $this->db->get('tbl_machine_allocation_details');
        return $query->num_rows() > 0;
    }

public function updateAllocationDetailsData($allocationId, $data)
    {
        $this->db->where('tbl_machine_allocation_idtbl_machine_allocation', $allocationId);
        return $this->db->update('tbl_machine_allocation_details', $data);
    }

public function insertQty($data)
    {
        return $this->db->insert('tbl_machine_allocation_details', $data);
    }

public function getMachineOrder($orderId, $machineTypeId)
{
    return $this->db->where('tbl_order_idtbl_order', $orderId)
                    ->where('machine_types_id', $machineTypeId)
                    ->get('machine_allocation_order')
                    ->row();
}

public function getMachineByOrder($orderId, $orderNumber)
{
    return $this->db->where('tbl_order_idtbl_order', $orderId)
                    ->get('machine_allocation_order')
                    ->row();
}

public function isMachineTypeCompleted($machineTypeId, $orderId)
{
    $this->db->select_sum('completedqty');
    $this->db->from('tbl_machine_allocation_details');
    $this->db->join('tbl_machine_allocation', 'tbl_machine_allocation.idtbl_machine_allocation = tbl_machine_allocation_details.tbl_machine_allocation_idtbl_machine_allocation');
    $this->db->join('machine_ins', 'machine_ins.id = tbl_machine_allocation.tbl_machine_idtbl_machine');
    $this->db->where('machine_ins.machine_type_id', $machineTypeId);
    $this->db->where('tbl_machine_allocation.tbl_order_idtbl_order', $orderId);

    $result = $this->db->get()->row();
    return ($result && $result->completedqty > 0); 
}

public function updateCompletedStatusIfEqual($allocationId)
{
    $alloc = $this->db->where('idtbl_machine_allocation', $allocationId)
                      ->get('tbl_machine_allocation')
                      ->row();

    $this->db->select_sum('completedqty');
    $this->db->from('tbl_machine_allocation_details');
    $this->db->where('tbl_machine_allocation_idtbl_machine_allocation', $allocationId);
    $details = $this->db->get()->row();

    if ($details && $alloc && $details->completedqty >= $alloc->allocatedqty) {
        $this->db->where('idtbl_machine_allocation', $allocationId)
                 ->update('tbl_machine_allocation', [
                     'completed_status' => 1,
                     'completeddatetime' => date('Y-m-d H:i:s')
                 ]);
    }
}

public function getMachineById($machineId)
{
    return $this->db->where('id', $machineId)
                    ->get('machine_ins')   
                    ->row();
}
public function insertCompletedLog($data)
{
    return $this->db->insert('completed_allocation_log', $data);
}

public function isEntireOrderCompletedWithMachineTypes($orderId)
{
    // Total allocated
    $this->db->select_sum('allocatedqty', 'total_allocated');
    $this->db->where('tbl_order_idtbl_order', $orderId);
    $allocData = $this->db->get('tbl_machine_allocation')->row();
    $totalAllocated = (float)($allocData->total_allocated ?? 0);

    // Total completed
    $this->db->select_sum('tbl_machine_allocation_details.completedqty', 'total_completed');
    $this->db->join('tbl_machine_allocation', 'tbl_machine_allocation.idtbl_machine_allocation = tbl_machine_allocation_details.tbl_machine_allocation_idtbl_machine_allocation');
    $this->db->where('tbl_machine_allocation.tbl_order_idtbl_order', $orderId);
    $completedData = $this->db->get('tbl_machine_allocation_details')->row();
    $totalCompleted = (float)($completedData->total_completed ?? 0);

    // Allocation statuses
    $this->db->select('COUNT(*) as total, SUM(CASE WHEN completed_status = 1 THEN 1 ELSE 0 END) as completed');
    $this->db->where('tbl_order_idtbl_order', $orderId);
    $statusData = $this->db->get('tbl_machine_allocation')->row();

    $allAllocationsCompleted = ((int)$statusData->total > 0 && (int)$statusData->total === (int)$statusData->completed);

    return ($allAllocationsCompleted && ($totalAllocated > 0 && $totalCompleted >= $totalAllocated));
}

public function insertCompletedOrderIfNotExists($orderId, $user)
{
    $exists = $this->db->where('tbl_order_idtbl_order', $orderId)
                       ->get('completed_orders')
                       ->num_rows() > 0;

    if (!$exists) {
        $data = [
            'tbl_order_idtbl_order' => $orderId,
            'completed_date' => date('Y-m-d H:i:s'),
            'insertuser' => $user,
        ];
        $this->db->insert('completed_orders', $data);
    }
}
public function updateOrderStatus($orderId, $data)
{
    $this->db->where('idtbl_order', $orderId);
    return $this->db->update('tbl_order', $data);
}




}