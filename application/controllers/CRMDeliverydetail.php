<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMDeliverydetail extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        // $this->load->model('Customerinfo');
		$this->load->model('Customerinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$result['customer'] = $this->Customerinfo->GetCustomerList();
		$this->load->view('deliverydetail',$result);
	}

	public function Deliverydetailinsertupdate()
	{
		$this->load->model('Deliverydetailinfo');
		$result= $this->Deliverydetailinfo->Deliverydetailinsertupdate(); 
	}

	public function Deliverydetailupdate(){
		$this->load->model('Deliverydetailinfo');
		$result= $this->Deliverydetailinfo->Deliverydetailupdate(); 
	}
	

	public function GetDeliveryDetails()
{
    $orderId = $this->input->post('orderId');

    $this->load->model('Deliverydetailinfo');
    $delivery = $this->Deliverydetailinfo->getDeliveryByOrderId($orderId);

    echo json_encode(['delivery' => $delivery]);
}

	
    public function Deliverydetailstatus($x, $y){
		$this->load->model('Deliverydetailinfo');
        $result=$this->Deliverydetailinfo->Deliverydetailstatus($x, $y);
	}

    public function Deliverydetailcheck(){
		$this->load->model('Deliverydetailinfo');
        $result=$this->Deliverydetailinfo->Deliverydetailcheck();
	}
	public function getInquiryByCustomerId() {
		$customer_id = $this->input->post('customer_id');
		$this->load->model('Deliverydetailinfo');
		$result = $this->Deliverydetailinfo->getInquiryByCustomerId($customer_id);
	
		echo json_encode($result);
	}

	public function getOrderByInquiryId() {
		$inquiry_id = $this->input->post('inquiry_id');
		$this->load->model('Deliverydetailinfo');
		$result = $this->Deliverydetailinfo->getOrderByInquiryId($inquiry_id);
	
		echo json_encode($result);
	}
	public function getOrderQuantityById() {
		$order_id = $this->input->post('order_id');
		$this->load->model('Deliverydetailinfo');
		$result = $this->Deliverydetailinfo->getOrderQuantityById($order_id);
	
		echo json_encode($result);
	}

	public function getMachineTypes() {
		$this->load->model('Deliverydetailinfo');
        $data = $this->Deliverydetailinfo->getMachineTypes(); 
        echo $data; 
    }

    public function saveMachineOrder() {
		$this->load->model('Deliverydetailinfo');
        $orderId   = $this->input->post('order_id');
        $inquiryId = $this->input->post('inquiry_id');
        $types     = $this->input->post('types'); 

        if ($this->Deliverydetailinfo->saveMachineOrder($orderId, $inquiryId, $types)) {
            echo "success";
        } else {
            echo "error";
        }
    }

	public function getExistingMachineOrder() {
		$this->load->model('Deliverydetailinfo');
		$orderId = $this->input->post('order_id');
		$inquiryId = $this->input->post('inquiry_id');
		echo json_encode($this->Deliverydetailinfo->getExistingMachineOrder($orderId, $inquiryId));
	}
	
	
}