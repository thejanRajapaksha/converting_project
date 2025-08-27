<?php

class ServiceItems extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function get_items_select() {
        $term = $this->input->get('term');
        $page = (int) $this->input->get('page');
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;

        $this->db->from('spare_parts');
        $this->db->group_start()
            ->like('name', $term, 'both')
            ->or_like('part_no', $term, 'both')
            ->group_end();
        $this->db->where('is_deleted', 0);
        $count = $this->db->count_all_results();

        $this->db->select('*');
        $this->db->from('spare_parts');
        $this->db->group_start()
            ->like('name', $term, 'both')
            ->or_like('part_no', $term, 'both')
            ->group_end();
        $this->db->where('is_deleted', 0);
        $this->db->limit($resultCount, $offset);
        $query = $this->db->get();
        $results = $query->result_array();

        $data = array();
        foreach ($results as $row) {
            $data[] = array(
                'id' => $row['id'],
                'text' => $row['name'] . ' - ' . $row['part_no']
            );
        }

        $endCount = $offset + $resultCount;
        $morePages = $endCount < $count;

        echo json_encode([
            "results" => $data,
            "pagination" => ["more" => $morePages]
        ]);

    }


    public function get_service_item_price()
    {
        $id = $this->input->post('service_item_id');
        $this->db->select('*');
        $this->db->from('spare_parts');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        $price = $result['unit_price'];
        echo json_encode($price);
    }

}