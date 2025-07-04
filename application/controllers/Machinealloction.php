<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Machinealloction extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Machineallocationinfo');
        // $this->load->model('Customerinquiryinfo');
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['machine']=$this->Machineallocationinfo->Getmachinelist();
        $result['employee']=$this->Machineallocationinfo->Getemployeelist();
        $result['inquiryinfo']=$this->Machineallocationinfo->GetAllCustomerInquiries();
        $result['customer']=$this->Machineallocationinfo->GetAllCustomers();
        
        $this->load->view('machineallocation', $result);
	}

    public function Machineinsertupdate(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->Machineinsertupdate();
	}

    public function Checkmachineavailability(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->Checkmachineavailability();
	}

    public function FetchItemDataForAllocation(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->FetchItemDataForAllocation();
	}
    public function GetDeliveryPlanDetails(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->GetDeliveryPlanDetails();
        echo json_encode($result);
	}

    public function Checkissueqty(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->Checkissueqty();
	}
    public function FetchAllocationData(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->FetchAllocationData();
	}
    public function GetOrderDetails(){
        $this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->GetOrderDetails();
        echo json_encode($result);
    }
   
    public function FetchCustomerInquiryAndOrderData(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->FetchCustomerInquiryAndOrderData();
        echo json_encode($result);
	}

    public function GetCostItemData(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->GetCostItemData();
        echo json_encode($result);

	}

    public function GetOrderList(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->GetOrderList();
	}

    public function GetDeliveryIdsForOrder(){
		$this->load->model('Machineallocationinfo');
        $result=$this->Machineallocationinfo->GetDeliveryIdsForOrder();
	}

}