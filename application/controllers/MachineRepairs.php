<?php

class MachineRepairs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Machine Repairs';
        $this->load->model('model_machine_repairs');

    }

    public function createRepair()
    {
        $response = array();

        // mark original machine_repair request as "has repair"
        $this->db->where('id', $this->input->post('repair_request_id'));
        $this->db->set('is_repair', 1);
        $this->db->update('machine_repairs');

        // insert main repair details
        $data = array(
            'repair_id'        => $this->input->post('repair_request_id'),
            'sub_total'        => $this->input->post('sub_total'),
            'repair_done_by'   => $this->input->post('repair_done_by'),
            'repair_charge'    => $this->input->post('repair_charge'),
            'transport_charge' => $this->input->post('transport_charge'),
            'repair_type'      => $this->input->post('repair_type'),
            'remarks'          => $this->input->post('remarks'),
            'created_by'       => $this->session->userdata('userid'),
            'created_at'       => date('Y-m-d H:i:s')
        );

        $create = $this->model_machine_repairs->create($data);

        // get last inserted repair details ID
        $repair_details_id = $this->db->insert_id();

        // insert repair items
        $repair_details = $this->input->post('repair_details');
        if (!empty($repair_details)) {
            foreach ($repair_details as $value) {
                $service_item_id = $value['repair_item_id'];

                $data = array(
                    'machine_repair_details_id' => $repair_details_id,
                    'service_item_id'           => $service_item_id,
                    'quantity'                  => $value['quantity'],
                    'price'                     => $value['price'],
                    'total'                     => $value['total'],
                    'created_by'                => $this->session->userdata('id'),
                    'created_at'                => date('Y-m-d H:i:s')
                );

                $this->model_machine_repairs->createRepairDetailItems($data);
            }
        }

        if ($create == true) {
            $response['success']  = true;
            $response['messages'] = 'Successfully created. The Page will be refreshed';
        } else {
            $response['success']  = false;
            $response['messages'] = 'Error in the database while creating the information';
        }

        echo json_encode($response);
    }

    //postponeService
    public function postponeRepair()
    {
        if(!in_array('createMachineRepairPostpone', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();
        $id = $this->input->post('id');

        $repair = $this->model_machine_repairs->getMachineRepairDetails($id);
        $original_date = $repair['repair_in_date'];

        $data = array(
            'repair_in_date' => $this->input->post('repair_in_date'),
            'postpone_reason' => $this->input->post('reason'),
            'is_postponed' => 1,
            'original_date' => $original_date,
            'updated_by' => $this->session->userdata('userid'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $postpone = $this->model_machine_repairs->update($id, $data);
        if($postpone == true) {
            $response['success'] = true;
            $response['messages'] = 'Successfully Postponed. The Page will be refreshed.';
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating the information';
        }
        echo json_encode($response);
    }

    //deleteService
    public function deleteService()
    {
        if(!in_array('createMachineService', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $data = array(
            'is_deleted' => 1,
            'deleted_by' => $this->session->userdata('userid'),
            'deleted_at' => date('Y-m-d H:i:s')
        );

        $response = array();
        $service_id = $this->input->post('id');
        $delete = $this->model_machine_services_calendar->update($service_id, $data);
        if($delete == true) {
            $response['success'] = true;
            $response['messages'] = 'Successfully deleted. The page will be refreshed.';
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating the information';
        }
        echo json_encode($response);
    }

    //get_employees_select
    public function get_employees_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $current_user = $this->session->userdata('userid');

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $current_user);
        $query = $this->db->get();
        $result = $query->row_array();

        $user_factory = $result['factory_id'];

        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('factory_id', $user_factory);
        $this->db->like('name_with_initial', $term, 'both');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where('factory_id', $user_factory);
        $this->db->like('name_with_initial', $term, 'both');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['id'],
                'text' => $v['name_with_initial']
            );
        }

        $endCount = $offset + $resultCount;
        $morePages = $endCount < $count;

        $results = array(
            "results" => $data,
            "pagination" => array(
                "more" => $morePages
            )
        );

        echo json_encode($results);

    }

    public function updateRepair($repair_id)
    {
        $response = array();

        // 1. Prepare main repair update data
        $data = array(
            'repair_done_by'   => $this->input->post('repair_done_by'),
            'sub_total'        => $this->input->post('sub_total'),
            'repair_charge'    => $this->input->post('repair_charge'),
            'transport_charge' => $this->input->post('transport_charge'),
            'repair_type'      => $this->input->post('repair_type'),
            'remarks'          => $this->input->post('remarks'),
            'updated_by'       => $this->session->userdata('userid'),
            'updated_at'       => date('Y-m-d H:i:s')
        );

        // 2. Fetch the machine_repair_details row that matches the repair_id
        $detail_row = $this->db->get_where('machine_repair_details', ['repair_id' => $repair_id])->row_array();

        if (!$detail_row) {
            $response['success'] = false;
            $response['messages'] = 'Repair details not found.';
            echo json_encode($response);
            return;
        }

        $detail_id = $detail_row['id'];

        // 3. Update main repair record
        $this->db->where('id', $detail_id);
        $update_main = $this->db->update('machine_repair_details', $data);

        if ($update_main) {
            // 4. Delete old items
            $this->db->where('machine_repair_details_id', $detail_id);
            $this->db->delete('machine_repair_details_items');

            // 5. Insert new items
            $edit_repair_details = $this->input->post('edit_repair_details');

            if (!empty($edit_repair_details)) {
                $insert_data = [];
                foreach ($edit_repair_details as $item) {
                    $insert_data[] = array(
                        'machine_repair_details_id' => $detail_id,
                        'service_item_id'           => $item['repair_item_id'],
                        'quantity'                  => $item['quantity'],
                        'price'                     => $item['price'],
                        'total'                     => $item['total'],
                        'created_by'                => $this->session->userdata('userid'),
                        'created_at'                => date('Y-m-d H:i:s')
                    );
                }
                if (!empty($insert_data)) {
                    $this->db->insert_batch('machine_repair_details_items', $insert_data);
                }
            }

            $response['success'] = true;
            $response['messages'] = 'Repair updated successfully!';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Failed to update repair.';
        }

        echo json_encode($response);
    }


    public function fetchRepairDetails($repair_id)
    {
        $this->db->select('r.id, r.repair_done_by, r.repair_charge, r.transport_charge, r.repair_type, r.remarks, mt.name as machine_type_name');
        $this->db->from('machine_repair_details r');
        $this->db->join('machine_repairs m', 'm.id = r.repair_id', 'left');
        $this->db->join('machine_ins mi', 'mi.id = m.machine_in_id', 'left');
        $this->db->join('machine_types mt', 'mt.id = mi.machine_type_id', 'left');
        $this->db->where('m.id', $repair_id);
        $repair = $this->db->get()->row_array();

        // Fetch repair items
        $this->db->select('i.service_item_id, s.name, i.quantity as qty, i.price');
        $this->db->from('machine_repair_details_items i');
        $this->db->join('machine_repair_details r', 'r.id = i.machine_repair_details_id', 'left');
        $this->db->join('machine_repairs m', 'm.id = r.repair_id', 'left');
        $this->db->join('spare_parts s', 's.id = i.service_item_id', 'left');
        $this->db->where('m.id', $repair_id);
        $items = $this->db->get()->result_array();

        // Build repair done by dropdown options (example: employees table)
        $employees = $this->db->get('service_employee')->result_array();
        $options = '';
        foreach ($employees as $emp) {
            $selected = ($emp['employee_id'] == $repair['repair_done_by']) ? 'selected' : '';
            $options .= '<option value="'.$emp['employee_id'].'" '.$selected.'>'.$emp['employee_name'].'</option>';
        }

        $response = array(
            'machine_type_name' => $repair['machine_type_name'],
            'repair_done_by_options' => $options,
            'repair_charge' => $repair['repair_charge'],
            'transport_charge' => $repair['transport_charge'],
            'repair_type' => $repair['repair_type'],
            'remarks' => $repair['remarks'],
            'items' => $items
        );

        echo json_encode($response);
    }

    public function completeRepair($repair_id)
    {
        $response = array();

        // Step 1: Get the machine_repair_details row
        $this->db->where('repair_id', $repair_id);
        $repair_detail = $this->db->get('machine_repair_details')->row_array();

        if(!$repair_detail) {
            $response['success'] = false;
            $response['messages'] = 'Repair details not found for this repair.';
            echo json_encode($response);
            return;
        }

        $detail_id = $repair_detail['id'];

        // Step 2: Get the repair items
        $this->db->where('machine_repair_details_id', $detail_id);
        $items = $this->db->get('machine_repair_details_items')->result_array();

        if(empty($items)) {
            $response['success'] = false;
            $response['messages'] = 'No repair items found.';
            echo json_encode($response);
            return;
        }

        // Step 3: Reduce stock (FIFO) and log usage
        foreach($items as $item){
            $issue_qty = (float)$item['quantity'];
            $sp_id     = $item['service_item_id'];

            $this->db->select('idtbl_print_stock, qty, tbl_sparepart_id, status, insertdatetime, batchno, unitprice');
            $this->db->where('tbl_sparepart_id', $sp_id);
            $this->db->where('status', 1);
            $this->db->order_by('insertdatetime', 'ASC');
            $batches = $this->db->get('tbl_print_stock')->result_array();

            foreach ($batches as $batch) {
                if ($issue_qty <= 0) break;

                $available_in_batch = (float)$batch['qty'];
                if ($available_in_batch <= 0) continue;

                if ($available_in_batch >= $issue_qty) {
                    // Deduct only required qty
                    $this->db->where('idtbl_print_stock', $batch['idtbl_print_stock']);
                    $this->db->set('qty', 'qty - ' . $issue_qty, FALSE);
                    $this->db->update('tbl_print_stock');

                    // ✅ Log issued qty
                    $this->db->insert('tbl_repair_stock', array(
                        'repair_id'   => $repair_id,
                        'batchno'     => $batch['batchno'],
                        'unitprice'   => $batch['unitprice'],
                        'qty'         => $issue_qty,
                        'spare_part_id' => $sp_id,
                        'created_by'  => $this->session->userdata('userid'),
                        'created_at'  => date('Y-m-d H:i:s')
                    ));

                    $issue_qty = 0;
                } else {
                    // Deduct full batch qty
                    $this->db->where('idtbl_print_stock', $batch['idtbl_print_stock']);
                    $this->db->set('qty', 0, FALSE);
                    $this->db->update('tbl_print_stock');

                    // ✅ Log issued full batch
                    $this->db->insert('tbl_repair_stock', array(
                        'repair_id'   => $repair_id,
                        'batchno'     => $batch['batchno'],
                        'unitprice'   => $batch['unitprice'],
                        'qty'         => $available_in_batch,
                        'spare_part_id' => $sp_id,
                        'created_by'  => $this->session->userdata('userid'),
                        'created_at'  => date('Y-m-d H:i:s')
                    ));

                    $issue_qty -= $available_in_batch;
                }
            }
        }

        // Step 4: Mark repair as completed
        $this->db->where('id', $repair_id);
        $update1 = $this->db->update('machine_repairs', array('is_completed' => 1));

        $this->db->where('repair_id', $repair_id);
        $update2 = $this->db->update('machine_repair_details', array('is_completed' => 1));

        if($update1 && $update2) {
            $response['success'] = true;
            $response['messages'] = 'Repair completed, stock reduced, and issued parts logged.';
        } else {
            $response['success'] = false;
            $response['messages'] = 'Failed to mark repair as completed.';
        }

        echo json_encode($response);
    }


}