<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMCompletedorder extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
		$this->load->model('Locationinfo');
        $this->load->model('Completedorderinfo');
		$result['locationdetails'] = $this->Locationinfo->getLocation(); 
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('completedOrder', $result);
	}
    public function Completedorderinsertupdate(){
		$this->load->model('Completedorderinfo');
        $result=$this->Completedorderinfo->Completedorderinsertupdate();
	}
    public function Completedorderstatus($x, $y){
		$this->load->model('Completedorderinfo');
        $result=$this->Completedorderinfo->Completedorderstatus($x, $y);
	}
    public function Getcompletedorders() {	
		$this->load->model('Completedorderinfo');
		$material_details = $this->Completedorderinfo->Getcompletedorders();	
		echo json_encode($material_details);
	}
    public function Completedorderupload(){
		$this->load->model('Completedorderinfo');
        $result=$this->Completedorderinfo->Completedorderupload();
	}
    public function Completedordercheck(){
		$this->load->model('Completedorderinfo');
        $result=$this->Completedorderinfo->Completedordercheck();
	}
	public function Savematerialbalances(){
		$this->load->model('Completedorderinfo');
        $this->Completedorderinfo->Savematerialbalances();
	}
    public function Getmaterialcategory(){		
		$this->load->model('Completedorderinfo');
		$result=$this->Completedorderinfo->Getmaterialcategory();		
	}
	public function GetPaymentDetails(){		
		$this->load->model('Completedorderinfo');
		$result=$this->Completedorderinfo->GetPaymentDetails();	
		echo json_encode($result);
	}

	public function loadSummaryDetails(){
		$this->load->model('Completedorderinfo');
		$result=$this->Completedorderinfo->loadSummaryDetails();
		echo json_encode($result);		
	}

	public function transferToFinishedGoods()
{
    $orderId = $this->input->post('orderId');
    $location = $this->input->post('location');
    $orderQty = $this->input->post('transferQty');
    $userId = $_SESSION['userid'];

    $data = [
        'tbl_order_idtbl_order' => $orderId,
        'tbl_stock_location_idtbl_location' => $location,
        'quantity' => $orderQty,
        'transfer_date' => date('Y-m-d H:i:s'),
        'tbl_user_idtbl_user' => $userId,
        'status' => 1
    ];

    $inserted = $this->db->insert('tbl_finished_goods', $data);

    if ($inserted) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database insert failed']);
    }
}

}