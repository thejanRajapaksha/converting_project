<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Suppliercontact extends CI_Controller {

	public function index($x)
    {
        $this->load->model('Commeninfo');
		$this->load->model('Suppliercontactinfo');
		$result['supplier_id'] = $x;
		$result['Suppliercontactdetails']=$this->Suppliercontactinfo->GetSupplierid($x);
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $this->load->view('suppliercontact', $result);
		
    }
   
	public function Suppliercontactinsertupdate(){
		$this->load->model('Suppliercontactinfo');
        $result=$this->Suppliercontactinfo->Suppliercontactinsertupdate();
	}
	public function Suppliercontactedit(){
		$this->load->model('Suppliercontactinfo');
        $result=$this->Suppliercontactinfo->Suppliercontactedit();
	}
	public function Suppliercontactstatus($x,$z,$y){
		$this->load->model('Suppliercontactinfo');
        $result=$this->Suppliercontactinfo->Suppliercontactstatus($x,$z,$y);
	}
	
}
