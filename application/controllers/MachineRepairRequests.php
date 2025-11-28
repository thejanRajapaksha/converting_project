<?php

class MachineRepairRequests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_machine_repair_requests');

    }

    public function index()
    {
        $this->load->model('Commeninfo');
        $data['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $this->load->view('machineRepairRequests', $data);
    }

public function fetchCategoryData()
{
    $result = array('data' => array());

    $data = $this->model_machine_repair_requests->getMachineRepairRequestsData();

    foreach ($data as $key => $value) {

        // WRAPPER FOR BUTTONS
        $buttons = '<div class="action-buttons d-flex align-items-center">';

        //check if machine_repair_details exists for repair_id
        $this->db->select('*');
        $this->db->from('machine_repair_details');
        $this->db->where('repair_id', $value['id']);
        $query = $this->db->get();
        $result1 = $query->row_array();

        if($value['is_completed'] == 0){

            $buttons .= '<button type="button" class="btn btn-info btn-sm mr-1" title="Edit" onclick="editRepair('.$value['id'].')" data-toggle="modal" data-target="#repairEditModal">
                            <i class="fas fa-pen"></i>
                        </button>';

            $buttons .= '<button type="button" class="btn btn-success btn-sm mr-1" title="Complete" data-id="'.$value['id'].'" data-toggle="modal" data-target="#completeModal">
                            <i class="fas fa-check-circle"></i>
                        </button>';

            if(empty($result1)){
                $buttons .= '<button type="button" class="btn btn-info btn-sm mr-1 repair_add_btn" data-id="'.$value['id'].'" data-machine_type_name="'.$value['machine_type_name'].'" title="Create Repair" data-toggle="modal" data-target="#repairAddModal"><i class="fas fa-wrench"></i></button>';

                $buttons .= '<button type="button" class="btn btn-warning btn-sm mr-1 btn_postpone" data-id="'.$value['id'].'" data-machine_type_name="'.$value['machine_type_name'].'" title="Postpone"><i class="fas fa-stop-circle"></i></button>';
            }

            $buttons .= '<button type="button" class="btn btn-primary btn-sm mr-1" title="Edit" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fas fa-pen"></i></button>';

            if($value['is_repair'] == 0){
                $buttons .= '<button type="button" class="btn btn-danger btn-sm mr-1" title="Delete" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fas fa-trash"></i></button>';
            }
        }

        if(!empty($result1)){
            if($value['is_completed'] == 0 || $value['is_completed'] == 1){
                $buttons .= '<button type="button" class="btn btn-primary btn-sm mr-1" title="View" onclick="viewFunc('.$value['id'].')" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></button>';
            }
        }

        // CLOSE WRAPPER
        $buttons .= '</div>';

        $result['data'][$key] = array(
            $value['machine_type_name'],
            $value['bar_code'],
            $value['s_no'],
            $value['repair_in_date'],
            $buttons
        );
    }

    echo json_encode($result);
}


    public function create()
    {
        $response = array();

        //$this->form_validation->set_rules('service_no', 'Service No', 'trim|required');
        $this->form_validation->set_rules('machine_in_id', 'Machine', 'trim|required');
        $this->form_validation->set_rules('repair_date', 'Repair In Date', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'machine_in_id' => $this->input->post('machine_in_id'),
                'repair_in_date' => $this->input->post('repair_date'),
                'is_repair' => 0,
            );

            $create = $this->model_machine_repair_requests->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Successfully created';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating the information';
            }
        }
        else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);
    }

    public function fetchMachineRepairRequestsDataById($id = null)
    {
        if($id) {
            $data = $this->model_machine_repair_requests->getMachineRepairRequestsData($id);
            echo json_encode($data);
        }

    }

    public function update($id)
    {
        $response = array();

        if($id) {
            $this->form_validation->set_rules('edit_machine_in_id', 'Machine', 'trim|required');
            $this->form_validation->set_rules('edit_repair_date', 'Repair Date', 'trim|required');

            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'machine_in_id' => $this->input->post('edit_machine_in_id'),
                    'repair_in_date' => $this->input->post('edit_repair_date'),
                    'updated_by' => $this->session->userdata('userid'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $update = $this->model_machine_repair_requests->update($id, $data);
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Successfully updated';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated the information';
                }
            }
            else {
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error please refresh the page again!!';
        }

        echo json_encode($response);
    }

    public function remove()
    {
        $machine_repair_id = $this->input->post('machine_repair_id');

        $response = array();
        if($machine_repair_id) {
             //$delete = $this->model_machine_repair_requests->remove($machine_repair_id);

            $data = array(
                'is_deleted' => 1,
                'deleted_by' => $this->session->userdata('userid'),
                'deleted_at' => date('Y-m-d H:i:s')
            );

            $delete = $this->model_machine_repair_requests->update($machine_repair_id, $data);

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

    public function getServiceNo()
    {
        $this->db->select('*');
        $this->db->from('machine_services');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        $machine_service = $query->row_array();

        if (empty($machine_service)) {
            $service_id = 1;
        } else {
            $service_id = $machine_service['id'] + 1;
        }

        //check if job no string is less than 4 digits
        if (strlen($service_id) < 4) {
            //add leading zeroes and trim to last 4 digits
            $service_id = str_pad($service_id, 4, '0', STR_PAD_LEFT);
        }

        $service_no = 'SRV' . $service_id;

        echo json_encode($service_no);
    }

    public function get_sparepart_batches() {
        $sparepart_id = $this->input->post('sparepart_id');
        $response = array('success' => false);

        if (!empty($sparepart_id)) {
            $batches = $this->model_machine_repair_requests->get_sparepart_batches($sparepart_id);
            if ($batches) {
                $response = array(
                    'success' => true,
                    'batches' => $batches
                );
            }
        }

        echo json_encode($response);
    }

}