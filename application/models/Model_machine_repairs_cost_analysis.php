<?php

class Model_machine_repairs_cost_analysis extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMachineRepairsCostAnalysisData($id = null, $data = null)
    {
        if($id) {
            $sql = "SELECT msd.*,
                m.s_no, m.bar_code, mt.name as machine_type_name,
               ms.repair_in_date, e.name_with_initial 
            FROM machine_repair_details msd  
            LEFT JOIN machine_repairs ms ON msd.repair_id = ms.id
            LEFT JOIN machine_ins m on ms.machine_in_id = m.id
            LEFT JOIN machine_types mt on m.machine_type_id = mt.id
            LEFT JOIN employees e on msd.repair_done_by = e.id 
            WHERE msd.id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $status = $data['status'];
        $repair_type = $data['repair_type'];
        $machine_type = $data['machine_type'];
        $machine_in_id = $data['machine_in_id'];
        $date_from = $data['date_from'];
        $date_to = $data['date_to'];

        $sql = "SELECT msd.*,
                m.s_no, m.bar_code, mt.name as machine_type_name,
                ms.repair_in_date
            FROM machine_repair_details msd
            LEFT JOIN machine_repairs ms ON msd.repair_id = ms.id
            LEFT JOIN machine_ins m on ms.machine_in_id = m.id
            LEFT JOIN machine_types mt on m.machine_type_id = mt.id
            WHERE msd.is_deleted = 0 ";

        if($status != '') {
            $sql .= " AND msd.is_completed = '$status' ";
        }

        if($repair_type != '') {
            $sql .= " AND msd.repair_type = '$repair_type' ";
        }

        if($machine_type != '') {
            $sql .= " AND mt.id = '$machine_type' ";
        }

        if($machine_in_id != '') {
            $sql .= " AND m.id = '$machine_in_id' ";
        }
        if (!empty($date_from) && !empty($date_to)) {
        $sql .= " AND DATE(ms.repair_in_date) >= '$date_from'
                AND DATE(ms.repair_in_date) <= '$date_to' ";
    }

        $sql .="ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMachineRepairItemsData($id)
    {
        $sql = "SELECT msdi.*, si.name as item_name 
                FROM machine_repair_details_items msdi 
                LEFT JOIN service_items si ON msdi.service_item_id = si.id
                WHERE msdi.machine_repair_details_id = ? AND si.is_deleted = 0 AND msdi.is_deleted = 0";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    //getMonthlyRepairCost
    public function getMonthlyRepairCost($month){

        $date = date('Y-m', strtotime($month));

        $sql = "SELECT SUM(msd.sub_total) as total_cost 
                FROM machine_repair_details msd 
                LEFT JOIN machine_repairs ms ON msd.repair_id = ms.id
                WHERE ms.repair_in_date LIKE '$date%' AND msd.is_deleted = 0";
        $query = $this->db->query($sql);
        return $query->row_array();

    }

    public function getMachineTypesRepairItemsCount($date)
    {
        $sql = "SELECT mt.name as machine_type_name, COUNT(msd.id) as total_count 
                FROM machine_types mt
                LEFT JOIN machine_ins m on mt.id = m.machine_type_id
                LEFT JOIN machine_repairs ms ON m.id = ms.machine_in_id
                LEFT JOIN machine_repair_details msd ON ms.id = msd.repair_id
                WHERE ms.repair_in_date = '$date' AND msd.is_deleted = 0
                GROUP BY mt.id";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getMachineRepairsCostAnalysisForPDF($filters)
{
    $status        = $filters['status'];
    $repair_type   = $filters['repair_type'];
    $machine_type  = $filters['machine_type'];
    $machine_in_id = $filters['machine_in_id'];
    $date_from     = $filters['date_from'];
    $date_to       = $filters['date_to'];

    $sql = "SELECT msd.*,
                m.s_no,
                m.bar_code,
                mt.name AS machine_type_name,
                ms.repair_in_date,
                msd.repair_type,
                msd.sub_total,
                msd.repair_charge,
                msd.transport_charge,
                msd.remarks,
                (msd.repair_charge + msd.transport_charge) AS total
            FROM machine_repair_details msd
            LEFT JOIN machine_repairs ms ON msd.repair_id = ms.id
            LEFT JOIN machine_ins m ON ms.machine_in_id = m.id
            LEFT JOIN machine_types mt ON m.machine_type_id = mt.id
            WHERE msd.is_deleted = 0 ";

    if ($status !== '') {
        $sql .= " AND msd.is_completed = '$status' ";
    }
    if ($repair_type !== '') {
        $sql .= " AND msd.repair_type = '$repair_type' ";
    }
    if ($machine_type !== '') {
        $sql .= " AND mt.id = '$machine_type' ";
    }
    if ($machine_in_id !== '') {
        $sql .= " AND m.id = '$machine_in_id' ";
    }
    if (!empty($date_from) && !empty($date_to)) {
        $sql .= " AND DATE(ms.repair_in_date) >= '$date_from'
                  AND DATE(ms.repair_in_date) <= '$date_to' ";
    }

    $sql .= " ORDER BY msd.id DESC";

    return $this->db->query($sql)->result_array();
}

public function generateMachineRepairsCostPDF($rows)
{
    $this->load->library('pdf');

    $options = new \Dompdf\Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new \Dompdf\Dompdf($options);

    $html = '
    <html>
    <head>
        <style>
            body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #000; padding: 5px; text-align: center; }
            th { background: #f2f2f2; }
        </style>
    </head>
    <body>
        <h3 style="text-align:center;">MACHINE REPAIRS COST ANALYSIS REPORT</h3>

        <table>
            <thead>
                <tr>
                    <th>Machine Type</th>
                    <th>BarCode</th>
                    <th>Serial No</th>
                    <th>Repair Date</th>
                    <th>Repair Type</th>
                    <th>Sub Total</th>
                    <th>Repair Charge</th>
                    <th>Transport Charge</th>
                    <th>Remarks</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($rows as $r) {
        $html .= '<tr>
            <td>'.$r['machine_type_name'].'</td>
            <td>'.$r['bar_code'].'</td>
            <td>'.$r['s_no'].'</td>
            <td>'.$r['repair_in_date'].'</td>
            <td>'.$r['repair_type'].'</td>
            <td>'.$r['sub_total'].'</td>
            <td>'.$r['repair_charge'].'</td>
            <td>'.$r['transport_charge'].'</td>
            <td>'.$r['remarks'].'</td>
            <td>'.$r['total'].'</td>
        </tr>';
    }

    $html .= '
            </tbody>
        </table>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream("machine_repairs_cost_analysis.pdf", ["Attachment" => 0]);
}




}