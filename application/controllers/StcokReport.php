<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Colombo');

class StockReport extends CI_Controller{

    public function index(){
        $this->load->model('Commeninfo');
        $result['menuaccess']=$this->Commeninfo->Getmenuprivilege();
        
        $this->load->view('stockreport', $result);
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

        public function get_spare_part_name_from_stock()
    {
        $term = $this->input->get('term');
        $page = $this->input->get('page');

        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->select('spare_parts.id, spare_parts.name');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->group_by('spare_parts.id');
        $query = $this->db->get();
        $this->db->limit($resultCount, $offset);
        $departments = $query->result_array();

        $this->db->select('spare_parts.id, spare_parts.name');
        $this->db->from('tbl_stock');
        $this->db->join('spare_parts', 'spare_parts.id = tbl_stock.spare_part_id', 'left');
        $this->db->group_by('spare_parts.id');
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

        public function fetchStockReport(){


        $spare_part_id = $this->input->post('spare_part_id');
        $supplier_id = $this->input->post('supplier_id');
        $machine_type_id = $this->input->post('machine_type_id');

        $sql = "SELECT SUM(ts.qty) as sum_qty, sp.name, sp.part_no, sp.id as sp_id
                FROM tbl_stock ts
                LEFT JOIN spare_parts sp ON sp.id = ts.spare_part_id
                LEFT JOIN spare_part_suppliers sps ON sps.sp_id = ts.spare_part_id 
                WHERE 1 = 1 
            ";
        if($spare_part_id != ''){
            $sql .= " AND ts.spare_part_id = '$spare_part_id' ";
        }

        if($supplier_id != ''){
            $sql .= " AND sps.supplier_id = '$supplier_id' ";
        }

        if($machine_type_id != ''){
            $sql .= " AND sp.type = '$machine_type_id' ";
        }

        $sql .= " GROUP BY ts.spare_part_id ";

        $query = $this->db->query($sql);
        $data = $query->result_array();

        $result = array();
        foreach ($data as $key => $value) {

            $id = $value['sp_id'];
            $sql2 = "
                SELECT SUM(qty) as sum_qty FROM machine_service_allocated_items
                WHERE spare_part_id = '$id' and is_finished = 0 AND is_deleted = 0
            ";
            $query1 = $this->db->query($sql2);
            $data1 = $query1->row_array();

            $remaining_stock = $value['sum_qty']-$data1['sum_qty'];

            $btn = '';
            if(!empty($data1)){
                if($data1['sum_qty'] > 0){
                    $btn = '<button type="button" class="btn btn-primary btn-sm btn_view" data-toggle="modal" data-target="#viewModal" data-spare_part_id="'.$id.'"> <i class="fa fa-eye text-white"></i> </button>';
                }
            }
  
            $result['data'][$key] = array(
                $value['part_no']. ' - ' .$value['name'],
                $remaining_stock,
                $data1['sum_qty'],
                $btn
            );
        } // /foreach

        echo json_encode($result);

    }

}