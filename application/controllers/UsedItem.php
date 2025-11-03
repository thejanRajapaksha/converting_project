<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Colombo');

class UsedItem extends CI_Controller {

    public function index() {
        $this->load->model('Useiteminfo');
        $this->load->model('Commeninfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $result['getmachinetype'] = $this->Useiteminfo->Machinetypeget();
        $result['getmachinemodel'] = $this->Useiteminfo->Machinemodelget();
        $result['getmachine'] = $this->Useiteminfo->Machineget();
        $this->load->view('useditem', $result);
    }

    public function useItemReport()
    {
        $filters = [
            'search_date'      => $this->input->post('search_date'),
            'search_week'      => $this->input->post('search_week'),
            'search_month'     => $this->input->post('search_month'),
            'search_from_date' => $this->input->post('search_from_date'),
            'search_to_date'   => $this->input->post('search_to_date'),
            'report_type'      => $this->input->post('report_type'),
            'search_type'      => $this->input->post('search_type'),
            'supplier'         => $this->input->post('supplier')
        ];

        $rows = $this->input->post('rows'); 

        if (empty($rows)) {
            show_error("No data received for report generation.");
            return;
        }

        $this->load->model('Useiteminfo');
        $this->Useiteminfo->generateUsedItemReportPDF($rows, $filters);
    }

    public function getModelsByType() {
        $this->load->model('Useiteminfo');

        $typeId = $this->input->post('type_id');
        $models = $this->Useiteminfo->getModelsByType($typeId);
        echo json_encode($models);
    }

    public function getMachinesByModel() {
        $this->load->model('Useiteminfo');

        $modelId = $this->input->post('model_id');
        $machine = $this->Useiteminfo->getMachinesByModel($modelId);
        echo json_encode($machine);
    }

    

}
