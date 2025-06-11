<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Dashboard extends CI_Controller {
    public function index() {
        $this->load->model('Commeninfo');
        $this->load->model('Dashboardinfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
    }
    public function checkMaterial() {
        $this->load->model('Dashboardinfo');
        $exists = $this->Dashboardinfo->checkMaterialRecord();
        echo json_encode($exists); 
    }
    public function checkCutting() {
        $this->load->model('Dashboardinfo');
        $exists = $this->Dashboardinfo->checkCuttingRecord();
        echo json_encode($exists); 
    }
    public function checkPrinting() {
        $this->load->model('Dashboardinfo');
        $exists = $this->Dashboardinfo->checkPrintingRecord();
        echo json_encode($exists); 
    }
    public function checkDelivery() {
        $this->load->model('Dashboardinfo');
        $exists = $this->Dashboardinfo->checkDeliveryRecord();
        echo json_encode($exists); 
    }
}
?>
