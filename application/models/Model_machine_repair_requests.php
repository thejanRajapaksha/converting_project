<?php

class Model_machine_repair_requests extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMachineRepairRequestsData($id = null)
    {
        if($id) {
            $sql = "SELECT mcr.*,
                m.s_no, m.bar_code, mt.name as machine_type_name 
            FROM machine_repairs mcr
            LEFT JOIN machine_ins m on mcr.machine_in_id = m.id
            LEFT JOIN machine_types mt on m.machine_type_id = mt.id 
            WHERE mcr.id = ? AND mcr.is_deleted = 0";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT mcr.*,
                m.s_no, m.bar_code, mt.name as machine_type_name 
            FROM machine_repairs mcr
            LEFT JOIN machine_ins m on mcr.machine_in_id = m.id
            LEFT JOIN machine_types mt on m.machine_type_id = mt.id 
            WHERE mcr.is_deleted = 0 
            ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function create($data = array())
    {
        if($data) {
            $create = $this->db->insert('machine_repairs', $data);
            return ($create == true) ? true : false;
        }
    }

    public function update($id = null, $data = array())
    {
        if ($id && $data) {
            $this->db->where('id', $id);
            $updateMain = $this->db->update('machine_repairs', $data);

            return ($updateMain) ? true : false;
        }

        return false;
    }

    public function remove($id = null)
    {
        if($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('machine_repairs');
            return ($delete == true) ? true : false;
        }

        return false;
    }

    public function get_sparepart_batches($sparepart_id) {
        $this->db->select('batchno, unitprice, qty');
        $this->db->from('tbl_print_stock');
        $this->db->where('tbl_sparepart_id', $sparepart_id);
        $this->db->where('qty >', 0);
        $this->db->order_by('idtbl_print_stock', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}