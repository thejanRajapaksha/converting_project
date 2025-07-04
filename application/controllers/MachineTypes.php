<?php

class MachineTypes extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_machine_types'); // load as lowercase
    }

    public function index()
    {
        $this->load->model('Commeninfo');
        $data['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $this->load->model('model_machine_types');
        $this->load->view('machineTypes', $data);
    }

    public function fetchCategoryData()
    {
        $result = array('data' => array());

        $data = $this->model_machine_types->getMachineTypesData();

        foreach ($data as $key => $value) {
            // button
            $buttons = '
                <button type="button" class="btn btn-default btn-sm" onclick="editFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#editModal"><i class="text-primary fa fa-edit"></i></button>
                <button type="button" class="btn btn-default btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="text-danger fa fa-trash"></i></button>
            ';

             $status = ($value['active'] == 1)
                ? '<span class="badge badge-success">Active</span>'
                : '<span class="badge badge-warning">Inactive</span>';

            $result['data'][$key] = array(
                $value['name'],
                $status,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function create()
    {
        $response = array();

        $this->form_validation->set_rules('machine_type_name', 'MachineType name', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'name' => $this->input->post('machine_type_name'),
                'active' => $this->input->post('active'),
            );

            $create = $this->model_machine_types->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Successfully created';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while creating the machine type information';
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

    public function fetchMachineTypesDataById($id = null)
    {
        if($id) {
            $data = $this->model_machine_types->getMachineTypesData($id);
            echo json_encode($data);
        }

    }

    public function update($id)
    {
        $response = array();

        if($id) {
            $this->form_validation->set_rules('edit_machine_type_name', 'MachineType name', 'trim|required');
            $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'name' => $this->input->post('edit_machine_type_name'),
                    'active' => $this->input->post('edit_active'),
                );

                $update = $this->model_machine_types->update($id, $data);
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Successfully updated';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated the brand information';
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
        $machine_type_id = $this->input->post('machine_type_id');

        $response = array();
        if($machine_type_id) {
            $delete = $this->model_machine_types->remove($machine_type_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the brand information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response);
    }

    public function get_machine_types_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('*');
        $this->db->from('machine_types');
        $this->db->like('name', $term, 'both');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $machine_ins = $query->result_array();

        $this->db->select('*');
        $this->db->from('machine_types');
        $this->db->like('name', $term, 'both');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($machine_ins as $v) {
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

}