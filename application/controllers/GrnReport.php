<?php
class GrnReport extends CI_Controller {
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
		$this->load->view('grnreport', $result);
	}
	public function Goodreceiveview(){
		$this->load->model('Goodreceiveinfo');
        $result=$this->Goodreceiveinfo->Goodreceiveview();
	}

	public function fetchGoodReceiveDataReport(){

        $spare_part_id = $this->input->post('spare_part_id');
        $supplier_id = $this->input->post('supplier_id');
        $machine_type_id = $this->input->post('machine_type_id');


        $sql = "SELECT tg.*, 
                 tot.type as order_type,
                ts.suppliername as suppliername,
                tl.location as location 
            FROM tbl_grn tg 
            LEFT JOIN tbl_grndetail tgd ON tgd.tbl_grn_idtbl_grn = tg.idtbl_grn
            LEFT JOIN tbl_order_type tot ON tot.idtbl_order_type = tg.tbl_order_type_idtbl_order_type
            LEFT JOIN tbl_supplier ts ON ts.idtbl_supplier = tg.tbl_supplier_idtbl_supplier
            LEFT JOIN tbl_location tl ON tl.idtbl_location = tg.tbl_location_idtbl_location 
            LEFT JOIN tbl_porder po ON po.idtbl_porder = tg.tbl_porder_idtbl_porder 
            LEFT JOIN spare_parts sp on tgd.spare_part_id = sp.id
            WHERE tg.approvestatus = 1   
            ";
        if($spare_part_id != ''){
            $sql .= " AND tgd.spare_part_id = '$spare_part_id' ";
        }

        if($supplier_id != ''){
            $sql .= " AND ts.idtbl_supplier = '$supplier_id' ";
        }

        if($machine_type_id != ''){
            $sql .= " AND sp.type = '$machine_type_id' ";
        }

        $sql .= ' ORDER BY tg.idtbl_grn DESC';

        $query = $this->db->query($sql);
        $data = $query->result_array();

        $result = array();
        foreach ($data as $key => $value) {

            // button
            $buttons = '';
            $buttons .= '<button class="btn btn-dark btn-sm btnview mr-1" id="' . $value['idtbl_grn'] . '"><i class="fas fa-eye"></i></button>';

            $result['data'][$key] = array(
                $value['order_type'],
                $value['grndate'],
                $value['batchno'],
                $value['suppliername'],
                $value['location'],
                $value['invoicenum'],
                $value['dispatchnum'],
                number_format($value['total'], 2, '.', ',') ,
                $value['remarks'],
                $buttons
            );
        } // /foreach

        echo json_encode($result);

    }
	    public function get_part_no_select_from_stock()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('spare_parts.id, spare_parts.name, spare_parts.part_no ');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->where('spare_parts.is_deleted', 0 );
        $this->db->like('spare_parts.name', $term, 'both');
        $this->db->group_by('spare_parts.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('spare_parts.id, spare_parts.name, spare_parts.part_no ');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->where('spare_parts.is_deleted', 0 );
        $this->db->like('spare_parts.name', $term, 'both');
        $this->db->group_by('spare_parts.id');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['id'],
                'text' => $v['part_no']. ' - ' .$v['name'],
            );
        }

        $endCount = $offset + $resultCount;
        $morePages = $endCount < $count;

        $results = array(
            "results" => $data,
            "pagination" => array(
                "more" => $morePages
            )
        );

        echo json_encode($results);

    }
	   public function get_supplier_select_from_stock()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('tbl_supplier.idtbl_supplier, tbl_supplier.suppliername');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->join('spare_part_suppliers', 'spare_part_suppliers.sp_id = spare_parts.id', 'left');
        $this->db->join('tbl_supplier', 'tbl_supplier.idtbl_supplier = spare_part_suppliers.supplier_id', 'left');
        $this->db->like('tbl_supplier.suppliername', $term, 'both');
        $this->db->group_by('tbl_supplier.idtbl_supplier');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('tbl_supplier.idtbl_supplier, tbl_supplier.suppliername');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->join('spare_part_suppliers', 'spare_part_suppliers.sp_id = spare_parts.id', 'left');
        $this->db->join('tbl_supplier', 'tbl_supplier.idtbl_supplier = spare_part_suppliers.supplier_id', 'left');
        $this->db->like('tbl_supplier.suppliername', $term, 'both');
        $this->db->group_by('tbl_supplier.idtbl_supplier');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['idtbl_supplier'],
                'text' => $v['suppliername'],
            );
        }

        $endCount = $offset + $resultCount;
        $morePages = $endCount < $count;

        $results = array(
            "results" => $data,
            "pagination" => array(
                "more" => $morePages
            )
        );

        echo json_encode($results);

    }

	    public function get_machine_type_select_from_stock()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('machine_types.id, machine_types.name');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->join('machine_types', 'machine_types.id = spare_parts.type', 'left');
        $this->db->group_by('machine_types.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('machine_types.id, machine_types.name');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->join('machine_types', 'machine_types.id = spare_parts.type', 'left');
        $this->db->group_by('machine_types.id');
        $count = $this->db->count_all_results();

        $data = array();
        foreach ($departments as $v) {
            $data[] = array(
                'id' => $v['id'],
                'text' => $v['name'],
            );
        }

        $endCount = $offset + $resultCount;
        $morePages = $endCount < $count;

        $results = array(
            "results" => $data,
            "pagination" => array(
                "more" => $morePages
            )
        );

        echo json_encode($results);

    }

}