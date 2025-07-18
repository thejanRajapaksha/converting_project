<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMInquiry extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('CRMInquiryinfo');
		$this->load->model('Productinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$result['product'] = $this->Productinfo->getProduct();
		$result['customername'] = $this->CRMInquiryinfo->Getcustomername();
		$this->load->view('crminquiry', $result);
	}
    public function Inquiryinsertupdate(){//var_dump($this->input->post('data'));die;
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquiryinsertupdate();
		echo json_encode(array('success'=>$result));
	}
    public function Inquirystatus($x, $y){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquirystatus($x, $y);
	}
	public function Inquirydetailstatus($x, $y){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquirydetailstatus($x, $y);
	}
    public function Inquiryedit(){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquiryedit();
	}
    public function Inquiryupload(){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquiryupload();
	}
    public function Inquirycheck(){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->Inquirycheck();
	}
	
	public function GetInquiryList(){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->GetInquiryList();
	}

	public function GetInquiryDetailList(){
		$this->load->model('CRMInquiryinfo');
        $result=$this->CRMInquiryinfo->GetInquiryDetailList();
	}
	public function getcustomer(){
		$this->load->model('CRMInquiryinfo');
		$result = $this->CRMInquiryinfo->Getcustomername();
	}
	
}