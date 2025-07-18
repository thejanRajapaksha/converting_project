<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMQuotationStatus extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('CRMQuotationStatusinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        $result['reasontype']=$this->CRMQuotationStatusinfo->Getreasontype();
        $result['quotationid']=$this->CRMQuotationStatusinfo->Getquotationid();
        $this->load->view('crmquotationstatus', $result);
	}
    public function CRMQuotationStatusinsertupdate(){
		$this->load->model('CRMQuotationStatusinfo');
        $result=$this->CRMQuotationStatusinfo->CRMQuotationStatusinsertupdate();
	}
    public function CRMQuotationStatusstatus($x, $y){
		$this->load->model('CRMQuotationStatusinfo');
        $result=$this->CRMQuotationStatusinfo->CRMQuotationStatusstatus($x, $y);
	}
    public function CRMQuotationStatusedit(){
		$this->load->model('CRMQuotationStatusinfo');
        $result=$this->CRMQuotationStatusinfo->CRMQuotationStatusedit();
	}
    public function CRMQuotationStatusupload(){
		$this->load->model('CRMQuotationStatusinfo');
        $result=$this->CRMQuotationStatusinfo->CRMQuotationStatusupload();
	}
    public function CRMQuotationStatuscheck(){
		$this->load->model('CRMQuotationStatusinfo');
        $result=$this->CRMQuotationStatusinfo->CRMQuotationStatuscheck();
	}
}