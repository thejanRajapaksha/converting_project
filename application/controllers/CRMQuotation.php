<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMQuotation extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('CRMQuotationinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$result['Inquiryid']=$this->CRMQuotationinfo->GetInquiryid();
		$this->load->view('crmquotation', $result);
	}
    public function Quotationinsertupdate(){
		$this->load->model('CRMQuotationinfo');
        $result=$this->CRMQuotationinfo->Quotationinsertupdate();
	}
    public function Quotationstatus($x, $y){
		$this->load->model('CRMQuotationinfo');
        $result=$this->CRMQuotationinfo->Quotationstatus($x, $y);
	}
    public function Quotationedit(){
		$this->load->model('CRMQuotationinfo');
        $result=$this->CRMQuotationinfo->Quotationedit();
	}
    public function Quotationupload(){
		$this->load->model('CRMQuotationinfo');
        $result=$this->CRMQuotationinfo->Quotationupload();
	}
    public function Quotationcheck(){
		$this->load->model('CRMQuotationinfo');
        $result=$this->CRMQuotationinfo->Quotationcheck();
	}
}