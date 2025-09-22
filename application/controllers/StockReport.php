<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Colombo');

class StockReport extends CI_Controller {

    public function index() {
        $this->load->model('StockReportinfo');
        $this->load->model('Commeninfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $result['getsuppier'] = $this->StockReportinfo->Suppliearget();
        $result['getmachinemodel'] = $this->StockReportinfo->Machinemodelget();
        $this->load->view('stockreport', $result);
    }

    public function stockReportPDF()
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

        $this->load->model('StockReportinfo');
        $this->StockReportinfo->generateStockReportPDF($rows, $filters);
    }

}
