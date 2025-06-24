<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class MachineWIP extends CI_Controller {
    public function index(){
       $this->load->model('Commeninfo');
        $this->load->model('Machineallocationinfo');
        $result['machine']=$this->Machineallocationinfo->Getmachinelist();
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        
        $this->load->view('machineWip', $result);
	}


}