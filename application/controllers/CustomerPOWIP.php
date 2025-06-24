<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CustomerPOWIP extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('CustomerPOWIPinfo');
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['customername'] = $this->CustomerPOWIPinfo->Getcustomername();

        $this->load->view('customerPOReport', $result);
	}

    public function getPOForCustomer() {
        $this->load->model('CustomerPOWIPinfo');
        $customerId = $this->input->post('customerId');
        $result = $this->CustomerPOWIPinfo->getPOForCustomer($customerId);
        echo json_encode($result);
    }

    
}