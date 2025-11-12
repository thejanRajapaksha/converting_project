<?php

class MachineRepairsEmployee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Commeninfo');
        $this->load->model('model_machine_repairs_employee');

    }

    public function index()
    {
       $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
       $this->load->view('machineRepairEmployee', $result);
    }

    public function fetchCategoryData()
    {

        $employee_id = $this->input->get('employee_id');
        $date_from = $this->input->get('date_from');
        $date_to = $this->input->get('date_to');

        $data = array(
            'employee_id' => $employee_id,
            'date_from' => $date_from,
            'date_to' => $date_to
        );

        $result = array('data' => array());

        $data = $this->model_machine_repairs_employee->getEmployeeRepairsData(null,$data);

        foreach ($data as $key => $value) {
            // button
            $buttons = '';

            //$buttons .= '<button type="button" class="btn btn-default btn-sm" onclick="viewFunc('.$value['employee_id'].', \''.$date_from.'\', \''.$date_to.'\')" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye text-info"></i></button>';
            //viewFunc add employee_name too
            $buttons .= '<button type="button" class="btn btn-primary btn-sm" onclick="viewFunc('.$value['employee_id'].', \''.$date_from.'\', \''.$date_to.'\', \''.$value['employee_name'].'\')" data-toggle="modal" data-target="#viewModal"><i class="fas fa-eye"></i></button>';

            $result['data'][$key] = array(
                $value['employee_name'],
                $value['repair_count'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }



    public function fetchRepairDataById()
    {

        $id = $this->input->post('id');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');

        if($id) {
            $data = $this->model_machine_repairs_employee->getEmployeeRepairsDataById($id, $date_from, $date_to);
            echo json_encode($data);
        }

    }

    public function get_service_employee_select()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('service_employee.employee_name, service_employee.employee_id');
        $this->db->from('service_employee');
        $this->db->join('machine_repair_details', 'service_employee.employee_id = machine_repair_details.repair_done_by', 'left');
        $this->db->where('machine_repair_details.is_deleted', 0 );
        $this->db->like('service_employee.employee_name', $term, 'both');
        $this->db->group_by('service_employee.employee_id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('service_employee.employee_name, service_employee.employee_id');
        $this->db->from('service_employee');
        $this->db->join('machine_repair_details', 'service_employee.employee_id = machine_repair_details.repair_done_by', 'left');
        $this->db->where('machine_repair_details.is_deleted', 0 );
        $this->db->like('service_employee.employee_name', $term, 'both');
        $this->db->group_by('service_employee.employee_id');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['employee_id'],
                'text' => $v['employee_name'],
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

    public function get_employees_select() {
        $term = $this->input->get('term'); 
        $page = $this->input->get('page');
        $limit = 20; 
        $offset = ($page - 1) * $limit;

        $this->db->select('employee_id, employee_name');
        $this->db->from('service_employee');
        $this->db->where('status', 1);
        if (!empty($term)) {
            $this->db->like('employee_name', $term, 'both');
        }
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        $results = [];
        foreach ($query->result() as $row) {
            $results[] = [
                'id' => $row->employee_id,
                'text' => $row->employee_name
            ];
        }

        $response = [
            'results' => $results,
            'pagination' => ['more' => false]
        ];

        echo json_encode($response);
    }


}