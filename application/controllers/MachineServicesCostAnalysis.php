<?php

class MachineServicesCostAnalysis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Commeninfo');
        $this->load->model('model_machine_services_cost_analysis');

    }

    public function index()
    {
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $this->load->view('machineservicescostanalysis', $result);
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

        $data = $this->model_machine_services_cost_analysis->getMachineServicesCostAnalysisData(null,$data);

        foreach ($data as $key => $value) {
            // button
            $buttons = '';

            $buttons .= '<button type="button" class="btn btn-default btn-sm" title="View" onclick="viewFunc('.$value['id'].')" data-toggle="modal" data-target="#viewModal"><i class="text-info fa fa-eye"></i></button>';

            $total = $value['sub_total'] + $value['service_charge'] + $value['transport_charge'];

            $result['data'][$key] = array(
                $value['machine_type_name'],
                $value['bar_code'],
                $value['s_no'],
                $value['service_no'],
                $value['service_date_from'],
                $value['service_date_to'],
                $value['service_type'],
                $value['sub_total'],
                $value['service_charge'],
                $value['transport_charge'],
                $value['remarks'],
                $total,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    //fetchMonthlyServiceCost
    public function fetchMonthlyServiceCost()
    {
        $last_12_months = array();

        for($i = 0; $i <= 12; $i++) {
            $last_12_months[$i] = date('M-Y', strtotime('-'.$i.' months'));
        }

        krsort($last_12_months);

        $data = array();

        foreach ($last_12_months as $month){
            //get cost for each month
            $cost = $this->model_machine_services_cost_analysis->getMonthlyServiceCost($month);
            $data[] = array(
                'month' => $month,
                'cost' => $cost['total_cost'] ?? 0
            );
        }

        $months = array_column($data, 'month');
        $costs = array_column($data, 'cost');

        $result = array('months' => $months, 'costs' => $costs);

        echo json_encode($result);

    }

    public function fetchMachineTypeServiceItems()
    {


        $date = $this->input->post('date');

        $data = $this->model_machine_services_cost_analysis->getMachineTypesServiceItemsCount($date);

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

    public function generateCostAnalysisPDF()
    {
        $this->load->model('Model_machine_services_cost_analysis');

        $filters = $this->input->post();
        
        $rows = $this->Model_machine_services_cost_analysis->getMachineServicesCostAnalysisForPDF($filters);

        $this->Model_machine_services_cost_analysis->generateMachineServicesCostAnalysisPDF($rows);
    }






}