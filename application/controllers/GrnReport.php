<?php
class Goodreceive extends CI_Controller {
    public function index(){
        $this->load->model('Commeninfo');
        $this->load->model('Goodreceiveinfo');
		$result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
		$result['companylist']=$this->Goodreceiveinfo->Getcompany();
		$result['locationlist']=$this->Goodreceiveinfo->Getlocation();
		$result['branchlist']=$this->Goodreceiveinfo->Getcompanybranch();
		$result['porderlist']=$this->Goodreceiveinfo->Getporder();
		$result['ordertypelist']=$this->Goodreceiveinfo->Getordertype();
		$result['measurelist']=$this->Goodreceiveinfo->Getmeasuretype();
		$this->load->view('goodreceive', $result);
	}
}