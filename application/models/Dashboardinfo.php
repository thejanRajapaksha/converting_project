<?php
class Dashboardinfo extends CI_Model {
    public function checkMaterialRecord() {
        $inquiryid = $this->input->post('inquiryid');
        $this->db->select('idtbl_material_detail');
        $this->db->from('tbl_material_detail'); 
        $this->db->where('tbl_inquiry_idtbl_inquiry', $inquiryid);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? 1 : 2; 
    }

    public function checkCuttingRecord() {
        $inquiryid = $this->input->post('inquiryid');
        $this->db->select('idtbl_order_detail');
        $this->db->from('tbl_order_detail'); 
        $this->db->where('tbl_inquiry_idtbl_inquiry', $inquiryid);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? 1 : 2; 
    }

    public function checkPrintingRecord() {
        $inquiryid = $this->input->post('inquiryid');
        $this->db->select('idtbl_printing_detail');
        $this->db->from('tbl_printing_detail'); 
        $this->db->where('tbl_inquiry_idtbl_inquiry', $inquiryid);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? 1 : 2; 
    }

    public function checkDeliveryRecord() {
        $inquiryid = $this->input->post('inquiryid');
        $this->db->select('idtbl_delivery_detail');
        $this->db->from('tbl_delivery_detail'); 
        $this->db->where('tbl_inquiry_idtbl_inquiry', $inquiryid);
        $query = $this->db->get();
        return $query->num_rows() > 0 ? 1 : 2; 
    }
}
?>
