<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class CRMReason extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('CRMReasoninfo');
	    $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$this->load->view('crmreason', $result);
	}
    public function Reasontypeinsertupdate(){
		$this->load->model('CRMReasoninfo');
        $result=$this->CRMReasoninfo->Reasontypeinsertupdate();
	}
    public function Reasontypestatus($x, $y){
		$this->load->model('CRMReasoninfo');
        $result=$this->CRMReasoninfo->Reasontypestatus($x, $y);
	}
    public function Reasontypeedit(){
		$this->load->model('CRMReasoninfo');
        $result=$this->CRMReasoninfo->Reasontypeedit();
	}
}