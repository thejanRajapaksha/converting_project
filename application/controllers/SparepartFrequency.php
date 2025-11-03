<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Colombo');

class SparepartFrequency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SparepartFrequency_model');
        $this->load->model('Commeninfo');
        $this->load->model('StockReportinfo');

    }

    public function index()
    {
        $data['getmachinetype'] = $this->StockReportinfo->Machinetypeget();
        $data['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $data['spareparts'] = $this->SparepartFrequency_model->getAllSpareParts();
        $data['getmachinemodel'] = $this->StockReportinfo->Machinemodelget();
        $this->load->view('sparepart_frequency_view', $data);

    }

    public function getFrequencyData()
{
    try {
        $sparepart_id = $this->input->post('sparepart_id');
        $month = $this->input->post('month');
        $machinetype = $this->input->post('machinetype');
        $machinemodel = $this->input->post('machinemodel');

        if (empty($sparepart_id) || empty($month)) {
            echo json_encode(['success' => false, 'message' => 'Spare part and month are required']);
            return;
        }

        $data = $this->SparepartFrequency_model->getSparePartFrequency($sparepart_id, $month, $machinetype, $machinemodel);
        echo json_encode(['success' => true, 'data' => $data]);

    } catch (Exception $e) {
        error_log('Error in getFrequencyData: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}

public function generatePDF()
{
    try {
        $sparepart_id = $this->input->post('sparepart_id');
        $month = $this->input->post('month');
        $sparepart_name = $this->input->post('sparepart_name');
        $machinetype = $this->input->post('machinetype');
        $machinemodel = $this->input->post('machinemodel');

        if (empty($sparepart_id) || empty($month)) {
            die('Spare part and month are required');
        }

        $data = $this->SparepartFrequency_model->getSparePartFrequency($sparepart_id, $month, $machinetype, $machinemodel);
        $this->SparepartFrequency_model->generateFrequencyPDF($data, $sparepart_name, $month, $machinetype, $machinemodel);

    } catch (Exception $e) {
        die('Error generating PDF: ' . $e->getMessage());
    }
}
}