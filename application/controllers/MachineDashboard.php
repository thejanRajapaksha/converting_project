<?php

class MachineDashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Machine Dashboard';
        $this->load->model('model_machine_dashboard');
    }

    public function index(){
        $this->load->model('Commeninfo');

        // Initialize data array
        $data['menuaccess'] = $this->Commeninfo->Getmenuprivilege();

        // Count all machine_ins
        $this->db->select('*');
        $this->db->from('machine_ins');
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        $data['count_machine_ins'] = $query->num_rows();

        // Get machine types
        $this->db->select('*');
        $this->db->from('machine_types');
        $query = $this->db->get();
        $machine_types = $query->result_array();
        $data['machine_types'] = $machine_types;

        $count_data = [];
        $current_date = date('Y-m-d');
        $current_date_time = date('Y-m-d H:i:s');

        foreach ($machine_types as $d) {
            $date_1 = date('Y-m-d', strtotime($current_date.' -1 year'));

            // Count for 0-1 year
            $this->db->where(['is_deleted' => 0, 'machine_type_id' => $d['id']]);
            $this->db->where('origin_date >=', $date_1);
            $this->db->where('origin_date <=', $current_date);
            $zero_1 = $this->db->get('machine_ins')->num_rows();

            // Count for 2-3 years
            $date_2 = date('Y-m-d', strtotime($current_date.' -2 year'));
            $date_3 = date('Y-m-d', strtotime($current_date.' -3 year'));
            $this->db->where(['is_deleted' => 0, 'machine_type_id' => $d['id']]);
            $this->db->where('origin_date >=', $date_3);
            $this->db->where('origin_date <=', $date_2);
            $two_3 = $this->db->get('machine_ins')->num_rows();

            // Count for 4-5 years
            $date_4 = date('Y-m-d', strtotime($current_date.' -4 year'));
            $date_5 = date('Y-m-d', strtotime($current_date.' -5 year'));
            $this->db->where(['is_deleted' => 0, 'machine_type_id' => $d['id']]);
            $this->db->where('origin_date >=', $date_5);
            $this->db->where('origin_date <=', $date_4);
            $four_5 = $this->db->get('machine_ins')->num_rows();

            // Count for >5 years
            $date_6 = date('Y-m-d', strtotime($current_date.' -5 year'));
            $this->db->where(['is_deleted' => 0, 'machine_type_id' => $d['id']]);
            $this->db->where('origin_date <', $date_6);
            $five_max = $this->db->get('machine_ins')->num_rows();

            $cd = [
                'type' => '2-3',
                'machine_type_id' => $d['id'],
                'machine_type_name' => $d['name'],
                'count_0_1' => $zero_1,
                'count_2_3' => $two_3,
                'count_4_5' => $four_5,
                'five_max' => $five_max
            ];

            $count_data[] = $cd;
        }

        $data['count_data'] = $count_data;
        $data['counts'] = [
            '0-1' => 0,
            '2-3' => 0,
            '4-5' => 0,
            '5<'  => 0
        ];

        $this->db->select(' COUNT(machine_ins.id) AS total_count');
        $this->db->join('machine_ins', 'machine_ins.id = machine_repairs.machine_in_id');
        $this->db->where('machine_repairs.is_deleted', 0);
        $this->db->where('machine_repairs.is_completed', 0);
        $this->db->where('machine_ins.is_deleted', 0);
        $this->db->where('machine_repairs.repair_out_date', null);
        $repairs_count = $this->db->count_all_results('machine_repairs');
        $data['repairs_count'] = $repairs_count;

        $this->db->select(' COUNT(machine_services.id) AS total_count');
        $this->db->join('machine_ins', 'machine_ins.id = machine_services.machine_in_id');
        $this->db->where('machine_services.is_deleted', 0);
        $this->db->where('machine_ins.is_deleted', 0);
        $this->db->where('service_date_from <=', $current_date_time);
        $this->db->where('service_date_to >=', $current_date_time);
        $services_count = $this->db->count_all_results('machine_services');
        $data['services_count'] = $services_count;

        $this->load->view('machineDashboard', $data);
    }

    //fetchMachineInsChartData
    public function fetchMachineInsChartData()
    {
        $data = $this->model_machine_dashboard->getMachineInsMachineTypesCount();

        $machine_types = array();
        $total_counts = array();
        $colors = array();

        foreach ($data as $val){
            $machine_types[] = $val['machine_type_name'];
            $total_counts[] = $val['total_count'];
            //random colors
            $colors[] = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        $result = array(
            'machine_types' => $machine_types,
            'total_counts' => $total_counts,
            'colors' => $colors
        );

        echo json_encode($result);

    }

    public function fetch_machine_types_data()
    {
        $machine_type_id = $this->input->post('id');

       // machine_ins not in machine_allocation_current
        $this->db->select('COUNT(machine_ins.id) AS total_count');
        $this->db->from('machine_ins');
        $this->db->where('machine_type_id', $machine_type_id);
        $this->db->where('is_deleted', 0);
        $this->db->where('id NOT IN (SELECT machine_in_id FROM machine_allocation_current)');
        $query = $this->db->get();
        $result = $query->row_array();
        $available_machines = $result['total_count'];

        //machine_ins in machine_repairs
        $this->db->select(' COUNT(machine_ins.id) AS total_count');
        $this->db->from('machine_repairs');
        $this->db->join('machine_ins', 'machine_ins.id = machine_repairs.machine_in_id');
        $this->db->where('machine_ins.machine_type_id', $machine_type_id);
        $this->db->where('machine_repairs.is_deleted', 0);
        $this->db->where('machine_ins.is_deleted', 0);
        $this->db->where('machine_repairs.repair_out_date', null);
        $query = $this->db->get();
        $result = $query->row_array();
        $repairing_machines = $result['total_count'];

        //machine_ins in machine_allocation_current
        // $this->db->select('machine_ins.*, machine_allocation_current.allocated_date, slots.name as slot_name, mlinelist.line_name as line_name, sections.name as section_name, departments.name as department_name');
        // $this->db->from('machine_allocation_current');
        // $this->db->join('slots', 'slots.id = machine_allocation_current.slot_id', 'left');
        // $this->db->join('mlinelist', 'mlinelist.id = slots.line', 'left');
        // $this->db->join('sections', 'sections.id = mlinelist.section', 'left');
        // $this->db->join('departments', 'departments.id = sections.department', 'left');
        // $this->db->join('machine_ins', 'machine_ins.id = machine_allocation_current.machine_in_id');
        // $this->db->where('machine_ins.machine_type_id', $machine_type_id);
        // $this->db->where('machine_ins.is_deleted', 0);
        // $query = $this->db->get();
        // $allocated_machines = $query->result_array();
        
        $this->db->select('machine_ins.*, ma.allocatedate, ma.startdatetime , ma.enddatetime , ma.allocatedqty , td.deliveryId');
        $this->db->from('tbl_machine_allocation as ma');
        $this->db->join('machine_ins', 'machine_ins.id = ma.tbl_machine_idtbl_machine', 'left');
        $this->db->join('tbl_order', 'tbl_order.idtbl_order = ma.tbl_order_idtbl_order', 'left');
        $this->db->join('tbl_delivery_detail as td', 'td.idtbl_delivery_detail = ma.tbl_delivery_plan_details_idtbl_delivery_plan_details', 'left');
        $this->db->where('machine_ins.machine_type_id', $machine_type_id);
        $this->db->where('machine_ins.is_deleted', 0);
        $query = $this->db->get();
        $allocated_machines = $query->result_array();

        $result = array(
            'available_machines' => $available_machines,
            'repairing_machines' => $repairing_machines,
            'allocated_machines' => $allocated_machines
        );

        echo json_encode($result);

    }

    public function fetch_available_machines_data(){
        $machine_type_id = $this->input->post('machine_type_id');

        $this->db->select('machine_ins.*,
                           mt.name as machine_type_name,
                           mm.name as machine_model_name,
                           it.name as in_type_name');

        $this->db->from('machine_ins');
        $this->db->join('machine_types mt', 'machine_ins.machine_type_id = mt.id');
        $this->db->join('machine_models mm', 'machine_ins.machine_model_id = mm.id');
        $this->db->join('in_types it', 'machine_ins.in_type_id = it.id');
        $this->db->where('machine_ins.is_deleted', 0);
        $this->db->where('machine_ins.machine_type_id', $machine_type_id);
        $this->db->where('machine_ins.id NOT IN (SELECT machine_in_id FROM machine_allocation_current)');
        $this->db->order_by('machine_ins.id', 'DESC');
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);
    }

    //fetch_repairing_machines_data
    public function fetch_repairing_machines_data()
    {
        $machine_type_id = $this->input->post('machine_type_id');
        $this->db->select('machine_ins.*,
                                mt.name as machine_type_name,
                                mm.name as machine_model_name,
                                it.name as in_type_name,
                                machine_repairs.repair_in_date
                                ');
        $this->db->from('machine_repairs');
        $this->db->join('machine_ins', 'machine_ins.id = machine_repairs.machine_in_id');
        $this->db->join('machine_types mt', 'machine_ins.machine_type_id = mt.id');
        $this->db->join('machine_models mm', 'machine_ins.machine_model_id = mm.id');
        $this->db->join('in_types it', 'machine_ins.in_type_id = it.id');
        $this->db->where('machine_ins.machine_type_id', $machine_type_id);
        $this->db->where('machine_repairs.is_deleted', 0);
        $this->db->where('machine_ins.is_deleted', 0);
        $this->db->where('machine_repairs.repair_out_date', null);
        $this->db->order_by('machine_ins.id', 'DESC');

        $query = $this->db->get();
        $result = $query->result_array();
        echo json_encode($result);

    }



}