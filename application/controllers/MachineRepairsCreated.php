<?php

class MachineRepairsCreated extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Commeninfo');
        $this->load->model('model_machine_repairs_created');
        $this->load->model('model_machine_repairs');

    }

    public function index()
    {
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $this->load->view('machinerepairscreated', $result);
    }

    public function fetchCategoryData()
    {


        $status = $this->input->get('status');
        $repair_type = $this->input->get('repair_type');
        $machine_type = $this->input->get('machine_type');
        $machine_in_id = $this->input->get('machine_in_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $data = array(
            'status' => $status,
            'repair_type' => $repair_type,
            'machine_type' => $machine_type,
            'machine_in_id' => $machine_in_id,
            'date_from' => $date_from,
            'date_to' => $date_to
        );

        $result = array('data' => array());

        $data = $this->model_machine_repairs_created->getMachineRepairsCreatedData(null,$data);

        foreach ($data as $key => $value) {
            // button
            $buttons = '';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" title="View" onclick="viewFunc('.$value['id'].')" data-toggle="modal" data-target="#viewModal"><i class="text-info fa fa-eye"></i></button>';

            if($value['is_completed'] == 0){
                
                    $buttons .= '<button type="button" class="btn btn-default btn-sm" title="Complete Repair" onclick="completeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#completeModal"><i class="text-success fa fa-check"></i></button>';
            }else{
                
                    $buttons .= '<button type="button" class="btn btn-default btn-sm" title="Remove Complete Status" onclick="removeCompleteFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeCompleteModal"><i class="text-danger fa fa-times"></i></button>';
                
            }

                $buttons .= '<button type="button" class="btn btn-default btn-sm" title="Edit" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="text-primary fa fa-edit"></i></button>';

                $buttons .= ' <button type="button" class="btn btn-default btn-sm" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="text-danger fa fa-trash"></i></button>';
            

            $result['data'][$key] = array(
                $value['machine_type_name'],
                $value['bar_code'],
                $value['s_no'],
                $value['repair_in_date'],
                $value['repair_type'],
                $value['sub_total'],
                $value['remarks'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }


    public function fetchMachineRepairsCreatedDataById($id = null)
    {
        if($id) {
            $repair_details = $this->model_machine_repairs_created->getMachineRepairsCreatedData($id);
            $service_items = $this->model_machine_repairs_created->getMachineRepairItemsData($repair_details['id']);
            echo json_encode(array('repair_details' => $repair_details, 'service_items' => $service_items));
        }

    }

    public function updateRepair()
    {

        $response = array();

        $data = array(
            'sub_total' => $this->input->post('sub_total'),
            'repair_done_by' => $this->input->post('repair_done_by'),
            'repair_charge' => $this->input->post('repair_charge'),
            'transport_charge' => $this->input->post('transport_charge'),
            'repair_type' => $this->input->post('repair_type'),
            'remarks' => $this->input->post('remarks'),
            'updated_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $id = $this->input->post('id');

        $create = $this->model_machine_repairs_created->update($id, $data);

        //delete all items from machine_repair_details_items where machine_repair_details_id = $id
        $this->model_machine_repairs_created->deleteMachineRepairItems($id);

        $repair_details = $this->input->post('repair_details');
        foreach ($repair_details as $value) {

            $service_item_name = $value['service_item_name'];

            $this->db->select('*');
            $this->db->from('service_items');
            $this->db->where('name', $service_item_name);
            $query = $this->db->get();
            $result = $query->row_array();
            $service_item_id = $result['id'];

            $data = array(
                'machine_repair_details_id' => $id,
                'service_item_id' => $service_item_id,
                'quantity' => $value['quantity'],
                'price' => $value['price'],
                'total' => $value['total'],
                'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->model_machine_repairs->createRepairDetailItems($data);
        }

        if($create == true) {
            $response['success'] = true;
            $response['messages'] = 'Successfully updated';
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error in the database while creating the information';
        }

        echo json_encode($response);
    }

    public function remove()
    {

        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $data = array(
                'is_deleted' => 1,
                'deleted_by' => $this->session->userdata('id'),
                'deleted_at' => date('Y-m-d H:i:s')
            );

            $delete = $this->model_machine_repairs_created->update($id, $data);

            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the information";
            }

        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response);
    }

    //complete
    public function complete()
    {

        $response = array();
        $id = $this->input->post('id');
        $complete_remarks = $this->input->post('remarks');
        $data = array(
            'is_completed' => 1,
            'complete_remarks' => $complete_remarks,
            'updated_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $complete = $this->model_machine_repairs_created->update($id, $data);
        if($complete == true) {
            $response['success'] = true;
            $response['messages'] = "Successfully completed";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error in the database while removing the information";
        }
        echo json_encode($response);
    }

    public function removeComplete()
    {

        $response = array();
        $id = $this->input->post('id');
        $complete_remarks = $this->input->post('remarks');
        $data = array(
            'is_completed' => 0,
            'complete_remarks' => $complete_remarks,
            'updated_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $complete = $this->model_machine_repairs_created->update($id, $data);
        if($complete == true) {
            $response['success'] = true;
            $response['messages'] = "Successfully Removed Complete Status";
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Error in the database while removing the information";
        }
        echo json_encode($response);
    }

    //get_machine_types_select
    public function get_machine_types_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('machine_types.id, machine_types.name');
        $this->db->from('machine_types');
        $this->db->join('machine_ins', 'machine_ins.machine_type_id = machine_types.id', 'left');
        $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_types.name', $term, 'both');
        $this->db->group_by('machine_types.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_types.id, machine_types.name');
        $this->db->from('machine_types');
        $this->db->join('machine_ins', 'machine_ins.machine_type_id = machine_types.id', 'left');
        $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_types.name', $term, 'both');
        $this->db->group_by('machine_types.id');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['id'],
                'text' => $v['name']
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

    public function get_machine_ins_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('machine_ins.id, machine_ins.s_no');
        $this->db->from('machine_ins');
        $this->db->join('machine_repairs', 'machine_repairs.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_repairs.is_deleted', 0);
        $this->db->like('machine_ins.s_no', $term, 'both');
        $this->db->group_by('machine_ins.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_ins.id, machine_ins.s_no');
        $this->db->from('machine_ins');
        $this->db->join('machine_repairs', 'machine_repairs.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_repairs.is_deleted', 0);
        $this->db->like('machine_ins.s_no', $term, 'both');
        $this->db->group_by('machine_ins.id');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['id'],
                'text' => $v['s_no']
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

    //get_service_no_select
    public function get_service_no_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('machine_services.id, machine_services.service_no');
        $this->db->from('machine_services');
        $this->db->join('machine_service_details', 'machine_service_details.service_id = machine_services.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_services.service_no', $term, 'both');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_services.id, machine_services.service_no');
        $this->db->from('machine_services');
        $this->db->join('machine_service_details', 'machine_service_details.service_id = machine_services.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_services.service_no', $term, 'both');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['service_no'],
                'text' => $v['service_no']
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





}