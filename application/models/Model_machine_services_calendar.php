<?php

class Model_machine_services_calendar extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //getServiceEvents
    public function getServiceEvents()
    {
        $this->db->select('*');
        $this->db->from('machine_services');
        //$this->db->where('machine_services.service_date >=', date('Y-m-d'));
        $this->db->where('machine_services.is_deleted =', 0);
        $this->db->order_by('machine_services.service_date_from', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    //getServiceRes
    public function getServiceRes($service_id)
    {
        $this->db->select('machine_services.*, machine_ins.s_no, machine_types.name as machine_type_name ');
        $this->db->from('machine_services');
        $this->db->join('machine_ins', 'machine_ins.id = machine_services.machine_in_id', 'left');
        $this->db->join('machine_types', 'machine_types.id = machine_ins.machine_type_id', 'left');
        $this->db->where('machine_services.id =', $service_id);
        $this->db->where('machine_services.is_deleted =', 0);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create($data = array())
    {
        if($data) {
            $create = $this->db->insert('machine_service_details', $data);
            return ($create == true) ? true : false;
        }
    }

    public function createServiceDetailItems($data = array())
    {
        if($data) {
            $create = $this->db->insert('machine_service_details_items', $data);
            return ($create == true) ? true : false;
        }
    }

    public function getServiceById($service_id)
    {
        if (empty($service_id)) {
            return false;
        }
        $this->db->select('
            id,
            service_id,
            service_done_by,
            se.employee_name AS service_done_by_name,
            service_charge,
            transport_charge,
            service_type,
            remarks
        ');
        $this->db->from('machine_service_details');
        $this->db->join('service_employee as se', 'se.employee_id = machine_service_details.service_done_by', 'left');
        $this->db->where('service_id', $service_id);
        $this->db->where('is_deleted', 0);
        $headerQuery = $this->db->get();

        if ($headerQuery->num_rows() == 0) {
            return false;
        }

        $header = $headerQuery->row();

        $this->db->select('
            msdi.id,
            msdi.spare_part_id,
            sp.name AS item_name,
            msdi.quantity,
            msdi.price,
            msdi.total
        ');
        $this->db->from('machine_service_details_items as msdi');
        $this->db->join('spare_parts as sp', 'sp.id = msdi.spare_part_id', 'left');
        $this->db->where('msdi.machine_service_details_id', $header->id);
        $this->db->where('msdi.is_deleted', 0);
        $detailsQuery = $this->db->get();

        $details = $detailsQuery->result();

        return [
            'header'  => $header,
            'details' => $details
        ];
    }

    public function update($id = null, $data = array())
    {
        if($id && $data) {
            $this->db->where('id', $id);
            $update = $this->db->update('machine_services', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id = null)
    {
        if($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('machine_services');
            return ($delete == true) ? true : false;
        }

        return false;
    }

    public function getActiveMachineService()
    {
        $sql = "SELECT * FROM machine_services WHERE active = ?";
        $query = $this->db->query($sql, array(1));
        return $query->result_array();
    }

    public function countTotalMachineServices()
    {
        $sql = "SELECT * FROM machine_services WHERE active = ?";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }

    public function getServiceHeader($id)
    {
        return $this->db->get_where('machine_service_details', ['id' => $id])->row_array();
    }

    public function getServiceDetailItems($id)
    {
        $this->db->select('machine_service_details_items.*, spare_parts.name as item_name');
        $this->db->from('machine_service_details_items');
        $this->db->join('spare_parts', 'spare_parts.id = machine_service_details_items.spare_part_id');
        $this->db->where('machine_service_details_id', $id);
        return $this->db->get()->result_array();
    }

    public function updateHeader($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('machine_service_details', $data);
    }

    public function deleteDetailItems($id)
    {
        return $this->db->delete('machine_service_details_items', [
            'machine_service_details_id' => $id
        ]);
    }

    public function EditServiceDetailItems($data = array())
    {
        if (!empty($data)) {
            return $this->db->insert('machine_service_details_items', $data);
        }
        return false;
    }

    public function getHeaderByServiceId($service_id)
    {
        return $this->db->get_where('machine_service_details', [
            'service_id' => $service_id,
            'is_deleted' => 0
        ])->row_array();
    }

}