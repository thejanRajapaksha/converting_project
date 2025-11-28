<?php
class MachineOverallCostinfo extends CI_Model{

   public function getMachineOverallCostForPDF($filters)
{
    $machinetype = $filters['machinetype'] ?? 0;
    $from_date   = $filters['from_date'] ?? null;
    $to_date     = $filters['to_date'] ?? null;

    $serviceQuery = "
        SELECT 
            mt.name AS machine_type,
            CONCAT(mi.reference, ' (', mi.bar_code, ')') AS machine,
            'Service' AS source,
            sd.sub_total,
            sd.service_charge,
            sd.transport_charge,
            (sd.sub_total + sd.service_charge + sd.transport_charge) AS total
        FROM machine_services s
        INNER JOIN machine_service_details sd ON s.id = sd.service_id
        INNER JOIN machine_ins mi ON s.machine_in_id = mi.id
        LEFT JOIN machine_types mt ON mi.machine_type_id = mt.id
    ";

    $repairQuery = "
        SELECT 
            mt.name AS machine_type,
            CONCAT(mi.reference, ' (', mi.bar_code, ')') AS machine,
            'Repair' AS source,
            rd.sub_total,
            rd.repair_charge AS service_charge,
            NULL AS transport_charge,
            (rd.sub_total + rd.repair_charge) AS total
        FROM machine_repairs r
        INNER JOIN machine_repair_details rd ON r.id = rd.repair_id
        INNER JOIN machine_ins mi ON r.machine_in_id = mi.id
        LEFT JOIN machine_types mt ON mi.machine_type_id = mt.id
    ";

    $baseQuery = "$serviceQuery UNION ALL $repairQuery WHERE 1=1";

    if ($machinetype > 0) {
        $baseQuery .= " AND mt.id = '$machinetype'";
    }

    if (!empty($from_date) && !empty($to_date)) {
        $baseQuery .= " AND DATE(s.created_at) BETWEEN '$from_date' AND '$to_date'";
    }

    $query = $this->db->query($baseQuery);
    return $query->result_array();
}

public function generateMachineOverallCostPDF($rows)
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
        <h3 style="text-align:center;">MACHINE OVERALL COST REPORT</h3>
        <table>
            <thead>
                <tr>
                    <th>Machine Type</th>
                    <th>Machine</th>
                    <th>Source</th>
                    <th>Items Cost</th>
                    <th>Service/Repair Charge</th>
                    <th>Transport Charge</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';

    $grandTotal = 0;
    foreach ($rows as $r) {
        $transport = $r['transport_charge'] ?? 0;
        $charge = $r['service_charge'] ?? 0;
        $total = $r['total'] ?? 0;
        $grandTotal += $total;

        $html .= '<tr>
            <td>' . $r['machine_type'] . '</td>
            <td>' . $r['machine'] . '</td>
            <td>' . $r['source'] . '</td>
            <td>' . number_format($r['sub_total'], 2) . '</td>
            <td>' . number_format($charge, 2) . '</td>
            <td>' . number_format($transport, 2) . '</td>
            <td>' . number_format($total, 2) . '</td>
        </tr>';
    }

    $html .= '<tr>
        <td colspan="6" style="text-align:right;font-weight:bold;">Grand Total</td>
        <td style="text-align:center;font-weight:bold;">' . number_format($grandTotal, 2) . '</td>
    </tr>';

    $html .= '
            </tbody>
        </table>
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("machine_overall_cost_report.pdf", ["Attachment" => 0]);
}


}
