<?php

class MachineServicesCreated extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Commeninfo');
        $this->load->model('model_machine_services_created');
        $this->load->model('model_machine_services_calendar');

    }

    public function index()
    {
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $this->load->view('machineservicecreated', $result);
    }

    public function fetchCategoryData()
    {

        $status = $this->input->get('status');
        $service_type = $this->input->get('service_type');
        $machine_type = $this->input->get('machine_type');
        $machine_in_id = $this->input->get('machine_in_id');
        $service_no = $this->input->get('service_no');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $data = array(
            'status' => $status,
            'service_type' => $service_type,
            'machine_type' => $machine_type,
            'machine_in_id' => $machine_in_id,
            'service_no' => $service_no,
            'date_from' => $date_from,
            'date_to' => $date_to
        );

        $result = array('data' => array());

        $data = $this->model_machine_services_created->getMachineServicesCreatedData(null,$data);

        foreach ($data as $key => $value) {
            // button
            // $buttons = '';

            // $buttons .= '<button type="button" class="btn btn-primary btn-sm" title="View" onclick="viewFunc('.$value['id'].')" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></button>&nbsp;';

            // if($value['is_completed'] == 0){
            //         $buttons .= '<button type="button" class="btn btn-success btn-sm" title="Complete Service" onclick="completeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#completeModal"><i class="fas fa-check"></i></button>&nbsp;';
                
            // }else{
            //         $buttons .= '<button type="button" class="btn btn-danger btn-sm" title="Remove Complete Status" onclick="removeCompleteFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeCompleteModal"><i class="fas fa-times"></i></button>&nbsp;';
            // }

            //         $buttons .= '<button type="button" class="btn btn-primary btn-sm" title="Edit" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>';

            //         $buttons .= ' <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';

            $result['data'][$key] = array(
                $value['machine_type_name'], 
                $value['s_no'],
                $value['service_no'],
                $value['service_date_from'],
                $value['service_date_to'],
                $value['service_type'],
                $value['sub_total'],
                $value['remarks'],
                // $buttons
            );
        } // /foreach

        echo json_encode($result);
    }


    public function fetchMachineServicesCreatedDataById($id = null)
    {
        if($id) {
            $service_details = $this->model_machine_services_created->getMachineServicesCreatedData($id);
            $service_items = $this->model_machine_services_created->getMachineServiceItemsData($service_details['id']);
            echo json_encode(array('service_details' => $service_details, 'service_items' => $service_items));
        }

    }

    public function updateService()
    {

        $response = array();

        $data = array(
            'sub_total' => $this->input->post('sub_total'),
            'service_done_by' => $this->input->post('service_done_by'),
            'service_charge' => $this->input->post('service_charge'),
            'transport_charge' => $this->input->post('transport_charge'),
            'service_type' => $this->input->post('service_type'),
            'remarks' => $this->input->post('remarks'),
            'updated_by' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $id = $this->input->post('id');

        $create = $this->model_machine_services_created->update($id, $data);

        //delete all items from machine_service_details_items where machine_service_details_id = $id
        $this->model_machine_services_created->deleteMachineServiceItems($id);

        $service_details = $this->input->post('service_details');
        foreach ($service_details as $value) {

            $service_item_name = $value['service_item_name'];

            // $this->db->select('*');
            // $this->db->from('service_items');
            // $this->db->where('name', $service_item_name);
            // $query = $this->db->get();
            // $result = $query->row_array();
            // $service_item_id = $result['service_item_id'];

            $service_item_id = $value['service_item_id'];

            $data = array(
                'machine_service_details_id' => $id,
                'spare_part_id' => $service_item_id,
                'quantity' => $value['quantity'],
                'price' => $value['price'],
                'total' => $value['total'],
                'created_by' => $this->session->userdata('id'),
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->model_machine_services_calendar->createServiceDetailItems($data);
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

            $delete = $this->model_machine_services_created->update($id, $data);

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
        $complete = $this->model_machine_services_created->update($id, $data);
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
        $complete = $this->model_machine_services_created->update($id, $data);
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
        // $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        // $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_types.name', $term, 'both');
        $this->db->group_by('machine_types.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_types.id, machine_types.name');
        $this->db->from('machine_types');
        $this->db->join('machine_ins', 'machine_ins.machine_type_id = machine_types.id', 'left');
        // $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        // $this->db->where('machine_services.is_deleted', 0);
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

    //get_machine_ins_select
    public function get_machine_ins_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('machine_ins.id, machine_ins.s_no');
        $this->db->from('machine_ins');
        $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->like('machine_ins.s_no', $term, 'both');
        $this->db->group_by('machine_ins.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_ins.id, machine_ins.s_no');
        $this->db->from('machine_ins');
        $this->db->join('machine_services', 'machine_services.machine_in_id = machine_ins.id', 'left');
        $this->db->where('machine_services.is_deleted', 0);
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

    // Main query - get paginated results
    $this->db->select('machine_services.id, machine_services.service_no');
    $this->db->from('machine_services');
    $this->db->join('machine_service_details', 'machine_service_details.service_id = machine_services.id', 'left');
    $this->db->where('machine_services.is_deleted', 0);
    $this->db->like('machine_services.service_no', $term, 'both');
    $this->db->order_by('machine_services.id', 'DESC');  // NEWEST FIRST
    $this->db->limit($resultCount, $offset);             // APPLY LIMIT BEFORE get()
    $query = $this->db->get();
    $departments = $query->result_array();

    // Count total results for pagination
    $this->db->select('COUNT(*) as count');
    $this->db->from('machine_services');
    $this->db->join('machine_service_details', 'machine_service_details.service_id = machine_services.id', 'left');
    $this->db->where('machine_services.is_deleted', 0);
    $this->db->like('machine_services.service_no', $term, 'both');
    $countResult = $this->db->get()->row();
    $count = $countResult->count;

    // Format for Select2
    $data = array();
    foreach ($departments as $v) {
        $data[] = array(
            'id' => $v['service_no'],
            'text' => $v['service_no']
        );
    }

    $morePages = ($offset + $resultCount) < $count;

    echo json_encode([
        "results" => $data,
        "pagination" => ["more" => $morePages]
    ]);
}
public function generatePDF()
{
    $filters = [
        'status'        => $this->input->post('status'),
        'service_type'  => $this->input->post('service_type'),
        'machine_type'  => $this->input->post('machine_type'),
        'machine_in_id' => $this->input->post('machine_in_id'),
        'service_no'    => $this->input->post('service_no'),
        'date_from'     => $this->input->post('date_from'),
        'date_to'       => $this->input->post('date_to')
    ];

    $this->load->model('Model_machine_services_created');
    $rows = $this->Model_machine_services_created->getMachineServicesForPDF($filters);

    $this->Model_machine_services_created->generateMachineServicesPDF($rows);
}







}