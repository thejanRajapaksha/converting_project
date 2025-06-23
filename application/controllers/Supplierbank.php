<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Supplierbank extends CI_Controller {
	public function index($x)
    {
		$this->load->model('Commeninfo');
		$this->load->model('Supplierbankinfo');
		$this->load->model('Suppliercontactinfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
		$result['supplier_id'] = $x;
		$result['Suppliercontactdetails']=$this->Suppliercontactinfo->GetSupplierid($x);
		$result['Supplierbankdetails']=$this->Supplierbankinfo->GetSupplierbankid($x);
        $this->load->view('supplierbank', $result);
    }
   
	public function Supplierbankinsertupdate(){
		$this->load->model('Supplierbankinfo');
        $result=$this->Supplierbankinfo->Supplierbankinsertupdate();
	}
	public function Supplierbankedit(){
		$this->load->model('Supplierbankinfo');
        $result=$this->Supplierbankinfo->Supplierbankedit();
	}
	public function Supplierbankstatus($x,$z,$y){
		$this->load->model('Supplierbankinfo');
        $result=$this->Supplierbankinfo->Supplierbankstatus($x,$z,$y);
	}
	
}
