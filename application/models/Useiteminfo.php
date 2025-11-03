<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class Useiteminfo extends CI_Model {


    public function Machinetypeget() {
        $this->db->select('name, id');
        $this->db->from('machine_types');
        $this->db->where('active', 1);
        $respond = $this->db->get();
        return $respond;
    }

    public function Machinemodelget() {
        $this->db->select('name, id');
        $this->db->from('machine_models');
        $this->db->where('active', 1);
        $respond = $this->db->get();
        return $respond;
    }

    public function Machineget() {
        $this->db->select('s_no, id ,reference');
        $this->db->from('machine_ins');
        $this->db->where('active', 1);
        $respond = $this->db->get();
        return $respond;
    }
    public function getModelsByType($typeId) {
        $this->db->select('DISTINCT(mm.id), mm.name');
        $this->db->from('machine_ins mi');
        $this->db->join('machine_models mm', 'mi.machine_model_id = mm.id', 'left');
        $this->db->where('mi.machine_type_id', $typeId);
        $this->db->where('mi.active', 1);
        $this->db->where('mm.active', 1);
        return $this->db->get()->result();
    }
    public function getMachinesByModel($modelId)
    {


        $this->db->select('id, reference, s_no');
        $this->db->from('machine_ins');
        $this->db->where('machine_model_id', $modelId);
        $this->db->where('active', 1); 

        return $this->db->get()->result();
    }


    public function generateUsedItemReportPDF($rows, $filters)
    {
    $this->load->library('pdf');

    $options = new \Dompdf\Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new \Dompdf\Dompdf($options);

    $logo_base64 = $this->getBase64Logo();

    $html = '
    <html>
    <head>
        <style>
            body { font-family: DejaVu Sans, sans-serif; font-size: 11px; }
            table { border-collapse: collapse; width: 100%; }
            th, td { border: 1px solid #000; padding: 5px; text-align: center; }
            th { background-color: #f2f2f2; }
            .header-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
            .logo-container img { max-height: 40px; max-width: 250px; }
            .title-container { text-align: center; flex-grow: 1; }
            .title-container h2 { margin: 0; padding: 0; }
        </style>
    </head>
    <body>
        <div class="header-row">
            <div class="logo-container">
                <img src="' . $logo_base64 . '" alt="Company Logo" />
            </div>
            <div class="title-container">
                <h2>Used Items Report</h2>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Machine Type</th>
                    <th>Machine Model</th>
                    <th>Machine</th>
                    <th>Spare Part</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>';

    foreach ($rows as $r) {
        $html .= '<tr>
            <td>' . htmlspecialchars($r['source']) . '</td>
            <td>' . htmlspecialchars($r['machine_type']) . '</td>
            <td>' . htmlspecialchars($r['machine_model']) . '</td>
            <td>' . htmlspecialchars($r['machine_name']) . '</td>
            <td>' . htmlspecialchars($r['spare_part_name']) . '</td>
            <td>' . htmlspecialchars($r['qty']) . '</td>
        </tr>';
    }

    $html .= '
            </tbody>
        </table>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("Used_Item_Report.pdf", ["Attachment" => 0]);
}

private function getBase64Logo()
    {
        $image_path = FCPATH . 'images/logo1.png';
        if (file_exists($image_path)) {
            $image_data = file_get_contents($image_path);
            $image_type = pathinfo($image_path, PATHINFO_EXTENSION);
            return 'data:image/' . $image_type . ';base64,' . base64_encode($image_data);
        }
        return '';
    }
}