<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class Supplier extends CI_Controller {
       public function index()
    {
        $this->load->model('Commeninfo');
		$this->load->model('Supplierinfo');
		$result['Suppliercategory']=$this->Supplierinfo->GetSuppliercategory();
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $this->load->view('supplier', $result);
    }
	public function Supplierinsertupdate(){
		$this->load->model('Supplierinfo');
        $result=$this->Supplierinfo->Supplierinsertupdate();
	}
	public function Supplieredit(){
		$this->load->model('Supplierinfo');
        $result=$this->Supplierinfo->Supplieredit();
	}
	public function Supplierstatus($x, $y){
		$this->load->model('Supplierinfo');
        $result=$this->Supplierinfo->Supplierstatus($x, $y);
	}
	
	public function GetSupplierList(){
		$this->load->model('Supplierinfo');
        $result=$this->Supplierinfo->GetSupplierList();
	}
	
}
