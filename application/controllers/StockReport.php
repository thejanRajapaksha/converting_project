<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Colombo');

class StockReport extends CI_Controller {

    public function index() {
        $this->load->model('StockReportinfo');
        $this->load->model('Commeninfo');
        $result['menuaccess'] = $this->Commeninfo->Getmenuprivilege();
        $result['getsuppier'] = $this->StockReportinfo->Suppliearget();
        $result['getmachinetype'] = $this->StockReportinfo->Machinetypeget();
        $result['getmachinemodel'] = $this->StockReportinfo->Machinemodelget();
        $this->load->view('stockreport', $result);
    }

    public function stockReportPDF()
    {
        $filters = [
            'search_date'      => $this->input->post('search_date'),
            'search_week'      => $this->input->post('search_week'),
            'search_month'     => $this->input->post('search_month'),
            'search_from_date' => $this->input->post('search_from_date'),
            'search_to_date'   => $this->input->post('search_to_date'),
            'report_type'      => $this->input->post('report_type'),
            'search_type'      => $this->input->post('search_type'),
            'supplier'         => $this->input->post('supplier')
        ];

        $rows = $this->input->post('rows'); 

        if (empty($rows)) {
            show_error("No data received for report generation.");
            return;
        }

        $this->load->model('StockReportinfo');
        $this->StockReportinfo->generateStockReportPDF($rows, $filters);
    }

    public function Getpartname() {
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

    public function getModelsByType() {
        $this->load->model('StockReportinfo');

        $typeId = $this->input->post('type_id');
        $models = $this->StockReportinfo->getModelsByType($typeId);
        echo json_encode($models);
    }

}
