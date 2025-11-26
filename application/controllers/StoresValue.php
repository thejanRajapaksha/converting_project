<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Colombo');

class StoresValue extends CI_Controller {

    public function index() {
        $this->load->model('StoresValueinfo');
        $this->load->model('Commeninfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $result['getmachinetype'] = $this->StoresValueinfo->Machinetypeget();
        $result['getmachinemodel'] = $this->StoresValueinfo->Machinemodelget();
        $result['getmachine'] = $this->StoresValueinfo->Machineget();
        $this->load->view('storesvalue', $result);
    }

    public function StoresValueReport()
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

        $this->load->model('StoresValueinfo');
        $this->StoresValueinfo->generateStoresValueReportPDF($rows, $filters);
    }

    public function getModelsByType() {
        $this->load->model('StoresValueinfo');

        $typeId = $this->input->post('type_id');
        $models = $this->StoresValueinfo->getModelsByType($typeId);
        echo json_encode($models);
    }

    public function getMachinesByModel() {
        $this->load->model('StoresValueinfo');

        $modelId = $this->input->post('model_id');
        $machine = $this->StoresValueinfo->getMachinesByModel($modelId);
        echo json_encode($machine);
    }

    public function close_month_stock(){
        $month = $this->input->post('month');

        if (empty($month)) {
            echo json_encode(["status" => "error", "message" => "Month is required"]);
            return;
        }
        $this->load->model('StoresValueinfo');
        $done = $this->StoresValueinfo->closeMonthStock($month);

        if ($done === true) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => $done]);
        }
    }

}
